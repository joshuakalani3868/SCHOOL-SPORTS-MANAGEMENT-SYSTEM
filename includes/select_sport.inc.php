<?php
// Start the session
session_start();

// Include database connection
include 'dbh.inc.php';

// Check if a sport is selected or to be removed
if (isset($_POST['selected_sport'])) {
    // Retrieve selected sport ID from the POST request
    $selected_sport = $_POST['selected_sport'];

    // user ID is stored in a session variable
    $student_id = $_SESSION['user_id'];

    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Check if the student has previously selected a sport
        $stmt_check = $pdo->prepare("SELECT sport_id FROM student_sports WHERE student_id = :student_id");
        $stmt_check->bindParam(':student_id', $student_id);
        $stmt_check->execute();
        $previous_sport = $stmt_check->fetchColumn();

        if ($previous_sport) {
            // Delete the previously selected sport for the current user from the Student_Sports table
            $stmt_remove = $pdo->prepare("DELETE FROM student_sports WHERE student_id = :student_id AND sport_id = :sport_id");
            $stmt_remove->bindParam(':student_id', $student_id);
            $stmt_remove->bindParam(':sport_id', $previous_sport);
            $stmt_remove->execute();

            $_SESSION['message'] = "Previous sport removed successfully!";
        } else {
            $_SESSION['message'] = "No previous sport selected.";
        }

        // Insert newly selected sport into Student_Sports table
        $stmt_insert = $pdo->prepare("INSERT INTO student_sports (student_id, sport_id) VALUES (:student_id, :sport_id)");
        $stmt_insert->bindParam(':student_id', $student_id);
        $stmt_insert->bindParam(':sport_id', $selected_sport);
        $stmt_insert->execute();

        // Commit the transaction
        $pdo->commit();

        // Provide feedback to the user upon successful submission
        $_SESSION['message'] = "New sport selected successfully!";
    } catch (PDOException $e) {
        // Rollback the transaction in case of error
        $pdo->rollBack();

        // Handle database errors
        $_SESSION['message'] = "Error: " . $e->getMessage();
    }
} else {
    // Redirect back to the sports selection page if no action is specified
    $_SESSION['message'] = "select another sport.";
}

// Redirect back to the sports selection page
header("Location: ../student/student_sport.php");
exit();
?>
