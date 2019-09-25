<?php
session_start();
if(!isset($_SESSION['UserID']) || @$_SESSION['UserType'] != "A")  {
    print "Session Expired. Please you may have to Log In again";
    exit;
}
(file_exists('../../php.files/classes/kas-framework.php'))? include ('../../php.files/classes/kas-framework.php'): include ('../../../php.files/classes/kas-framework.php');
// Include configuration file
include('../tools/config.php');// custom config to get variables
//Include global functions
include_once "../../includes/common.php";
// config
include_once "../../includes/configuration.php";
//clearing the default for storing the bulk sms numbers...
$_SESSION['sendto_nos'] = "";
?>
<!doctype html>
<html>
<head>
	<title>Send SMS</title>
	<link rel="stylesheet" href="mystrap.css"> <!-- load bootstrap via CDN -->

	<script src="jquery.min.js"></script> <!-- load jquery via CDN -->
	 <!--<script src="pinmagic.js"></script> load our javascript file -->
</head>
<style type="text/css">
	.text_type { width:200px; height: 30px}
	.textarea_type { width: 200px;  }
</style>
<div class="col-sm-6 col-sm-offset-3">

	<h4><strong>SCHOOL SMS SENDER </strong></h4>
	<form action="" method="POST" id="bulk_sms_sender_form">
        <div style="float: left; width: 48%; padding: 10px;">
			<label for="type">Group Selector</label>
			<table width="100%">
                <tr><td> Send To </td><td><select name="sendto_selecter" id="sendto_selecter" class="form-control">
                            <option>Everybody</option> <option>Category</option></select>
                    </td> </tr>
					
				<tr><td>  Category </td><td>
					<span id="category_dropdown" style="display:none"><select class="form-control" name="category_selecter" id="category_selecter">
                            <option value="All">----------</option><option>Parent</option>
							<option>Student</option> <option>Staff</option></select>
						</span>	</td> </tr>

				<tr><td>  Grade </td><td>
					<span id="grade_dropdown" style="display:none"><select class="form-control" name="grade_selecter" id="grade_selecter">
                            <option>All</option> 
							<?php 
								$kas_framework->getallFieldinDropdownOption('tbl_grade_domains', 'school_names', 'school_names', $all_grades);
							?>
                            <option> -------------------- </option>
							<?php 
								$kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', $matchField);
							 ?>
							</select>
						</span>	</td> </tr>						
				
				<tr><td>  Sex Selector </td><td>
					<span id="sex_dropdown" style="display:none"><select class="form-control" name="sex_selecter" id="sex_selecter">
                            <option value="%%">All</option> <option>Male</option> <option>Female</option></select>
						</span>	</td> </tr>
						
				<tr><td>  Staff Group </td><td>
					<span id="staff_dropdown" style="display:none"><select class="form-control" name="staff_selecter" id="staff_selecter">
                            <option value="%%">All</option> <option value="T">Teaching</option> <option  value="gov_board">Governing Board</option>
							<option value="S">Non-Teaching</option> <option value="Tp">Teaching Practice</option><option value="Ty">NYSC</option></select>
						</span>	</td> </tr>
						
				<tr><td>  Student Group </td><td>
			<span id="student_dropdown" style="display:none"><select class="form-control" name="student_selecter" id="student_selecter">
					<option value="%%">All</option> <option  value="1">Admitted</option>
					<option value="2">Graduated</option> <option value="3">Suspended</option></select>
				</span>	</td> </tr>
				<tr><td colspan="2"> <hr /></td></tr>
                <tr><td colspan="2" align="center">
                        <button id="generate_nos" class="btn btn-success">Store Selection for Message <span class="fa fa-arrow-right"></span></button>
                        <button id="view_nos" class="btn btn-success">View Numbers<span class="fa fa-arrow-right"></span></button>
                    </td></tr>
            </table>
			
			<p>&nbsp;</p>
			<div id="messenger_for_no_generator" style="text-align: center;"> </div>
			<div id="messenger_for_bulk_sms" style="text-align: center; "> </div>
		</div>
		
        <div style="float: right; width: 48%; padding: 10px; border:1px solid #000">
			<table class="table table-striped table-bordered">
                
                <tr><td width="30%"> Country </td><td><select name="country" class="form-control">
                            <option>Nigeria</option> <option>International</option></select>
                    </td> </tr>
                <tr><td> Sender ID <br />(11 Char) </td><td><input class="text_type" type="text" maxlength="11" name="sender_id" value="<?php print @$_POST["sender_id"] ?>"  placeholder="Senders Name e.g Proprietor" /> </td> </tr>
                <tr><td> Message </td><td><textarea maxlength="330" id="message_body" cols="120" rows="5" class="form-control textarea_type" name="message_body"><?php print @$_POST["message_body"] ?></textarea>
                        <span id="textarea_message_word"></span> &raquo; <span id="textarea_message_page"></span> </td>
                </tr>
                <tr><td colspan="2" align="right">
                        <button id="send_bulk_sms_button" type="submit" class="btn btn-success">Send SMS <span class="fa fa-arrow-right"></span></button>
                    </td></tr>
            </table>
		</div>
    </form>

