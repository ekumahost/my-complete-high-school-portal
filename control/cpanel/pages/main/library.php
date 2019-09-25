<?php 
$title="Main Config Under development";

if (!defined('MYSCHOOLAPPADMIN_CORE')) {
	// if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}
?>
<div style="margin:10px 0; text-align:center"><h3><i class="icon icon-color icon-book"></i> School Library </h3></div>
<?php $myp->AlertInfo('Hey Admin! ', 'There is no need to worry about this. You can <a href="main?page=roles&case=liberian" class="btn btn-default btn-sm">Assign a Staff to Manage</a> this Section of the Library'); ?>
<div style="margin-left:80px; text-align:center">
	<p class="pull-right">
  <a href="../../library/" target="_blank" class="btn btn-default btn-large"><strong>Launch the Online Library </strong></a>
  <br />This is the powerful school library online managed by library admin. </p>
  <p class="pull-left">
  <a href="pages/fancyteacher/admin_media_codes_1.php" class="fancybox fancybox.iframe btn btn-default btn-large"><strong>View/Edit Online Catalog</strong></a><br />
  Install Online Library from Modules</p>
</div>



