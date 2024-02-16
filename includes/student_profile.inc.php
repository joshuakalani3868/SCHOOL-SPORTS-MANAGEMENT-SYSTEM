<?php
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];

    // Retrieve current user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify old password
    if (!password_verify($old_password, $user['password'])) {
        $_SESSION['message'] = "Incorrect old password.";
        header("Location: student_profile.php");
        exit();
    }

    // Check if new password matches confirmation password
    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = "New password and confirm password do not match.";
        header("Location: student_profile.php");
        exit();
    }

    // Hash the new password if it's provided
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    } else {
        // Use the old password if new password is not provided
        $hashed_password = $user['password'];
    }

    // Update user profile
    $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ?, email = ?, age = ?, gender = ?, phone_number = ? WHERE id = ?");
    $stmt->execute([$username, $hashed_password, $email, $age, $gender, $phone_number, $user_id]);

    $_SESSION['message'] = "Profile updated successfully!";
    header("Location: student_homepage.php");
    exit();
}
?>
