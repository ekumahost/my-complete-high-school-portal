<?php 
$title="Password Control";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

?>

<div align="center"><iframe style="border-bottom-color:#FFFFFF" src="ajax/change_pass.php" width="80%" height="350">This browser cannot allow this. use current version of Chrome </iframe> </div>