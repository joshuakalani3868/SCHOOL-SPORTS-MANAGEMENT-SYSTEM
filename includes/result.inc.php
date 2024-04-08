<?php
// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'dbh.inc.php';

// Adding result
if (isset($_POST['save_result'])) {
    // Retrieve data from the form
    $event_id = $_POST['event_id'];
    $sport_id = $_POST['sport_id'];
    $sport_type = $_POST['sport_type'];
    $rank = $_POST['rank'];
    $score_line = $_POST['score_line'];
    $draw_a_id = $_POST['draw_a_id'];
    $draw_b_id = $_POST['draw_b_id'];

    // Set student_id to NULL if "None" option is selected
    $student_id = ($_POST['student_id'] !== 'none') ? $_POST['student_id'] : null;

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO results (event_id, sport_id, student_id, sport_type, rank, score_line, draw_a_id, draw_b_id) VALUES (:event_id, :sport_id, :student_id, :sport_type, :rank, :score_line, :draw_a_id, :draw_b_id)");

    if ($stmt) {
        // Bind parameters
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':sport_id', $sport_id);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':sport_type', $sport_type);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':score_line', $score_line);
        $stmt->bindParam(':draw_a_id', $draw_a_id);
        $stmt->bindParam(':draw_b_id', $draw_b_id);

        // Execute the statement
        try {
            $stmt->execute();
            $_SESSION['message'] = "Result created successfully!";
            header("Location: ../admin/result_details.php");
            exit(0);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $_SESSION['message'] = "Result not created! Error: " . $e->getMessage(); // Include the error message in the session
            header("Location: ../admin/result_create.php"); // Redirect back to the create result page
            exit(0); // Terminate script execution
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/result_create.php");
        exit(0);
    }
}

// Updating result
if (isset($_POST['update_result'])) {
    // Retrieve data from the form
    $result_id = $_POST['result_id'];
    $event_id = $_POST['event_id'];
    $sport_id = $_POST['sport_id'];
    $sport_type = $_POST['sport_type'];
    $rank = $_POST['rank'];
    $score_line = $_POST['score_line'];
    $draw_a_id = $_POST['draw_a_id'];
    $draw_b_id = $_POST['draw_b_id'];

    // Set student_id to NULL if "None" option is selected
    $student_id = ($_POST['student_id'] !== 'none') ? $_POST['student_id'] : null;

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE results SET event_id = :event_id, sport_id = :sport_id, student_id = :student_id, sport_type = :sport_type, rank = :rank, score_line = :score_line, draw_a_id = :draw_a_id, draw_b_id = :draw_b_id WHERE id = :result_id");

    if ($stmt) {
        // Bind parameters
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':sport_id', $sport_id);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':sport_type', $sport_type);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':score_line', $score_line);
        $stmt->bindParam(':draw_a_id', $draw_a_id);
        $stmt->bindParam(':draw_b_id', $draw_b_id);
        $stmt->bindParam(':result_id', $result_id);

        // Execute the statement
        try {
            $stmt->execute();
            $_SESSION['message'] = "Result updated successfully!";
            header("Location: ../admin/result_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Result not updated!";
            echo "Error: " . $e->getMessage();
            header("Location: ../admin/result_details.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/result_details.php");
        exit(0);
    }
}

// Delete result
if(isset($_POST['delete_result'])) {
    // Retrieve result ID from the form
    $result_id = $_POST['delete_result'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM results WHERE id = :result_id");

    if ($stmt) {
        // Bind parameter
        $stmt->bindParam(':result_id', $result_id);

        // Execute the statement
        try {
            $stmt->execute();
            $_SESSION['message'] = "Result deleted successfully!";
            header("Location: ../admin/result_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete result! Error: " . $e->getMessage();
            header("Location: ../admin/result_details.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/result_details.php");
        exit(0);
    }
}

// Function to fetch events from the database
function fetchEvents() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT id, event_name FROM events");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

// Function to fetch sports from the database
function fetchSports() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT id, sport_name FROM sports");
        $sports = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $sports;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

// Function to fetch schools from the database
function fetchSchools() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT school_id, school_name FROM schools");
        $schools = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $schools;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

// Function to fetch students from the database
function fetchStudents() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT t.student_id, u.username AS student_name FROM teams t JOIN users u ON t.student_id = u.id");
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $students;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}
?>