</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</html>


<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#textarea_message_word').html("0 Character");      $('#textarea_message_page').html("1 Page");

        $('#message_body').keyup(function(e){
            var string_length = $('#message_body').val().length;
            if (string_length <= 1) {   $('#textarea_message_word').html(string_length + " Character");
            } else {
                $('#textarea_message_word').html(string_length + " Characters");
                //checking to see if the character exceeds 160 string
                if (string_length < 160) {  $('#textarea_message_page').html("1 Page");
                } else if (string_length < 311) {  $('#textarea_message_page').html("2 Page");
                } else {  $('#textarea_message_page').html("Message Exceeds 2 Pages.");  }
            }
        })
    });

    $('#sendto_selecter').on('change', function(e){
        to_cat = $(this).val();
        if (to_cat == "Everybody") {  $('#category_dropdown').hide(); $('#grade_dropdown').hide();   $('#sex_dropdown').hide(); $('#staff_dropdown').hide();
        } else {  $('#category_dropdown').show();  }
    })

    $('#category_selecter').on('change', function(e){
        cat_drop = $(this).val();
        if (cat_drop == "All") { $('#grade_dropdown').hide(); $('#sex_dropdown').hide(); $('#staff_dropdown').hide(); $('#student_dropdown').hide();
        } else { $('#grade_dropdown').show();  $('#sex_dropdown').show();
            if (cat_drop == "Staff") {   $('#staff_dropdown').show();   $('#grade_dropdown').hide();  } else {    $('#staff_dropdown').hide(); }
            if (cat_drop == "Student") {   $('#student_dropdown').show();  } else {    $('#student_dropdown').hide(); }
        }
    })
	//for the grade selecter
	$('#grade_selecter').on('change', function(e){
		value_selected = $(this).val();
		if (value_selected == "All") { $('#student_selecter').show();
		} else { $('#student_selecter').hide(); }
	})

	$('#generate_nos').on('click', function(e){
        $('#messenger_for_no_generator').html("Generating Numbers. Please Wait...");
		$('#messenger_for_bulk_sms').html("");
        formValues = $('#bulk_sms_sender_form').serializeArray();
            $.post('sendsms_no_processor?transfer=generate_nos', formValues, function(data) {
                $('#messenger_for_no_generator').html(data);
            }); e.preventDefault();
    });

        $('#view_nos').on('click', function(e){
            $('#messenger_for_no_generator').html("Loading Numbers. Please Wait...");
            $.post('sendsms_no_processor?transfer=view_nos', {}, function(data) {
                $('#messenger_for_no_generator').html(data);
            });
            e.preventDefault();
        })

    /* */$('#send_bulk_sms_button').on('click', function(e){
            $('#messenger_for_bulk_sms').html("Sending Bulk SMS. Please Wait...");
            formValues = $('#bulk_sms_sender_form').serializeArray();
            $.post('sendsms_no_processor?transfer=send_bulk', formValues, function(data) {
                $('#messenger_for_bulk_sms').html(data);
                $('#messenger_for_no_generator').html("");
            }); e.preventDefault();
    })

</script>