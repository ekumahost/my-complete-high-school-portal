<?php 
include ('../../../php.files/classes/kas-framework.php');
include("../../includes/configuration.php");
include('../db_selector.php');

?>

<style type="text/css">
.active{color:#003399}
.inactive{color:red}

</style>
  <p>&nbsp;DATABASE SUMMARY </p>
  <table width="98%" border="0">
    <tr>
      <td><strong>SUMMERY OF STUDENTS</strong></td>
      <td><strong>SUMMARY OF STAFF</strong></td>
      <td><strong>SUMMARY OF FEES collected </strong></td>
      <td><strong>SUMMARY OF MESSAGES</strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
        <tr>
          <td> Total students </td>
          <td><div class="all"><?php CountAllStudents();?></div></td>
        </tr>
        <tr>
          <td>Active Students </td>
          <td><div class="active"><?php CountAllActiveStudents();?></div></td>
        </tr>
        <tr>
          <td>Inactive Students </td>
          <td><div class="inactive"><?php CountAllInActiveStudents();?></div></td>
        </tr>
        <tr>
          <td>Graduated Students </td>
          <td><div class="graduate"><?php CountAllGraduateStudents();?></div></td>
        </tr>
        <tr>
          <td>Prospective Students </td>
          <td><div class="graduate"><?php CountAllStudentsProspective();?></div></td>
        </tr>
        <tr>
          <td>Students transfered Out </td>
          <td><div class="graduate"><?php CountAlltransferedOutStudents();?></div></td>
        </tr>
        <tr>
          <td>Expelled Students</td>
          <td><div class="inactive"><?php CountExpelled();?></div></td>
        </tr>
        <tr>
          <td>Suspended Students </td>
          <td><div class="inactive"><?php Countsuspend();?></div></td>
        </tr>
        <tr>
          <td>Withdrawn (by self)</td>
          <td><div class="inactive"><?php Countwithdraw();?></div></td>
        </tr>
        <tr>
          <td>Deceased</td>
          <td><div class="inactive"><?php CountDeceased();?></div></td>
        </tr>
        <tr>
          <td>Students Tranfered in</td>
          <td>none</td>
        </tr>
      </table></td>
      <td><table width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
        <tr>
          <td> Total staff </td>
          <td><div class="graduate"><?php CountStaff();?></div></td>
        </tr>
        <tr>
          <td>Total Teachers </td>
          <td><div class="graduate"><?php CountAllTeachers();?></div></td>
        </tr>
        <tr>
          <td>Total Active Teachers </td>
          <td><div class="graduate"><?php CountAllActiveTeachers();?></div></td>
        </tr>
        <tr>
          <td>Total Inactive Teachers </td>
          <td><div class="graduate"><?php CountAllInActiveTeachers();?></div></td>
        </tr>
        <tr>
          <td>Total Non Teaching Staff </td>
          <td><div class="graduate"><?php CountNonTeachingStaff();?></div></td>
        </tr>
        <tr>
          <td>Total Active Non teaching Staff </td>
          <td><div class="graduate"><?php CountActiveNonTeachingStaff();?></div></td>
        </tr>
        <tr>
          <td>Total Inactive Non teaching Staff </td>
          <td><div class="graduate"><?php CountInactiveNonTeachingStaff();?></div></td>
        </tr>
        <tr>
          <td>Total Teacher Coppers(NYSC) </td>
          <td><div class="graduate"><?php CountNYSC();?></div></td>
        </tr>
        <tr>
          <td>Total Practising Teachers </td>
          <td><div class="graduate"><?php CountPractiseteacher();?></div></td>
        </tr>
        <tr>
          <td>Total Admins </td>
          <td><div class="graduate"><?php Countadmins();?></div></td>
        </tr>
        <tr>
          <td>Total lesson Teachers </td>
          <td><div class="graduate"><?php Countlessonteacher();?></div></td>
        </tr>
      </table></td>
      <td><table width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
        <tr>
          <td> Total Fees</td>
          <td><?php SumUpFee(); ?></td>
        </tr>
        <tr>
          <td>School Fees </td>
          <td><?php SumUpSchoolFee(); ?></td>
        </tr>
        <tr>
          <td>Hostel Fee</td>
          <td><?php SumUpHostelFee(); ?></td>
        </tr>
        <tr>
          <td>Uniforms</td>
          <td><?php SumUpunifromFee(); ?></td>
        </tr>
        <tr>
          <td>Shoes</td>
          <td><?php SumUpshoesFee(); ?></td>
        </tr>
        <tr>
          <td>Books</td>
          <td><?php SumUpbookFee(); ?></td>
        </tr>
        <tr>
          <td>Meals</td>
          <td><?php SumUpmealFee(); ?></td>
        </tr>
        <tr>
          <td>Medication</td>
          <td><?php SumUpmedicationFee(); ?></td>
        </tr>
        <tr>
          <td>Others</td>
          <td><?php SumUpotherFee(); ?></td>
        </tr>
        <tr>
          <td>Total Unpaid Invoice </td>
          <td>Ms</td>
        </tr>
        <tr>
          <td>Total Expired Invoice </td>
          <td>Ms</td>
        </tr>
      </table></td>
      <td><table width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
        <tr>
          <td> Total Active Message <a href="modules?controller=mails">Read </a></td>
          <td><?php CountAllUnreadMessages(); ?></td>
        </tr>
        <tr>
          <td>Total Message from Parents </td>
          <td><?php CountAlMessagesC(); ?></td>
        </tr>
        <tr>
          <td>Total message from Staff </td>
          <td><?php CountAlMessagesB(); ?></td>
        </tr>
        <tr>
          <td><p>Total message from Students </p>          </td>
          <td><?php CountAlMessagesA(); ?></td>
        </tr>
        <tr>
          <td>Total message from Public </td>
          <td><?php CountAlMessagesD(); ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
