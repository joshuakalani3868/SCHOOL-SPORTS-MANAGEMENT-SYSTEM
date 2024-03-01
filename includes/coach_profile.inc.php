<?php
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin/index.php");
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
echo "Old password from form: " . $old_password . "<br>";
echo "Hashed password from database: " . $user['pwd'] . "<br>";
if (!password_verify($old_password, $user['pwd'])) {
    $_SESSION['message'] = "Incorrect old password.";
    header("Location: ../coach/coach_profile.php");
    exit();
}

    // Check if new password matches confirmation password
    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = "New password and confirm password do not match.";
        header("Location: ../coach/coach_profile.php");
        exit();
    }

    // Hash the new password using the same algorithm as login
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update user profile
$stmt = $pdo->prepare("UPDATE users SET username = ?, pwd = ?, email = ?, age = ?, gender = ?, phone_number = ? WHERE id = ?");
$stmt->execute([$username, $hashed_password, $email, $age, $gender, $phone_number, $user_id]);

$_SESSION['message'] = "Profile updated successfully!";
header("Location: ../coach/coach_profile.php");
exit();
}

?>
