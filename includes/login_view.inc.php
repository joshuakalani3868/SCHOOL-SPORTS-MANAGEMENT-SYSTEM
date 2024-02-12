<?php
declare(strict_types=1);

// Check and display login errors
function check_login_errors() {
    // Check if there are errors in the session
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        // Display each error in a paragraph
        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        // Remove information from the session after displaying errors
        unset($_SESSION["errors_login"]);
    } elseif (isset($_GET['login']) && $_GET['login'] === "success") {
        // Do something if login is successful
    }
}
?>
