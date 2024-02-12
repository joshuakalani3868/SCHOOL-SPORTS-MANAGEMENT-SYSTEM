<?php

declare(strict_types=1);

// Check if errors are stored in session
function check_signup_errors()
{
    if (isset($_SESSION['error_signup'])) {
        $errors = $_SESSION['error_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-errors"> ' . $error . ' </p>';
        }

        unset($_SESSION['error_signup']);
        //check get method  inside url
    } else if (isset($_GET["signup"]) && $_GET["signup"] ==="success") {
        echo'<br>';
        echo '<p class="form-success">Signup success!</p>';
    }
}
