<?php
//programmed by the Ultimate Kelvin - Kastech
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

extract($_POST);
//print_r($_POST);
$transfer = $_GET['transfer'];

/* checking the sms api settings */
$check_api = "SELECT * FROM tbl_app_config WHERE module = 'sms_api'";
$dbh_Query = $dbh->prepare($check_api); $dbh_Query->execute();
$api_settings = $dbh_Query->fetch(PDO::FETCH_OBJ);
$dbh_Query = null;


function add_sms_history($category, $others, string $message_body) : bool {
    $insert = "INSERT INTO bulk_sms_store (`category`, `others`, `message_body`, `date_sent`)
      VALUES ('".$category."', '".$others."', '".$message_body."', '".date('d-m-Y')."')";
	  $dbh_sSQL = $dbh->prepare($insert); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
        return ($rowCount == 1)? true:  false;
}

/*---------------------------------------------------------------------------------------------------------*/
if ($transfer == "check_server") {
    //if statement for checking the server for internet connectivity
    if ($api_settings->status == 0) {
        $myp->AlertInfo('Notice! ', 'Your SMS API settings is turned Off <a class="btn btn-sm btn-default" target="_blank" href="../cpanel/main?page=schoolapp&tools=api#mainsetting">Turn On</a>');
    } else if ($api_settings->api_user == '' or $api_settings->api_pass == '' or $api_settings->api_def == '') {
        $myp->AlertInfo('Notice! ', 'Your Definitions are wrong. Please <a class="btn btn-sm btn-default" target="_blank" href="../main?page=schoolapp&tools=api#mainsetting">Correct them here</a>');
    } else {
        //process the curl download
        $http_request = curl_download($api_settings->api_def.'/API/WebSMS/Http/v1.0a/index.php?method=show_route&username='.$api_settings->api_user.'&password='.$api_settings->api_pass.'&format=text');
        if ($http_request == "") { //to be tested
            $myp->AlertInfo("Oops! ", "Could not get response from server. Please check internet connection and try again later");
        } else { //we need to know if the stuff connected at all to the account, then we can display connected if it did
            if (strpos($http_request, "Error") !== false) { $myp->AlertImportant("Server Response! ", "Could not connect to the server. Please Check username, password and API");
            } else { $myp->AlertImportant("Server Response! ", "Connection Verified. Account Connected."); } /*  $myp->AlertImportant("Server Response! ", $http_request);*/
        }
    }
    /*---------------------------------------------------------------------------------------------------------*/
} else if ($transfer == "check_balance") {
    //if statement for checking the server for available balance
    $http_request = curl_download($api_settings->api_def.'/API/WebSMS/Http/v1.0a/index.php?method=credit_check&username='.$api_settings->api_user.'&password='.$api_settings->api_pass.'&format=json');
    if ($http_request == "") { //to be tested
        $myp->AlertInfo("Oops! ", "Could not get response from server. Please check internet connection and try again later");
    } else {  //we need to know if the stuff connected at all to the account, then we can display connected if it did
        if (strpos($http_request, "Error") !== false) { $myp->AlertImportant("Server Response! ", "Could not connect to the server. Please Check username, password and API");
        } else {
            $phpArray = json_decode($http_request, true);
            $availaibl_credit = $phpArray[3]['availablecredit'];
            $myp->AlertImportant("Server Response! ", "Available Balance/Credit: ".$availaibl_credit." Unit");
        }
    }
/*---------------------------------------------------------------------------------------------------------*/
} else if ($transfer == "generate_nos") {
   extract($_POST);
//this is the hell of the work...
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($sendto_selecter == "Everybody") {
		$general_all_number = 0; $general_parent_numbers = ""; $general_staff_numbers = ""; $general_student_numbers = "";

		//select all the parents numbers;
		$parent_phone_collector = "SELECT * FROM student_parents WHERE student_parents_status = '1'";
		$dbh_Query = $dbh->prepare($parent_phone_collector);$dbh_Query->execute(); 
		while ($parent_col = $dbh_Query->fetch(PDO::FETCH_OBJ)) {
			if ($parent_col->student_parents_mobile1 == "" and $parent_col->student_parents_mobile2 == "") { //then do nothing
			} else {  $general_parent_numbers .= ($parent_col->student_parents_mobile1 == "")? $parent_col->student_parents_mobile2: $parent_col->student_parents_mobile1. ", ";
				$general_all_number = $general_all_number + 1; }
		}
		$dbh_Query = null;

		//select all the staff numbers;
		$staff_phone_collector = "SELECT * FROM staff WHERE staff_status = '1'";
		$dbh_Query_S = $dbh->prepare($staff_phone_collector);$dbh_Query_S->execute();
		while ($staff_col = $dbh_Query_S->fetch(PDO::FETCH_OBJ)) {
			if ($staff_col->staff_mobile == "") { //then do nothing
			} else {  $general_staff_numbers .= $staff_col->staff_mobile. ", ";
				$general_all_number = $general_all_number + 1;  }
		}
		$dbh_Query_S = null;
		
		//select all the students numbers
		$student_phone_collector = "SELECT * FROM studentbio WHERE admit = '1'";
		$dbh_Query_SP = $dbh->prepare($student_phone_collector);$dbh_Query_SP->execute();
		while ($student_col = $dbh_Query_SP->fetch(PDO::FETCH_OBJ)) {
			if ($student_col->std_bio_mobile == "") { //then do nothing
			} else {  $general_student_numbers .= $student_col->std_bio_mobile. ", ";
				$general_all_number = $general_all_number + 1;  }
		}
		 $dbh_Query_SP = null;
		 
		//okk... lets collate all the numbers together now and get rid of the last comma. then store it in a session for the bulk sms sender.
		$everybody_no = $general_parent_numbers.$general_staff_numbers.$general_student_numbers;
		$everybody_no = rtrim(trim($everybody_no), ","); $_SESSION['sendto_nos'] = $everybody_no;
		print " Number(s) transferred: <b>".number_format($general_all_number) ."</b>. Ready to send... ";

	} else if ($sendto_selecter == "Category") {
		//if its a category, wont we like to know the category? Of course, so we do the following
			 if ($category_selecter == "All"){
				 print "Please Select a Category"; $_SESSION['sendto_nos'] = "";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			 } else if ($category_selecter == "Parent") {
				 $general_parent_numbers = ""; $general_all_number = 0;
				//working parameters {grade_selecter, sex_selecter}
				function get_parents_from_grade_selector($grade, $sex) {
				global $general_all_number; global $general_parent_numbers;
				  //print $deduced_grades_obj->grades_id. '<br />'; now, we have gotten the grade levels: lets deal with it as a single grade
						$each_grade = "SELECT * FROM student_grade_year WHERE student_grade_year_grade = '".$grade."'
							AND student_grade_year_year = '".$_SESSION['CurrentYear']."' ";
							$dbh_Query_EG = $dbh->prepare($each_grade);$dbh_Query_EG->execute(); $rowCount = $dbh_Query_EG->rowCount(); 
							//now we use this to get the parents that is tied to the students..
							//lets filter for the classes that is not in the database, maybe the class does not exist
							if ($rowCount == 0) { //then do nothing about it
								} else {
									//we catch the parents via the student id
									while ($student_id_obj = $dbh_Query_EG->fetch(PDO::FETCH_OBJ)) {
										//print $student_id_obj->student_grade_year_student; especially the activated ones in the portal.
										$get_parents_no = "SELECT * FROM parent_to_kids AS ptk, student_parents AS sp 
											WHERE ptk.student_id = '".$student_id_obj->student_grade_year_student."' AND ptk.confirmation = '1' AND 
											ptk.parent_id = sp.student_parents_id AND sp.student_parents_sex LIKE '".$sex."'";
											$dbh_sSQL_ptk = $dbh->prepare($get_parents_no); $dbh_sSQL_ptk->execute(); $rowCountx = $dbh_sSQL_ptk->rowCount(); 
											if ($rowCountx != 0) {
												$get_parent_no_obj = $dbh_sSQL_ptk->fetch(PDO::FETCH_OBJ);
												$general_parent_numbers .= ($get_parent_no_obj->student_parents_mobile1 == "")? $get_parent_no_obj->student_parents_mobile2: $get_parent_no_obj->student_parents_mobile1. ", ";
												$general_all_number = $general_all_number + 1;
											}
										$dbh_sSQL_ptk = null;
									}
									$dbh_Query_EG = null; //close the connection on the thread to stop a sleeping connection
								}
				}
				 //lets check if the grade selected is to all of them
				 if ($grade_selecter == "All") {
					$raw_query = "SELECT * FROM web_users AS wu, student_parents AS sp, parent_to_kids AS ptk 
								WHERE wu.web_users_type = 'C' AND sp.student_parents_id = wu.web_users_relid AND sp.student_parents_status = '1'
								AND ptk.confirmation = '1' AND ptk.parent_id = wu.web_users_relid";
						$dbh_Query_RQ = $dbh->prepare($raw_query); $dbh_Query_RQ->execute();
					
						while ($all_parent_number = $dbh_Query_RQ->fetch(PDO::FETCH_OBJ)) {
							 if ($all_parent_number->student_parents_mobile1 == "" and $all_parent_number->student_parents_mobile2 == "") {  // then do nothing
							 } else {
								 $general_parent_numbers .= ($all_parent_number->student_parents_mobile1 == "")? $all_parent_number->student_parents_mobile2: $all_parent_number->student_parents_mobile1. ", ";
								 $general_all_number = $general_all_number + 1;
							 }
						 }
					 $dbh_Query_RQ = null;
				 } else {
					 //we are going to run the most complex query of all times here.. because a category was selected...
					 //first of all, we get the students under a class, then we get their parents and info
						if (!is_numeric($grade_selecter)) { //then its an advanced selector ... lets go crazy { $_SESSION['CurrentTerm'], $_SESSION['CurrentYear'] }
							//let us know the grade selector that was pointed out
								$deduce_grades_id = "SELECT * FROM tbl_grade_domains AS gd, grades AS g WHERE gd.school_names = '".$grade_selecter."' AND gd.id = g.grades_domain";
								$dbh_Query_ddgID = $dbh->prepare($deduce_grades_id); $dbh_Query_ddgID->execute();
                            while ($deduced_grades_obj = $dbh_Query_ddgID->fetch(PDO::FETCH_OBJ)) {
                                get_parents_from_grade_selector($deduced_grades_obj->grades_id, $sex_selecter);
                            }
							 $dbh_Query_ddgID = null;
						} else {
							get_parents_from_grade_selector($grade_selecter, $sex_selecter);
						}
					}
				$everybody_no = rtrim(trim($general_parent_numbers), ",");
				 $_SESSION['sendto_nos'] = $everybody_no;
				 print " Number(s) transferred: <b>".number_format($general_all_number) ."</b>. Ready to send... ";
				 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			} else if  ($category_selecter == "Student") {
				//working parameters {grade_selecter, sex_selecter, student_selecter}
				$general_student_numbers = "";
			    $general_all_number = 0;
				 
			function get_student_from_grade_selector($grade, $sex, $group) {
				global $general_all_number;
				global $general_student_numbers;
				  //print $deduced_grades_obj->grades_id. '<br />'; now, we have gotten the grade levels: lets deal with it as a single grade
					$each_grade = "SELECT * FROM student_grade_year AS sgy, studentbio AS sb WHERE sgy.student_grade_year_grade = '".$grade."'
						AND sgy.student_grade_year_year = '".$_SESSION['CurrentYear']."' AND sgy.student_grade_year_student = sb.studentbio_id
						AND sb.admit LIKE '".$group."' AND sb.studentbio_gender LIKE '".$sex."'";
					$dbh_sSQL_each_grade = $dbh->prepare($each_grade); $dbh_sSQL_each_grade->execute(); $rowCountxyz = $dbh_sSQL_each_grade->rowCount(); 
						//lets filter for the classes that is not in the database, maybe the class does not exist
						if ($rowCountxyz == 0) { //then do nothing about it
							} else {
								//we append all the students mobile to this
								while ($student_id_obj = $dbh_sSQL_each_grade->fetch(PDO::FETCH_OBJ)) {
									if ($student_id_obj->std_bio_mobile != "") {
										$general_student_numbers .= $student_id_obj->std_bio_mobile. ", ";
										$general_all_number = $general_all_number + 1;
									} 
								}
								$dbh_sSQL_each_grade = null;
							}
				}
				
				if ($grade_selecter == "All") {
					$all_std_no = "SELECT * FROM studentbio WHERE admit LIKE '".$student_selecter."'";
					$dbh_Query_all_std_no = $dbh->prepare($all_std_no); $dbh_Query_all_std_no->execute(); 
						while ($get_all_std_nos = $dbh_Query_all_std_no->fetch(PDO::FETCH_OBJ)) {
							$general_student_numbers .= $get_all_std_nos->std_bio_mobile. ", ";
							$general_all_number = $general_all_number + 1;
						}
					$dbh_Query_all_std_no = null;
						
				} else {
				//we are going to run the most complex query of all times here.. because a category was selected...
				//first of all, we get the students under a class, then we get their parents and info
						if (!is_numeric($grade_selecter)) {
                            $deduce_grades_id = "SELECT * FROM tbl_grade_domains AS gd, grades AS g WHERE gd.school_names = '".$grade_selecter."' AND gd.id = g.grades_domain";
							$dbh_Query_DDGRADE = $dbh->prepare($deduce_grades_id); $dbh_Query_DDGRADE->execute(); $dbh_Query_DDGRADE = null;
                                while ($deduced_grades_obj = $dbh_Query_DDGRADE->fetch(PDO::FETCH_OBJ)) {
                                    get_student_from_grade_selector($deduced_grades_obj->grades_id, $sex_selecter, '%%');
                                }
						} else {
                            get_student_from_grade_selector($grade_selecter, $sex_selecter, '%%');
						}				
				}
				 $everybody_no = rtrim(trim($general_student_numbers), ",");
					$_SESSION['sendto_nos'] = $everybody_no;
					print " Number(s) transferred: <b>".number_format($general_all_number) ."</b>. Ready to send... ";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			} else if ($category_selecter == "Staff") {
				//then we need to know the king of staff coming in
                 $general_staff_numbers = "";
                 $general_all_number = 0;
				//working parameters {grade_selecter, sex_selecter, staff_selecter}
                 $queryLized = ($staff_selecter == "gov_board")? " IN ('X', 'Xp', 'Y', 'Yp')": " LIKE '".$staff_selecter."'";
				 $staff_phone_number_collector_all = "SELECT * FROM web_users AS wu, staff AS st WHERE wu.web_users_type ".$queryLized." AND st.staff_id = wu.web_users_relid AND st.staff_sex LIKE '".$sex_selecter."'";
					$dbh_Query_spn = $dbh->prepare($staff_phone_number_collector_all); $dbh_Query_spn->execute();
						while ($all_staff_number = $dbh_Query_spn->fetch(PDO::FETCH_OBJ)) {
							if ($all_staff_number->staff_mobile == "") {  // then do nothing
							} else {
                                $general_staff_numbers .= $all_staff_number->staff_mobile. ", ";
                                $general_all_number = $general_all_number + 1;
							}
						}
					$dbh_Query_spn = null;
                 $everybody_no = rtrim(trim($general_staff_numbers), ",");
                 $_SESSION['sendto_nos'] = $everybody_no;
                 print " Number(s) transferred: <b>".number_format($general_all_number) ."</b>. Ready to send... ";
             }
	}
/*---------------------------------------------------------------------------------------------------------*/
} else if ($transfer == "view_nos") {
    $nos_to_view = ($_SESSION['sendto_nos'] == "")? "No Numbers to View":  $_SESSION['sendto_nos'];
    print "<textarea rows='4' cols='45' style='padding:10px'>".$nos_to_view."</textarea>"; // to view the numbers that are in the stored session.
/*---------------------------------------------------------------------------------------------------------*/
} else if ($transfer == "send_single") {
   //condition for sending single messages
    if (strIsEmpty($country) or strIsEmpty($sender_id) or strIsEmpty($message_numbers) or strIsEmpty($message_body)) {
        $myp->AlertInfo('Error! ', 'Please fill in all the fields');
    } else {
        $final = nl2br($message_body);
        $final_msg = str_replace('<br />', '', $final);
		$final_msg = preg_replace('/\s+/', '+',$final_msg); // remove all white spaces from the message and add a plus to them
        $http_request = curl_download($api_settings->api_def.'/API/WebSMS/Http/v3.0/?method=compose&username='.$api_settings->api_user.'&password='.$api_settings->api_pass.'&sender='.$sender_id.'&to='.$message_numbers.'&message='.$final_msg.'&reqid=1&international=1&format=xml');
        if ($http_request == "") { //to be tested
            $myp->AlertInfo("Oops! ", "Could not get response from server. Please try again later");
        } else if (strpos($http_request, "a:5") !== true) {
            $myp->AlertInfo("Server Message! ", 'Message Sent!');
            $others = "Sender ID: ".$sender_id;
            add_sms_history("Single Message", $others, $message_body);
        }
    }
 /*---------------------------------------------------------------------------------------------------------*/
} else if ($transfer == "send_bulk") {
    //print_r($_POST);
    //condition for sending bulk messages
    if (strIsEmpty($country) or strIsEmpty($sender_id) or strIsEmpty($message_body)) {
        $myp->AlertInfo('Error! ', 'Please fill in all the fields');
    } else if ($_SESSION['sendto_nos'] == "") {
        $myp->AlertInfo('Emmmm! ', 'Looks like you are trying to send message to nobody. Please Click on "View numbers".');
    } else {
        $final = nl2br($message_body);
        $final_msg = str_replace('<br />', '', $final);
		$final_msg = preg_replace('/\s+/', '+',$final_msg); // remove all white spaces from the message and add a plus to them
		//http://sms.ifihear.com/API/WebSMS/Http/v3.0?method=compose&username=Am4gej&password=openam4gej&sender='.$sender.'&to='.$to.'&message='.$final_msg.'..www.am4gej.org.&international=1&format=xml
        $http_request = curl_download($api_settings->api_def.'/API/WebSMS/Http/v3.0/?method=compose&username='.$api_settings->api_user.'&password='.$api_settings->api_pass.'&sender='.$sender_id.'&to='.$_SESSION['sendto_nos'].'&message='.$final_msg.'&reqid=1&international=1&format=xml');
        if ($http_request == "") { //to be tested
            $myp->AlertInfo("Oops! ", "Could not get response from server. Please try again later");

        } else {

            $others = ""; //organizing the details of the others .. more details of the sending
            $others .= ($sendto_selecter == "Everybody")? "Sent To Everybody": "Sent to ".$category_selecter;
            $others .= ($sex_selecter == "%%")? "<br />All Sex": "<br />Sent to: ".$sex_selecter;
            if (is_numeric($grade_selecter)) {
                $grade_selecter = mysql_result(mysql_query("SELECT * FROM grades WHERE grades_id = '".$grade_selecter."'"), 0, 'grades_desc');
            } else  { $grade_selecter = $grade_selecter; }
				
				if (strpos($http_request, "a:5") !== false) { 
					$others .= ($category_selecter == "Parent" or $category_selecter == "Student")? "<br />Grade: ".$grade_selecter: "";
					if ($staff_selecter == "%%") { $staff_selecter = "All"; }
					else if ($staff_selecter == "T") { $staff_selecter = "Teaching Staff"; }
					else if ($staff_selecter == "gov_board") { $staff_selecter = "Governing Board"; }
					else if ($staff_selecter == "S") { $staff_selecter = "Non Teaching Staff"; }
					else if ($staff_selecter == "Ty") { $staff_selecter = "NYSC Staff"; }
					else if ($staff_selecter == "Tp") { $staff_selecter = "Teaching Practice Staff"; }

					$others .= ($category_selecter == "Staff")? "<br />Staff Group: ".$staff_selecter: "";

					if ($student_selecter == "%%") { $student_selecter = "All"; }
					else if ($student_selecter == "1") { $student_selecter = "Admitted"; }
					else if ($student_selecter == "2") { $student_selecter = "Graduated"; }
					else if ($student_selecter == "3") { $student_selecter = "Suspended"; }

					$myp->AlertInfo("Server Message! ", "Message Sent!");
					add_sms_history("Bulk Message", $others, $message_body);
				} else {
					$myp->AlertInfo("Server Message! ", $http_request);
				}
        }
    }
}
/*---------------------------------------------------------------------------------------------------------*/
?>