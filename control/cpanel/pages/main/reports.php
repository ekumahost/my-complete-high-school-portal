<?php 
$title="Main Config Under developmet";
if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}
?>

<div style="margin-left:40px"><h3>GENERAL PORTAL REPORT DOWNLOAD </h3></div>

<div style="margin-left:80px">
<br />
<table width="50%" border="1" cellpadding="10" cellspacing="4" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
  <tr>
    <td>HTML REPORTS </td>
    <td>PDF REPORTS </td>
  </tr>
  <tr>
    <td><a href="pages/reports/admin_reports.php" class="fancybox fancybox.iframe btn btn-default btn-large"> Active Students/Daily Attendance/Discipline </a></td>
    <td><a href="pages/reports/down_reports.php" class="fancybox fancybox.iframe btn btn-default btn-large"> Active Students/Daily Attendance/Discipline <font color="red">!</font></a></td>
  </tr>
  <tr>
    <td><a href="pages/reports/generatereportcardnew.php" class="fancybox fancybox.iframe btn btn-default btn-large"> Report Cards Generation <font color="red">!</font></a></td>
    <td><a href="pages/reports/down_reports.php" class="fancybox fancybox.iframe btn btn-default btn-large"> Report Cards Generation <font color="red">!</font></a></td>
  </tr>
</table>


</div>



