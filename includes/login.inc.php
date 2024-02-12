<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // Error handlers
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../admin/index.php"); // Redirect to login page with errors
            die();
        }

        // Retrieve user's role from the database
        $role = $result['role'];

        $newSessionId = password_hash(session_create_id(), PASSWORD_DEFAULT);
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        // Prevent XSS
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["role"] = $role; // Set user's role in session

        // Reset time
        $_SESSION["last_regeneration"] = time();

        // Redirect user to respective dashboard based on their role
        if ($role == 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($role == 'student') {
            header("Location: ../student/student_homepage.php");
        } elseif ($role == 'coach') {
            header("Location: ../coach/coach_homepage.php");
        } else {
            // Handle unexpected role or redirect to a default page
            // Example:
            header("Location: ../admin/index.php");
        }
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location:../admin/index.php");
    die();
}
?>
