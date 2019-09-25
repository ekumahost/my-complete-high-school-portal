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
unset($_SESSION['CurrentYear']);
unset($_SESSION['LAST_ACTIVITY']);
unset($_SESSION['UserType']);
unset($_SESSION['CurrentTerm']);
//admission grade sessions
unset($_SESSION['adbatch']);	
unset($_SESSION['adgrade']);	



//session_unregister("UserId");
//session_unregister("UserType");
header("Location: ../home");
?>