<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'dbh.inc.php';

// Add Team
if (isset($_POST['save_team'])) {
    $coach_id = $_POST['coach_id'];
    $sport_id = $_POST['sport_id'];

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
if (isset($_POST['sport_id'])) {
    $sport_id = $_POST['sport_id'];
    $students = fetchStudentsBySport($sport_id);
    $options = '';
    foreach ($students as $student) {
        $options .= "<option value='{$student['student_id']}'>{$student['student_name']}</option>";
    }
    echo $options;
    exit();
}



// Update Team
if (isset($_POST['update_team'])) {
    $team_id = $_POST['team_id'];
    $coach_id = $_POST['coach_id'];
    $sport_id = $_POST['sport_id'];

    // Convert names to IDs
    $coach_id = getUserIdFromName($coach_name);
    $sport_id = getSportIdFromName($sport_name);
    $student_id = getUserIdFromName($student_name);

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE teams SET coach_id = :coach_id, sport_id = :sport_id, student_id = :student_id WHERE id = :team_id");

    if ($stmt) {
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->bindParam(':sport_id', $sport_id);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':team_id', $team_id);

        try {
            $stmt->execute();
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

// Function to get user ID from name
function getUserIdFromName($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['id'] : null;
}

// Function to get sport ID from name
function getSportIdFromName($sport_name) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM sports WHERE sport_name = :sport_name");
    $stmt->bindParam(':sport_name', $sport_name);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['id'] : null;
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


?>
