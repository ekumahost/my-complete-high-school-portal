<?php
// DONT LET IDIOTS ACESS THIS PAGE DIRECTLY
if (!defined ('DIRECT_PASS')){echo ' Fatal Error';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT

?>

<div>
	<ul class="breadcrumb"> 
		<li>
			<a href="index">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="#">Dashboard</a><span class="divider">/</span></li>
		<li> <div id="loading"> </div></li>
			
		<div align="right">
		 <li><a href="<?php echo $kas_framework->help_url(''); ?>" target="_blank">Get Help</a></li> |  <li><a href="#" title="Manual not Ready yet">Download Manual</a></li> | <li><a href="main?page=reports">Reports</a></li>

	</div>
	</ul> 
	</div>	  
<a href="#" id="EDITZONE"></a>
