<?php
session_start();    // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['userID']) && !isset($_SESSION['adminID'])) {
	 
	 // Need the functions:
	 require ('login_functions.php');
	 redirect_user('loginUser.php');
	    
} else { // Cancel the session:
    
    $_SESSION = array(); // Clear the variables
    session_destroy();	 // Destroy the session
}

// Print a customized message:
echo '<script>alert("You are now logged out!");</script>';
echo '<script>window.location.href = "home.php";</script>';

?>