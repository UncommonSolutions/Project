<?php
SESSION_START();

require_once ("./includes/security.php");

$_SESSION = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.
setcookie (session_name(), '', time()-300, '/', '', 0); // Destroy the cookie.

// Start defining the URL.
	redirect('/login.php');
?>