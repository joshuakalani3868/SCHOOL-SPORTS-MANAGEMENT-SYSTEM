<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'dbh.inc.php';

// Update Team
if (isset($_POST['update_team'])) {
    $team_id = $_POST['team_id'];
    $coach_id = $_POST['coach_id'];
    $sport_id = $_POST['sport_id'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE teams SET coach_id = :coach_id, sport_id = :sport_id WHERE id = :team_id");

    if ($stmt) {
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->bindParam(':sport_id', $sport_id);
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
