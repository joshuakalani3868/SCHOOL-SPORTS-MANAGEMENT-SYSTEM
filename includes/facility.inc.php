<?php

session_start();
require 'dbh.inc.php';

// Adding facility
if (isset($_POST['save_facility'])) {
    $facility_name = $_POST['facility_name'];
    $facility_type = $_POST['facility_type'];
    $sports_available = $_POST['sports_available'];
    $capacity = $_POST['capacity'];
    $operating_time = $_POST['operating_time'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO facilities (facility_name, facility_type, sports_available, capacity, operating_time) VALUES (:facility_name, :facility_type, :sports_available, :capacity, :operating_time)");

    if ($stmt) {
        $stmt->bindParam(':facility_name', $facility_name);
        $stmt->bindParam(':facility_type', $facility_type);
        $stmt->bindParam(':sports_available', $sports_available);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':operating_time', $operating_time);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Facility created successfully!";
            header("Location: ../admin/facility_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Facility not created!";
            header("Location: ../admin/facility_create.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/facility_create.php");
        exit(0);
    }
}

// Updating facility
if (isset($_POST['update_facility'])) {
    $facility_id = $_POST['facility_id']; // Assuming you have a hidden input in your form for facility_id
    $facility_name = $_POST['facility_name'];
    $facility_type = $_POST['facility_type'];
    $sports_available = $_POST['sports_available'];
    $capacity = $_POST['capacity'];
    $operating_time = $_POST['operating_time'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE facilities SET facility_name = :facility_name, facility_type = :facility_type, sports_available = :sports_available, capacity = :capacity, operating_time = :operating_time WHERE id = :facility_id");

    if ($stmt) {
        $stmt->bindParam(':facility_name', $facility_name);
        $stmt->bindParam(':facility_type', $facility_type);
        $stmt->bindParam(':sports_available', $sports_available);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':operating_time', $operating_time);
        $stmt->bindParam(':facility_id', $facility_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Facility updated successfully!";
            header("Location: ../admin/facility_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Facility not updated!";
            header("Location: ../admin/facility_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/facility_details.php");
        exit(0);
    }
}

// Delete facility
if(isset($_POST['delete_facility'])) {
    $facility_id = $_POST['delete_facility'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM facilities WHERE id = :facility_id");

    if ($stmt) {
        $stmt->bindParam(':facility_id', $facility_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Facility deleted successfully!";
            header("Location: ../admin/facility_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete facility! Error: " . $e->getMessage(); // Include error message for debugging
            header("Location: ../admin/facility_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/facility_details.php");
        exit(0);
    }
}
?>
