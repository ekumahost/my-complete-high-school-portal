<?php 
$title="mass Email";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

?>

<center><iframe src="fancyadmin/admin_mass_email.php" width="100%" align="middle" height="500"> </iframe></center>




