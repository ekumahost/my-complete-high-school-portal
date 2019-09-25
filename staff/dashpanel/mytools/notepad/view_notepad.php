<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
extract($_POST);
	if (!isset($_POST['byepass'])) {
		exit('Error 404: File is Classified');
	}
	
	$rawQ = "SELECT * FROM staff_notepad WHERE id = '".$value."' AND author = '".$web_users_relid."' LIMIT 1";
	$db_rawQ = $dbh->prepare($rawQ);
	$db_rawQ->execute();
	$paramObj = $db_rawQ->fetch(PDO::FETCH_OBJ);
	$db_rawQ = null;

print '<div class="box box-primary">
		<div class="box-header">
			<i class="fa fa-pencil-square-o"></i>
			<h3 class="box-title">'.$paramObj->title.'</h3>
				<span style="float:right; margin:4px;" id="headingPlacement">
				
				<div id="messageBoxForReading"></div>
				
				<button class="btn btn-default btn-sm" id="back"><i class="fa fa-mail-reply"></i> Back</button>&nbsp;
				<button class="btn btn-warning btn-sm" id="edit" value="'.$paramObj->id.'">
				<i class="fa fa-pencil"></i> Edit</button>&nbsp;
				<button class="btn btn-danger btn-sm" id="delete" value="'.$paramObj->id.'">
				<i class="fa fa-trash-o"></i> Delete</button>&nbsp;
				</span>
		</div>

		<div class="box-body" style="text-align:justify"> '.$paramObj->note.' </div>
</div>';

//print $notepad_text;

?>

<script type="text/javascript">
	$('#back').click(function(e) {
		$('#messageBox2').hide();
		$('#messageBox').hide();
		$('#todoListDiv').fadeIn(1000);
	})

	$(window).scroll(function(e) {
			var scroll_pos = $(window).scrollTop();
			if (scroll_pos > 70) { 
				window_width = $(document).innerWidth() + 17;
				if (window_width > 960) {
					$('#headingPlacement').css('position', 'fixed').css('margin-top', '-66px').css('background-color', '#FFFFFF').css('right', '16px');
				}
			} else {
				$('#headingPlacement').css('position', 'inherit').css('margin-top', '4px');
			}
		});
		
	$('#delete').click(function(e) {
		value = $(this).attr('value'); rsn = 'confirmDelete'; byepass = 'C3W4uoO6EU5UBfytrRF4343F4D';
		$.post('notepad-handler', {value:value, rsn:rsn, byepass:byepass}, function(data){
			$('#messageBoxForReading').hide().show().html(data);
		});
	})

	$('#edit').click(function(e) {
		$('#messageBox2').html('<?php $kas_framework->loading('center'); ?>').show();
			$('#todoListDiv').hide();
			value = $(this).attr('value');  byepass = 'C3W4uoO6EU5UBfytrRF4343F4D';
			$.post('edit_notepad', {value:value, byepass:byepass}, function(data){
				$('#messageBox2').hide().fadeIn().html(data);
					$('#messageBox').hide();
			});
		})
</script>