<?php
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin/index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/coach_profile.css">
</head>
<?php include('../includes/coach_header.inc.php'); ?>
<body>
    <div class="container">
        <h1>Update Profile</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <p><?= $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form action="../includes/coach_profile.inc.php" method="post">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= $user['username'] ?>" readonly><br>

            <label for="old_password">Old Password:</label>
            <input type="password" name="old_password" id="old_password" required><br>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password"><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password"><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required><br>

            <label for="age">Age:</label>
            <input type="number" name="age" id="age" value="<?= $user['age'] ?>" required><br>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="male" <?= ($user['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= ($user['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= ($user['gender'] == 'other') ? 'selected' : '' ?>>Other</option>
            </select><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" value="<?= $user['phone_number'] ?>" required><br>

            <button type="submit">Update</button>
           
        </form>
    </div>
</body>
</html>
