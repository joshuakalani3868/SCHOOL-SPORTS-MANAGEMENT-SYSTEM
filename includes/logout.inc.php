<?php
// Start or resume a session
session_start();

// Destroy the session data
session_destroy();

// Redirect the user to the login/signup form
header("Location:../admin/index.php");
exit();
?>
