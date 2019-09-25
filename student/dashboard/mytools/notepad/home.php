<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/students.php');
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Notepad</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
	<?php require (constant('tripple_return').'inc.files/header.php') ?>
		<p style="margin-top:18px">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
				<?php require (constant('tripple_return').'inc.files/sidebar.php') ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                 <section class="content-header">
                    <h1><i class="fa fa-tablet text-paleyellow"></i> My Notepad <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>My Tools</a></li>
						<li class="active"><i class="fa fa-tablet"></i>&nbsp;&nbsp;Notepad</li>
                    </ol>
                </section>

			<!-- Main content -->
			<section class="content">
			<?php $student->checkBasicPlanStudent(); //$student->authConfirm($useradmitStatus); ?>
			<div id="messageBox">
		<?php 
				if (isset($_POST['createbutton'])) {
					include ('create-notepad.php');
				} else if (isset($_POST['updateNOte'])) {
					include ('update_notepad.php');
				}
		?>
			</div>
			<div id="messageBox2"></div>
	
		<div class="box box-primary" id="todoListDiv">
	<!-----the content of the notepad--->
		<div class="box-header">
			<i class="fa fa-pencil-square-o"></i>
			<h3 class="box-title">My Notes</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<ul class="todo-list">
		<?php 
		$thisQ = "SELECT * FROM student_notepad WHERE author = '".$student_id_original."' ORDER BY id DESC";
		$db_thisQ = $dbh->prepare($thisQ);
		$db_thisQ->execute();
		$get_rows_db_thisQ = $db_thisQ->rowCount();
			
			if ($get_rows_db_thisQ == 0) {
				$kas_framework->showalertwarningwithPaleYellow('No Note Found for you '.$_SESSION['tapp_std_username'].'. Please try Creating One');
			} else {
				$sn = $get_rows_db_thisQ;
				$sn = $sn + 1;
					while ($notepad = $db_thisQ->fetch(PDO::FETCH_OBJ)) {
					$sn = $sn - 1;
					print '<li class="idzez'.$notepad->id.'">
						<!-- todo text -->
						'.$sn.' &raquo;
						<span class="text">'.$notepad->title.'... </span>
						<a href="#view_notepad" class="btn btn-primary btn-sm" value="'.$notepad->id.'" style="margin-top:-3px"><i class="fa fa-circle-o"></i> View</a>
						<!-- General tools such as edit or delete-->
						<div class="tools">
							<i class="fa fa-edit" title="edit" value="'.$notepad->id.'"></i>
							<i class="fa fa-trash-o" title="delete" value="'.$notepad->id.'"></i>
						</div>
					</li>';
				}
				$db_thisQ = null;	
			}
		?>
			</ul>
		</div><!-- /.box-body -->
		<!-- /.box -->
					<!-----the content of the notepad ends here---->
		<div class="box-footer clearfix no-border">
			<button class="btn btn-default pull-right" id="todo_add" data-toggle="modal" data-target="#notepad-modal"><i class="fa fa-plus"></i> Add New Note</button>
		</div>
	<!-- Loading (remove the following to stop the loading)
			<div class="overlay"><h1 style="text-align:center; margin-top:70px"> Not Ready Yet</h1></div>
			<div class="loading-img"></div>-->
			<!-- end loading -->
	</div>		
				<!-- COMPOSE MESSAGE MODAL -->
	<div class="modal fade" id="notepad-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i> Create New Note</h4>
                    </div>
				<form action="#" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><font color="red">*</font> Title:</span>
								<input name="notepad_title" type="text" class="form-control" placeholder="Enter Title" value="<?php print @$_POST['notepad_title']; ?>">
							</div>
						</div>
						<div class='box box-info'> 
                                <div class='box-body pad'>
									<textarea id="editor1" name="notepad_text" rows="10" cols="80"><?php print @$_POST['notepad_text']; ?></textarea>
                                </div>
                        </div><!-- /.box -->
						</div>
					<div class="modal-footer clearfix">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
							<button type="submit" id="createbutton" name="createbutton" class="btn btn-primary pull-left"><i class="fa fa-tablet"></i> Create Note</button>
							<span id="show_creating" style="display:none" class="pull-left margin"><?php $kas_framework->loading_h() ?></span>
					   </div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->		

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        <!-- ./wrapper -->


          <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		 <!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>        
        <!-- CK Editor -->
        <script src="<?php print constant('quad_return') ?>js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php print constant('quad_return') ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });		
			$('.btn-sm').click(function(e) {
				$('#todoListDiv').hide();
				$('#messageBox2').html('<?php $kas_framework->loading('center'); ?>').show();
				value = $(this).attr('value'); byepass = 'h6VTY656B6T6TB6BGg6';
					$.post('view_notepad', {value:value, byepass:byepass}, function(data) {
						$('#messageBox2').hide().fadeIn().html(data);
						$('#messageBox').hide();
					});
				return false;
			});
			
			$('.fa-trash-o').click(function(e) {
				value = $(this).attr('value'); rsn = 'confirmDelete';  byepass = 'h6VTY656B6T6TB6BGg6';
				$.post('notepad-handler', {value:value, rsn:rsn, byepass:byepass}, function(data){
					$('#messageBox').hide().show().html(data);
				});
			});
			
			$('.fa-edit').click(function(e) {
			$('#messageBox2').html('<?php $kas_framework->loading('center'); ?>').show();
				$('#todoListDiv').hide();
				value = $(this).attr('value');  byepass = 'h6VTY656B6T6TB6BGg6';
				$.post('edit_notepad', {value:value, byepass:byepass}, function(data){
					$('#messageBox2').hide().fadeIn().html(data);
						$('#messageBox').hide();
				});
			});	
			
			$('#createbutton').click(function(e){
				$('#show_creating').show();
			})
        </script>
<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>