<?php
include("tools/secure.php");	
		
 $action = @$_GET["action"];
// gets permission
 $operator = @$_GET["operator"]; 
 $page = @$_GET["page"];			
		
function LoadConfigPage(){
$myp = new MyPublican;
 
	global $action,$operator,$page,$db;
 
	if ($action =="edit" && $operator == "admin" && $page == "configindex"){

	//if ($action =="edit"){

		// before loading the page, lets hide the welcome div say hide the changerbody div
		/**/ echo "<script> 
				$(document).ready(function(){
				 $('#changerbody').hide();
				});
				</script>"; 
					
		include("ajax/school_config.php");
		
		//echo "WE HAVE SEEN ADMIN OPERATOR CONFIG PASSED IN URL HERE";	
		} else {
			$myp->AlertError('Fatal URL Error! ', 'Something is not Right. Please stop messing around with the URL');
		}
}


function LoadAdminStudentPage(){// THIS FUNCTION IS DEBRICATED IN JUNE 25 2014, PLEASE REMOVE INCLUDING PAGE IMPORTED FROM AJAX
$myp = new MyPublican;
 global $operator,$page,$db;
	if ($operator == "admin" && $page == "admin_STUDENTS"){
	//if ($action =="edit"){

	// before loading the page, lets hide the weelcome div say hide the changerbody div
		echo "<script> 
				$(document).ready(function(){
				 $('#changerbody').hide();
				});
				</script>";
							
		include("ajax/admin_student.php");
		
		//echo "WE HAVE SEEN ADMIN OPERATOR CONFIG PASSED IN URL HERE";	
		} else {
			$myp->AlertError('Fatal Error ', ' Please contact the Support Team');
		}
}

function LoadanotherPage(){

}

?>