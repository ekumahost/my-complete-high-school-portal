<?php
require ( '../../../../php.files/classes/pdoDB.php');
require ( '../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
extract($_POST);
	
	$rawQ = "SELECT * FROM staff_notepad WHERE id = '".$value."' AND author = '".$web_users_relid."' LIMIT 1";
	$db_rawQ = $dbh->prepare($rawQ);
	$db_rawQ->execute();
	$paramObj = $db_rawQ->fetch(PDO::FETCH_OBJ);
	$db_rawQ = null;	

print '<div class="box box-primary">'; ?>
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i> Edit Your Note</h4>
                </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Title:</span>
                            <input name="notepad_title" type="text" class="form-control" placeholder="Enter Title" value="<?php print $paramObj->title; ?>">
                        </div>
                    </div>
                    <div class='box box-info'>
                            <div class='box-body pad'>
								 <textarea id="editor2" name="notepad_text" rows="10"><?php print $paramObj->note; ?></textarea>
								 <input type="hidden" name="id" value="<?php print $paramObj->id; ?>" />
                            </div>
                    </div><!-- /.box -->
                 <div class="modal-footer clearfix">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Discard </button>
                        
                       <button type="submit" name="updateNOte"><a class="btn btn-app">
                        <i class="fa fa-save"></i> Save </a></button>
                   </div> 
                   <div id="messageBoxForReading"></div>
				</div>
                
            </form>
        </div><!-- /.modal-content -->
	<?php print '</div>'; ?>
	<!-- CK Editor -->
	  <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
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
			CKEDITOR.replace('editor2');
			//bootstrap WYSIHTML5 - text editor
			$(".textarea").wysihtml5();
		});

		$('.btn-danger').click(function(e) {
			$('#messageBox2').hide();
			$('#messageBox').hide();
			$('#todoListDiv').fadeIn(1000);
		})
			
		$('#delete').click(function(e) {
			value = $(this).attr('value'); rsn = 'confirmDelete'
			$.post('notepad-handler', {value:value, rsn:rsn}, function(data){
				$('#messageBox').hide().show().html(data);
			});
		})

	</script>