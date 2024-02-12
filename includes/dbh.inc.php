<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$dbname = 'ssms';
$dbusername = 'root';
$dbpassword = '';

// Establish PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Establish mysqli connection
$con = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to delete a user by ID
/*function deleteUser($pdo, $user_id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);

    try {
        $stmt->execute();
        return true; // Deletion successful
    } catch (PDOException $e) {
        return false; // Deletion failed
    }
}*/
?>
