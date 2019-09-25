<?php
//*
// logout.php
// All Sections
// Logout user and return to login page
//*


session_start();

// modification
unset($_SESSION['UserId']);
unset($_SESSION['UserType']);
//session_unregister("UserId");
//session_unregister("UserType");
header("Location: index");
?>