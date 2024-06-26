<?php

session_start();
require 'dbh.inc.php';

// Adding event
if (isset($_POST['save_event'])) {
    $event_name = $_POST['event_name'];
    $facility_name = $_POST['facility_name']; // Add facility_name
    $facility_type = $_POST['facility_type']; // Add facility_type
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $event_time = $_POST['event_time'];
    $host_school = $_POST['host_school']; // Add host_school
    $participant_schools = implode(',', $_POST['participant_school']); // Modified to handle multiple selected schools

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO events (event_name, facility_name, facility_type, description, start_date, end_date, event_time, host_school, participant_school) VALUES (:event_name, :facility_name, :facility_type, :description, :start_date, :end_date, :event_time, :host_school, :participant_schools)");

    if ($stmt) {
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':facility_name', $facility_name);
        $stmt->bindParam(':facility_type', $facility_type); // Bind facility_type parameter
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':event_time', $event_time);
        $stmt->bindParam(':host_school', $host_school);
        $stmt->bindParam(':participant_schools', $participant_schools); // Modify binding to participant_schools

        try {
            $stmt->execute();
            $_SESSION['message'] = "Event created successfully!";
            header("Location: ../admin/event_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Event not created!";
            header("Location: ../admin/event_create.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/event_create.php");
        exit(0);
    }
}

// Updating event
if (isset($_POST['update_event'])) {
    $event_id = $_POST['event_id']; // Assuming you have a hidden input in your form for event_id
    $event_name = $_POST['event_name'];
    $facility_name = $_POST['facility_name']; // Add facility_name
    $facility_type = $_POST['facility_type']; // Add facility_type
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $event_time = $_POST['event_time'];
    $host_school = $_POST['host_school']; // Add host_school
    $participant_schools = implode(',', $_POST['participant_school']); // Modified to handle multiple selected schools

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE events SET event_name = :event_name, facility_name = :facility_name, facility_type = :facility_type, description = :description, start_date = :start_date, end_date = :end_date, event_time = :event_time, host_school = :host_school, participant_school = :participant_schools WHERE id = :event_id");

    if ($stmt) {
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':facility_name', $facility_name);
        $stmt->bindParam(':facility_type', $facility_type); // Bind facility_type parameter
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':event_time', $event_time);
        $stmt->bindParam(':host_school', $host_school);
        $stmt->bindParam(':participant_schools', $participant_schools); // Modify binding to participant_schools
        $stmt->bindParam(':event_id', $event_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Event updated successfully!";
            header("Location: ../admin/event_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Event not updated!";
            header("Location: ../admin/event_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/event_details.php");
        exit(0);
    }
}

// Delete event
if (isset($_POST['delete_event'])) {
    $event_id = $_POST['delete_event'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :event_id");

    if ($stmt) {
        $stmt->bindParam(':event_id', $event_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Event deleted successfully!";
            header("Location: ../admin/event_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete event! Error: " . $e->getMessage(); // Include error message for debugging
            header("Location: ../admin/event_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/event_details.php");
        exit(0);
    }
}

// Function to fetch facilities from the database
function fetchFacilities() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT id, facility_name FROM facilities"); // Adjust query according to your database structure
        $facilities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $facilities;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

// Function to fetch schools where is_host = 'host'
function fetchHostSchools() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT school_name FROM Schools WHERE is_host = 'host'"); // Only fetching school names
        $schools = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $schools;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

// Function to fetch schools where is_host = 'participant'
function fetchParticipantSchools() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT school_name FROM Schools WHERE is_host = 'participant'"); // Only fetching school names
        $schools = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $schools;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

?>
