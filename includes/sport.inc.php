<?php

session_start();
require 'dbh.inc.php';

// Adding sport
if (isset($_POST['save_sport'])) {
    $sport_name = $_POST['sport_name'];
    $sport_type = $_POST['sport_type'];
    $game_type = $_POST['game_type'];
    $number_of_players = $_POST['number_of_players'];
    $facility_type = $_POST['facility_type'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO sports (sport_name, sport_type, game_type, number_of_players, facility_type) VALUES (:sport_name, :sport_type, :game_type, :number_of_players, :facility_type)");

    if ($stmt) {
        $stmt->bindParam(':sport_name', $sport_name);
        $stmt->bindParam(':sport_type', $sport_type);
        $stmt->bindParam(':game_type', $game_type);
        $stmt->bindParam(':number_of_players', $number_of_players);
        $stmt->bindParam(':facility_type', $facility_type);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Sport created successfully!";
            header("Location: ../admin/sport_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Sport not created!";
            header("Location: ../admin/sport_create.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/sport_create.php");
        exit(0);
    }
}

// Updating sport
if (isset($_POST['update_sport'])) {
    $sport_id = $_POST['sport_id']; // Assuming you have a hidden input in your form for sport_id
    $sport_name = $_POST['sport_name'];
    $sport_type = $_POST['sport_type'];
    $game_type = $_POST['game_type'];
    $number_of_players = $_POST['number_of_players'];
    $facility_type = $_POST['facility_type'];
    
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE sports SET sport_name = :sport_name, sport_type = :sport_type, game_type = :game_type, number_of_players = :number_of_players, facility_type = :facility_type WHERE id = :sport_id");

    if ($stmt) {
        $stmt->bindParam(':sport_name', $sport_name);
        $stmt->bindParam(':sport_type', $sport_type);
        $stmt->bindParam(':game_type', $game_type);
        $stmt->bindParam(':number_of_players', $number_of_players);
        $stmt->bindParam(':facility_type', $facility_type);
        $stmt->bindParam(':sport_id', $sport_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Sport updated successfully!";
            header("Location: ../admin/sport_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Sport not updated!";
            header("Location: ../admin/sport_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/sport_details.php");
        exit(0);
    }
}

// Delete sport
if(isset($_POST['delete_sport'])) {
    $sport_id = $_POST['delete_sport'];
    
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM sports WHERE id = :sport_id");

    if ($stmt) {
        $stmt->bindParam(':sport_id', $sport_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "Sport deleted successfully!";
            header("Location: ../admin/sport_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete sport! Error: " . $e->getMessage(); // Include error message for debugging
            header("Location: ../admin/sport_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/sport_details.php");
        exit(0);
    }
}
