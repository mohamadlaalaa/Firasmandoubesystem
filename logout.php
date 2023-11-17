<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Return a response (you can customize this as needed)
echo "Logged out successfully";
?>