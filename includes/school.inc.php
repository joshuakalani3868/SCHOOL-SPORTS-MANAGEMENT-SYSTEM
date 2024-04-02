<?php
session_start();
require 'dbh.inc.php';

// Adding school
if (isset($_POST['save_school'])) {
    $school_name = $_POST['school_name'];
    $school_location = $_POST['school_location'];
    $contact_person_name = $_POST['contact_person_name'];
    $contact_person_email = $_POST['contact_person_email'];
    $contact_person_phone = $_POST['contact_person_phone'];
    $is_host = $_POST['is_host'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO Schools (school_name, school_location, contact_person_name, contact_person_email, contact_person_phone, is_host) VALUES (:school_name, :school_location, :contact_person_name, :contact_person_email, :contact_person_phone, :is_host)");

    if ($stmt) {
        $stmt->bindParam(':school_name', $school_name);
        $stmt->bindParam(':school_location', $school_location);
        $stmt->bindParam(':contact_person_name', $contact_person_name);
        $stmt->bindParam(':contact_person_email', $contact_person_email);
        $stmt->bindParam(':contact_person_phone', $contact_person_phone);
        $stmt->bindParam(':is_host', $is_host);

        try {
            $stmt->execute();
            $_SESSION['message'] = "School added successfully!";
            header("Location: ../admin/school_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to add school!";
            header("Location: ../admin/school_create.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/school_create.php");
        exit(0);
    }
}

// Updating school
if (isset($_POST['update_school'])) {
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];
    $school_location = $_POST['school_location'];
    $contact_person_name = $_POST['contact_person_name'];
    $contact_person_email = $_POST['contact_person_email'];
    $contact_person_phone = $_POST['contact_person_phone'];
    $is_host = $_POST['is_host'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE Schools SET school_name = :school_name, school_location = :school_location, contact_person_name = :contact_person_name, contact_person_email = :contact_person_email, contact_person_phone = :contact_person_phone, is_host = :is_host WHERE school_id = :school_id");

    if ($stmt) {
        $stmt->bindParam(':school_name', $school_name);
        $stmt->bindParam(':school_location', $school_location);
        $stmt->bindParam(':contact_person_name', $contact_person_name);
        $stmt->bindParam(':contact_person_email', $contact_person_email);
        $stmt->bindParam(':contact_person_phone', $contact_person_phone);
        $stmt->bindParam(':is_host', $is_host);
        $stmt->bindParam(':school_id', $school_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "School updated successfully!";
            header("Location: ../admin/school_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to update school!";
            header("Location: ../admin/school_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/school_details.php");
        exit(0);
    }
}

// Delete school
if(isset($_POST['delete_school'])) {
    $school_id = $_POST['delete_school'];
    
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM Schools WHERE school_id = :school_id");

    if ($stmt) {
        $stmt->bindParam(':school_id', $school_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "School deleted successfully!";
            header("Location: ../admin/school_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete school!";
            header("Location: ../admin/school_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/school_details.php");
        exit(0);
    }
}
?>
