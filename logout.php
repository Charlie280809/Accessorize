<?php
session_start(); // Start the session
session_destroy(); // Destroy the session
header('Location: login.php'); // Redirect to login page
exit(); // Ensure no further code is executed
?>