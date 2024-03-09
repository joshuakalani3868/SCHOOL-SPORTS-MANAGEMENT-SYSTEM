<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'dbh.inc.php';

// Add Team
if (isset($_POST['save_team'])) {
    $coach_id = $_POST['coach_id'];
    $sport_id = $_POST['sport_id'];

    // Check if the coach is already paired with the selected sport
$existing_pair = checkCoachSportPair($coach_id, $sport_id);
if ($existing_pair) {
    $_SESSION['message'] = "Coach already Picked .";
    header("Location: ../admin/team_create.php");
    exit();
}


    // Fetch students who selected the given sport
    $students = fetchStudentsBySport($sport_id);

    // Check if there are any students for the given sport
    if (empty($students)) {
        $_SESSION['message'] = "No students found for the selected sport.";
        header("Location: ../admin/team_create.php");
        exit();
    }

    // Prepare the array to hold student IDs
    $student_ids = array();
    foreach ($students as $student) {
        $student_ids[] = $student['student_id'];
    }

    try {
        // Prepare the SQL statement
        $sql = "INSERT INTO teams (coach_id, sport_id, student_id) VALUES (:coach_id, :sport_id, :student_id)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->bindParam(':sport_id', $sport_id);

        // Insert each student ID in the same row
        foreach ($student_ids as $student_id) {
            $stmt->bindParam(':student_id', $student_id);
            $stmt->execute();
        }

        $_SESSION['message'] = "Teams created successfully!";
        header("Location: ../admin/team_details.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = "Failed to create Team: " . $e->getMessage();
        header("Location: ../admin/team_create.php");
        exit();
    }
}

// Fetch students based on sport_id
/*if (isset($_POST['sport_id'])) {
    $sport_id = $_POST['sport_id'];
    $students = fetchStudentsBySport($sport_id);
    $options = '';
    foreach ($students as $student) {
        $options .= "<option value='{$student['student_id']}'>{$student['student_name']}</option>";
    }
    echo $options;
    exit();
}*/

// Update Team
if (isset($_POST['update_team'])) {
    $team_id = $_POST['team_id'];
    $coach_id = $_POST['coach_id'];
    $sport_id = $_POST['sport_id'];

    // Fetch students who selected the updated sport
    $students = fetchStudentsBySport($sport_id);

    // Check if there are any students for the updated sport
    if (empty($students)) {
        $_SESSION['message'] = "No students found for the selected sport.";
        header("Location: ../admin/team_details.php");
        exit();
    }

    // Prepare the array to hold student IDs
    $student_ids = array();
    foreach ($students as $student) {
        $student_ids[] = $student['student_id'];
    }

    // Using prepared statements to prevent SQL injection
    $updateStmt = $pdo->prepare("UPDATE teams SET coach_id = :coach_id, sport_id = :sport_id WHERE id = :team_id");

    if ($updateStmt) {
        $updateStmt->bindParam(':coach_id', $coach_id);
        $updateStmt->bindParam(':sport_id', $sport_id);
        $updateStmt->bindParam(':team_id', $team_id);

        try {
            $updateStmt->execute();

            // Delete existing team-student associations for the updated team
            $deleteStmt = $pdo->prepare("DELETE FROM teams WHERE id = :team_id");
            $deleteStmt->bindParam(':team_id', $team_id);
            $deleteStmt->execute();

            // Insert updated team-student associations, avoiding duplicates
            $insertStmt = $pdo->prepare("INSERT INTO teams (coach_id, sport_id, student_id) VALUES (:coach_id, :sport_id, :student_id)");
            $insertStmt->bindParam(':coach_id', $coach_id);
            $insertStmt->bindParam(':sport_id', $sport_id);

            foreach ($student_ids as $student_id) {
                // Check if the association already exists before inserting
                $existing_pair = checkTeamAssociation($team_id, $coach_id, $sport_id, $student_id);
                if (!$existing_pair) {
                    $insertStmt->bindParam(':student_id', $student_id);
                    $insertStmt->execute();
                }
            }

            $_SESSION['message'] = "Team updated successfully!";
            header("Location: ../admin/team_details.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to update Team: " . $e->getMessage();
            header("Location: ../admin/team_details.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/team_details.php");
        exit();
    }
}

// Function to check if team association already exists
function checkTeamAssociation($team_id, $coach_id, $sport_id, $student_id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM teams WHERE id != :team_id AND coach_id = :coach_id AND sport_id = :sport_id AND student_id = :student_id");
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->bindParam(':sport_id', $sport_id);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        return $count > 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}




// Delete Team
if (isset($_POST['delete_team'])) {
    $team_id = $_POST['delete_team'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM teams WHERE id = :team_id");

    if ($stmt) {
        $stmt->bindParam(':team_id', $team_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Team deleted successfully!";
            header("Location: ../admin/team_details.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete Team: " . $e->getMessage();
            header("Location: ../admin/team_details.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/team_details.php");
        exit();
    }
}

// Function to fetch coaches from the database
function fetchCoaches()
{
    global $pdo; // Assuming $pdo is your database connection object

    try {
        // Query to fetch only coaches from the users table based on their role
        $stmt = $pdo->prepare("SELECT id, username FROM users WHERE role = 'coach'");
        $stmt->execute();

        // Fetch all rows as associative array
        $coaches = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $coaches;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array if there's an error
    }
}

// Function to fetch sports from the database
function fetchSports()
{
    global $pdo; // Assuming $pdo is your database connection object

    try {
        // Query to fetch sports from the sports table
        $stmt = $pdo->prepare("SELECT id, sport_name FROM sports");
        $stmt->execute();

        // Fetch all rows as associative array
        $sports = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sports;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array if there's an error
    }
}

// Function to fetch students by sport from the database
function fetchStudentsBySport($sport_id)
{
    global $pdo; // Assuming $pdo is your database connection object

    try {
        $stmt = $pdo->prepare("
            SELECT users.id AS student_id, users.username AS student_name
            FROM users
            INNER JOIN student_sports ON users.id = student_sports.student_id
            WHERE student_sports.sport_id = :sport_id
        ");
        $stmt->bindParam(':sport_id', $sport_id);
        $stmt->execute();

        // Fetch all rows as associative array
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $students;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array if there's an error
    }
}

// Function to check if a coach is already paired with any sport
function checkCoachSportPair($coach_id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM teams WHERE coach_id = :coach_id");
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        return ($count > 0);
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return false;
    }
}


?>
