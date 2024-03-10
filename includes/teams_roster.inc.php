<?php
session_start();
require 'dbh.inc.php';

// Adding teams roster
if (isset($_POST['save_roster'])) {
    $coach_id = $_SESSION['user_id']; // Assuming coach ID is stored in the session
    $day_of_week = $_POST['day_of_week'];
    $activity_time_range = $_POST['activity_time_range'];
    $activity_description = $_POST['activity_description'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO teams_roster (coach_id, day_of_week, activity_time_range, activity_description) VALUES (:coach_id, :day_of_week, :activity_time_range, :activity_description)");

    if ($stmt) {
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->bindParam(':day_of_week', $day_of_week);
        $stmt->bindParam(':activity_time_range', $activity_time_range);
        $stmt->bindParam(':activity_description', $activity_description);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Roster created successfully!";
            header("Location: ../coach/teams_roster_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Roster not created!";
            header("Location: ../coach/teams_roster_create.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../coach/teams_roster_create.php");
        exit(0);
    }
}

// Updating teams roster
if (isset($_POST['update_roster'])) {
    $roster_id = $_POST['roster_id']; // Assuming you have a hidden input in your form for roster_id
    $day_of_week = $_POST['day_of_week'];
    $activity_time_range = $_POST['activity_time_range'];
    $activity_description = $_POST['activity_description'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE teams_roster SET day_of_week = :day_of_week, activity_time_range = :activity_time_range, activity_description = :activity_description WHERE id = :roster_id");

    if ($stmt) {
        $stmt->bindParam(':day_of_week', $day_of_week);
        $stmt->bindParam(':activity_time_range', $activity_time_range);
        $stmt->bindParam(':activity_description', $activity_description);
        $stmt->bindParam(':roster_id', $roster_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Roster updated successfully!";
            header("Location: ../coach/teams_roster_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Roster not updated!";
            header("Location: ../coach/teams_roster_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../coach/teams_roster_details.php");
        exit(0);
    }
}

// Delete teams roster
if(isset($_POST['delete_roster'])) {
    $roster_id = $_POST['delete_roster'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM teams_roster WHERE id = :roster_id");

    if ($stmt) {
        $stmt->bindParam(':roster_id', $roster_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Roster deleted successfully!";
            header("Location: ../coach/teams_roster_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete roster! Error: " . $e->getMessage(); // Include error message for debugging
            header("Location: ../coach/teams_roster_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../coach/teams_roster_details.php");
        exit(0);
    }
}
?>
