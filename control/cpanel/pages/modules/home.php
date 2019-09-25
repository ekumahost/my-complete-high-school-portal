<?php 
$title="Modules";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

?>
<style type="text/css">
	#notActive { background-color: #006666; color:#FFF; }
</style>
<div align="right" style="margin:0 10px 0 0"> 
<form action="modules?controller=home" name="" id=""> 
 <input placeholder="Find/Download Extensions" type="text" class="span2 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Media Chat", "Snow Plugin", "Shutdown", "Wallet Creditor", "Phone Call"]'></form>
</div>

<div class="row-fluid sortable">
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-book-empty"></i>Admission</h2><i class="icon32 icon-color icon-book-empty"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="modules?controller=admission_sett">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#admission"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-book"></i> Library </h2><i class="icon32 icon-color icon-book"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=library">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#lib"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-compose"></i> Exam </h2><i class="icon32 icon-color icon-compose"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#exam">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#exam"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#exam"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <i class="icon icon-color icon-sent"></i><h2>Payment</h2><i class="icon32 icon-color icon-sent"></i>
    </div>
    <div class="box-content">
       <div class="row-fluid">
        <div class="span4">
          <h6><a href="modules?controller=payments&tool=fees">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#payment"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>



<div class="row-fluid sortable" >
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-bookmark"></i>Registration</h2><i class="icon32 icon-color icon-bookmark"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#reg">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#reg"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="reg"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-home"></i> Hostel </h2><i class="icon32 icon-color icon-home"></i> 
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
       <div class="row-fluid">
        <div class="span4">
          <h6><a href="modules?controller=hostels">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-transfer-ew"></i>Tracking</h2><i class="icon32 icon-color icon-transfer-ew"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
     <div class="row-fluid">
        <div class="span4">
          <h6><a href="#tracking">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#tracking"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#tracking"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
     <i class="icon icon-color icon-rssfeed"></i> <h2>CCTV</h2><i class="icon32 icon-color icon-rssfeed"></i>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#cctv">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#cctv"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#cctv"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>

<div class="row-fluid sortable">
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-image"></i>Album</h2>
      <i class="icon32 icon-color icon-image"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#album">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#album"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#album"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-folder-open"></i> Files </h2>
      <i class="icon32 icon-color icon-folder-open"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#file">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#file"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#file"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-mail-closed"></i>Bulk SMS</h2>
      <i class="icon32 icon-color icon-mail-closed"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#sms">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#sms"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#sms"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title"> <i class="icon icon-color icon-pdf"></i>
        <h2>Transcript</h2>
        <i class="icon32 icon-color icon-pdf"></i> </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#transcript">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#transcript"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#transcript"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>

<div class="row-fluid sortable">
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-doc"></i>Results</h2>
      <i class="icon32 icon-color icon-doc"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
       <div class="row-fluid">
        <div class="span4">
          <h6><a href="results?page=home&control=report#console">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#result"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-contacts"></i> Parents </h2>
      <i class="icon32 icon-color icon-contacts"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=parents">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#parent"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-users"></i>Staff</h2>
      <i class="icon32 icon-color icon-users"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=staff">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#staff"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#staff"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <i class="icon icon-color icon-bookmark"></i>
      <h2>Duty Roaster </h2>
      <i class="icon32 icon-color icon-bookmark"></i>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="modules?controller=duty">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#duty"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#duty"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>

<div class="row-fluid sortable">
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-arrowthick-s"></i>Demote/Promote</h2>
      <i class="icon32 icon-color icon-arrowthick-s"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=demote">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#demote+promote"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#demote+promote"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-comment"></i>Social</h2>
      <i class="icon32 icon-color icon-comment"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#social">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#social"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#social"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-plane"></i> Transport </h2>
      <i class="icon32 icon-color icon-globe"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#transport">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#transport"><font color="red">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#transport"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title"> <i class="icon icon-color icon-mail-open"></i>
        <h2>Email</h2>
        <i class="icon32 icon-color icon-mail-open"></i> </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="modules?controller=mails">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#email"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#email"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>

<div class="row-fluid sortable">
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-cart"></i>School Fee </h2>
      <i class="icon32 icon-color icon-cart"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="fees?page=defaultfees#mainsetting">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#fees"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#fees"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-briefcase"></i>Wallets</h2>
      <i class="icon32 icon-color icon-briefcase"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="modules?controller=wallet">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#wallet"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#wallet"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-clipboard"></i> Scratch Cards </h2>
      <i class="icon32 icon-color icon-clipboard"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=cards&myaction=view">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#card"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#card"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title"> <i class="icon icon-color icon-users"></i>
        <h2>Students</h2>
        <i class="icon32 icon-color icon-users"></i> </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=users">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>

<div class="row-fluid sortable">
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-heart"></i>Health </h2>
      <i class="icon32 icon-color icon-heart"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#health" class="alert4Staff">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#health"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#health"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-date"></i>Attendance</h2>
      <i class="icon32 icon-color icon-date"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#attendance" class="alert4Staff">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#attendance"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#attendance"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-help"></i> Discipline </h2>
      <i class="icon32 icon-color icon-help"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#discipline" class="alert4Staff">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#discipline"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#discipline"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" style="background-color:#CCC">
    <div class="box-header well" data-original-title="data-original-title"> <i class="icon icon-color icon-volume-on"></i>
        <h2>Media</h2>
        <i class="icon32 icon-color icon-volume-on"></i> </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>


<div class="row-fluid sortable">
  <div class="box span3" style="background-color:#CCC">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-script"></i>Report</h2>
      <i class="icon32 icon-color icon-script"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-archive"></i> Dropbox Backup </h2>
      <i class="icon32 icon-color icon-archive"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#dropbox">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#dropbox"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#dropbox"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-locked"></i> Passwords </h2>
      <i class="icon32 icon-color icon-locked"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#pwd">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#pwd"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#pwd"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title"> <i class="icon icon-color icon-profile"></i>
        <h2>Portal Control</h2>
        <i class="icon32 icon-color icon-profile"></i> </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=schoolapp&tools#mainsetting">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#control"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#control"><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>


<div class="row-fluid sortable">
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-script"></i>JAMB</h2>
      <i class="icon32 icon-color icon-script"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#jamb">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#jamb"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#jamb"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-script"></i> WAEC/NECO </h2>
      <i class="icon32 icon-color icon-clipboard"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#neco">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#neco"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#neco"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon icon-color icon-clipboard"></i> API </h2>
      <i class="icon32 icon-color icon-clipboard"></i>
      <div class="box-icon"> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="main?page=schoolapp&tools=api#mainsetting">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#api"><font color="red">Uninstall</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href=""><font color="green">Active</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="box span3" id="notActive">
    <div class="box-header well" data-original-title="data-original-title"> <i class="icon icon-color icon-gear"></i>
        <h2>Installer</h2>
      <i class="icon32 icon-color icon-gear"></i> </div>
    <div class="box-content">
      <div class="row-fluid">
        <div class="span4">
          <h6><a href="#installer">Manage</a></h6>
        </div>
        <div class="span4">
          <h6><a href="#installer"><font color="#FFCC66">Install</font></a></h6>
        </div>
        <div class="span4">
          <h6><a href="#installer"><font color="red">Inactive</font></a></h6>
        </div>
      </div>
    </div>
  </div>
  <!--/span-->
</div>

<script>
$('.alert4Staff').click(function(e){
	alert('Available In Staff Portal');
})
</script>