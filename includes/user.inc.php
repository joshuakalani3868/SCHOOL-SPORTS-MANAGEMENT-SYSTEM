<?php
session_start();
require 'dbh.inc.php';

// Adding user
if (isset($_POST['save_user'])) {
    $name = $_POST['name'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];
    $role = $_POST['role']; // New role field
    $age = $_POST['age']; // New age field
    $gender = $_POST['gender']; // New gender field
    $phone_number = $_POST['phone_number']; // New phone_number field

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO users (username, pwd, email, role, age, gender, phone_number) VALUES (:name, :password, :email, :role, :age, :gender, :phone_number)");

    if ($stmt) {
        $stmt->bindParam(':name', $name);
        // Update password hashing algorithm to match login.inc.php
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role); // Bind role parameter
        $stmt->bindParam(':age', $age); // Bind age parameter
        $stmt->bindParam(':gender', $gender); // Bind gender parameter
        $stmt->bindParam(':phone_number', $phone_number); // Bind phone_number parameter

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
    $role = $_POST['role']; // New role field
    $age = $_POST['age']; // New age field
    $gender = $_POST['gender']; // New gender field
    $phone_number = $_POST['phone_number']; // New phone_number field
    
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE users SET username = :name, pwd = :password, email = :email, role = :role, age = :age, gender = :gender, phone_number = :phone_number WHERE id = :user_id");

    if ($stmt) {
        $stmt->bindParam(':name', $name);
        // Update password hashing algorithm to match login.inc.php
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role); // Bind role parameter
        $stmt->bindParam(':age', $age); // Bind age parameter
        $stmt->bindParam(':gender', $gender); // Bind gender parameter
        $stmt->bindParam(':phone_number', $phone_number); // Bind phone_number parameter
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

// Update user profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];

    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE users SET age = ?, gender = ?, phone_number = ? WHERE id = ?");
    $stmt->execute([$age, $gender, $phone_number, $user_id]);

    $_SESSION['message'] = "Profile updated successfully!";
    header("Location: student_homepage.php");
    exit();
}
?>
