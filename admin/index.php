<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/signup_view.inc.php';
require_once '../includes/login_view.inc.php';

// Check if the user is already logged in, redirect them to the appropriate dashboard
if(isset($_SESSION['username'])) {
    // Check user's role and redirect accordingly
    if ($_SESSION['role'] == 'admin') {
        header("Location:dashboard.php");
        exit;
    } elseif ($_SESSION['role'] == 'student') {
        header("Location: ../student/student_homepage.php");
        exit;
    } elseif ($_SESSION['role'] == 'coach') {
        header("Location: ../coach/coach_homepage.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            background-image: url('../img/pexels-pixabay-274506.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 10px;
        }
    </style>
    <title>Login and Signup Form</title>
</head>

<body>
    <div class="container">
        <div class="login-section">
            <h3>Login</h3>
            <?php check_login_errors(); ?>
            <form action="../includes/login.inc.php" method="post" autocomplete="off">
                <input type="text" name="username" placeholder="Username" value="" autocomplete="off">
                <input type="password" name="pwd" placeholder="Password" value="" autocomplete="off" maxlenght="8">
                <button>Login</button>
            </form>
        </div>

        <div class="signup-section">
            <h3>Signup</h3>
            <form action="../includes/signup.inc.php" method="post" autocomplete="off">
                <input type="text" name="username" placeholder="Username" value="" autocomplete="off">
                <input type="password" name="pwd" placeholder="Password" value="" autocomplete="off" maxlenght="8">
                <input type="email" name="email" placeholder="E-Mail" value="" autocomplete="off">
                <button>Sign Up</button>
            </form>
            <?php check_signup_errors(); ?>
        </div>
    </div>
</body>
</html>
