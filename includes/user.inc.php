<?php
session_start();
require 'dbh.inc.php';

// Adding user
if (isset($_POST['save_user'])) {
    $name = $_POST['name'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO users (username, pwd, email) VALUES (:name, :password, :email)");

    if ($stmt) {
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        try {
            $stmt->execute();
            $_SESSION['message'] = "User created successfully!";
            header("Location: ../admin/user_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "User not created!";
            header("Location: ../admin/user_create.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/user_create.php");
        exit(0);
    }
}

// Updating user
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id']; // Assuming you have a hidden input in your form for user_id
    $name = $_POST['name'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];
joshua:
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE users SET username = :name, pwd = :password, email = :email WHERE id = :user_id");

    if ($stmt) {
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_id', $user_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "User updated successfully!";
            header("Location: ../admin/user_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "User not updated!";
            header("Location: ../admin/user_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/user_details.php");
        exit(0);
    }
}

// Delete user
if(isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];
    
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");

    if ($stmt) {
        $stmt->bindParam(':user_id', $user_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "User deleted successfully!";
            header("Location: ../admin/user_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete user! Error: " . $e->getMessage(); // Include error message for debugging
            header("Location: ../admin/user_details.php");
            exit(0);
        }
    } else {
        // Handle the case where $stmt is not created
        $_SESSION['message'] = "Failed to prepare the statement!";
        header("Location: ../admin/user_details.php");
        exit(0);
    }
}

// Check if the delete button is clicked
/*if(isset($_POST['delete_user'])) {
    // Retrieve the user ID from the form
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);
    
    // SQL query to delete the user with the specified ID
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "User deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting user";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to user_details.php
    header("Location: user_details.php");
    exit();
}*/
?>
