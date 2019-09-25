<?php 
$title="Fees management";
if (!defined('feespage'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

?>

<div style="margin-left:40px">&nbsp;&nbsp;&nbsp;&nbsp;
<a href="" class="fancybox fancybox.iframe label label-success" ><button class=""><font color="red">!</font>WAEC/NECO/JAMB</button></a>
<a href="" class="fancybox fancybox.iframe label label-success"><button class=""><font color="red">!</font>School Materials</button></a>
<a href="" class="fancybox fancybox.iframe label label-success"><button class=""><font color="red">!</font>Salary</button></a>
<a href="fees?page=defaultfees#mainsetting" target="_blank" class="label label-success"><button class="">Set School Fee defaults</button></a>
<a href="manage_fees/db/setResultFee.php" class="fancybox fancybox.iframe label label-success"><button class="">Result Checking Fee</button></a>
</div>


<iframe src="manage_fees/db/index.php?setfee" width="100%" height="995" name="pageframes" border="0" frameborder="0">You need a valid/current browser to load thos page. use Google chrome. thanks </iframe> 


<BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />