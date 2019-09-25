<?php 

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 
echo '<script type="text/javascript">
<!--
window.location = "../index.php?action=notauth&message=you are entering the wrong rooms"
//-->
</script>';


	exit;
}
?>