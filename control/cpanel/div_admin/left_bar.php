<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
				
<li class="nav-header hidden-tablet">Main Menu</li>
<li><a class="ajax-link" href="home"><i class="icon icon-color icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
<li><a class="ajax-link" href="admin_configuration?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes"><i class="icon icon-color icon-gear"></i><span class="hidden-tablet"> Configurations</span></a></li>
<li><a class="ajax-link" href="main?page=schoolapp&tools#mainsetting"><i class="icon icon-color icon-wrench"></i><span class="hidden-tablet"> Portal Control</span></a></li>
<li><a class="ajax-link" href="main?page=profile"><i class="icon icon-color icon-edit"></i><span class="hidden-tablet"> School Profile</span></a></li>
<li><a class="ajax-link" href="modules?controller=module"><i class="icon icon-color icon-bookmark"></i><span class="hidden-tablet"> Modules Plugin</span></a></li>
<li><a class="ajax-link" href="main?page=roles"><i class="icon icon-color icon-pdf"></i><span class="hidden-tablet"> Sub Admins</span></a></li>
<li><a class="ajax-link" href="modules?controller=duty"><i class="icon icon-color icon-link"></i><span class="hidden-tablet"> Staff Duty Roaster </span></a></li>
<li><a class="ajax-link" href="modules?controller=academicAdviser"><i class="icon icon-color icon-users"></i><span class="hidden-tablet"> Teachers &amp; Students </span></a></li>
<li><a class="ajax-link" href="main?page=staff"><i class="icon icon-color icon-user"></i><span class="hidden-tablet"> Staff Profile</span></a></li>
<li><a class="ajax-link" href="main?page=users"><i class="icon icon-color icon-user"></i><span class="hidden-tablet"> Students Profile</span></a></li>
<li><a class="ajax-link" href="modules?controller=admission"><i class="icon icon-color icon-book-empty"></i><span class="hidden-tablet"> Student Admission</span></a></li>
<li><a class="ajax-link" href="main?page=parents"><i class="icon icon-color icon-user"></i><span class="hidden-tablet"> Parents Profile</span></a></li>
<li><a class="ajax-link" href="main?page=cards&myaction=view"><i class="icon icon-color icon-document"></i><span class="hidden-tablet"> Scratch Cards</span></a></li>
<li><a class="ajax-link" href="fees?page=home#mainsetting"><i class="icon icon-color icon-cart"></i><span class="hidden-tablet"> General School Fees</span></a></li>
<li><a class="ajax-link" href="fees?page=defaultfees#mainsetting"><i class="icon icon-color icon-cart"></i><span class="hidden-tablet"> Default School Fee</span></a></li>
<li><a class="ajax-link" href="main?page=library"><i class="icon icon-color icon-book"></i><span class="hidden-tablet"> Library Catalogue</span></a></li>
<li><a class="ajax-link" href="modules?controller=hostels"><i class="icon icon-color icon-home"></i><span class="hidden-tablet"> Manage Hostels </span></a></li>
<li><a class="ajax-link" href="modules?controller=mails"><i class="icon icon-color icon-inbox"></i><span class="hidden-tablet"> Portal Mails (<?php //print mysql_num_rows(mysql_query("SELECT * FROM tbl_portal_emails WHERE status ='0'")) ?>)</span></a></li>
<li><a class="ajax-link" href="modules?controller=payments&tool=fees"><i class="icon icon-color icon-sent"></i><span class="hidden-tablet"> Payments Viewer</span></a></li>
<li id=""><a class="ajax-link" href="main?page=addresults#mainsetting"><i class="icon icon-color icon-doc"></i><span class="hidden-tablet"> Manage Results</span></a></li>
<li id=""><a class="ajax-link" href="results?page=report_cards"><i class="icon icon-color icon-pdf"></i><span class="hidden-tablet"> Reports Cards</span></a></li>
 <li id="SendSMSLink"><a class="ajax-link" href="main?page=sms"><i class="icon icon-color icon-mail-open"></i><span class="hidden-tablet"> SMS Center </span></a></li>
<li><a class="ajax-link" href="modules?controller=home"><i class="icon icon-color icon-gear"></i><span class="hidden-tablet"> Extensions</span></a></li>

<li style="padding:14px 0; font-variant:small-caps; font-size:16px"><center>Sub Menu</center></li>
<!---
<li><a class="ajax-link" href="students?page=home#console"><i class="icon icon-color icon-users"></i><span class="hidden-tablet"> Editor: Students <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="teachers?page=home#console"><i class="icon icon-color icon-user"></i><span class="hidden-tablet"> Editor: Teachers <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="fees?page=home"><i class="icon icon-color icon-cart"></i><span class="hidden-tablet"> Editor: Fees <font color="red">!</font></span></a></li>
<li id=""><a class="ajax-link" href="results?page=home&control=report#console"><i class="icon icon-color icon-doc"></i><span class="hidden-tablet"> Editor: Results <font color="red">!</font></span></a></li>
 --->
<li><a class="ajax-link" href="main?page=email"><i class="icon icon-color icon-envelope-open"></i><span class="hidden-tablet"> Newsletter <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="modules?controller=exams"><i class="icon icon-color icon-compose"></i><span class="hidden-tablet">Exams <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="modules?controller=cctv"><i class="icon icon-color icon-rssfeed"></i><span class="hidden-tablet">CCTV Security <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="modules?controller=tracking"><i class="icon icon-color icon-transfer-ew"></i><span class="hidden-tablet">Tracking Security <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="modules?controller=externalexams"><i class="icon icon-color icon-script"></i><span class="hidden-tablet">WAEC/NECO/JAMB <font color="red">!</font></span></a></li>
<li><a class="ajax-link" href="main?page=forum"><i class="icon icon-color icon-comment"></i><span class="hidden-tablet"> Forum <font color="red">!</font></span></a></li>						
<li><a class="ajax-link" href="main?page=backups"><i class="icon icon-color icon-archive"></i><span class="hidden-tablet"> Back Up  <font color="red">!</font></span></a></li>					
   </ul>
</div><!--/.well --><?php 
if (!defined('modulepage')){

				include("left_bar_module.php");}?>
			</div><!--/span-->
			<!-- left menu ends -->