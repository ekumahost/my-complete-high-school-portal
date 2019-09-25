<?php
$title = "Bulk SMS Sender";
if (!defined('MYSCHOOLAPPADMIN_CORE')) { // if the user access this page directly, take his ass back to home
    header('Location: ../../../index.php?action=notauth');
    exit;
}
?>
<table style=" margin:20px 0 0 50px; width: 80%">
    <tr>
        <td>
            <h3>SMS Sending APP</h3>
			<br>
            <p><a href="ajax/sendsms_single.php" class="fancybox fancybox.iframe"><button type="submit" class="btn btn-large btn-success">Send Single/Multiple SMS<span class="fa fa-arrow-right"></span></button></a>
                <a href="ajax/sendsms_bulk.php" class="fancybox fancybox.iframe"><button type="submit" class="btn btn-large btn-success">Send Bulk SMS: MySchool <span class="fa fa-arrow-right"></span></button></a>
                <a href="main?page=schoolapp&tools=api#mainsetting"><button type="submit" class="btn btn-success btn-large">SMS Settings<span class="fa fa-arrow-right"></span></button></a>
                <a href="#" id="check_balance"><button type="submit" class="btn btn-success btn-large">Check My Account Balance<span class="fa fa-arrow-right"></span></button></a>&nbsp;
            </p>
            <p>
            <a href="#" id="check_server"><button type="submit" class="btn btn-success btn-large">Check Server Connection<span class="fa fa-arrow-right"></span></button></a>&nbsp;
            <a href="main?page=sms&help" class="btn btn-default btn-large">Learn How to Send SMS (Help)</a>
            <a href="" class="btn btn-default btn-large">Check SMS pricing detail </a></p>
        </td>
    </tr>
</table>

<div style="margin: 20px;" id="check_server_message"></div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="data-original-title">
            <h2><i class="icon icon-color icon-mail-open"></i> Messages Sent so Far</h2>
            <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
                <thead>
                <tr>
                    <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
                    <th>Category</th>
                    <th width="15%">Others</th>
                    <th width="50%">Message </th>
                    <th>Date </th>
                </thead>
                <tbody>
                <?php $get_all_msg =  "SELECT * FROM bulk_sms_store ORDER BY id DESC";
				$dbh_get_all_msg = $dbh->prepare($get_all_msg); $dbh_get_all_msg->execute();
                    $serial = 0;
                    while ( $view_mgs = $dbh_get_all_msg->fetch(PDO::FETCH_OBJ)) {
                        $serial = $serial + 1;
                            print '<tr><td>'.$serial.'</td>
                                    <td>'.$view_mgs->category.'</td>
                                    <td>'.$view_mgs->others.'</td>
                                    <td>'.$view_mgs->message_body.'</td>
                                    <td>'.$view_mgs->date_sent.'</td></tr>';
                    }
					$dbh_get_all_msg = null;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->
</div>
<script type="text/javascript">
    $('#check_balance').on('click', function(e){
        $('#check_server_message').html("Checking the Server For your Available Balance. Please Wait...");
        $.post('ajax/sendsms_no_processor?transfer=check_balance', {}, function(data) {
            $('#check_server_message').html(data);
        })
        e.preventDefault();
    })

    $('#check_server').on('click', function(e){
        $('#check_server_message').html("Checking the Server For Connectivity. Please Wait...");
        $.post('ajax/sendsms_no_processor?transfer=check_server', {}, function(data) {
            $('#check_server_message').html(data);
        })
        e.preventDefault();
    })

</script>