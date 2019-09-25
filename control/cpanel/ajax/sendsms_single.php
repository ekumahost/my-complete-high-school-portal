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
?>
<!doctype html>
<html>
<head>
	<title>Send SMS</title>
	<link rel="stylesheet" href="mystrap.css"> <!-- load bootstrap via CDN -->

	<script src="jquery.min.js"></script> <!-- load jquery via CDN -->
	 <!--<script src="pinmagic.js"></script> load our javascript file -->
</head>

<div class="col-sm-6 col-sm-offset-3">

	<h4><strong>SCHOOL SMS SENDER  </strong></h4> 
	<form action="" method="POST" id="send_single_form">
        <table class="table table-striped table-bordered">
            <thead>
            <tr><th colspan="2"> SMS Sending Details (You will only be allowed to send 2 pages)</th>
            </tr>
            </thead>
            <tbody>
                <tr><td> Country </td><td><select name="country" class="form-control">
                        <option>Nigeria</option> <option>International</option></select>
                    </td> </tr>
                <tr><td> Sender ID (11 Character) </td><td><input class="form-control"type="text" maxlength="11" name="sender_id" value="<?php print @$_POST["sender_id"] ?>"  placeholder="Senders Name e.g Proprietor" /> </td> </tr>
                <tr><td> Numbers (Separate with Comma,) </td><td><textarea cols="80" rows="2" class="form-control" name="message_numbers"><?php print @$_POST["message_numbers"] ?></textarea></td>
                </tr>
                <tr><td> Message </td><td><textarea maxlength="330" id="message_body" cols="80" rows="5" class="form-control" name="message_body"><?php print @$_POST["message_body"] ?></textarea>
                        <span id="textarea_message_word"></span> &raquo; <span id="textarea_message_page"></span> </td>
                </tr>
            <tr><td colspan="2" align="right">
                    <button name="send_single_sms_button" type="submit" class="btn btn-success">Send SMS <span class="fa fa-arrow-right"></span></button>
                   </td></tr>
            </tbody>
        </table>
  </form>

<div id="send_single_message"></div>

</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</html>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#textarea_message_word').html("0 Character");
        $('#textarea_message_page').html("1 Page");

        $('#message_body').keyup(function(e){
            var string_length = $('#message_body').val().length;
            if (string_length <= 1) {
                $('#textarea_message_word').html(string_length + " Character");
            } else {
                $('#textarea_message_word').html(string_length + " Characters");
                    //checking to see if the character exceeds 160 string
                    if (string_length < 160) {
                        $('#textarea_message_page').html("1 Page");
                    } else if (string_length < 307) {
                        $('#textarea_message_page').html("2 Page");
                    } else {
                        $('#textarea_message_page').html("Message Exceeds 2 Pages.");
                    }
            }
        })
    });

    $('#send_single_form').on('submit', function(e){
        $('#send_single_message').html('Sending Message. Please Wait...');
        formValues = $('#send_single_form').serializeArray();
        $.post('sendsms_no_processor?transfer=send_single', formValues, function(data) {
            $('#send_single_message').html(data);
        });
        e.preventDefault();
    });
</script>