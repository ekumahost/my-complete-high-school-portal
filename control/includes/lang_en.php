<?php


/** ensure this file is being included by a parent file: */
defined( '_VALID' ) or die( 'No direct access allowed.' );// BOUNCE ANY HACKER comming from this window

/** common */

DEFINE('_BROWSER_TITLE', ':: TeraSchool App');
DEFINE('_WELCOME', 'Welcome');
DEFINE('_YES', 'Yes');
DEFINE('_NO', 'No');
DEFINE('_ENTER_VALUE', 'You have to enter a value!');
DEFINE('_ERROR', 'Error');
DEFINE("_MAX_ATTEMPTS", 400);
DEFINE('_MALE', 'Male');
DEFINE('_FEMALE', 'Female');
DEFINE('_NEW', 'New');
DEFINE('_HOST', 'localhost');
DEFINE('_DATE_FORMAT', 'l F j, Y');
DEFINE('_EXAMS_DATE', '%m/%d/%Y');
DEFINE('_STUDENTBIO_DATE', '%m/%d/%Y');
DEFINE('_CAL_FORMAT', 'MM/DD/YYYY');
DEFINE('_STUDENT_DATE', 'YYYY-MM-DD');
DEFINE('_MONDAY', 'Mo');
DEFINE('_TUESDAY', 'Tu');
DEFINE('_WEDNESDAY', 'We');
DEFINE('_THURSDAY', 'Th');
DEFINE('_FRIDAY', 'Fr');

/** index.php */

DEFINE('_INDEX_TITLE', 'TeraSchool Management System' );
DEFINE('_INDEX_ERRLOG', 'Nay! Wrong password!<br> Account will be blocked at several trials.' );
DEFINE('_INDEX_NOTAUTH', 'Not authorized or session expired. Close this Tab and Login again.' );
DEFINE('_INDEX_NOTFOUND', 'We could not find any user with that email, please try again.' );
DEFINE('_INDEX_GOTPASS', 'Your password has been emailed to you.' );
DEFINE('_INDEX_ATTEMPT', 'Too many attempts to login.<br>Please retry in 20 minutes.' );
DEFINE('_INDEX_USERNAME', 'User Name' );
DEFINE('_INDEX_PASSWORD', 'Password' );
DEFINE('_INDEX_LOGIN', 'Login' );
DEFINE('_INDEX_FORGOT_PASSWORD', 'Forgot Password' );

/** admin_change_student_year.php */

DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_CONFIRM', 'The default year for students wil be changed. Continue?' );
DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_UPPER', 'Administrator Area' );
DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_TITLE', 'Change Default Year for Students' );
DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_SELECT', 'Select available years:' );

/** admin_change_year.php */

DEFINE('_ADMIN_CHANGE_YEAR_CONFIRM', 'Last Possibility to change Your Mind\nChange to Next Year ?');
DEFINE('_ADMIN_CHANGE_YEAR_UPPER', 'Administrator Area');
DEFINE('_ADMIN_CHANGE_YEAR_TITLE', 'Change Current Year to Next One');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT1', 'Are you really sure you want to change the current working year from ');
DEFINE('_ADMIN_CHANGE_YEAR_TO', ' to ');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT2', 'Current default year will be set to ');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT3', ' and all students will be swifted up one grade.');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT4', 'This operation <strong>CANNOT</strong> be reversed, so please be <strong>ABSOLUTELY</strong> sure that you want to perform this change.');
DEFINE('_ADMIN_CHANGE_YEAR_CONFIRM2', 'Confirm Change Of Year');

/** admin_change_year_successul.php */

DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_TITLE', 'Change Was Successful');
DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_TEXT1', 'All Students Were Promoted');
DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_TEXT2', 'You Are Now in the New Year');

/** admin_change_year_error.php */

DEFINE('_ADMIN_CHANGE_YEAR_ERROR_UPPER', 'Administrator Area');
DEFINE('_ADMIN_CHANGE_YEAR_ERROR_TITLE', 'Change Was Unsuccessful');
DEFINE('_ADMIN_CHANGE_YEAR_ERROR_TEXT1', 'That School Year Already exists');

/** admin_config.php */

DEFINE('_ADMIN_CONFIG_UPPER', 'Administrator Area');
DEFINE('_ADMIN_CONFIG_TITLE', 'Update General Configuration');
DEFINE('_ADMIN_CONFIG_CURRENT', 'Current Year');
DEFINE('_ADMIN_CONFIG_NEXT', 'Change to Next Year');
DEFINE('_ADMIN_CONFIG_LOGIN', 'Login Message (seen by every user and general public)');
DEFINE('_ADMIN_CONFIG_TEACHERS', 'Message to Teachers (it will display when Teachers Login)');
DEFINE('_ADMIN_CONFIG_PARENTS', 'Message to Parents(it will display when parents Login)');
DEFINE('_ADMIN_CONFIG_DEF_CITY', 'Default City');
DEFINE('_ADMIN_CONFIG_DEF_STATE', 'Default State');
DEFINE('_ADMIN_CONFIG_DEF_ZIP', 'Default Zip');
DEFINE('_ADMIN_CONFIG_DEF_DATE', 'Default Entry Date');
DEFINE('_ADMIN_CONFIG_DEF_UPDATE', 'Update Messages');




/** generatereportcard.php */

DEFINE('_GENERATE_REPORT_CARD_ADMIN_AREA', 'Administrator Area');
DEFINE('_GENERATE_REPORT_CARD_TITLE', 'Report Card');
DEFINE('_GENERATE_REPORT_CARD_SUBTITLE', 'No report cards to view.');
DEFINE('_GENERATE_REPORT_CARD_NAME', 'Course Name');
DEFINE('_GENERATE_REPORT_CARD_TEACHER', 'Teacher');
DEFINE('_GENERATE_REPORT_CARD_OVERALL', 'Overall');
DEFINE('_GENERATE_REPORT_CARD_EFFORT', 'Effort');
DEFINE('_GENERATE_REPORT_CARD_CONDUCT', 'Conduct');
DEFINE('_GENERATE_REPORT_CARD_COMMENTS', 'Comments');
DEFINE('_GENERATE_REPORT_CARD_GENERATE', 'Generate Report');

/** generatereportcardnew.php */

DEFINE('_GENERATE_REPORT_CARD_NEW_ADMIN_AREA', 'Administrator Area');
DEFINE('_GENERATE_REPORT_CARD_NEW_TITLE', 'Report Card');
DEFINE('_GENERATE_REPORT_CARD_NEW_TITLE2', 'Choose a Report Card to view');
DEFINE('_GENERATE_REPORT_CARD_NEW_SUBTITLE', 'No report cards to view.');
DEFINE("_GENERATE_REPORT_CARD_NEW_WRITE", "Report cards for Grade");
DEFINE('_GENERATE_REPORT_CARD_NEW_NAME', 'Course Name');
DEFINE('_GENERATE_REPORT_CARD_NEW_TEACHER', 'Teacher');
DEFINE('_GENERATE_REPORT_CARD_NEW_OVERALL', 'Overall');
DEFINE('_GENERATE_REPORT_CARD_NEW_EFFORT', 'Effort');
DEFINE('_GENERATE_REPORT_CARD_NEW_CONDUCT', 'Conduct');
DEFINE('_GENERATE_REPORT_CARD_NEW_COMMENTS', 'Comments');
DEFINE('_GENERATE_REPORT_CARD_NEW_COURSE', 'Course Name');
DEFINE('_GENERATE_REPORT_CARD_NEW_NONE', 'None');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER1', 'Quarter 1');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER2', 'Quarter 2');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER3', 'Quarter 3');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER4', 'Quarter 4');
DEFINE('_GENERATE_REPORT_CARD_NEW_CHOOSE', 'Choose a Student');
DEFINE('_GENERATE_REPORT_CARD_NEW_GENERATE', 'Generate Report');
DEFINE('_GENERATE_REPORT_CARD_NEW_GENERATE2', 'Generate Report');
DEFINE('_GENERATE_REPORT_CARD_NEW_CHOOSE2', 'Choose a school and grade to generate report card for');

/*** forgot_password.php */

DEFINE('_FORGOT_PASSWORD_FORM_ERROR','The value in field Email has to be a valid address.');
DEFINE('_FORGOT_PASSWORD_SUBJECT','Password Retrieval');
DEFINE('_FORGOT_PASSWORD_BODY1','Your password to access SMS System is ');
DEFINE('_FORGOT_PASSWORD_BODY2','You can use it to login now. Thanks - The Principal');
DEFINE('_FORGOT_PASSWORD_FORM_ERROR2','No user has been found with the email address you provided.');
DEFINE('_FORGOT_PASSWORD_PICTURE_SMALL','images/sms_en_small.gif');
DEFINE('_FORGOT_PASSWORD_EMAIL','Input your email address');
DEFINE('_FORGOT_PASSWORD_SUBMIT','Retrieve Password');

/** ez_results.php */

DEFINE('_EZ_RESULTS_NO_RESULTS', 'No Results.');
DEFINE('_EZ_RESULTS_MIXED_NAV_LEFT', 'Browsing CUR_START-CUR_END of TOTAL_RESULTS results (page CUR_PAGE of NUM_PAGES pages)');
DEFINE('_EZ_RESULTS_MIXED_NAV_RIGHT', 'Browsing CUR_START-CUR_END of TOTAL_RESULTS results (page CUR_PAGE of NUM_PAGES pages)');
DEFINE('_EZ_RESULTS_TEXT_COUNT', 'NUMBER Results');
DEFINE('_EZ_RESULTS_TEXT_NEXT', 'Next NUMBER &gt;&gt;');
DEFINE('_EZ_RESULTS_TEXT_BACK', '&lt;&lt; NUMBER Back');
DEFINE('_EZ_RESULTS_TEXT_NUM_PAGES', '| NUMBER PAGES |');
DEFINE('_EZ_RESULTS_TEXT_START_PAGE', '[<u>start</u>]');
DEFINE('_EZ_RESULTS_TEXT_LAST_PAGE', '[<u>last of NUMBER pages</u>]');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_LINK', 'Goto page NUMBER of results..');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_NEXT', 'Goto next NUMBER of results..');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_BACK', 'Goto previous NUMBER of results..');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_START', 'Goto start NUMBER of results..');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_END', 'Goto end NUMBER of results..');





















DEFINE('_REPORT_GRADES_2_HEADER', 'Active Students Report');
DEFINE('_REPORT_GRADES_2_HEADER_SUBJECT', 'Subject');
DEFINE('_REPORT_GRADES_2_HEADER_QUARTER', 'Quarter');
DEFINE('_REPORT_GRADES_2_HEADER_GRADE', 'Grade');
DEFINE('_REPORT_GRADES_2_HEADER_EFFORT', 'Effort');
DEFINE('_REPORT_GRADES_2_HEADER_CONDUCT', 'Conduct');
DEFINE('_REPORT_GRADES_2_NONE', 'No matching records to display');

/** report_student.php */

DEFINE('_REPORT_STUDENT_BROWSER_TITLE', 'Student Report');
DEFINE('_REPORT_STUDENT_HEADER', 'Actives Student Report');
DEFINE('_REPORT_STUDENT_ROUTE', 'Bus Route ');
DEFINE('_REPORT_STUDENT_HOME', 'Home Room ');
DEFINE('_REPORT_STUDENT_INTERNAL', 'Internal ID');
DEFINE('_REPORT_STUDENT_DOB', 'DOB');
DEFINE('_REPORT_STUDENT_SCHOOL', 'School');
DEFINE('_REPORT_STUDENT_GRADE', 'Grade');
DEFINE('_REPORT_STUDENT_ETHNICITY', 'Ethnicity');
DEFINE('_REPORT_STUDENT_NONE', 'No matching records to display');

/** reply.php */

DEFINE('_REPLY_UPPER', 'Discussion Board');

/** post.php */

DEFINE('_POST_UPPER', 'Discussion Board');

/** phpunit.php */

DEFINE('_PHPUNIT_FAIL', 'FAIL');
DEFINE('_PHPUNIT_OK', 'OK');

/** phpforum.php */

DEFINE('_PHPFORUM_MISSING_GET', 'Missing GET arguments in URL');
DEFINE('_PHPFORUM_INVALID_FORUM', 'Invalid forum selected');
DEFINE('_PHPFORUM_FORUM_EMPTY', 'Forum empty');
DEFINE('_PHPFORUM_INVALID_POS', 'Invalid position identifier');

/** pdfclass.php */

DEFINE('_PDFCLASS_INTERNAL', 'Internal ID');
DEFINE('_PDFCLASS_NAME', 'Name');
DEFINE('_PDFCLASS_DOB', 'DOB');
DEFINE('_PDFCLASS_SCHOOL', 'School');
DEFINE('_PDFCLASS_GRADE', 'Grade');
DEFINE('_PDFCLASS_HOME', 'Home Room');
DEFINE('_PDFCLASS_ETHNICITY', 'Ethnicity');
DEFINE('_PDFCLASS_SEX', 'Sex');
DEFINE('_PDFCLASS_ROUTE', 'Bus Route');

/** nurse_info_1.php */

DEFINE('_NURSE_INFO_1_TITLE', 'Manage Students');
DEFINE('_NURSE_INFO_1_SEARCH_DB', 'Search the Database');
DEFINE('_NURSE_INFO_1_BY_INTERNAL', 'By Internal ID');
DEFINE('_NURSE_INFO_1_BY_LAST', 'By Last Name');
DEFINE('_NURSE_INFO_1_SEARCH', 'Search');
DEFINE('_NURSE_INFO_1_OR_BY', 'Or By');
DEFINE('_NURSE_INFO_1_BY_GRADE', 'By Grade');
DEFINE('_NURSE_INFO_1_BY_GENDER', 'By Gender');
DEFINE('_NURSE_INFO_1_BY_ETHNICITY', 'By Ethnicity');
DEFINE('_NURSE_INFO_1_ACTIVE', 'Active');
DEFINE('_NURSE_INFO_1_HOMED', 'Homed');
DEFINE('_NURSE_INFO_1_SPED', 'Sp.Ed.');
DEFINE('_NURSE_INFO_1_SEARCH_LAST', 'Or display by last name initial');

/** nurse_info_2.php */

DEFINE('_NURSE_INFO_2_ERROR_ID', 'No Student found with Internal ID ');
DEFINE('_NURSE_INFO_2_ERROR_LAST', 'No Student found with Last Name ');
DEFINE('_NURSE_INFO_2_SELECT', 'Select');
DEFINE('_NURSE_INFO_2_ERROR_CRITERIA', 'No Student found with your search criteria.');
DEFINE('_NURSE_INFO_2_TITLE', 'Student Search Result');
DEFINE('_NURSE_INFO_2_NEW', 'New Search');

/** nurse_info_3.php */

DEFINE('_NURSE_INFO_3_UPPER', 'Health Area');
DEFINE('_NURSE_INFO_3_TITLE', 'Student Health Summary');
DEFINE('_NURSE_INFO_3_DOB', 'Date of Birth');
DEFINE('_NURSE_INFO_3_SCHOOL', 'School');
DEFINE('_NURSE_INFO_3_GRADE', 'Grade');
DEFINE('_NURSE_INFO_3_HOME', 'Home Room');
DEFINE('_NURSE_INFO_3_TEACHER', 'Teacher');
DEFINE('_NURSE_INFO_3_ROUTE', 'Bus Route');
DEFINE('_NURSE_INFO_3_PRIMARY', 'Primary Contact');
DEFINE('_NURSE_INFO_3_RESIDENCE', 'Residence');
DEFINE('_NURSE_INFO_3_ADDRESS', 'Address');
DEFINE('_NURSE_INFO_3_CITY', 'City');
DEFINE('_NURSE_INFO_3_STATE', 'State');
DEFINE('_NURSE_INFO_3_ZIP', 'Zip');
DEFINE('_NURSE_INFO_3_PHONE1', 'Phone #');
DEFINE('_NURSE_INFO_3_PHONE2', 'Alt. Phone #');
DEFINE('_NURSE_INFO_3_PHONE3', 'Alt. Phone #');
DEFINE('_NURSE_INFO_3_MED_INFO', 'Medication Information for Student');
DEFINE('_NURSE_INFO_3_DATE', 'Date');
DEFINE('_NURSE_INFO_3_MEDICATION', 'Medication');
DEFINE('_NURSE_INFO_3_CODE', 'Code');
DEFINE('_NURSE_INFO_3_DETAILS', 'Details');
DEFINE('_NURSE_INFO_3_ALL_INFO', 'Allergy Information for Student');
DEFINE('_NURSE_INFO_3_ALLERGY', 'Allergy');
DEFINE('_NURSE_INFO_3_IMM_INFO', 'Immunization History for Student');
DEFINE('_NURSE_INFO_3_IMM', 'Immunization');
DEFINE('_NURSE_INFO_3_HEALTH_INFO', 'Health Office History for Student');
DEFINE('_NURSE_INFO_3_HEALTH', 'Health');

/** nurse_student_1.php */

DEFINE('_NURSE_STUDENT_1_ENTER_VALUE', 'You have to enter a value!');
DEFINE('_NURSE_STUDENT_1_TITLE', 'Manage Students');
DEFINE('_NURSE_STUDENT_1_SEARCH_DB', 'Search the Database');
DEFINE('_NURSE_STUDENT_1_BY_INTERNAL', 'By Internal ID');
DEFINE('_NURSE_STUDENT_1_BY_LAST', 'By Last Name');
DEFINE('_NURSE_STUDENT_1_SEARCH', 'Search');
DEFINE('_NURSE_STUDENT_1_OR_BY', 'Or By');
DEFINE('_NURSE_STUDENT_1_BY_GRADE', 'By Grade');
DEFINE('_NURSE_STUDENT_1_BY_GENDER', 'By Gender');
DEFINE('_NURSE_STUDENT_1_BY_ETHNICITY', 'By Ethnicity');
DEFINE('_NURSE_STUDENT_1_ACTIVE', 'Active');
DEFINE('_NURSE_STUDENT_1_HOMED', 'Homed');
DEFINE('_NURSE_STUDENT_1_SPED', 'Sp.Ed.');
DEFINE('_NURSE_STUDENT_1_SEARCH_LAST', 'Or display by last name initial');

/** nurse_student_2.php */

DEFINE('_NURSE_STUDENT_2_ERROR_ID', 'No Student found with Internal ID ');
DEFINE('_NURSE_STUDENT_2_ERROR_LAST', 'No Student found with Last Name ');
DEFINE('_NURSE_STUDENT_2_SELECT', 'Select');
DEFINE('_NURSE_STUDENT_2_ERROR_CRITERIA', 'No Student found with your search criteria.');
DEFINE('_NURSE_STUDENT_2_TITLE', 'Student Search Result');
DEFINE('_NURSE_STUDENT_2_NEW', 'New Search');

/** makereport.php */

DEFINE("_MAKE_REPORT_THING", "Discipline report");
DEFINE('_MAKE_REPORT_FROM', ' from ');
DEFINE('_MAKE_REPORT_TO', ' to ');
DEFINE('_MAKE_REPORT_NAME', 'Name');
DEFINE('_MAKE_REPORT_INFRACTION', 'Infraction');
DEFINE('_MAKE_REPORT_DATE', 'Date');
DEFINE('_MAKE_REPORT_REPORTER', 'Reporter');
DEFINE('_MAKE_REPORT_ACTION', 'Action Taken');
DEFINE('_MAKE_REPORT_NOTES', 'Notes');
DEFINE('_MAKE_REPORT_SEX', 'Sex');
DEFINE('_MAKE_REPORT_SCHOOL', 'School');
DEFINE('_MAKE_REPORT_REASON', 'Reason for report');

/** health_menu.php */

DEFINE('_HEALTH_MENU_TITLE', 'Health Main Menu');
DEFINE('_HEALTH_MENU_SUBTITLE', 'Please choose a menu item from your left');

/** health_menu.inc.php */

DEFINE('_HEALTH_MENU_INC_TITLE', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_HEALTH_MENU_INC_TEXT', 'Hauptmen&uuml;');
DEFINE('_HEALTH_MENU_INC_SUMMARY', 'Student Health Summary');
DEFINE('_HEALTH_MENU_INC_SUMMARY_TEXT', 'Student Summary');
DEFINE('_HEALTH_MENU_INC_VISITS', 'Manage Health Office Visits');
DEFINE('_HEALTH_MENU_INC_VISITS_TEXT', 'Health Office Visits');
DEFINE('_HEALTH_MENU_INC_MED', 'Student Medications');
DEFINE('_HEALTH_MENU_INC_MED_TEXT', 'Student Medications');
DEFINE('_HEALTH_MENU_INC_IMM', 'Student Immunizations');
DEFINE('_HEALTH_MENU_INC_IMM_TEXT', 'Student Immunizations');
DEFINE('_HEALTH_MENU_INC_ALL', 'Student Allergies');
DEFINE('_HEALTH_MENU_INC_ALL_TEXT', 'Student Allergies');
DEFINE('_HEALTH_MENU_INC_CHANGE', 'Change Student Year');
DEFINE('_HEALTH_MENU_INC_CHANGE_TEXT', 'Change Student Year');
DEFINE('_HEALTH_MENU_INC_FORUM', 'Discussion Board');
DEFINE('_HEALTH_MENU_INC_FORUM_TEXT', 'Forum');
DEFINE('_HEALTH_MENU_INC_CHAT', 'Chat');
DEFINE('_HEALTH_MENU_INC_CHAT_TEXT', 'Chat');
DEFINE('_HEALTH_MENU_INC_EDIT_HEALTH', 'Edit Health Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_HEALTH_TEXT', 'Health Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_IMM', 'Edit Immunization Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_IMM_TEXT', 'Immunization Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_MED', 'Edit Medication Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_MED_TEXT', 'Medication Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_ALL', 'Edit Allergy Codes');
DEFINE('_HEALTH_MENU_INC_EDIT_ALL_TEXT', 'Allergy Codes');
DEFINE('_HEALTH_MENU_INC_PASSWORD', 'Change Login Password');
DEFINE('_HEALTH_MENU_INC_PASSWORD_TEXT', 'Change Password');
DEFINE('_HEALTH_MENU_INC_LOGOUT', 'Logout from System');
DEFINE('_HEALTH_MENU_INC_LOGOUT_TEXT', 'Logout');
DEFINE('_HEALTH_MENU_INC_ADMIN_AREA', 'Back to Admin Area');
DEFINE('_HEALTH_MENU_INC_ADMIN_AREA_TEXT', 'Admin Area');
DEFINE('_HEALTH_MENU_INC_YEAR', 'Year');

/** health_menu_forum.inc.php */
/** uses the same constants as health_menu.inc.php */

/** health_med_student_1.php */

DEFINE('_HEALTH_MED_STUDENT_1_ERROR_FORM', 'You should select a student first.');
DEFINE('_HEALTH_MED_STUDENT_1_DATE', 'Date');
DEFINE('_HEALTH_MED_STUDENT_1_MEDICATION', 'Medication');
DEFINE('_HEALTH_MED_STUDENT_1_DETAILS', 'Details');
DEFINE('_HEALTH_MED_STUDENT_1_UPPER', 'Health Area');
DEFINE('_HEALTH_MED_STUDENT_1_TITLE', 'Medication Information for Student');
DEFINE('_HEALTH_MED_STUDENT_1_BACK', 'Back to Studen');
DEFINE('_HEALTH_MED_STUDENT_1_ADD', 'Add Medicine Entry');

/** health_med_student_2.php */

DEFINE('_HEALTH_MED_STUDENT_2_UPPER', 'Health Area');
DEFINE('_HEALTH_MED_STUDENT_2_TITLE', 'Medication History for Student');
DEFINE('_HEALTH_MED_STUDENT_2_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_MED_STUDENT_2_SCHOOL', 'School');
DEFINE('_HEALTH_MED_STUDENT_2_YEAR', 'Year');
DEFINE('_HEALTH_MED_STUDENT_2_MED', 'Medication');
DEFINE('_HEALTH_MED_STUDENT_2_DATE', 'Date of Event');
DEFINE('_HEALTH_MED_STUDENT_2_REASON', 'Reason for Medication');
DEFINE('_HEALTH_MED_STUDENT_2_NOTES', 'Notes');
DEFINE('_HEALTH_MED_STUDENT_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_HEALTH_MED_STUDENT_2_BACK', 'Back to Student');
DEFINE('_HEALTH_MED_STUDENT_2_EDIT', 'Edit Health Note');

/** health_med_student_3.php */

DEFINE('_HEALTH_MED_STUDENT_3_UPPER', 'Health Area');
DEFINE('_HEALTH_MED_STUDENT_3_TITLE', 'Medicine History for Student');
DEFINE('_HEALTH_MED_STUDENT_3_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_MED_STUDENT_3_SCHOOL', 'School');
DEFINE('_HEALTH_MED_STUDENT_3_YEAR', 'Year');
DEFINE('_HEALTH_MED_STUDENT_3_MED', 'Select Medication');
DEFINE('_HEALTH_MED_STUDENT_3_DATE', 'Date of Change');
DEFINE('_HEALTH_MED_STUDENT_3_REASON', 'Reason for Medication');
DEFINE('_HEALTH_MED_STUDENT_3_NOTES', 'Notes');
DEFINE('_HEALTH_MED_STUDENT_3_BACK', 'Back to Student');
DEFINE('_HEALTH_MED_STUDENT_3_UPDATE_NOTE', 'Update Note');
DEFINE('_HEALTH_MED_STUDENT_3_ADD_NOTE', 'Add Note');

/** health_med_student_4.php */

DEFINE('_HEALTH_MED_STUDENT_4_ENTER_MED', 'You have to select a medication');
DEFINE('_HEALTH_MED_STUDENT_4_ENTER_REASON', 'You have to provide a reason for this change.');
DEFINE('_HEALTH_MED_STUDENT_4_UPPER', 'Health Area');
DEFINE('_HEALTH_MED_STUDENT_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** health_medicine.php */

DEFINE('_HEALTH_MEDICINE_NOT_REMOVED', 'Code cannot be removed, it\'s used in the system.');
DEFINE('_HEALTH_MEDICINE_DUP', 'That code has already been used.  Duplicates are not allowed.');
DEFINE('_HEALTH_MEDICINE_EDIT', 'Edit');
DEFINE('_HEALTH_MEDICINE_REMOVE', 'Remove');
DEFINE('_HEALTH_MEDICINE_SURE', 'Are you sure you want to remove this record?');
DEFINE('_HEALTH_MEDICINE_UPPER', 'Health Area');
DEFINE('_HEALTH_MEDICINE_TITLE', 'Manage Medicine Codes');
DEFINE('_HEALTH_MEDICINE_ADD_MED', 'Add New Medicine Code');
DEFINE('_HEALTH_MEDICINE_ADD', 'Add');
DEFINE('_HEALTH_MEDICINE_UPDATE_MED', 'Update Health Medicine Code');
DEFINE('_HEALTH_MEDICINE_UPDATE', 'Update');

/** health_manage_1.php */

DEFINE('_HEALTH_MANAGE_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_HEALTH_MANAGE_1_DATE', 'Date');
DEFINE('_HEALTH_MANAGE_1_CODE', 'Code');
DEFINE('_HEALTH_MANAGE_1_DETAILS', 'Details');
DEFINE('_HEALTH_MANAGE_1_UPPER', 'Health Area');
DEFINE('_HEALTH_MANAGE_1_TITLE', 'Health Office History for student');
DEFINE('_HEALTH_MANAGE_1_BACK', 'Back to Student');
DEFINE('_HEALTH_MANAGE_1_ADD', 'Add Health Office Note');

/** health_manage_2.php */

DEFINE('_HEALTH_MANAGE_2_UPPER', 'Health Area');
DEFINE('_HEALTH_MANAGE_2_TITLE', 'Health History for student');
DEFINE('_HEALTH_MANAGE_2_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_MANAGE_2_SCHOOL', 'School');
DEFINE('_HEALTH_MANAGE_2_YEAR', 'Year');
DEFINE('_HEALTH_MANAGE_2_INCIDENT', 'Health Incident');
DEFINE('_HEALTH_MANAGE_2_DATE', 'Date');
DEFINE('_HEALTH_MANAGE_2_ACTION', 'Action Taken');
DEFINE('_HEALTH_MANAGE_2_WHO', 'Who sent the student to Health');
DEFINE('_HEALTH_MANAGE_2_NOTES', 'Notes');
DEFINE('_HEALTH_MANAGE_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_HEALTH_MANAGE_2_BACK', 'Back to Student');
DEFINE('_HEALTH_MANAGE_2_EDIT', 'Edit Health Note');

/** health_manage_3.php */

DEFINE('_HEALTH_MANAGE_3_UPPER', 'Health Area');
DEFINE('_HEALTH_MANAGE_3_TITLE', 'Health History for student');
DEFINE('_HEALTH_MANAGE_3_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_MANAGE_3_SCHOOL', 'School');
DEFINE('_HEALTH_MANAGE_3_YEAR', 'Year');
DEFINE('_HEALTH_MANAGE_3_REASON', 'Reason for Office Visit');
DEFINE('_HEALTH_MANAGE_3_DATE', 'Ailment Date');
DEFINE('_HEALTH_MANAGE_3_SELECT', 'Select Reason');
DEFINE('_HEALTH_MANAGE_3_ACTION', 'Action Taken');
DEFINE('_HEALTH_MANAGE_3_WHO', 'Who sent the student to Health Office');
DEFINE('_HEALTH_MANAGE_3_NOTES', 'Notes');
DEFINE('_HEALTH_MANAGE_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_HEALTH_MANAGE_3_DELETE', 'Delete');
DEFINE('_HEALTH_MANAGE_3_NEW', 'Add New');
DEFINE('_HEALTH_MANAGE_3_BACK', 'Back to Student');
DEFINE('_HEALTH_MANAGE_3_UPDATE_NOTE', 'Update Note');
DEFINE('_HEALTH_MANAGE_3_ADD_NOTE', 'Add Note');

/** health_manage_4.php */

DEFINE('_HEALTH_MANAGE_4_ENTER_INFRACTION', 'You have to select an infraction code.');
DEFINE('_HEALTH_MANAGE_4_ENTER_DATE', 'You have to select a date.');
DEFINE('_HEALTH_MANAGE_4_ENTER_ACTION', 'You have to assign the action to be taken.');
DEFINE('_HEALTH_MANAGE_4_ENTER_WHO', 'You have to assign who reported this event.');
DEFINE('_HEALTH_MANAGE_4_UPPER', 'Health Area');
DEFINE('_HEALTH_MANAGE_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** health_immunz_student_1.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_DATE', 'Date');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_IMM', 'Immunization');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_DETAILS', 'Details');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_TITLE', 'Immunization History for student');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_BACK', 'Back to Student');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_ADD', 'Add Immunization Entry');

/** health_immunz_student_2.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_2_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_TITLE', 'Immunization History for student');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_SCHOOL', 'School');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_YEAR', 'Year');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_IMM', 'Immunization');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_DATE', 'Date of Event');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_REASON', 'Reason');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_NOTES', 'Notes');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_BACK', 'Back to Student');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_EDIT', 'Edit Immunization Note');

/** health_immunz_student_3.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_3_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_TITLE', 'Immunization History for student');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_SCHOOL', 'School');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_YEAR', 'Year');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_IMM', 'Immunization');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_DATE', 'Date of Event');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_SELECT', 'Select Immunization');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_REASON', 'Reason for Immunization');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_NOTES', 'Notes');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_BACK', 'Back to Student');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_UPDATE_NOTE', 'Update Note');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_ADD_NOTE', 'Add Note');

/** health_immunz_student_4.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_4_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_STUDENT_4_ENTER_MED', 'You have to select an immunization.');
DEFINE('_HEALTH_IMMUNZ_STUDENT_4_ENTER_REASON', 'You have to provide a reason for this change.');
DEFINE('_HEALTH_IMMUNZ_SZUDENT_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** health_immunz.php */

DEFINE('_HEALTH_IMMUNZ_NOT_REMOVED', 'Code cannot be removed, it\'s used in the system.');
DEFINE('_HEALTH_IMMUNZ_DUP', 'That code has already been used.  Duplicates are not allowed.');
DEFINE('_HEALTH_IMMUNZ_EDIT', 'Edit');
DEFINE('_HEALTH_IMMUNZ_REMOVE', 'Remove');
DEFINE('_HEALTH_IMMUNZ_SURE', 'Are you sure you want to remove this record?');
DEFINE('_HEALTH_IMMUNZ_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_TITLE', 'Manage Immunization Codes');
DEFINE('_HEALTH_IMMUNZ_NEW', 'Add New Immunization Code');
DEFINE('_HEALTH_IMMUNZ_ADD', 'Add');
DEFINE('_HEALTH_IMMUNZ_UPDATE_CODE', 'Update Immunization Code');
DEFINE('_HEALTH_IMMUNZ_UPDATE', 'Update');

/** health_immunz_1.php */

DEFINE('_HEALTH_IMMUNZ_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_HEALTH_IMMUNZ_1_DATE', 'Date');
DEFINE('_HEALTH_IMMUNZ_1_CODE', 'Code');
DEFINE('_HEALTH_IMMUNZ_1_DETAILS', 'Details');
DEFINE('_HEALTH_IMMUNZ_1_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_1_TITLE', 'Immunization History for Student');
DEFINE('_HEALTH_IMMUNZ_1_BACK', 'Back to Student');
DEFINE('_HEALTH_IMMUNZ_1_ADD', 'Add Immunization Note');

/** health_immunz_2.php */

DEFINE('_HEALTH_IMMUNZ_2_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_2_TITLE', 'Immunization Information for Student');
DEFINE('_HEALTH_IMMUNZ_2_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_IMMUNZ_2_SCHOOL', 'School');
DEFINE('_HEALTH_IMMUNZ_2_YEAR', 'Year');
DEFINE('_HEALTH_IMMUNZ_2_MED', 'Medication');
DEFINE('_HEALTH_IMMUNZ_2_DATE', 'Date of Event');
DEFINE('_HEALTH_IMMUNZ_2_REASON', 'Reason for Immunization');
DEFINE('_HEALTH_IMMUNZ_2_NOTES', 'Notes');
DEFINE('_HEALTH_IMMUNZ_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_HEALTH_IMMUNZ_2_BACK', 'Back to Student');
DEFINE('_HEALTH_IMMUNZ_2_EDIT', 'Edit Immunization Note');

/** health_immunz_3.php */

DEFINE('_HEALTH_IMMUNZ_3_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_3_TITLE', 'Immunization Information for Student');
DEFINE('_HEALTH_IMMUNZ_3_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_IMMUNZ_3_SCHOOL', 'School');
DEFINE('_HEALTH_IMMUNZ_3_YEAR', 'Year');
DEFINE('_HEALTH_IMMUNZ_3_MED', 'Medication');
DEFINE('_HEALTH_IMMUNZ_3_DATE', 'Date of Event');
DEFINE('_HEALTH_IMMUNZ_3_SELECT', 'Select Medication');
DEFINE('_HEALTH_IMMUNZ_3_REASON', 'Reason for Immunization');
DEFINE('_HEALTH_IMMUNZ_3_NOTES', 'Notes');
DEFINE('_HEALTH_IMMUNZ_3_BACK', 'Back to Student');
DEFINE('_HEALTH_IMMUNZ_3_UPDATE_NOTE', 'Update Note');
DEFINE('_HEALTH_IMMUNZ_3_ADD_NOTE', 'Add Note');

/** health_immunz_4.php */

DEFINE('_HEALTH_IMMUNZ_4_ENTER_MED', 'You have to select a medication.');
DEFINE('_HEALTH_IMMUNZ_4_ENTER_DATE', 'You have to select a date of record.');
DEFINE('_HEALTH_IMMUNZ_4_ENTER_REASON', 'You have to state the reason for this change.');
DEFINE('_HEALTH_IMMUNZ_4_UPPER', 'Health Area');
DEFINE('_HEALTH_IMMUNZ_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** health_allergy_1.php */

DEFINE('_HEALTH_ALLERGY_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_HEALTH_ALLERGY_1_DATE', 'Date');
DEFINE('_HEALTH_ALLERGY_1_CODE', 'Code');
DEFINE('_HEALTH_ALLERGY_1_DETAILS', 'Details');
DEFINE('_HEALTH_ALLERGY_1_UPPER', 'Health Area');
DEFINE('_HEALTH_ALLERGY_1_TITLE', 'Allergy History for Student');
DEFINE('_HEALTH_ALLERGY_1_BACK', 'Back to Student');
DEFINE('_HEALTH_ALLERGY_1_ADD', 'Add Allergy Note');

/** health_allergy_2.php */

DEFINE('_HEALTH_ALLERGY_2_UPPER', 'Health Area');
DEFINE('_HEALTH_ALLERGY_2_TITLE', 'Allergy Information for Student');
DEFINE('_HEALTH_ALLERGY_2_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_ALLERGY_2_SCHOOL', 'School');
DEFINE('_HEALTH_ALLERGY_2_YEAR', 'Year');
DEFINE('_HEALTH_ALLERGY_2_ALLERGY', 'Allergy');
DEFINE('_HEALTH_ALLERGY_2_DATE', 'Date of Event');
DEFINE('_HEALTH_ALLERGY_2_REASON', 'Reason for Allergy');
DEFINE('_HEALTH_ALLERGY_2_NOTES', 'Notes');
DEFINE('_HEALTH_ALLERGY_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_HEALTH_ALLERGY_2_BACK', 'Back to Student');
DEFINE('_HEALTH_ALLERGY_2_EDIT', 'Edit Allergy Note');

/** health_allergy_3.php */

DEFINE('_HEALTH_ALLERGY_3_UPPER', 'Health Area');
DEFINE('_HEALTH_ALLERGY_3_TITLE', 'Allergy Information for Student');
DEFINE('_HEALTH_ALLERGY_3_INSERTED', 'Note inserted by ');
DEFINE('_HEALTH_ALLERGY_3_SCHOOL', 'School');
DEFINE('_HEALTH_ALLERGY_3_YEAR', 'Year');
DEFINE('_HEALTH_ALLERGY_3_ALLERGY', 'Allergy');
DEFINE('_HEALTH_ALLERGY_3_DATE', 'Date of Event');
DEFINE('_HEALTH_ALLERGY_3_SELECT', 'Select Allergy');
DEFINE('_HEALTH_ALLERGY_3_REASON', 'Reason for Allergy');
DEFINE('_HEALTH_ALLERGY_3_NOTES', 'Notes');
DEFINE('_HEALTH_ALLERGY_3_BACK', 'Back to Student');
DEFINE('_HEALTH_ALLERGY_3_UPDATE_NOTE', 'Update Note');
DEFINE('_HEALTH_ALLERGY_3_ADD_NOTE', 'Add Note');

/** health_allergy_4.php */

DEFINE('_HEALTH_ALLERGY_4_ENTER_DATE', 'You have to select a date of record.');
DEFINE('_HEALTH_ALLERGY_4_ENTER_REASON', 'You have to state the reason for this change.');
DEFINE('_HEALTH_ALLERGY_4_UPPER', 'Health Area');
DEFINE('_HEALTH_ALLERGY_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** health_allergies.php */

DEFINE('_HEALTH_ALLERGIES_NOT_REMOVED', 'Code cannot be removed, it\'s used in the system.');
DEFINE('_HEALTH_ALLERGIES_DUP', 'That code has already been used.  Duplicates are not allowed.');
DEFINE('_HEALTH_ALLERGIES_EDIT', 'Edit');
DEFINE('_HEALTH_ALLERGIES_REMOVE', 'Remove');
DEFINE('_HEALTH_ALLERGIES_SURE', 'Are you sure you want to remove this record?');
DEFINE('_HEALTH_ALLERGIES_UPPER', 'Health Area');
DEFINE('_HEALTH_ALLERGIES_TITLE', 'Manage Allergy Codes');
DEFINE('_HEALTH_ALLERGIES_NEW', 'Add New Allergy Code');
DEFINE('_HEALTH_ALLERGIES_ADD', 'Add');
DEFINE('_HEALTH_ALLERGIES_UPDATE_CODE', 'Update Allergy Code');
DEFINE('_HEALTH_ALLERGIES_UPDATE', 'Update');

/** health_change_password.php */

DEFINE('_HEALTH_CHANGE_PASSWORD_SUCCESSFUL', 'Password Successfully Changed.' );
DEFINE('_HEALTH_CHANGE_PASSWORD_TITLE', 'Change your access password' );
DEFINE('_HEALTH_CHANGE_PASSWORD_UPDATE', 'Update Password' );

/** health_change_student_year.php */

DEFINE('_HEALTH_CHANGE_STUDENT_YEAR_CONFIRM', 'The default year for students wil be changed. Continue?' );
DEFINE('_HEALTH_CHANGE_STUDENT_YEAR_TITLE', 'Change Default Year for Students' );
DEFINE('_HEALTH_CHANGE_STUDENT_YEAR_SELECT', 'Select available years:' );

/** health_codes.php */

DEFINE('_HEALTH_CODES_NOT_REMOVED', 'Code cannot be removed, it\'s used in the system.');
DEFINE('_HEALTH_CODES_DUP', 'That code has already been used.  Duplicates are not allowed.');
DEFINE('_HEALTH_CODES_EDIT', 'Edit');
DEFINE('_HEALTH_CODES_REMOVE', 'Remove');
DEFINE('_HEALTH_CODES_SURE', 'Are you sure you want to remove this record?');
DEFINE('_HEALTH_CODES_UPPER', 'Health Area');
DEFINE('_HEALTH_CODES_TITLE', 'Manage Health Office Codes');
DEFINE('_HEALTH_CODES_NEW', 'Add New Health Office Code');
DEFINE('_HEALTH_CODES_ADD', 'Add');
DEFINE('_HEALTH_CODES_UPDATE_CODE', 'Update Health Office Code');
DEFINE('_HEALTH_CODES_UPDATE', 'Update');


/** down_reports.php */

DEFINE('_DOWN_REPORTS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_DOWN_REPORTS_TITLE', 'PDF reports');
DEFINE('_DOWN_REPORTS_STUDENTS', 'All Active Students');
DEFINE('_DOWN_REPORTS_ATTENDANCE', 'Daily Attendance Bulletin');
DEFINE('_DOWN_REPORTS_DISCIPLINE', 'Discipline');
DEFINE('_DOWN_REPORTS_GRADES', 'Report Cards');
DEFINE('_DOWN_REPORTS_SORTED', 'sorted by');
DEFINE('_DOWN_REPORTS_GRADES_ID', 'Grade');
DEFINE('_DOWN_REPORTS_SCHOOL', 'School');
DEFINE('_DOWN_REPORTS_ETH', 'Ethnicity');
DEFINE('_DOWN_REPORTS_GENDER', 'Gender');
DEFINE('_DOWN_REPORTS_HEADER', 'Active Students Report');
DEFINE('_DOWN_REPORTS_ROUTE', 'Bus Route');
DEFINE('_DOWN_REPORTS_HOME', 'Home Room');
DEFINE('_DOWN_REPORTS_FROM', 'from');
DEFINE('_DOWN_REPORTS_TO', 'to');
DEFINE('_DOWN_REPORTS_BY', 'By');
DEFINE('_DOWN_REPORTS_NONE', 'None');
DEFINE('_DOWN_REPORTS_DOWNLOAD', 'Download Report');

/** displayforum.php */

DEFINE('_DISPLAY_FORUM_UPPER', 'Discussion Board');

/** contacts_homework.php */

DEFINE('_CONTACTS_HOMEWORK_TITLE', 'Active Homework');
DEFINE('_CONTACTS_HOMEWORK_SUBJECT', 'Subject');
DEFINE('_CONTACTS_HOMEWORK_ROOM', 'Room');
DEFINE('_CONTACTS_HOMEWORK_TEACHER', 'Teacher');
DEFINE('_CONTACTS_HOMEWORK_ASSIGNED_ON', 'Assigned on');
DEFINE('_CONTACTS_HOMEWORK_DUE_ON', 'Due on');
DEFINE('_CONTACTS_HOMEWORK_NOTES', 'Notes');
DEFINE('_CONTACTS_HOMEWORK_FILES', 'Files');

/** contacts_menu.php */

DEFINE('_CONTACTS_MENU_TITLE', 'Parents\' Menu');
DEFINE('_CONTACTS_MENU_SUBTITLE', 'Please choose a student');
DEFINE('_CONTACTS_MENU_NO_STUDENTS', 'No Students');

/** contacts_set_student.php */

DEFINE('_CONTACTS_SET_STUDENT_TITLE', 'Parents\' Menu');
DEFINE('_CONTACTS_SET_STUDENT_SUBTITLE', 'Please use the menu on the left to see notes for student');

/** contact_change_password.php */

DEFINE('_CONTACT_CHANGE_PASSWORD_SUCCESSFUL', 'Password Successfully Changed.' );
DEFINE('_CONTACT_CHANGE_PASSWORD_TITLE', 'Change your access password' );
DEFINE('_CONTACT_CHANGE_PASSWORD_UPDATE', 'Update Password' );

/** contact_change_student_year.php */

DEFINE('_CONTACT_CHANGE_STUDENT_YEAR_CONFIRM', 'The default year for students wil be changed. Continue?' );
DEFINE('_CONTACT_CHANGE_STUDENT_YEAR_TITLE', 'Change Default Year for Students' );
DEFINE('_CONTACT_CHANGE_STUDENT_YEAR_SELECT', 'Select available years:' );

/** contact_manage_attendance_1.php */

DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_DATE', 'Date');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_CODE', 'Code');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_DETAILS', 'Details');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_TITLE', 'Attendance history for student');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_BACK', 'Back to Student');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_ADD_NOTE', 'Add Attendance Note');

/** contact_manage_attendance_2.php */

DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_TITLE', 'Attendance history for student');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_INSERTED', 'Note inserted by ');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_SCHOOL', 'School');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_YEAR', 'Year');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_CODE', 'Code');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_DATE', 'Date');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_NOTES', 'Notes');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_BACK', 'Back to Student');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_EDIT', 'Edit Attendance Note');

/** contact_manage_discipline_1.php */

DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_DATE', 'Date');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_CODE', 'Code');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_DETAILS', 'Details');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_TITLE', 'Discipline history for student');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_BACK', 'Back to Student');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_ADD_NOTE', 'Add Discipline Note');

/** contact_manage_discipline_2.php */

DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_TITLE', 'Discipline history for student');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_INSERTED', 'Note inserted by ');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_SCHOOL', 'School');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_YEAR', 'Year');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_INFRACTION', 'Infraction');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_DATE', 'Infraction Date');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_START_DATE', 'Start Date');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_END_DATE', 'End Date');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_ACTION', 'Action to be taken');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_WHO', 'Who reported the infraction');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_NOTES', 'Notes');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_BACK', 'Back to Student');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_EDIT', 'Edit Discipline Note');

/** contact_manage_grades_1.php */

DEFINE('_CONTACT_MANAGE_GRADES_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_CONTACT_MANAGE_GRADES_1_QUARTER', 'Quarter');
DEFINE('_CONTACT_MANAGE_GRADES_1_SUBJECT', 'Subject');
DEFINE('_CONTACT_MANAGE_GRADES_1_GRADE', 'Grade');
DEFINE('_CONTACT_MANAGE_GRADES_1_EFFORT', 'Effort');
DEFINE('_CONTACT_MANAGE_GRADES_1_DETAILS', 'Details');
DEFINE('_CONTACT_MANAGE_GRADES_1_TITLE', 'Grades history for student');
DEFINE('_CONTACT_MANAGE_GRADES_1_BACK', 'Back to Student');
DEFINE('_CONTACT_MANAGE_GRADES_1_ADD_NOTE', 'Add Grades Results');

/** contact_manage_grades_2.php */

DEFINE('_CONTACT_MANAGE_GRADES_2_TITLE', 'Grades history for student');
DEFINE('_CONTACT_MANAGE_GRADES_2_INSERTED', 'Note inserted by ');
DEFINE('_CONTACT_MANAGE_GRADES_2_SCHOOL', 'School');
DEFINE('_CONTACT_MANAGE_GRADES_2_SUBJECT', 'Subject');
DEFINE('_CONTACT_MANAGE_GRADES_2_QUARTER', 'Quarter');
DEFINE('_CONTACT_MANAGE_GRADES_2_GRADE', 'Grade');
DEFINE('_CONTACT_MANAGE_GRADES_2_EFFORT', 'Effort');
DEFINE('_CONTACT_MANAGE_GRADES_2_CONDUCT', 'Conduct');
DEFINE('_CONTACT_MANAGE_GRADES_2_COMMENTS', 'Comments');
DEFINE('_CONTACT_MANAGE_GRADES_2_NOTES', 'Notes');
DEFINE('_CONTACT_MANAGE_GRADES_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_CONTACT_MANAGE_GRADES_2_BACK', 'Back to Student');
DEFINE('_CONTACT_MANAGE_GRADES_2_EDIT', 'Edit Grades Note');

/** contact_menu_forum.inc.php */

DEFINE('_CONTACT_MENU_FORUM_INC_TITLE', 'Back to Main Menu');
DEFINE('_CONTACT_MENU_FORUM_INC_TITLE_TEXT', 'Main Menu');
DEFINE('_CONTACT_MENU_FORUM_INC_ATT', 'Attendance');
DEFINE('_CONTACT_MENU_FORUM_INC_ATT_TEXT', 'Attendance Notes');
DEFINE('_CONTACT_MENU_FORUM_INC_DIS', 'Discipline');
DEFINE('_CONTACT_MENU_FORUM_INC_DIS_TEXT', 'Discipline Notes');
DEFINE('_CONTACT_MENU_FORUM_INC_GRADE', 'Grade');
DEFINE('_CONTACT_MENU_FORUM_INC_GRADE_TEXT', 'Grade Reporting');
DEFINE('_CONTACT_MENU_FORUM_INC_CHANGE', 'Change Student Year');
DEFINE('_CONTACT_MENU_FORUM_INC_CHANGE_TEXT', 'Change Student Year');
DEFINE('_CONTACT_MENU_FORUM_INC_HOMEWORK', 'Homework');
DEFINE('_CONTACT_MENU_FORUM_INC_HOMEWORK_TEXT', 'Homework');
DEFINE('_CONTACT_MENU_FORUM_INC_FORUM', 'Discussion Board');
DEFINE('_CONTACT_MENU_FORUM_INC_FORUM_TEXT', 'Forum');
DEFINE('_CONTACT_MENU_FORUM_INC_CHAT', 'Chat');
DEFINE('_CONTACT_MENU_FORUM_INC_CHAT_TEXT', 'Chat');
DEFINE('_CONTACT_MENU_FORUM_INC_PASS', 'Change Password');
DEFINE('_CONTACT_MENU_FORUM_INC_PASS_TEXT', 'Change Password');
DEFINE('_CONTACT_MENU_FORUM_INC_LOGOUT', 'Logout from System');
DEFINE('_CONTACT_MENU_FORUM_INC_LOGOUT_TEXT', 'Logout');

/** contact_menu.inc.php */

DEFINE('_CONTACT_MENU_INC_TITLE', 'Back to Main Menu');
DEFINE('_CONTACT_MENU_INC_TITLE_TEXT', 'Main Menu');
DEFINE('_CONTACT_MENU_INC_TIMETABLE', 'Show Timetable');
DEFINE('_CONTACT_MENU_INC_TIMETABLE_TEXT', 'Timetable');
DEFINE('_CONTACT_MENU_INC_EXAMS', 'Show Exams and Tests');
DEFINE('_CONTACT_MENU_INC_EXAMS_TEXT', 'Exams and Tests');
DEFINE('_CONTACT_MENU_INC_ATT', 'Attendance');
DEFINE('_CONTACT_MENU_INC_ATT_TEXT', 'Attendance Notes');
DEFINE('_CONTACT_MENU_INC_DIS', 'Discipline');
DEFINE('_CONTACT_MENU_INC_DIS_TEXT', 'Discipline Notes');
DEFINE('_CONTACT_MENU_INC_GRADE', 'Grade');
DEFINE('_CONTACT_MENU_INC_GRADE_TEXT', 'Grade Reporting');
DEFINE('_CONTACT_MENU_INC_CHANGE', 'Change Student Year');
DEFINE('_CONTACT_MENU_INC_CHANGE_TEXT', 'Change Student Year');
DEFINE('_CONTACT_MENU_INC_HOMEWORK', 'Homework');
DEFINE('_CONTACT_MENU_INC_HOMEWORK_TEXT', 'Homework');
DEFINE('_CONTACT_MENU_INC_FORUM', 'Discussion Board');
DEFINE('_CONTACT_MENU_INC_FORUM_TEXT', 'Forum');
DEFINE('_CONTACT_MENU_INC_CHAT', 'Chat');
DEFINE('_CONTACT_MENU_INC_CHAT_TEXT', 'Chat');
DEFINE('_CONTACT_MENU_INC_SPEAK', 'Manage Speaking Hours');
DEFINE('_CONTACT_MENU_INC_SPEAK_TEXT', 'Speaking Hours');
DEFINE('_CONTACT_MENU_INC_PASS', 'Change Password');
DEFINE('_CONTACT_MENU_INC_PASS_TEXT', 'Change Password');
DEFINE('_CONTACT_MENU_INC_LOGOUT', 'Logout from System');
DEFINE('_CONTACT_MENU_INC_LOGOUT_TEXT', 'Logout');
DEFINE('_CONTACT_MENU_INC_YEAR', 'Year');

/** admin_webusers_active.php */

/** admin_webusers_contacts.php */

DEFINE('_ADMIN_WEBUSERS_CONTACTS_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_TITLE', 'Student contact search result');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_NO_DATA', 'No data found.');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_ACTIVATE', 'Activate');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_DEACTIVATE', 'Deactivate');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_PASS', 'Reset Password');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_NEW', 'New Search');

/** admin_webusers_resetpass.php */

DEFINE('_ADMIN_WEBUSERS_RESETPASS_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_TITLE', 'Passsword Reset');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_NO_DATA', 'No data found.');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_SUBJECT', 'Your new SMS Password');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_BODY1', 'Your password in the SMS has been reset. Your new password is : ');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_BODY2', 'This is just a temporary pasword. Please login and change it immediately.');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_USER1', 'Password for user ');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_USER2', ' reset to ');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_USER3', '. An Email has been dispatched to the user.');

/** admin_webusers_teachers.php */

DEFINE('_ADMIN_WEBUSERS_TEACHERS_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_TITLE', 'Teachers Search Result');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_NODATA', 'No data found.');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_ACTIVATE', 'Activate');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_DEACTIVATE', 'Deactivate');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_PASS', 'Reset Password');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_NEW', 'New Search');

/** admin_users_1.php */

DEFINE('_ADMIN_USERS_1_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_USERS_1_TITLE', 'Remove Users from Database');
DEFINE('_ADMIN_USERS_1_SUBTITLE1', 'Remove/Deactivate Teachers');
DEFINE('_ADMIN_USERS_1_BY_SCHOOL', 'By School Name');
DEFINE('_ADMIN_USERS_1_BY_LASTNAME', 'By Last Name');
DEFINE('_ADMIN_USERS_1_ALL_SCHOOLS', 'All Schools');
DEFINE('_ADMIN_USERS_1_SEARCH', 'Search');
DEFINE('_ADMIN_USERS_1_BY_LAST', 'Or display by last name initial');
DEFINE('_ADMIN_USERS_1_SUBTITLE2', 'Remove/Deactivate Students Contacts');
DEFINE('_ADMIN_USERS_1_BY_LIST', 'From the List');
DEFINE('_ADMIN_USERS_1_ALL_CONTACTS', 'All Student Contacts');

/** admin_users_2.php */

DEFINE('_ADMIN_USERS_2_FORM_ERROR', 'No Record found with Last Name ');
DEFINE('_ADMIN_USERS_2_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_USERS_2_SEARCH_RESULTS', 'Search Result');
DEFINE('_ADMIN_USERS_2_NEW', 'New Search');

/** admin_users_3.php */

DEFINE('_ADMIN_USERS_3_FORM_ERROR', 'Ethnicity cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_USERS_3_EDIT', 'Edit');
DEFINE('_ADMIN_USERS_3_REMOVE', 'Remove');
DEFINE('_ADMIN_USERS_3_SURE', 'Are you sure your want to remove this record?');
DEFINE('_ADMIN_USERS_3_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_USERS_3_ETH', 'Manage Ethnicities');
DEFINE('_ADMIN_USERS_3_ADD_NEW', 'Add New Ethnicity');
DEFINE('_ADMIN_USERS_3_ADD', 'Add');
DEFINE('_ADMIN_USERS_3_UPDATE_ETH', 'Update Ethnicity');
DEFINE('_ADMIN_USERS_3_UPDATE', 'Update');

/** admin_titles.php */

DEFINE('_ADMIN_TITLES_FORM_ERROR', 'Title cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_TITLES_DUP', 'That title is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_TITLES_EDIT', 'Edit');
DEFINE('_ADMIN_TITLES_REMOVE', 'Remove');
DEFINE('_ADMIN_TITLES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_TITLES_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_TITLES_TITLE', 'Manage Titles');
DEFINE('_ADMIN_TITLES_ADD_NEW', 'Add New Title');
DEFINE('_ADMIN_TITLES_ADD', 'Add');
DEFINE('_ADMIN_TITLES_UPDATE_TITLE', 'Update Title');
DEFINE('_ADMIN_TITLES_UPDATE', 'Update');

/** admin_terms.php */

DEFINE('_ADMIN_TERMS_FORM_ERROR', 'Term cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_TERMS_DUP', 'That term is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_TERMS_EDIT', 'Edit');
DEFINE('_ADMIN_TERMS_REMOVE', 'Remove');
DEFINE('_ADMIN_TERMS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_TERMS_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_TERMS_TITLE', 'Manage Terms');
DEFINE('_ADMIN_TERMS_ADD_NEW', 'Add New Term Name');
DEFINE('_ADMIN_TERMS_ADD', 'Add');
DEFINE('_ADMIN_TERMS_UPDATE_TERM', 'Update Term Name');
DEFINE('_ADMIN_TERMS_UPDATE', 'Update');

/** admin_teacher_schedules.php */

DEFINE('_ADMIN_TEACHER_SCHEDULES_FORM_ERROR', 'This schedule entry cannot be removed, students are assigned to it in the system.');
DEFINE('_ADMIN_TEACHER_SCHEDULES_DUP', 'That schedule entry has already been used.  Duplicates are not allowed.');
DEFINE('_ADMIN_TEACHER_SCHEDULES_EDIT', 'Edit');
DEFINE('_ADMIN_TEACHER_SCHEDULES_REMOVE', 'Remove');
DEFINE('_ADMIN_TEACHER_SCHEDULES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_TEACHER_SCHEDULES_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_TEACHER_SCHEDULES_TITLE', 'Manage Teacher Schedule');
DEFINE('_ADMIN_TEACHER_SCHEDULES_ADD_NEW', 'Add New Schedule');
DEFINE('_ADMIN_TEACHER_SCHEDULES_ADD', 'Add');
DEFINE('_ADMIN_TEACHER_SCHEDULES_UPDATE_SCHEDULE', 'Update Schedule');
DEFINE('_ADMIN_TEACHER_SCHEDULES_UPDATE', 'Update');

/** admin_teacher_1.php */

DEFINE('_ADMIN_TEACHER_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_TEACHER_1_TITLE', 'Manage Teachers');
DEFINE('_ADMIN_TEACHER_1_ADD_NEW', 'Add New Teacher');
DEFINE('_ADMIN_TEACHER_1_SUBTITLE', 'Or search the database');
DEFINE('_ADMIN_TEACHER_1_BY_SCHOOL', 'By School');
DEFINE('_ADMIN_TEACHER_1_BY_NAME', 'By Last Name');
DEFINE('_ADMIN_TEACHER_1_ALL', 'All Schools');
DEFINE('_ADMIN_TEACHER_1_SEARCH', 'Search');
DEFINE('_ADMIN_TEACHER_1_BY_LAST', 'Or display by last name initial');

/** admin_teacher_2.php */

DEFINE('_ADMIN_TEACHER_2_ACTIVATE', 'Activate');
DEFINE('_ADMIN_TEACHER_2_DEACTIVATE', 'Deactivate');
DEFINE('_ADMIN_TEACHER_2_REMOVE', 'Remove');
DEFINE('_ADMIN_TEACHER_2_SURE', 'Are you sure?');
DEFINE('_ADMIN_TEACHER_2_REMOVE_ERROR', 'Error deleting teacher');
DEFINE('_ADMIN_TEACHER_2_FORM_ERROR', 'No Teachers found for school ');
DEFINE('_ADMIN_TEACHER_2_FORM_ERROR2', 'No Teachers found');
DEFINE('_ADMIN_TEACHER_2_FORM_ERROR3', 'No Teachers found with Last Name ');
DEFINE('_ADMIN_TEACHER_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_TEACHER_2_TITLE', 'Teacher Search Result');
DEFINE('_ADMIN_TEACHER_2_NEW', 'New Search');
DEFINE('_ADMIN_TEACHER_2_NAME', 'Name');
DEFINE('_ADMIN_TEACHER_2_SCHOOL', 'School');
DEFINE('_ADMIN_TEACHER_2_ACTIVE', 'Active');
DEFINE('_ADMIN_TEACHER_2_EDIT', 'Edit');

/** admin_subjects.php */

DEFINE('_ADMIN_SUBJECTS_FORM_ERROR', 'Subject cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_SUBJECTS_DUP', 'That subject already exists.  You cannot add duplicate subject names.');
DEFINE('_ADMIN_SUBJECTS_EDIT', 'Edit');
DEFINE('_ADMIN_SUBJECTS_REMOVE', 'Remove');
DEFINE('_ADMIN_SUBJECTS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_SUBJECTS_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_SUBJECTS_TITLE', 'Manage Subjects');
DEFINE('_ADMIN_SUBJECTS_ADD_NEW', 'Add New Subject');
DEFINE('_ADMIN_SUBJECTS_ADD', 'Add');
DEFINE('_ADMIN_SUBJECTS_UPDATE_SUBJECT', 'Update Subject Name');
DEFINE('_ADMIN_SUBJECTS_UPDATE', 'Update');

//* admin_stu_schedule.php */

DEFINE('_ADMIN_STU_SCHEDULE_FORM_ERROR', 'Entry cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_STU_SCHEDULE_DUP', 'That entry has already been used.  Duplicates are not allowed.');
DEFINE('_ADMIN_STU_SCHEDULE_TERM', 'Term');
DEFINE('_ADMIN_STU_SCHEDULE_TEACHER', 'Teacher Name');
DEFINE('_ADMIN_STU_SCHEDULE_SUBJECT', 'Subject');
DEFINE('_ADMIN_STU_SCHEDULE_PERIOD', 'Period');
DEFINE('_ADMIN_STU_SCHEDULE_REMOVE', 'Remove');
DEFINE('_ADMIN_STU_SCHEDULE_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_STU_SCHEDULE_UPPER', 'Administrator Area');
DEFINE('_ADMIN_STU_SCHEDULE_TITLE', 'Manage Schedule Entries');
DEFINE('_ADMIN_STU_SCHEDULE_ADD_NEW', 'Add New Schedule Entry');
DEFINE('_ADMIN_STU_SCHEDULE_ADD', 'Add');
DEFINE('_ADMIN_STU_SCHEDULE_DAYS', 'Days');

/** admin_student_1.php */

DEFINE('_ADMIN_STUDENT_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_STUDENT_1_TITLE', 'Manage Students');
DEFINE('_ADMIN_STUDENT_1_ADD_NEW', 'Add New Student');
DEFINE('_ADMIN_STUDENT_1_SUBTITLE', 'Or search the database');
DEFINE('_ADMIN_STUDENT_1_BY_INTERNAL', 'By Internal Number');
DEFINE('_ADMIN_STUDENT_1_BY_NAME', 'By Last Name');
DEFINE('_ADMIN_STUDENT_1_SEARCH', 'Search');
DEFINE('_ADMIN_STUDENT_1_OR_BY', 'Or By');
DEFINE('_ADMIN_STUDENT_1_BY_SCHOOL', 'By School');
DEFINE('_ADMIN_STUDENT_1_BY_GRADE', 'By Grade');
DEFINE('_ADMIN_STUDENT_1_BY_GENDER', 'By Gender');
DEFINE('_ADMIN_STUDENT_1_BY_ETHNICITY', 'By Ethnicity');
DEFINE('_ADMIN_STUDENT_1_ACTIVE', 'Active');
DEFINE('_ADMIN_STUDENT_1_HOMED', 'Homed');
DEFINE('_ADMIN_STUDENT_1_SPED', 'Sped');
DEFINE('_ADMIN_STUDENT_1_BY_LAST', 'Or display by last name initial');

/** admin_student_2.php */

DEFINE('_ADMIN_STUDENT_2_FORM_ERROR', 'No Student found with internal ID ');
DEFINE('_ADMIN_STUDENT_2_SELECT', 'Select');
DEFINE('_ADMIN_STUDENT_2_FORM_ERROR2', 'No Student found with Last Name ');
DEFINE('_ADMIN_STUDENT_2_FORM_ERROR3', 'No Student found with your search criteria.');
DEFINE('_ADMIN_STUDENT_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_STUDENT_2_TITLE', 'Student Search Result');
DEFINE('_ADMIN_STUDENT_2_NEW', 'New Search');

/** admin_student_5.php */

DEFINE('_ADMIN_STUDENT_5_DUP', 'Duplicate entries were not added.');
DEFINE('_ADMIN_STUDENT_5_REMOVE', 'Remove');
DEFINE('_ADMIN_STUDENT_5_UPPER', 'Scheduling Information Here');
DEFINE('_ADMIN_STUDENT_5_TITLE', 'Students in this Schedule');
DEFINE('_ADMIN_STUDENT_5_BACK', 'Back to Schedule');
DEFINE('_ADMIN_STUDENT_5_CHANGE', 'Make Changes');

/** admin_sgrades.php */

DEFINE('_ADMIN_SGRADES_FORM_ERROR', 'Grade cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_SGRADES_EDIT', 'Edit');
DEFINE('_ADMIN_SGRADES_REMOVE', 'Remove');
DEFINE('_ADMIN_SGRADES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_SGRADES_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SGRADES_TITLE', 'Manage Grade Comments');
DEFINE('_ADMIN_SGRADES_ADD_NEW', 'Add New Comment');
DEFINE('_ADMIN_SGRADES_ADD', 'Add');
DEFINE('_ADMIN_SGRADES_UPDATE_COMMENT', 'Update Comment');
DEFINE('_ADMIN_SGRADES_UPDATE', 'Update');

/** admin_school_years.php */

DEFINE('_ADMIN_SCHOOL_YEARS_FORM_ERROR', 'Can\'t remove that year, there are students assigned to it.');
DEFINE('_ADMIN_SCHOOL_YEARS_FORM_ERROR2', 'Can\'t have duplicate school years.');
DEFINE('_ADMIN_SCHOOL_YEARS_SCHOOLYEAR', 'Schoolyear is ');
DEFINE('_ADMIN_SCHOOL_YEARS_EDIT', 'Edit');
DEFINE('_ADMIN_SCHOOL_YEARS_REMOVE', 'Remove');
DEFINE('_ADMIN_SCHOOL_YEARS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_SCHOOL_YEARS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SCHOOL_YEARS_TITLE', 'Manage School Years');
DEFINE('_ADMIN_SCHOOL_YEARS_ADD_NEW', 'Add New School Year');
DEFINE('_ADMIN_SCHOOL_YEARS_ADD', 'Add');
DEFINE('_ADMIN_SCHOOL_YEARS_UPDATE_YEAR', 'Update School Year');
DEFINE('_ADMIN_SCHOOL_YEARS_UPDATE', 'Update');

/** admin_school_names.php */

DEFINE('_ADMIN_SCHOOL_NAMES_FORM_ERROR', 'School cannot be removed, it\'s used in the system.<br>You can not break a hall when students are inside. LOL! ');
DEFINE('_ADMIN_SCHOOL_NAMES_DUP', 'School Name is already being used.  Duplicates are not allowed.');
DEFINE('_ADMIN_SCHOOL_NAMES_EDIT', 'Edit');
DEFINE('_ADMIN_SCHOOL_NAMES_REMOVE', 'Remove');
DEFINE('_ADMIN_SCHOOL_NAMES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_SCHOOL_NAMES_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SCHOOL_NAMES_TITLE', 'Manage School Names');
DEFINE('_ADMIN_SCHOOL_NAMES_ADD_NEW', 'Add New School Name');
DEFINE('_ADMIN_SCHOOL_NAMES_ADD', 'Add');
DEFINE('_ADMIN_SCHOOL_NAMES_UPDATE_NAME', 'Update School Name');
DEFINE('_ADMIN_SCHOOL_NAMES_UPDATE', 'Update');

/** admin_schedule_teach_1.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_1_FORM_ERROR', 'You should select a teacher first.');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_YEAR', 'Year');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_SCHOOL', 'School');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_TERM', 'Term');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_SUBJECT', 'Subject');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_PERIOD', 'Class Period');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_DETAILS', 'Details');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_REMOVE', 'Remove');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_TITLE', 'Teacher Schedule for ');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_BACK', 'Back to Teacher');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_ADD', 'Add Schedule Entry');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_DAYS', 'Days');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_ROOM', 'Room');

/** admin_schedule_teach_2.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_TITLE', 'Teacher Schedule for ');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_TERM', 'Term');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_SUBJECT', 'Subject');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_PERIOD', 'Class Period');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_YEAR', 'Year');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_ROOM', 'Room');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_NOTES', 'Notes');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_BACK', 'Back to Teacher');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_ADD', 'Add Students to this Schedule');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_EDIT', 'Edit Schedule Entry');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_STUDENTS', 'Students in this Schedule');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_REMOVE', 'Remove');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_DAYS', 'Days');

/** admin_schedule_teach_3.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_TITLE', 'Teacher Schedule for ');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_SCHOOL', 'School');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_PERIOD', 'Class Period');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_TERM', 'Term');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_SUBJECT', 'Subject');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_ROOM', 'Room');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_BACK', 'Back to Teacher\'s Schedule');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_UPDATE', 'Update Entry');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_ADD', 'Add Entry');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_DAYS', 'Day of Week');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_DEF_DAYS', 'M-F');

/** admin_schedule_teach_4.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_4_SELECT_TERM', 'You have to select a term.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR', 'You have to select a subject.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR2', 'You have to select a period this class is held.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR3', 'Teacher Already has this Schedule Entry.  Duplicate Entries are not allowed.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_TITLE', 'Scheduling Entry');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_SUBTITLE', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_UPPER', 'Administrator Area');

/** admin_schedule_students_1.php */

DEFINE('_ADMIN_SCHEDULE_STUDENT_1_UPPER', 'Student Scheduling Area');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_TITLE', 'Assign Students to Classes');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_SCHEDULE', 'Schedule Entry');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_PERIOD', 'Period');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_CHOOSE', 'Choose Grade');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_BUILD', 'Build List');

/** admin_schedule_students_2.php */

DEFINE('_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR', 'You need to specify the grade level.');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR2', 'No Student found with your search criteria.');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_TITLE', 'Click The Boxes To Add Students to This Class');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_CLASS', 'Class');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_PERIOD', 'Period');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_NEW', 'New Search');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_ADD', 'Add Selected Students');

/** admin_reports.php */

DEFINE('_ADMIN_REPORTS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_REPORTS_TITLE', 'HTML Reports');
DEFINE('_ADMIN_REPORTS_STUDENTS', 'All Active Students');
DEFINE('_ADMIN_REPORTS_ATTENDANCE', 'Daily Attendance Bulletin');
DEFINE('_ADMIN_REPORTS_DISCIPLINE', 'Discipline');
DEFINE('_ADMIN_REPORTS_GRADES', 'Report Cards');
DEFINE('_ADMIN_REPORTS_SORTED', 'sorted by');
DEFINE('_ADMIN_REPORTS_GRADES_ID', 'Grade');
DEFINE('_ADMIN_REPORTS_SCHOOL', 'School');
DEFINE('_ADMIN_REPORTS_ETH', 'Ethnicity');
DEFINE('_ADMIN_REPORTS_GENDER', 'Gender');
DEFINE('_ADMIN_REPORTS_ROUTE', 'Bus Route');
DEFINE('_ADMIN_REPORTS_HOME', 'Home Room');
DEFINE('_ADMIN_REPORTS_BY', 'By');
DEFINE('_ADMIN_REPORTS_FROM', 'from');
DEFINE('_ADMIN_REPORTS_TO', 'to');
DEFINE('_ADMIN_REPORTS_NONE', 'None');
DEFINE('_ADMIN_REPORTS_DOWNLOAD', 'Download Report');

/** admin_relations.php */

DEFINE('_ADMIN_RELATIONS_FORM_ERROR', 'Relation cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_RELATIONS_DUP', 'That relation is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_RELATIONS_EDIT', 'Edit');
DEFINE('_ADMIN_RELATIONS_REMOVE', 'Remove');
DEFINE('_ADMIN_RELATIONS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_RELATIONS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_RELATIONS_TITLE', 'Manage Relations');
DEFINE('_ADMIN_RELATIONS_ADD_NEW', 'Add New Relation');
DEFINE('_ADMIN_RELATIONS_ADD', 'Add');
DEFINE('_ADMIN_RELATIONS_UPDATE_REL', 'Update Relation');
DEFINE('_ADMIN_RELATIONS_UPDATE', 'Update');

/** admin_process_mass_mail.php */

// nothing so far */

/** admin_menu.inc.php */

DEFINE('_ADMIN_MENU_INC_YEAR', 'Year');
DEFINE('_ADMIN_MENU_INC_DATA', 'Data');
DEFINE('_ADMIN_MENU_INC_MAINT', 'Table Maintenance');
DEFINE('_ADMIN_MENU_INC_MAINT_TEXT', 'Table Maintenance');
DEFINE('_ADMIN_MENU_INC_USER', 'Change/Delete User Logins');
DEFINE('_ADMIN_MENU_INC_USER_TEXT', 'Manage User Logins');
DEFINE('_ADMIN_MENU_INC_STUDENTS', 'Students');
DEFINE('_ADMIN_MENU_INC_MAN_STU', 'Manage Students');
DEFINE('_ADMIN_MENU_INC_MAN_STU_TEXT', 'Manage Students');
DEFINE('_ADMIN_MENU_INC_MAN_ATT', 'Manage Attendance');
DEFINE('_ADMIN_MENU_INC_MAN_ATT_TEXT', 'Manage Attendance');
DEFINE('_ADMIN_MENU_INC_HEALTH', 'Health');
DEFINE('_ADMIN_MENU_INC_HEALTH_TEXT', 'Health');
DEFINE('_ADMIN_MENU_INC_DIS', 'Discipline');
DEFINE('_ADMIN_MENU_INC_DIS_TEXT', 'Discipline');
DEFINE('_ADMIN_MENU_INC_GRA', 'Manage Grades Reporting');
DEFINE('_ADMIN_MENU_INC_GRA_TEXT', 'Grades Reporting');
DEFINE('_ADMIN_MENU_INC_MEDIA', 'Manage Media Reporting');
DEFINE('_ADMIN_MENU_INC_MEDIA_TEXT', 'Media Reporting');
DEFINE('_ADMIN_MENU_INC_CHANGE', 'Change Student Year');
DEFINE('_ADMIN_MENU_INC_CHANGE_TEXT', 'Change Student Year');
DEFINE('_ADMIN_MENU_INC_EXAMS', 'Manage Exams and Tests');
DEFINE('_ADMIN_MENU_INC_EXAMS_TEXT', 'Exams and Tests');
DEFINE('_ADMIN_MENU_INC_TEACHERS_AREA', 'Teachers');
DEFINE('_ADMIN_MENU_INC_TEACHERS', 'Manage Teachers');
DEFINE('_ADMIN_MENU_INC_TEACHERS_TEXT', 'Manage Teachers');
DEFINE('_ADMIN_MENU_INC_SCHEDULE', 'Manage Schedules');
DEFINE('_ADMIN_MENU_INC_SCHEDULE_TEXT', 'Schedule');
DEFINE('_ADMIN_MENU_INC_MASS', 'Send Mass Email');
DEFINE('_ADMIN_MENU_INC_MASS_TEXT', 'Mass Email');
DEFINE('_ADMIN_MENU_INC_FORUM', 'Discussion Board');
DEFINE('_ADMIN_MENU_INC_FORUM_TEXT', 'Forum');
DEFINE('_ADMIN_MENU_INC_CHAT', 'Chat');
DEFINE('_ADMIN_MENU_INC_CHAT_TEXT', 'Chat');
DEFINE('_ADMIN_MENU_INC_BOOK', 'Ordering books');
DEFINE('_ADMIN_MENU_INC_BOOK_TEXT', 'Book Orders');
DEFINE('_ADMIN_MENU_INC_BACKUP', 'Backup the Database');
DEFINE('_ADMIN_MENU_INC_BACKUP_TEXT', 'Database Backup');
DEFINE('_ADMIN_MENU_INC_PASS', 'Change Password');
DEFINE('_ADMIN_MENU_INC_PASS_TEXT', 'Password');
DEFINE('_ADMIN_MENU_INC_REPORTS', 'Reports');
DEFINE('_ADMIN_MENU_INC_REP', 'View Reports');
DEFINE('_ADMIN_MENU_INC_REP_TEXT', 'Reports');
DEFINE('_ADMIN_MENU_INC_DOWN', 'Download Reports');
DEFINE('_ADMIN_MENU_INC_DOWN_TEXT', 'Download Reports');
DEFINE('_ADMIN_MENU_INC_GEN', 'Generate Student Report Card');
DEFINE('_ADMIN_MENU_INC_GEN_TEXT', 'Report Cards');
DEFINE('_ADMIN_MENU_INC_LOGOUT', 'Logout from System');
DEFINE('_ADMIN_MENU_INC_LOGOUT_TEXT', 'Logout');

/** admin_menu_forum.inc.php */

DEFINE('_ADMIN_MENU_FORUM_INC_YEAR', 'Year');
DEFINE('_ADMIN_MENU_FORUM_INC_MAINT', 'Table Maintenace');
DEFINE('_ADMIN_MENU_FORUM_INC_MAINT_TEXT', 'Table Maintenace');
DEFINE('_ADMIN_MENU_FORUM_INC_USER', 'Change/Delete User Logins');
DEFINE('_ADMIN_MENU_FORUM_INC_USER_TEXT', 'Manage User Logins');
DEFINE('_ADMIN_MENU_FORUM_INC_STUDENTS', 'Students');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_STU', 'Manage Students');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_STU_TEXT', 'Manage Students');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_ATT', 'Manage Attendance');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_ATT_TEXT', 'Manage Attendance');
DEFINE('_ADMIN_MENU_FORUM_INC_HEALTH', 'Health');
DEFINE('_ADMIN_MENU_FORUM_INC_HEALTH_TEXT', 'Health');
DEFINE('_ADMIN_MENU_FORUM_INC_DIS', 'Discipline');
DEFINE('_ADMIN_MENU_FORUM_INC_DIS_TEXT', 'Discipline');
DEFINE('_ADMIN_MENU_FORUM_INC_GRA', 'Manage Grades Reporting');
DEFINE('_ADMIN_MENU_FORUM_INC_GRA_TEXT', 'Grades Reporting');
DEFINE('_ADMIN_MENU_FORUM_INC_CHANGE', 'Change Student Year');
DEFINE('_ADMIN_MENU_FORUM_INC_CHANGE_TEXT', 'Change Student Year');
DEFINE('_ADMIN_MENU_FORUM_INC_EXAMS', 'Sicherung der Datenbank');
DEFINE('_ADMIN_MENU_FORUM_INC_EXAMS_TEXT', 'Backup');
DEFINE('_ADMIN_MENU_FORUM_INC_TEACHERS', 'Manage Teachers');
DEFINE('_ADMIN_MENU_FORUM_INC_TEACHERS_TEXT', 'Teachers');
DEFINE('_ADMIN_MENU_FORUM_INC_SCHEDULE', 'Manage Schedules');
DEFINE('_ADMIN_MENU_FORUM_INC_SCHEDULE_TEXT', 'Schedule');
DEFINE('_ADMIN_MENU_FORUM_INC_MASS', 'Send Mass Email');
DEFINE('_ADMIN_MENU_FORUM_INC_MASS_TEXT', 'Mass Email');
DEFINE('_ADMIN_MENU_FORUM_INC_FORUM', 'Discussion Board');
DEFINE('_ADMIN_MENU_FORUM_INC_FORUM_TEXT', 'Forum');
DEFINE('_ADMIN_MENU_FORUM_INC_CHAT', 'Chat');
DEFINE('_ADMIN_MENU_FORUM_INC_CHAT_TEXT', 'Chat');
DEFINE('_ADMIN_MENU_FORUM_INC_BOOK', 'Ordering books');
DEFINE('_ADMIN_MENU_FORUM_INC_BOOK_TEXT', 'Book Order');
DEFINE('_ADMIN_MENU_FORUM_INC_BACKUP', 'Backup the Database');
DEFINE('_ADMIN_MENU_FORUM_INC_BACKUP_TEXT', 'Backup');
DEFINE('_ADMIN_MENU_FORUM_INC_PASS', 'Change Password');
DEFINE('_ADMIN_MENU_FORUM_INC_PASS_TEXT', 'Password');
DEFINE('_ADMIN_MENU_FORUM_INC_REP', 'View Reports');
DEFINE('_ADMIN_MENU_FORUM_INC_REP_TEXT', 'Reports');
DEFINE('_ADMIN_MENU_FORUM_INC_DOWN', 'Download Reports');
DEFINE('_ADMIN_MENU_FORUM_INC_DOWN_TEXT', 'Download Reports');
DEFINE('_ADMIN_MENU_FORUM_INC_GEN', 'Generate Student Report Card');
DEFINE('_ADMIN_MENU_FORUM_INC_GEN_TEXT', 'Report Cards');
DEFINE('_ADMIN_MENU_FORUM_INC_LOGOUT', 'Logout from System');
DEFINE('_ADMIN_MENU_FORUM_INC_LOGOUT_TEXT', 'Logout');

/** admin_mass_email.php */

DEFINE('_ADMIN_MASS_EMAIL_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MASS_EMAIL_TITLE', 'Mass Email');
DEFINE('_ADMIN_MASS_EMAIL_SUBTITLE', 'Copy of the message will be sent to administrator');
DEFINE('_ADMIN_MASS_EMAIL_SEND', 'Send message to');
DEFINE('_ADMIN_MASS_EMAIL_CONTACTS', 'Contacts');
DEFINE('_ADMIN_MASS_EMAIL_ROOM', 'Homeroom');
DEFINE('_ADMIN_MASS_EMAIL_ALL', 'All');
DEFINE('_ADMIN_MASS_EMAIL_TEACHERS', 'Teachers');
DEFINE('_ADMIN_MASS_EMAIL_BOTH', 'Both');
DEFINE('_ADMIN_MASS_EMAIL_SUBJECT', 'Subject');
DEFINE('_ADMIN_MASS_EMAIL_MESSAGE', 'Message');
DEFINE('_ADMIN_MASS_EMAIL_NOW', 'Send message now');

/** admin_manage_schedule_1.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_1_FORM_ERROR', 'You should select a teacher first.');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_TERM', 'Term');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_SUBJECT', 'Subject');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_PERIOD', 'Class Period');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_REMOVE', 'Remove');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_SURE2', 'Are you sure you wish to delete selected records ?');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_TITLE', 'Schedule for ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_DELETE', 'Delete Selected');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_ADD', 'Add Schedule Note');

/** admin_manage_schedule_2.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_TITLE', 'Schedule Entry for Student');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_CODE', 'Code');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_EDIT', 'Edit Schedule Note');

/** admin_manage_schedule_3.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ENTER', 'Code and Date should be entered.');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_TITLE', 'Schedule for Student');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ENTRY', 'Schedule Entry');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_TERM', 'Term');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_SELECT', 'Select Code');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_NOTIFY', 'Notify Contacts');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_DELETE', 'Delete');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ADD_NEW', 'Add New');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_BACK', 'Back');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_UPDATE', 'Update Note');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ADD', 'Add Note');

/** admin_manage_schedule_4.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_4_FROM', 'h.leinfellner@sbg.at');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_FROM_NAME', 'School Principal');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_SUBJECT', 'New attendance note for ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_BODY1', 'A new attendance note has been inserted for ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_BODY2', 'Please login to the parents interface website for details. Thanks - The Principal');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** admin_manage_grades_1.php */

DEFINE('_ADMIN_MANAGE_GRADES_1_FORM_ERROR', 'You should select a teacher first.');
DEFINE('_ADMIN_MANAGE_GRADES_1_QUARTER', 'Qrtr');
DEFINE('_ADMIN_MANAGE_GRADES_1_SUBJECT', 'Subject');
DEFINE('_ADMIN_MANAGE_GRADES_1_GRADE', 'Grade');
DEFINE('_ADMIN_MANAGE_GRADES_1_EFFORT', 'Effort');
DEFINE('_ADMIN_MANAGE_GRADES_1_CONDUCT', 'Conduct');
DEFINE('_ADMIN_MANAGE_GRADES_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_GRADES_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_GRADES_1_TITLE', 'Grade History for Student');
DEFINE('_ADMIN_MANAGE_GRADES_1_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_GRADES_1_ADD', 'Add Grade Result');

/** admin_manage_grades_2.php */

DEFINE('_ADMIN_MANAGE_GRADES_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_GRADES_2_TITLE', 'Grade History for Student');
DEFINE('_ADMIN_MANAGE_GRADES_2_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_GRADES_2_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_GRADES_2_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_GRADES_2_QUARTER', 'Quarter');
DEFINE('_ADMIN_MANAGE_GRADES_2_GRADE', 'Grade');
DEFINE('_ADMIN_MANAGE_GRADES_2_EFFORT', 'Effort');
DEFINE('_ADMIN_MANAGE_GRADES_2_CONDUCT', 'Conduct');
DEFINE('_ADMIN_MANAGE_GRADES_2_COMMENTS', 'Comments');
DEFINE('_ADMIN_MANAGE_GRADES_2_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_GRADES_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_GRADES_2_BACK', 'Back');
DEFINE('_ADMIN_MANAGE_GRADES_2_EDIT', 'Edit Grade Note');

/** admin_manage_grades_3.php */

DEFINE('_ADMIN_MANAGE_GRADES_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_GRADES_3_TITLE', 'Grade History for Student ');
DEFINE('_ADMIN_MANAGE_GRADES_3_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_GRADES_3_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_GRADES_3_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_GRADES_3_TERM', 'Term');
DEFINE('_ADMIN_MANAGE_GRADES_3_GRADE', 'Grade');
DEFINE('_ADMIN_MANAGE_GRADES_3_EFFORT', 'Effort');
DEFINE('_ADMIN_MANAGE_GRADES_3_CONDUCT', 'Conduct');
DEFINE('_ADMIN_MANAGE_GRADES_3_COMMENTS', 'Comments');
DEFINE('_ADMIN_MANAGE_GRADES_3_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_GRADES_3_NOTIFY', 'Notify Contacts');
DEFINE('_ADMIN_MANAGE_GRADES_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_GRADES_3_DELETE', 'Delete');
DEFINE('_ADMIN_MANAGE_GRADES_3_ADD_NEW', 'Add New');
DEFINE('_ADMIN_MANAGE_GRADES_3_BACK', 'Back');
DEFINE('_ADMIN_MANAGE_GRADES_3_UPDATE', 'Update Note');
DEFINE('_ADMIN_MANAGE_GRADES_3_ADD', 'Add Note');

/** admin_manage_grades_4.php */

DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_QUARTER', 'You have to select a quarter.');
DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_OVERALL', 'You have to enter an overall grade.');
DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_EFFORT', 'You have to select an effort grade.');
DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_CONDUCT', 'You have to select a conduct grade.');
DEFINE('_ADMIN_MANAGE_GRADES_4_SUBJECT', 'New grade note for ');
DEFINE('_ADMIN_MANAGE_GRADES_4_BODY1', 'A new grade note has been inserted for ');
DEFINE('_ADMIN_MANAGE_GRADES_4_BODY2', 'Please login to the parents interface website for details. Thanks - The Principal');
DEFINE('_ADMIN_MANAGE_GRADES_4_TITLE', 'Grade Note');
DEFINE('_ADMIN_MANAGE_GRADES_4_SUBTITLE', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_MANAGE_GRADES_4_UPPER', 'Administrator Area');

/** admin_manage_discipline_1.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_QUARTER', 'Qrtr');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_CODE', 'Code');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_TITLE', 'Discipline History for Student');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_ADD', 'Add Discipline Note');

/** admin_manage_discipline_2.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_TITLE', 'Discipline history for student');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_INFRACTION', 'Infraction');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_START_DATE', 'Administration Action Start Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_END_DATE', 'Administration Action End Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_ACTION', 'Action to be Taken');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_WHO', 'Who reported the infraction');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_EDIT', 'Edit Discipline Note');

/** admin_manage_discipline_3.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_TITLE', 'Discipline history for student');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_INFRACTION', 'Infraction');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_SELECT_INFRACTION', 'Select Infraction');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_START_DATE', 'Administration Action Start Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_END_DATE', 'Administration Action End Date');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_ACTION', 'Action to be Taken');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_WHO', 'Who reported the infraction');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_NOTIFY', 'Notify Contacts');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_DELETE', 'Delete');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_ADD_NEW', 'Add New');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_UPDATE', 'Update Note');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_ADD', 'Add Note');

/** admin_manage_discipline_4.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_CODE', 'You have to select an infraction code.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_DATE', 'You have to select a date of infraction.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_START', 'You have to select a starting date.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_END', 'You have to select an ending date.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_ACTION', 'You have to assign the action to be taken.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_WHO', 'You have to assign who reported the infraction.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_FROM', 'h.leinfellner@sbg.at');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_FROM_NAME', 'School Principal');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_SUBJECT', 'New discipline note for ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_BODY1', 'A new discipline note has been inserted for ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_BODY2', 'Please login to the parents interface website for details. Thanks - The Principal');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** admin_manage_attendance_1.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_FORM_ERROR', 'You should select a student first.');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_CODE', 'Code');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_TITLE', 'Attendance History for Student');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_ADD', 'Add Attendance Note');

/** admin_manage_attendance_2.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_TITLE', 'Attendance history for student');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_CODE', 'Code');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_EDIT', 'Edit Attendance Note');

/** admin_manage_attendance_3.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_FORM_ERROR', 'Code and Date should be entered.');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_TITLE', 'Attendance history for student');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_CODE', 'Code');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_SELECT', 'Select Code');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_DATE', 'Date');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_NOTIFY', 'Notify Contacts');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_DELETE', 'Delete');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_ADD_NEW', 'Add New');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_UPDATE', 'Update Note');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_ADD', 'Add Note');

/** admin_manage_attendance_4.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_FROM', 'School Principal');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_SUBJECT', 'New attendance note for ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_BODY1', 'A new attendance note has been inserted for ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_BODY2', 'Please login to the parents interface website for details. Thanks - The Principal');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');

/** admin_maint_tables_menu.inc.php */

DEFINE('_ADMIN_MAINT_TABLES_MENU_YEAR', 'Year');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TABLES', 'Basic Tables');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CONF', 'Set Messages, Default Values');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CONF_TEXT', 'Configuration');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SCHOOL', 'Manage School Names');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SCHOOL_TEXT', 'School Names');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SUB', 'Manage Subjects');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SUB_TEXT', 'Subjects');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GRADE', 'Manage Gradelevels');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GRADE_TEXT', 'Gradelevels');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ROOMS', 'Manage Rooms');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ROOMS_TEXT', 'Rooms');
DEFINE('_ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES', 'Manage Exams Types');
DEFINE('_ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES_TEXT', 'Exams Types');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SPEAK', 'Manage Speaking Hours');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SPEAK_TEXT', 'Speaking Hours');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TERMS', 'Manage Terms');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TERMS_TEXT', 'Manage Terms');
DEFINE('_ADMIN_MAINT_TABLES_MENU_YEARS', 'Manage School Years');
DEFINE('_ADMIN_MAINT_TABLES_MENU_YEARS_TEXT', 'School Years');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ETH', 'Manage Ethnic Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ETH_TEXT', 'Ethnicities');
DEFINE('_ADMIN_MAINT_TABLES_MENU_COMM', 'Manage Grade Comments');
DEFINE('_ADMIN_MAINT_TABLES_MENU_COMM_TEXT', 'Comments');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ATT', 'Manage Attendance Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ATT_TEXT', 'Attendance Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_INFR', 'Manage Infraction Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_INFR_TEXT', 'Infraction Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GEN', 'Manage Generations (Jr. Sr. 3rd, etc)');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GEN_TEXT', 'Generations');
DEFINE('_ADMIN_MAINT_TABLES_MENU_REL', 'Manage Relations');
DEFINE('_ADMIN_MAINT_TABLES_MENU_REL_TEXT', 'Relations');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TITLES', 'Manage Titles (Mr., Mrs., etc)');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TITLES_TEXT', 'Titles');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MEDIA', 'Manage Library');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MEDIA_TEXT', 'Library');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CUS', 'Manage Custom Fields');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CUS_TEXT', 'Custom Fields');
DEFINE('_ADMIN_MAINT_TABLES_MENU_HEALTH', 'Health Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_OFF', 'Office Codes (Reasons for Visits)');
DEFINE('_ADMIN_MAINT_TABLES_MENU_OFF_TEXT', 'Office Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_IMM', 'Immunization Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_IMM_TEXT', 'Immunization Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MED', 'Medication Names');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MED_TEXT', 'Medication Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ALL', 'Allergy Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ALL_TEXT', 'Allergy Codes');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MENU', 'Main Menu');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ADMIN', 'Return to Main Menu');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ADMIN_TEXT', 'Main Admin Menu');

/** admin_maint_menu.php */

DEFINE('_ADMIN_MAINT_MENU_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MAINT_MENU_TITLE', 'Admin Table Maintenance Menu');
DEFINE('_ADMIN_MAINT_MENU_SUBTITLE', 'Please choose a menu item from your left');

/** admin_infraction_codes.php */

DEFINE('_ADMIN_INFRACTION_CODES_FORM_ERROR', 'Infraction Code cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_INFRACTION_CODES_DUP', 'That infraction code is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_INFRACTION_CODES_EDIT', 'Edit');
DEFINE('_ADMIN_INFRACTION_CODES_REMOVE', 'Remove');
DEFINE('_ADMIN_INFRACTION_CODES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_INFRACTION_CODES_UPPER', 'Administrator Area');
DEFINE('_ADMIN_INFRACTION_CODES_TITLE', 'Manage Infraction Codes');
DEFINE('_ADMIN_INFRACTION_CODES_ADD_NEW', 'Add New Infraction Code');
DEFINE('_ADMIN_INFRACTION_CODES_ADD', 'Add');
DEFINE('_ADMIN_INFRACTION_CODES_UPDATE_INFR', 'Update Infraction Code');
DEFINE('_ADMIN_INFRACTION_CODES_UPDATE', 'Update');

/** admin_grades.php */

DEFINE('_ADMIN_GRADES_FORM_ERROR', 'Grade level cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_GRADES_DUP', 'Grade level is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_GRADES_EDIT', 'Edit');
DEFINE('_ADMIN_GRADES_REMOVE', 'Remove');
DEFINE('_ADMIN_GRADES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_GRADES_UPPER', 'Administrator Area');
DEFINE('_ADMIN_GRADES_TITLE', 'Manage Grades');
DEFINE('_ADMIN_GRADES_SUBTITLE', 'Grades Should be in Order of Lowest to Highest');
DEFINE('_ADMIN_GRADES_ADD_NEW', 'Add New Grade');
DEFINE('_ADMIN_GRADES_ADD', 'Add');
DEFINE('_ADMIN_GRADES_UPDATE_GRADE', 'Update Grade');
DEFINE('_ADMIN_GRADES_UPDATE', 'Update');

/** admin_generations.php */

DEFINE('_ADMIN_GENERATIONS_FORM_ERROR', 'Generation cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_GENERATIONS_DUP', 'Generation is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_GENERATIONS_EDIT', 'Edit');
DEFINE('_ADMIN_GENERATIONS_REMOVE', 'Remove');
DEFINE('_ADMIN_GENERATIONS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_GENERATIONS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_GENERATIONS_TITLE', 'Manage Generations');
DEFINE('_ADMIN_GENERATIONS_ADD_NEW', 'Add New Generation');
DEFINE('_ADMIN_GENERATIONS_ADD', 'Add');
DEFINE('_ADMIN_GENERATIONS_UPDATE_GEN', 'Update Generation');
DEFINE('_ADMIN_GENERATIONS_UPDATE', 'Update');

/** admin_ethnicity.php */

DEFINE('_ADMIN_ETHNICITY_FORM_ERROR', 'Ethnicity cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_ETHNICITY_DUP', 'Ethnicity is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_ETHNICITY_EDIT', 'Edit');
DEFINE('_ADMIN_ETHNICITY_REMOVE', 'Remove');
DEFINE('_ADMIN_ETHNICITY_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_ETHNICITY_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ETHNICITY_TITLE', 'Manage Ethnicities');
DEFINE('_ADMIN_ETHNICITY_ADD_NEW', 'Add New Ethnicity');
DEFINE('_ADMIN_ETHNICITY_ADD', 'Add');
DEFINE('_ADMIN_ETHNICITY_UPDATE_ETH', 'Update Ethnicity');
DEFINE('_ADMIN_ETHNICITY_UPDATE', 'Update');

/** admin_attendance_codes.php */

DEFINE('_ADMIN_ATTENDANCE_CODES_FORM_ERROR', 'Attendance Code cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_ATTENDANCE_CODES_DUP', 'Attendance Code is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_ATTENDANCE_CODES_EDIT', 'Edit');
DEFINE('_ADMIN_ATTENDANCE_CODES_REMOVE', 'Remove');
DEFINE('_ADMIN_ATTENDANCE_CODES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_ATTENDANCE_CODES_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ATTENDANCE_CODES_TITLE', 'Manage Attendance Codes');
DEFINE('_ADMIN_ATTENDANCE_CODES_ADD_NEW', 'Add New Attendance Code');
DEFINE('_ADMIN_ATTENDANCE_CODES_ADD', 'Add');
DEFINE('_ADMIN_ATTENDANCE_CODES_UPDATE_ATT', 'Update Attendance Code');
DEFINE('_ADMIN_ATTENDANCE_CODES_UPDATE', 'Update');

/** admin_custom_fields.php */

DEFINE('_ADMIN_CUSTOM_FIELDS_FORM_ERROR', 'Custom Field cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_CUSTOM_FIELDS_DUP', 'Custom Field is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_CUSTOM_FIELDS_EDIT', 'Edit');
DEFINE('_ADMIN_CUSTOM_FIELDS_REMOVE', 'Remove');
DEFINE('_ADMIN_CUSTOM_FIELDS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_CUSTOM_FIELDS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_CUSTOM_FIELDS_TITLE', 'Manage Custom Fields');
DEFINE('_ADMIN_CUSTOM_FIELDS_ADD_NEW', 'Add New Custom Field');
DEFINE('_ADMIN_CUSTOM_FIELDS_ADD', 'Add');
DEFINE('_ADMIN_CUSTOM_FIELDS_UPDATE_CUSTOM', 'Update Custom Field');
DEFINE('_ADMIN_CUSTOM_FIELDS_UPDATE', 'Update');

/** admin_conf_change_year.php */

DEFINE('_ADMIN_CONF_CHANGE_YEAR_FORM_ERROR', 'That year has already been created. You must be having an issue or priority 1. this may be caused if you have switched year backward before. go to operation manual to learn how to fix this');

/** admin_change_password.php */

DEFINE('_ADMIN_CHANGE_PASSWORD_SUCCESSFUL', 'Password Successfully Changed.');
DEFINE('_ADMIN_CHANGE_PASSWORD_TITLE', 'Change your access password');
DEFINE('_ADMIN_CHANGE_PASSWORD_UPDATE', 'Update Password');


/** admin_add_contact_user.php */

DEFINE('_ADMIN_ADD_CONTACT_USER_FORM_ERROR', 'The value in field Email has to be a valid address.');
DEFINE('_ADMIN_ADD_CONTACT_USER_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_CONTACT_USER_TITLE_ERROR', 'Error Adding Web User');
DEFINE('_ADMIN_ADD_CONTACT_USER_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_ADD_CONTACT_USER_TITLE_SUCCESS', 'Successfully Added Web User');
DEFINE('_ADMIN_ADD_CONTACT_USER_ADD', 'Add New Contact');
DEFINE('_ADMIN_ADD_CONTACT_USER_BACK', 'Back to Student');

/** admin_edit_student_1.php */

DEFINE('_ADMIN_EDIT_STUDENT_1_ERROR1', 'Cannot Initialize new GD image stream');
DEFINE('_ADMIN_EDIT_STUDENT_1_ERROR2', 'Error creating image');
DEFINE('_ADMIN_EDIT_STUDENT_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EDIT_STUDENT_1_TITLE', 'Manage Student');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_CONTACT', 'Add Contact');
DEFINE('_ADMIN_EDIT_STUDENT_1_VIEW_SCHEDULE', 'View Schedule');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_PIC', 'Add/Edit Picture');
DEFINE('_ADMIN_EDIT_STUDENT_1_INTERNAL_ID', 'Internal ID' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ETHNICITY', 'Ethnicity' );
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHDATE', 'Date of Birth' );
DEFINE('_ADMIN_EDIT_STUDENT_1_SCHOOL', 'School' );
DEFINE('_ADMIN_EDIT_STUDENT_1_GRADE', 'Grade' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ACTIVE', 'Active' );
DEFINE('_ADMIN_EDIT_STUDENT_1_HOMED', 'Homed' );
DEFINE('_ADMIN_EDIT_STUDENT_1_SPED', 'Sped' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ENTRY_RECORD', 'Entry Record' );
DEFINE('_ADMIN_EDIT_STUDENT_1_NOTES', 'Notes');
DEFINE('_ADMIN_EDIT_STUDENT_1_INTO', ' into ' );
DEFINE('_ADMIN_EDIT_STUDENT_1_FROM', ' from ' );
DEFINE('_ADMIN_EDIT_STUDENT_1_HOME', 'Home Room' );
DEFINE('_ADMIN_EDIT_STUDENT_1_TEACHER', 'Teacher' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ROUTE', 'Bus Route' );
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHCITY', 'Birth City');
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHSTATE', 'Birth State');
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHCOUNTRY', 'Birth Country');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLNAME', 'Prvs School Name');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLADDRESS', 'Prvs School Address');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLCITY', 'Prvs School City');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLSTATE', 'Prvs School State');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLZIP', 'Prvs School Zip');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLCOUNTRY', 'Prvs School Country');
DEFINE('_ADMIN_EDIT_STUDENT_1_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_EDIT_STUDENT_1_EDIT_STUDENT', 'Edit Student');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRIMARY_CONTACT', 'Primary Contact');
DEFINE('_ADMIN_EDIT_STUDENT_1_RESIDENCE', 'Residence');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADDRESS', 'Address');
DEFINE('_ADMIN_EDIT_STUDENT_1_CITY', 'City');
DEFINE('_ADMIN_EDIT_STUDENT_1_STATE', 'State');
DEFINE('_ADMIN_EDIT_STUDENT_1_ZIP', 'Zip');
DEFINE('_ADMIN_EDIT_STUDENT_1_PHONE1', 'Phone #');
DEFINE('_ADMIN_EDIT_STUDENT_1_PHONE2', 'Alt. Phone #');
DEFINE('_ADMIN_EDIT_STUDENT_1_PHONE3', 'Alt. Phone #');
DEFINE('_ADMIN_EDIT_STUDENT_1_EMAIL', 'Email');
DEFINE('_ADMIN_EDIT_STUDENT_1_WEB_USER', 'Web User');
DEFINE('_ADMIN_EDIT_STUDENT_1_EDIT_PRIMARY', 'Edit Primary Contact');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_CONTACTS', 'Additional Contacts');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_FIRST_NAME', 'First Name');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_LAST_NAME', 'Last Name');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_RELATION', 'Relation');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_WEB_USER', 'Web User');
DEFINE('_ADMIN_EDIT_STUDENT_1_DETAILS', 'Details');

/** admin_edit_student_2.php */

DEFINE('_ADMIN_EDIT_STUDENT_2_UPPER', 'Administrator Area' );
DEFINE('_ADMIN_EDIT_STUDENT_2_TITLE', 'Manage Students' );
DEFINE('_ADMIN_EDIT_STUDENT_2_CONTACT', 'Contact' );
DEFINE('_ADMIN_EDIT_STUDENT_2_RESIDENCE', 'Residence' );
DEFINE('_ADMIN_EDIT_STUDENT_2_ADDRESS', 'Address');
DEFINE('_ADMIN_EDIT_STUDENT_2_CITY', 'City');
DEFINE('_ADMIN_EDIT_STUDENT_2_STATE', 'State');
DEFINE('_ADMIN_EDIT_STUDENT_2_ZIP', 'Zip');
DEFINE('_ADMIN_EDIT_STUDENT_2_PHONE1', 'Phone #');
DEFINE('_ADMIN_EDIT_STUDENT_2_PHONE2', 'Alt. Phone #');
DEFINE('_ADMIN_EDIT_STUDENT_2_PHONE3', 'Alt. Phone #');
DEFINE('_ADMIN_EDIT_STUDENT_2_EMAIL', 'Email');
DEFINE('_ADMIN_EDIT_STUDENT_2_WEB_USER', 'Web User');
DEFINE('_ADMIN_EDIT_STUDENT_2_EDIT', 'Edit Contact');
DEFINE('_ADMIN_EDIT_STUDENT_2_BACK', 'Back to Student');

/** admin_edit_student_3.php */

DEFINE('_ADMIN_EDIT_STUDENT_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EDIT_STUDENT_3_TITLE', 'Edit Student');
DEFINE('_ADMIN_EDIT_STUDENT_3_FIRST', 'First Name');
DEFINE('_ADMIN_EDIT_STUDENT_3_MIDDLE', 'M.I.');
DEFINE('_ADMIN_EDIT_STUDENT_3_LAST', 'Last Name');
DEFINE('_ADMIN_EDIT_STUDENT_3_GEN', 'Generation');
DEFINE('_ADMIN_EDIT_STUDENT_3_GENDER', 'Gender' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ETHNICITY', 'Ethnicity' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ACTIVE', 'Active' );
DEFINE('_ADMIN_EDIT_STUDENT_3_HOMED', 'Homed' );
DEFINE('_ADMIN_EDIT_STUDENT_3_SPED', 'Sped' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ENTRY_RECORD', 'Entry Record' );
DEFINE('_ADMIN_EDIT_STUDENT_3_NOTES', 'Notes');
DEFINE('_ADMIN_EDIT_STUDENT_3_DELETE', 'Delete');
DEFINE('_ADMIN_EDIT_STUDENT_3_INTO', ' into ' );
DEFINE('_ADMIN_EDIT_STUDENT_3_FROM', ' from ' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ENTRY', 'Entry' );
DEFINE('_ADMIN_EDIT_STUDENT_3_EXIT', 'Exit' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ON', 'am' );
DEFINE('_ADMIN_EDIT_STUDENT_3_FOR_YEAR', 'for the year' );
DEFINE('_ADMIN_EDIT_STUDENT_3_SCHOOL', 'School' );
DEFINE('_ADMIN_EDIT_STUDENT_3_INTERNAL_ID', 'Internal ID' );
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHDATE', 'Date of Birth' );
DEFINE('_ADMIN_EDIT_STUDENT_3_HOME', 'Home Room' );
DEFINE('_ADMIN_EDIT_STUDENT_3_TEACHER', 'Teacher' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ROUTE', 'Bus Route' );
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHCITY', 'Birth City');
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHSTATE', 'Birth State');
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHCOUNTRY', 'Birth Country');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLNAME', 'Prvs School Name');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLADDRESS', 'Prvs School Address');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLCITY', 'Prvs School City');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLSTATE', 'Prvs School State');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLZIP', 'Prvs School Zip');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLCOUNTRY', 'Prvs School Country');
DEFINE('_ADMIN_EDIT_STUDENT_3_MESSAGE', 'Now please select student grade for current year');
DEFINE('_ADMIN_EDIT_STUDENT_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_EDIT_STUDENT_3_ADD_NEW', 'Add New');
DEFINE('_ADMIN_EDIT_STUDENT_3_BACK', 'Back to Student');
DEFINE('_ADMIN_EDIT_STUDENT_3_UPDATE', 'Update Student');

/** admin_edit_student_4.php */

DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_ID', 'You have to assign an internal id to student.');
DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_LAST', 'Student must have a Last Name.');
DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_FIRST', 'Student must have a First Name.');
DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_DOB', 'Student must have a Date of Birth.');
DEFINE('_ADMIN_EDIT_STUDENT_4_FORM_ERROR', 'Date of Birth is not in a correct format.');
DEFINE('_ADMIN_EDIT_STUDENT_4_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EDIT_STUDENT_4_TITLE', 'Error Updating Student');
DEFINE('_ADMIN_EDIT_STUDENT_4_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_EDIT_STUDENT_4_BACK', 'Back to Student');

/** admin_add_student_1.php */

DEFINE('_ADMIN_ADD_STUDENT_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_STUDENT_1_TITLE', 'Add New Student');
DEFINE('_ADMIN_ADD_STUDENT_1_FIRST', 'First Name');
DEFINE('_ADMIN_ADD_STUDENT_1_MIDDLE', 'M.I.');
DEFINE('_ADMIN_ADD_STUDENT_1_LAST', 'Last Name');
DEFINE('_ADMIN_ADD_STUDENT_1_GEN', 'Generation');
DEFINE('_ADMIN_ADD_STUDENT_1_GENDER', 'Gender' );
DEFINE('_ADMIN_ADD_STUDENT_1_ETHNICITY', 'Ethnicity' );
DEFINE('_ADMIN_ADD_STUDENT_1_ACTIVE', 'Active' );
DEFINE('_ADMIN_ADD_STUDENT_1_HOMED', 'Homed' );
DEFINE('_ADMIN_ADD_STUDENT_1_SPED', 'Sped' );

// DEFINE('_ADMIN_ADD_STUDENT_1_ENTRY_RECORD', 'Entry Record' );
// DEFINE('_ADMIN_ADD_STUDENT_1_NOTES', 'Notes');
// DEFINE('_ADMIN_ADD_STUDENT_1_DELETE', 'Delete');
// DEFINE('_ADMIN_ADD_STUDENT_1_INTO', ' into ' );
// DEFINE('_ADMIN_ADD_STUDENT_1_FROM', ' from ' );
// DEFINE('_ADMIN_ADD_STUDENT_1_ENTRY', 'Entry' );
// DEFINE('_ADMIN_ADD_STUDENT_1_EXIT', 'Exit' );
// DEFINE('_ADMIN_ADD_STUDENT_1_ON', 'am' );
// DEFINE('_ADMIN_ADD_STUDENT_1_FOR_YEAR', 'for the year' );

DEFINE('_ADMIN_ADD_STUDENT_1_SCHOOL', 'School' );
DEFINE('_ADMIN_ADD_STUDENT_1_INTERNAL_ID', 'Internal ID' );
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHDATE', 'Date of Birth' );
DEFINE('_ADMIN_ADD_STUDENT_1_HOME', 'Home Room' );
DEFINE('_ADMIN_ADD_STUDENT_1_TEACHER', 'Teacher' );
DEFINE('_ADMIN_ADD_STUDENT_1_ROUTE', 'Bus Route' );
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHCITY', 'Birth City');
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHSTATE', 'Birth State');
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHCOUNTRY', 'Birth Country');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLNAME', 'Prvs School Name');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLADDRESS', 'Prvs School Address');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLCITY', 'Prvs School City');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLSTATE', 'Prvs School State');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLZIP', 'Prvs School Zip');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLCOUNTRY', 'Prvs School Country');
DEFINE('_ADMIN_ADD_STUDENT_1_MESSAGE', 'Now please select student grade for current year');
DEFINE('_ADMIN_ADD_STUDENT_1_ADD', 'Add Student');

// DEFINE('_ADMIN_ADD_STUDENT_1_CUSTOM_FIELDS', 'Custom Fields');
// DEFINE('_ADMIN_ADD_STUDENT_1_DELETE', 'Delete');
// DEFINE('_ADMIN_ADD_STUDENT_1_ADD_NEW', 'Add New');
// DEFINE('_ADMIN_ADD_STUDENT_1_BACK', 'Back to Student');
// DEFINE('_ADMIN_ADD_STUDENT_1_UPDATE', 'Update Student');

/** admin_add_student_2.php */

DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_ID', 'You have to assign an internal id to student.');
DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_LAST', 'Student must have a Last Name.');
DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_FIRST', 'Student must have a First Name.');
DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_DOB', 'Student must have a Date of Birth.');
DEFINE('_ADMIN_ADD_STUDENT_2_FORM_ERROR', 'Date of Birth is not in a correct format.');
DEFINE('_ADMIN_ADD_STUDENT_2_FORM_ERROR2', 'Internal ID already assigned to ');
DEFINE('_ADMIN_ADD_STUDENT_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_STUDENT_2_TITLE', 'Error Adding New Student');
DEFINE('_ADMIN_ADD_STUDENT_2_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_ADD_STUDENT_2_TITLE_PRIMARY', 'Add Primary Contact for Student');
DEFINE('_ADMIN_ADD_STUDENT_2_DB_PRIMARY', 'Or Choose Primary Contact from Database');
DEFINE('_ADMIN_ADD_STUDENT_2_SEARCH', 'Search');
DEFINE('_ADMIN_ADD_STUDENT_2_P_TITLE', 'Title');
DEFINE('_ADMIN_ADD_STUDENT_2_FIRST', 'First Name');
DEFINE('_ADMIN_ADD_STUDENT_2_LAST', 'Last Name');
DEFINE('_ADMIN_ADD_STUDENT_2_RESIDENCE', 'Residence');
DEFINE('_ADMIN_ADD_STUDENT_2_RELATION', 'Relation');
DEFINE('_ADMIN_ADD_STUDENT_2_ADDRESS', 'Address');
DEFINE('_ADMIN_ADD_STUDENT_2_CITY', 'City');
DEFINE('_ADMIN_ADD_STUDENT_2_STATE', 'State');
DEFINE('_ADMIN_ADD_STUDENT_2_ZIP', 'Zip');
DEFINE('_ADMIN_ADD_STUDENT_2_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_STUDENT_2_PHONE1', 'Phone');
DEFINE('_ADMIN_ADD_STUDENT_2_PHONE2', 'Alt. Phone');
DEFINE('_ADMIN_ADD_STUDENT_2_PHONE3', 'Alt. Phone');
DEFINE('_ADMIN_ADD_STUDENT_2_MAILINGS', 'Mailings');
DEFINE('_ADMIN_ADD_STUDENT_2_OTHER', 'Other Notes');
DEFINE('_ADMIN_ADD_STUDENT_2_ADD', 'Add Contact');

/** admin_add_student_3.php */

DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_FIRST', 'Primary Contact must have a First Name.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_LAST', 'Primary Contact must have a Last Name.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_RELATION', 'You have to provide the relation to the student.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_ADDRESS', 'You have to provide an address for the contact.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_CITY', 'You have to provide a city for the contact.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_STATE', 'You have to provide a state for the contact.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_ZIP', 'You have to provide a zip for the contact.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_PHONE', 'You have to provide at least one phone number for the contact.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_EMAIL', 'The value in field Email has to be a valid address.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_ALL', 'You have to fill in all values.');
DEFINE('_ADMIN_ADD_STUDENT_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_STUDENT_3_TITLE', 'Error Adding Primary Contact');
DEFINE('_ADMIN_ADD_STUDENT_3_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_ADD_STUDENT_3_TITLE_SUCCESS', 'Successfully Added New Student and Primary Contact');
DEFINE('_ADMIN_ADD_STUDENT_3_STUDENT', 'Student');
DEFINE('_ADMIN_ADD_STUDENT_3_CONTACT', 'Primary Contact');
DEFINE('_ADMIN_ADD_STUDENT_3_MESSAGE', 'If you want this contact be a web user for the student, please fill the following information:');
DEFINE('_ADMIN_ADD_STUDENT_3_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_STUDENT_3_USERNAME', 'Username');
DEFINE('_ADMIN_ADD_STUDENT_3_PASSWORD', 'Password');
DEFINE('_ADMIN_ADD_STUDENT_3_SET', 'Set As User');
DEFINE('_ADMIN_ADD_STUDENT_3_ADD_NEW', 'Add New Contact');
DEFINE('_ADMIN_ADD_STUDENT_3_ADD', 'Add New Student');

/** admin_add_student_4.php */

DEFINE('_ADMIN_ADD_STUDENT_4_FORM_ERROR', 'No contact Found. Please use your back browser button to add contact.');
DEFINE('_ADMIN_ADD_STUDENT_4_SELECT', 'Select');
DEFINE('_ADMIN_ADD_STUDENT_4_ALERT', 'You have to assign a relation.');
DEFINE('_ADMIN_ADD_STUDENT_4_ALERT2', 'Select this contact as primary for the student ?');
DEFINE('_ADMIN_ADD_STUDENT_4_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_STUDENT_4_TITLE', 'Error Adding Primary Contact');
DEFINE('_ADMIN_ADD_STUDENT_4_TITLE2', 'Choose Primary Contact for');
DEFINE('_ADMIN_ADD_STUDENT_4_STUDENT', 'Student');
DEFINE('_ADMIN_ADD_STUDENT_4_SEL_REL', 'Select Relation');
DEFINE('_ADMIN_ADD_STUDENT_4_RESIDENCE', 'Residence');
DEFINE('_ADMIN_ADD_STUDENT_4_BACK', 'Click your browser back button to return.');

/** admin_add_student_5.php */

DEFINE('_ADMIN_ADD_STUDENT_5_ENTER_ALL', 'You have to fill in all values.');
DEFINE('_ADMIN_ADD_STUDENT_5_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_STUDENT_5_TITLE_SUCCESS', 'Successfully Added New Student and Primary Contact');
DEFINE('_ADMIN_ADD_STUDENT_5_STUDENT', 'Student');
DEFINE('_ADMIN_ADD_STUDENT_5_CONTACT', 'Primary Contact');
DEFINE('_ADMIN_ADD_STUDENT_5_MESSAGE', 'If you want this contact be a web user for the student, please fill the following information:');
DEFINE('_ADMIN_ADD_STUDENT_5_EMAIL', 'Email Address');
DEFINE('_ADMIN_ADD_STUDENT_5_USERNAME', 'Username');
DEFINE('_ADMIN_ADD_STUDENT_5_PASSWORD', 'Password');
DEFINE('_ADMIN_ADD_STUDENT_5_SET', 'Set As User');
DEFINE('_ADMIN_ADD_STUDENT_5_ADD_NEW', 'Add New Contact');

/** admin_add_edit_picture.php */

DEFINE('_ADMIN_ADD_EDIT_PICTURE_ERROR', 'The image type you uploaded is not valid, only images with extension .jpg, .jpeg, .gif and .png are allowed. Please re-upload.');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_UPLOAD_ERROR', 'File upload failed.');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_PIC_ERROR', 'Error creating image');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_TITLE', 'Manage Student');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_CURRENT', 'Current Image');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_CLICK', 'Click here to go back');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_NONE', 'No stored image found, please use the form below to upload an image.');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_PICNAME', 'Picture to upload:');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_PICGRADE', 'What grade was this picture taken in?');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_EDITPIC', 'Edit picture');

/** admin_add_edit_teacher_1.php */

DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_UPDATE_SUB', 'Update Teacher');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_UPDATE_PAG', 'Update Teacher');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_SUB', 'Add Teacher');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_PAG', 'Add New Teacher');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_TITLE', 'Title');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_FIRST', 'First Name');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_LAST', 'Last Name');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_MIDDLE', 'MI');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_SCHOOL', 'School');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ACCESS', 'Access to Health');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_USERNAME', 'Username');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_PASSWORD', 'Password');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_SCH', 'Add/View Schedule');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_TEACHER', 'Add Teacher');

/** admin_add_edit_teacher_2.php */

DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_FIRST', 'Teacher must have a First Name.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_LAST', 'Teacher must have a Last Name.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_USER', 'You have to provide a user name for the teacher.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_PASS', 'You have to provide a password for the teacher.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_EMAIL', 'You have to provide an email address for the teacher.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_EMAIL_VALID', 'The value in field Email has to be a valid address.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_DUP', 'That username is already in use. Press your browser\'s back button and choose a different username.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ADDED', 'Added');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_UPDATED', 'Updated');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ADDING', 'Adding');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_UPDATING', 'Updating');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_TITLE', 'Title');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_TEACHER', 'Teacher');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_SUCCESSFULLY', 'Successfully');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ADD_TEACHER', 'Add Teacher');

/** admin_add_edit_contact_1.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_UPDATE_SUB', 'Update Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_UPDATE_PAG', 'Update Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADD_SUB', 'Add Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADD_PAG', 'Add New Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_TITLE', 'Add Additional Contact for Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_DB_PRIMARY', 'Or Choose Primary Contact from Database');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_SEARCH', 'Search');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_P_TITLE', 'Title');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_FIRST', 'First Name');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_LAST', 'Last Name');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_RESIDENCE', 'Residence');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_RELATION', 'Relation');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADDRESS', 'Address');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_CITY', 'City');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_STATE', 'State');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ZIP', 'Zip');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_PHONE1', 'Phone');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_PHONE2', 'Alt. Phone');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_PHONE3', 'Alt. Phone');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_MAILINGS', 'Mailings');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_OTHER', 'Other Notes');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADD', 'Add Contact');

/** admin_add_edit_contact_2.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_FIRST', 'Primary Contact must have a First Name.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_LAST', 'Primary Contact must have a Last Name.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_RELATION', 'You have to provide the relation to the student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ADDRESS', 'You have to provide an address for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_CITY', 'You have to provide a city for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_STATE', 'You have to provide a state for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ZIP', 'You have to provide a zip for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_PHONE', 'You have to provide at least one phone number for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_EMAIL', 'The value in field Email has to be a valid address.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_REL_DEF1', 'Relation ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_REL_DEF2', ' already defined for student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_RES_DEF', ' Residence already assigned for student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ADDED', 'Added');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_UPDATED', 'Updated');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ADDING', 'Adding');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_UPDATING', 'Updating');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ALL', 'You have to fill in all values.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_TITLE', 'Error');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_CONTACT', 'Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_PLEASE', 'Please');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_CLICK_HERE', 'click here');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_CORRECT', 'to correct the following error(s):');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_TITLE_SUCCESS', 'Successfully');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_MESSAGE', 'If you want this contact be a web user for the student, please fill the following information:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_EMAIL', 'Email Address');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_USERNAME', 'Username');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_PASSWORD', 'Password');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_SET', 'Set As User');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ADD_NEW', 'Add New Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_BACK', 'Back to Student');

/** admin_add_edit_contact_3.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_FORM_ERROR', 'No contact Found. Please use your back browser button to add contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_ENTER_RELATION', 'You have to assign a relation.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_CONFIRM', 'Select this additional contact for the student ?');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_TITLE', 'Error Adding Primary Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_CHOOSE', 'Choose Additional Contact for');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_STUDENT', 'Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_SEL_REL', 'Select Relation');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_RESIDENCE', 'Residence');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_BACK', 'Back to Student');

/** admin_add_edit_contact_4.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_REL_DEF1', 'Relation ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_REL_DEF2', ' already defined for student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_RES_DEF', ' Residence already assigned for student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_ENTER_ALL', 'You have to fill in all values.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_TITLE', 'Successfully Added Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_STUDENT', 'Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_ADDITIONAL', 'Additional Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_MESSAGE', 'If you want this contact be a web user for the student, please fill the following information:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_EMAIL', 'Email Address');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_USERNAME', 'Username');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_PASSWORD', 'Password');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_SET', 'Set As User');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_ADD_NEW', 'Add New Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_BACK', 'Back to Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_TITLE_ERROR', 'Error inserting Contact for Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_BACK2', 'Please click the back button of your browser to correct error(s)');

/** admin_add_edit_contact_5.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_EDIT', 'Edit');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_CFS', 'Contact for Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_P_TITLE', 'Title');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_FIRST', 'First Name');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_LAST', 'Last Name');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_RESIDENCE', 'Residence');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_RELATION', 'Relation');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_ADDRESS', 'Address');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_CITY', 'City');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_STATE', 'State');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_ZIP', 'Zip');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_PHONE1', 'Phone');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_PHONE2', 'Alt. Phone');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_PHONE3', 'Alt. Phone');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_MAILINGS', 'Mailings');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_OTHER', 'Other Notes');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_BACK', 'Back to Student');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_UPDATE', 'Update Contact');

/** admin_add_edit_contact_6.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_FIRST', 'Contact must have a First Name.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_LAST', 'Contact must have a Last Name.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_RELATION', 'You have to provide the relation to the student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_ADDRESS', 'You have to provide an address for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_CITY', 'You have to provide a city for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_STATE', 'You have to provide a state for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_ZIP', 'You have to provide a zip for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_PHONE', 'You have to provide at least one phone number for the contact.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_EMAIL', 'The value in field Email has to be a valid address.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_RES_DEF', ' Residence already assigned for student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_REL_DEF1', 'Relation ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_REL_DEF2', ' already defined for student.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_ALL', 'You have to fill in all values.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_UPDATED', 'Updated');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_UPDATING', 'Updating');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_TITLE', 'Error');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_CONTACT', 'Contact');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ERROR_BACK', 'Please use your browser \'back\' button to correct the following error(s):');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_TITLE_SUCCESS', 'Successfully');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_MESSAGE', 'If you want this contact be a web user for the student, please fill the following information:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_EMAIL', 'Email Address');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_USERNAME', 'Username');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_PASSWORD', 'Password');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_SET', 'Set As User');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_BACK', 'Back to Student');

/** admin_process_mass_mail.php */

DEFINE('_ADMIN_PROCESS_MASS_MAIL_GENERAL', 'General Email');

/** admin_rooms.php */

DEFINE('_ADMIN_ROOMS_FORM_ERROR', 'Field cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_ROOMS_DUP', 'Field is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_ROOMS_EDIT', 'Edit');
DEFINE('_ADMIN_ROOMS_REMOVE', 'Remove');
DEFINE('_ADMIN_ROOMS_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_ROOMS_UPPER', 'Administrator Area');
DEFINE('_ADMIN_ROOMS_TITLE', 'Manage Rooms');
DEFINE('_ADMIN_ROOMS_ADD_NEW', 'Add New Rooms');
DEFINE('_ADMIN_ROOMS_ADD', 'Add');
DEFINE('_ADMIN_ROOMS_UPDATE_CUSTOM', 'Update Room');
DEFINE('_ADMIN_ROOMS_UPDATE', 'Update');

/** contact_timetable.php */

DEFINE('_CONTACT_TIMETABLE_FORM_ERROR', 'You should select a student first.');
DEFINE('_CONTACT_TIMETABLE_DATE', 'Date');
DEFINE('_CONTACT_TIMETABLE_CODE', 'Code');
DEFINE('_CONTACT_TIMETABLE_DETAILS', 'Details');
DEFINE('_CONTACT_TIMETABLE_TITLE', 'Timetable history for student');
DEFINE('_CONTACT_TIMETABLE_BACK', 'Back to Student');
DEFINE('_CONTACT_TIMETABLE_ADD_NOTE', 'Add Timetable Entry');

/** exams_types_rooms.php */

DEFINE('_ADMIN_EXAMS_TYPES_FORM_ERROR', 'This Exam Type cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_EXAMS_TYPES_DUP', 'This Exam Type is already in the system and can\'t be duplicated.');
DEFINE('_ADMIN_EXAMS_TYPES_EDIT', 'Edit');
DEFINE('_ADMIN_EXAMS_TYPES_REMOVE', 'Remove');
DEFINE('_ADMIN_EXAMS_TYPES_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_EXAMS_TYPES_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EXAMS_TYPES_TITLE', 'Manage Exam Types');
DEFINE('_ADMIN_EXAMS_TYPES_ADD_NEW', 'Add New Exam Type');
DEFINE('_ADMIN_EXAMS_TYPES_ADD', 'Add');
DEFINE('_ADMIN_EXAMS_TYPES_UPDATE_CUSTOM', 'Update Exam Type');
DEFINE('_ADMIN_EXAMS_TYPES_UPDATE', 'Update');

/** admin_exams_1.php */

DEFINE('_ADMIN_EXAMS_1_SCHOOL', 'School');
DEFINE('_ADMIN_EXAMS_1_ROOM', 'Room');
DEFINE('_ADMIN_EXAMS_1_DATE', 'Date');
DEFINE('_ADMIN_EXAMS_1_SUBJECT', 'Subject');
DEFINE('_ADMIN_EXAMS_1_TYPE', 'Type');
DEFINE('_ADMIN_EXAMS_1_TEACHER', 'Teacher');
DEFINE('_ADMIN_EXAMS_1_DETAILS', 'Details');
DEFINE('_ADMIN_EXAMS_1_REMOVE', 'Remove');
DEFINE('_ADMIN_EXAMS_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EXAMS_1_TITLE', 'Exams and Tests');
DEFINE('_ADMIN_EXAMS_1_ADD', 'Add New Exam');

/** admin_exams_2.php */

DEFINE('_ADMIN_EXAMS_2_SCHOOL', 'School');
DEFINE('_ADMIN_EXAMS_2_ROOM', 'Room');
DEFINE('_ADMIN_EXAMS_2_DATE', 'Date');
DEFINE('_ADMIN_EXAMS_2_SUBJECT', 'Subject');
DEFINE('_ADMIN_EXAMS_2_TYPE', 'Type');
DEFINE('_ADMIN_EXAMS_2_EDIT', 'Edit');
DEFINE('_ADMIN_EXAMS_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EXAMS_2_TITLE', 'Exams and Tests');
DEFINE('_ADMIN_EXAMS_2_YEAR', 'Year');
DEFINE('_ADMIN_EXAMS_2_TEACHER', 'Teacher');
DEFINE('_ADMIN_EXAMS_2_BACK', 'Back to Exams');

/** admin_exams_3.php */

DEFINE('_ADMIN_EXAMS_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EXAMS_3_TITLE', 'Exams and Tests');
DEFINE('_ADMIN_EXAMS_3_YEAR', 'Year');
DEFINE('_ADMIN_EXAMS_3_SCHOOL', 'School');
DEFINE('_ADMIN_EXAMS_3_ROOM', 'Room');
DEFINE('_ADMIN_EXAMS_3_DATE', 'Date');
DEFINE('_ADMIN_EXAMS_3_SUBJECT', 'Subject');
DEFINE('_ADMIN_EXAMS_3_TYPE', 'Type');
DEFINE('_ADMIN_EXAMS_3_TEACHER', 'Teacher');
DEFINE('_ADMIN_EXAMS_3_BACK', 'Back');
DEFINE('_ADMIN_EXAMS_3_UPDATE', 'Update Exam');
DEFINE('_ADMIN_EXAMS_3_ADD', 'Add New Exam');

/** admin_exams_4.php */

DEFINE('_ADMIN_EXAMS_4_SELECT_ROOM', 'Please select a room');
DEFINE('_ADMIN_EXAMS_4_FORM_DATE', 'Please select a date');
DEFINE('_ADMIN_EXAMS_4_FORM_SUBJECT', 'Please select a subject');
DEFINE('_ADMIN_EXAMS_4_FORM_TYPE', 'Please select a type of exam');
DEFINE('_ADMIN_EXAMS_4_FORM_TEACHER', 'PLease select a teacher');
DEFINE('_ADMIN_EXAMS_4_DUP', 'This exam already exists');
DEFINE('_ADMIN_EXAMS_4_UPDATING', 'Updating');
DEFINE('_ADMIN_EXAMS_4_ADDING', 'Adding');
DEFINE('_ADMIN_EXAMS_4_UPPER', 'Administrator Area');
DEFINE('_ADMIN_EXAMS_4_TITLE', 'Exams');

/** teacher_exams_1.php */

DEFINE('_TEACHER_EXAMS_1_SCHOOL', 'School');
DEFINE('_TEACHER_EXAMS_1_ROOM', 'Room');
DEFINE('_TEACHER_EXAMS_1_DATE', 'Date');
DEFINE('_TEACHER_EXAMS_1_SUBJECT', 'Subject');
DEFINE('_TEACHER_EXAMS_1_TYPE', 'Type');
DEFINE('_TEACHER_EXAMS_1_TEACHER', 'Teacher');
DEFINE('_TEACHER_EXAMS_1_DETAILS', 'Details');
DEFINE('_TEACHER_EXAMS_1_REMOVE', 'Remove');
DEFINE('_TEACHER_EXAMS_1_UPPER', 'Administrator Area');
DEFINE('_TEACHER_EXAMS_1_TITLE', 'Exams and Tests');
DEFINE('_TEACHER_EXAMS_1_ADD', 'Add New Exam');

/** teacher_exams_2.php */

DEFINE('_TEACHER_EXAMS_2_SCHOOL', 'School');
DEFINE('_TEACHER_EXAMS_2_ROOM', 'Room');
DEFINE('_TEACHER_EXAMS_2_DATE', 'Date');
DEFINE('_TEACHER_EXAMS_2_SUBJECT', 'Subject');
DEFINE('_TEACHER_EXAMS_2_TYPE', 'Type');
DEFINE('_TEACHER_EXAMS_2_EDIT', 'Edit');
DEFINE('_TEACHER_EXAMS_2_UPPER', 'Administrator Area');
DEFINE('_TEACHER_EXAMS_2_TITLE', 'Exams and Tests');
DEFINE('_TEACHER_EXAMS_2_YEAR', 'Year');
DEFINE('_TEACHER_EXAMS_2_TEACHER', 'Teacher');
DEFINE('_TEACHER_EXAMS_2_BACK', 'Back to Exams');

/** teacher_exams_3.php */

DEFINE('_TEACHER_EXAMS_3_UPPER', 'Administrator Area');
DEFINE('_TEACHER_EXAMS_3_TITLE', 'Exams and Tests');
DEFINE('_TEACHER_EXAMS_3_YEAR', 'Year');
DEFINE('_TEACHER_EXAMS_3_SCHOOL', 'School');
DEFINE('_TEACHER_EXAMS_3_ROOM', 'Room');
DEFINE('_TEACHER_EXAMS_3_DATE', 'Date');
DEFINE('_TEACHER_EXAMS_3_SUBJECT', 'Subject');
DEFINE('_TEACHER_EXAMS_3_TYPE', 'Type');
DEFINE('_TEACHER_EXAMS_3_TEACHER', 'Teacher');
DEFINE('_TEACHER_EXAMS_3_BACK', 'Back');
DEFINE('_TEACHER_EXAMS_3_UPDATE', 'Update Exam');
DEFINE('_TEACHER_EXAMS_3_ADD', 'Add New Exam');

/** teacher_exams_4.php */

DEFINE('_TEACHER_EXAMS_4_SELECT_ROOM', 'Please select a room');
DEFINE('_TEACHER_EXAMS_4_FORM_DATE', 'Please select a date');
DEFINE('_TEACHER_EXAMS_4_FORM_SUBJECT', 'Please select a subject');
DEFINE('_TEACHER_EXAMS_4_FORM_TYPE', 'Please select a type of exam');
DEFINE('_TEACHER_EXAMS_4_FORM_TEACHER', 'PLease select a teacher');
DEFINE('_TEACHER_EXAMS_4_DUP', 'This exam already exists');
DEFINE('_TEACHER_EXAMS_4_UPDATING', 'Updating');
DEFINE('_TEACHER_EXAMS_4_ADDING', 'Adding');
DEFINE('_TEACHER_EXAMS_4_UPPER', 'Administrator Area');
DEFINE('_TEACHER_EXAMS_4_TITLE', 'Exams');

/** contact_exams.php */

DEFINE('_CONTACT_EXAMS_FORM_ERROR', 'Please select a student first.');
DEFINE('_CONTACT_EXAMS_SCHOOL', 'School');
DEFINE('_CONTACT_EXAMS_ROOM', 'Room');
DEFINE('_CONTACT_EXAMS_DAYS', 'Day');
DEFINE('_CONTACT_EXAMS_SUBJECT', 'Subject');
DEFINE('_CONTACT_EXAMS_TYPE', 'Type');
DEFINE('_CONTACT_EXAMS_TEACHER', 'Teacher');
DEFINE('_CONTACT_EXAMS_TITLE', 'Exams and Tests');

/** admin_subjects.php */

DEFINE('_ADMIN_SPEAK_FORM_ERROR', 'Entry cannot be removed, it\'s used in the system.');
DEFINE('_ADMIN_SPEAK_DUP', 'Entry for this teacher already exists.');
DEFINE('_ADMIN_SPEAK_EDIT', 'Edit');
DEFINE('_ADMIN_SPEAK_REMOVE', 'Remove');
DEFINE('_ADMIN_SPEAK_SURE', 'Are you sure you want to remove this record ?');
DEFINE('_ADMIN_SPEAK_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_SPEAK_TITLE', 'Manage Speaking Hours');
DEFINE('_ADMIN_SPEAK_ADD_NEW', 'Add New Speaking Hour');
DEFINE('_ADMIN_SPEAK_TEACHER', 'Teacher');
DEFINE('_ADMIN_SPEAK_DAY', 'Day');
DEFINE('_ADMIN_SPEAK_PERIOD', 'Period');
DEFINE('_ADMIN_SPEAK_ADD', 'Add');
DEFINE('_ADMIN_SPEAK_UPDATE_SUBJECT', 'Update Speaking Hour');
DEFINE('_ADMIN_SPEAK_UPDATE', 'Update');

/** contact_speak.php */

DEFINE('_CONTACT_SPEAK_TEACHER', 'Teacher');
DEFINE('_CONTACT_SPEAK_DAY', 'Day');
DEFINE('_CONTACT_SPEAK_PERIOD', 'Period');
DEFINE('_CONTACT_SPEAK_UPPER', 'Contact Area');
DEFINE('_CONTACT_SPEAK_TITLE', 'Speaking Hours');

/** teacher_speak.php */

DEFINE('_TEACHER_SPEAK_TEACHER', 'Teacher');
DEFINE('_TEACHER_SPEAK_DAY', 'Day');
DEFINE('_TEACHER_SPEAK_PERIOD', 'Period');
DEFINE('_TEACHER_SPEAK_UPPER', 'Teacher Area');
DEFINE('_TEACHER_SPEAK_TITLE', 'Speaking Hours');
DEFINE('_TEACHER_SPEAK_UPDATE_SUBJECT', 'Update Own Speaking Hour');
DEFINE('_TEACHER_SPEAK_UPDATE', 'Update Speaking Hour');

/** admin_books.php */

DEFINE('_ADMIN_BOOKS_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_BOOKS_TITLE', 'Ordering Books');
DEFINE('_ADMIN_BOOKS_SUBTITLE', 'at this Store:');
DEFINE('_ADMIN_BOOKS_TEXT', 'Please enter the ISBN number and the quantity of the book you want to order.');
DEFINE('_ADMIN_BOOKS_TEXT2', 'Note that the order is binding!');
DEFINE('_ADMIN_BOOKS_TEXT3', '');
DEFINE('_ADMIN_BOOKS_PHONE', 'Phone');
DEFINE('_ADMIN_BOOKS_FAX', 'Fax');
DEFINE('_ADMIN_BOOKS_EMAIL', 'Email');
DEFINE('_ADMIN_BOOKS_DISCOUNT', 'Discount');
DEFINE('_ADMIN_BOOKS_ISBN', 'ISBN Number');
DEFINE('_ADMIN_BOOKS_QUANTITY', 'Quantity');
DEFINE('_ADMIN_BOOKS_LOOKUP', 'Lookup book data!');

/** admin_books_2.php */

DEFINE('_ADMIN_BOOKS_2_MESSAGE1', 'New book order!');
DEFINE('_ADMIN_BOOKS_2_MESSAGE2', 'This book has been ordered:');
DEFINE('_ADMIN_BOOKS_2_MESSAGE3', 'Quantity:');
DEFINE('_ADMIN_BOOKS_2_SUBJECT', 'Book Order');
DEFINE('_ADMIN_BOOKS_2_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_BOOKS_2_TITLE', 'Ordering Books');
DEFINE('_ADMIN_BOOKS_2_SUBTITLE', 'You are ordering:');
DEFINE('_ADMIN_BOOKS_2_ISBN', 'ISBN Number');
DEFINE('_ADMIN_BOOKS_2_BOOKTITLE', 'Title of Book');
DEFINE('_ADMIN_BOOKS_2_BOOKPUBLISHER', 'Publisher');
DEFINE('_ADMIN_BOOKS_2_BOOKSUMMARY', 'Summary');
DEFINE('_ADMIN_BOOKS_2_QUANTITY', 'Quantity');
DEFINE('_ADMIN_BOOKS_2_ORDER', 'Order now!');
DEFINE('_ADMIN_BOOKS_2_SCHOOLNAME', 'Name of Schule');
DEFINE('_ADMIN_BOOKS_2_SCHOOLADDRESS', 'Address of Schule');
DEFINE('_ADMIN_BOOKS_2_SCHOOLADDRESS2', 'ZIP and City');

/** admin_books_3.php */

DEFINE('_ADMIN_BOOKS_3_ADMIN_AREA', 'Administrator Area');
DEFINE('_ADMIN_BOOKS_3_SUBJECT', 'Book Order');
DEFINE('_ADMIN_BOOKS_3_QUANTITY','Quantity');
DEFINE('_ADMIN_BOOKS_3_ISBN', 'ISBN');
DEFINE('_ADMIN_BOOKS_3_BOOKTITLE', 'Title of Book');
DEFINE('_ADMIN_BOOKS_3_BOOKPUBLISHER', 'Publisher');
DEFINE('_ADMIN_BOOKS_3_BOOKSUMMARY', 'Summary');
DEFINE('_ADMIN_BOOKS_3_SENT_TO', 'Sent to');
DEFINE('_ADMIN_BOOKS_3_SENT_TO_EMAIL', 'Email Address');
DEFINE('_ADMIN_BOOKS_3_TITLE', 'Book Order');
DEFINE('_ADMIN_BOOKS_3_SUBTITLE', 'Confirmation');
DEFINE('_ADMIN_BOOKS_3_SCHOOLNAME', 'Name of Schule');
DEFINE('_ADMIN_BOOKS_3_SCHOOLADDRESS', 'Address of Schule');
DEFINE('_ADMIN_BOOKS_3_SCHOOLADDRESS2', 'ZIP and City');

/** admin_contact_2.php */

DEFINE('_ADMIN_CONTACT_2_ACTIVATE', 'Activate');
DEFINE('_ADMIN_CONTACT_2_DEACTIVATE', 'Deactivate');
DEFINE('_ADMIN_CONTACT_2_EDIT', 'Edit');
DEFINE('_ADMIN_CONTACT_2_FORM_ERROR', 'Contact not found');
DEFINE('_ADMIN_CONTACT_2_NAME', 'Name');
DEFINE('_ADMIN_CONTACT_2_ACTIVE', 'Active');
DEFINE('_ADMIN_CONTACT_2_FORM_ERROR2', 'Contact not found: ');
DEFINE('_ADMIN_CONTACT_2_FORM_ERROR3', 'Contact not found: Letter ');
DEFINE('_ADMIN_CONTACT_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_CONTACT_2_TITLE', 'Teacher Search Result');
DEFINE('_ADMIN_CONTACT_2_NEW', 'New Search');

/** admin_export.php */

DEFINE('_ADMIN_EXPORT_NO_DATA', 'No Records found!');

/** admin_chat.php */

DEFINE('_ADMIN_CHAT_UPPER', 'Administrator Area - Chat');
DEFINE('_ADMIN_CHAT_TITLE', 'Chat');
DEFINE('_ADMIN_CHAT_TEXT', 'Please click here to enter the chat room ...');

/** teacher_chat.php */

DEFINE('_TEACHER_CHAT_UPPER', 'Teacher Area - Chat');
DEFINE('_TEACHER_CHAT_TITLE', 'Chat');
DEFINE('_TEACHER_CHAT_TEXT', 'Please click here to enter the chat room ...');

/** contact_chat.php */

DEFINE('_CONTACT_CHAT_UPPER', 'Contact Area - Chat');
DEFINE('_CONTACT_CHAT_TITLE', 'Chat');
DEFINE('_CONTACT_CHAT_TEXT', 'Please click here to enter the chat room ...');

/** health_chat.php */

DEFINE('_HEALTH_CHAT_UPPER', 'Health Area - Chat');
DEFINE('_HEALTH_CHAT_TITLE', 'Chat');
DEFINE('_HEALTH_CHAT_TEXT', 'Please click here to enter the chat room ...');

/** admin_backup.php */

DEFINE('_ADMIN_BACKUP_ERROR_OPENING_FILE', 'Fehler beim &Ouml;ffnen der Datei');
DEFINE('_ADMIN_BACKUP_UPPER', 'Administrator Area - Backup');
DEFINE('_ADMIN_BACKUP_TITLE', 'Backup der Datenbank');
DEFINE('_ADMIN_BACKUP_SUBTITLE', 'Bitte ausw&auml;hlen, auf welche Art die Datenbank gespeichert werden soll:');
DEFINE('_ADMIN_BACKUP_DOWNLOAD', 'Download');
DEFINE('_ADMIN_BACKUP_FILE', 'Datei');
DEFINE('_ADMIN_BACKUP_SCREEN', 'Bildschirm');
DEFINE('_ADMIN_BACKUP_SUBMIT', 'Los');

/** admin_backup2.php */

DEFINE('_ADMIN_BACKUP_2_FILE_OK', 'Successfully saved file');
DEFINE('_ADMIN_BACKUP_2_SCREEN_OK', 'Screen Output successful');
DEFINE('_ADMIN_BACKUP_2_DOWNLOAD_OK', 'Download Successfull');
DEFINE('_ADMIN_BACKUP_2_UPPER', 'Administrator: Backup');
DEFINE('_ADMIN_BACKUP_2_TITLE', 'Database Backup');
DEFINE('_ADMIN_BACKUP_2_SUBTITLE', '');

/** admin_media_codes_1.php */

DEFINE('_ADMIN_MEDIA_CODES_1_UPPER', 'Manage Library - Admin');
DEFINE('_ADMIN_MEDIA_CODES_1_TITLE', 'Add, Delete, Edit Media');
DEFINE('_ADMIN_MEDIA_CODES_1_ADD_NEW', 'Add New Media');
DEFINE('_ADMIN_MEDIA_CODES_1_LINE_1', 'Title of Media');
DEFINE('_ADMIN_MEDIA_CODES_1_LINE_2', 'Identifying Aspect #1');
DEFINE('_ADMIN_MEDIA_CODES_1_LINE_3', 'Identifying Aspect #2');
DEFINE('_ADMIN_MEDIA_CODES_1_ADD', 'Add to Media Library');
DEFINE('_ADMIN_MEDIA_CODES_1_EDIT', 'Edit');
DEFINE('_ADMIN_MEDIA_CODES_1_REMOVE', 'Remove');
DEFINE('_ADMIN_MEDIA_CODES_1_UPDATE', 'Update Media');
DEFINE('_ADMIN_MEDIA_CODES_1_SURE', 'Are you sure?');
DEFINE('_ADMIN_MEDIA_CODES_1_CHECK', 'Check all media');
DEFINE('_ADMIN_MEDIA_CODES_1_DAYS', 'Day(s)');
DEFINE('_ADMIN_MEDIA_CODES_1_DELETE', 'Kann nicht gel&ouml;scht werden, wird im System verwendet.');

/** admin_media_codes_2.php */

DEFINE('_ADMIN_MEDIA_CODES_2_FORM_ERROR', 'Error deleting entry');
DEFINE('_ADMIN_MEDIA_CODES_2_FORM_ERROR_2', 'Select a Student First');
DEFINE('_ADMIN_MEDIA_CODES_2_TITLE', 'Media due within ');
DEFINE('_ADMIN_MEDIA_CODES_2_TITLE2', ' day(s)');
DEFINE('_ADMIN_MEDIA_CODES_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MEDIA_CODES_2_DATEOUT', 'Date Out');
DEFINE('_ADMIN_MEDIA_CODES_2_DATEDUE', 'Date Due');
DEFINE('_ADMIN_MEDIA_CODES_2_CODE', 'Media Name');
DEFINE('_ADMIN_MEDIA_CODES_2_NOTIFY', 'Notify');
DEFINE('_ADMIN_MEDIA_CODES_2_SEND', 'Send');
DEFINE('_ADMIN_MEDIA_CODES_2_CHECK', 'Check which media are due');
DEFINE('_ADMIN_MEDIA_CODES_2_NOTIFYALL', 'Notify all contacts automatically');

/** admin_media_codes_3.php */

/** admin_media_codes_4.php */

DEFINE('_ADMIN_MEDIA_CODES_4_MESSAGE', 'Please do not forget the return the media to the School Library. Thank you.');
DEFINE('_ADMIN_MEDIA_CODES_4_SUBJECT', 'School Library');
DEFINE('_ADMIN_MEDIA_CODES_4_EMAIL', 'Email');
DEFINE('_ADMIN_MEDIA_CODES_4_SUB', 'Subject');
DEFINE('_ADMIN_MEDIA_CODES_4_MESS', 'Message');

/** admin_manage_media_1.php */

DEFINE('_ADMIN_MANAGE_MEDIA_1_FORM_ERROR', 'Error deleting entry');
DEFINE('_ADMIN_MANAGE_MEDIA_1_FORM_ERROR_2', 'Select a Student First');
DEFINE('_ADMIN_MANAGE_MEDIA_1_ADD', 'Add Media Note');
DEFINE('_ADMIN_MANAGE_MEDIA_1_TITLE', 'Media History for Student');
DEFINE('_ADMIN_MANAGE_MEDIA_1_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_MEDIA_1_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_MEDIA_1_DATEOUT', 'Date Out');
DEFINE('_ADMIN_MANAGE_MEDIA_1_DATEDUE', 'Date Due');
DEFINE('_ADMIN_MANAGE_MEDIA_1_CODE', 'Media Name');
DEFINE('_ADMIN_MANAGE_MEDIA_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_MEDIA_1_REMOVE', 'Remove');
DEFINE('_ADMIN_MANAGE_MEDIA_1_CHECK', 'Check which media are due');

/** admin_manage_media_2.php */

DEFINE('_ADMIN_MANAGE_MEDIA_2_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_MEDIA_2_TITLE', 'Media Items Due For Student');
DEFINE('_ADMIN_MANAGE_MEDIA_2_INSERTED', 'Note added by ');
DEFINE('_ADMIN_MANAGE_MEDIA_2_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_MEDIA_2_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_MEDIA_2_DATE', 'Date Out');
DEFINE('_ADMIN_MANAGE_MEDIA_2_START_DATE', 'Date Due');
DEFINE('_ADMIN_MANAGE_MEDIA_2_END_DATE', 'Date Returned');
DEFINE('_ADMIN_MANAGE_MEDIA_2_INFRACTION', 'Media Title');
DEFINE('_ADMIN_MANAGE_MEDIA_2_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_MEDIA_2_BACK', 'Go Back');
DEFINE('_ADMIN_MANAGE_MEDIA_2_EDIT', 'Edit Entry');

/**admin_manage_media_3.php */

DEFINE('_ADMIN_MANAGE_MEDIA_3_UPPER', 'Administrator Area');
DEFINE('_ADMIN_MANAGE_MEDIA_3_TITLE', 'Media history for student');
DEFINE('_ADMIN_MANAGE_MEDIA_3_INSERTED', 'Note inserted by ');
DEFINE('_ADMIN_MANAGE_MEDIA_3_SCHOOL', 'School');
DEFINE('_ADMIN_MANAGE_MEDIA_3_YEAR', 'Year');
DEFINE('_ADMIN_MANAGE_MEDIA_3_INFRACTION', 'Media');
DEFINE('_ADMIN_MANAGE_MEDIA_3_DATE', 'Date Out');
DEFINE('_ADMIN_MANAGE_MEDIA_3_SELECT_INFRACTION', 'Select Media');
DEFINE('_ADMIN_MANAGE_MEDIA_3_START_DATE', 'Date Due');
DEFINE('_ADMIN_MANAGE_MEDIA_3_END_DATE', 'Date Returned');
DEFINE('_ADMIN_MANAGE_MEDIA_3_NOTES', 'Notes');
DEFINE('_ADMIN_MANAGE_MEDIA_3_CUSTOM_FIELDS', 'Custom Fields');
DEFINE('_ADMIN_MANAGE_MEDIA_3_DELETE', 'Delete');
DEFINE('_ADMIN_MANAGE_MEDIA_3_ADD', 'Add');
DEFINE('_ADMIN_MANAGE_MEDIA_3_BACK', 'Back to Student');
DEFINE('_ADMIN_MANAGE_MEDIA_3_UPDATE', 'Update Note');
DEFINE('_ADMIN_MANAGE_MEDIA_3_NOTIFY', 'Notify Contact(s)');

/**admin_manage_media_4.php */

DEFINE('_ADMIN_MANAGE_MEDIA_4_ENTER_CODE', 'Bitte Code eingeben');
DEFINE('_ADMIN_MANAGE_MEDIA_4_ENTER_DATE', 'Bitte Start Datum eingeben');
DEFINE('_ADMIN_MANAGE_MEDIA_4_ENTER_START', 'Bitte Ende Datum eingeben');
DEFINE('_ADMIN_MANAGE_MEDIA_4_ENTER_END', 'Bitte R&uuml;ckgabedatum eingeben');
DEFINE('_ADMIN_MANAGE_MEDIA_4_UPPER', 'Media Bereich');
DEFINE('_ADMIN_MANAGE_MEDIA_4_ERROR_BACK', 'Zur&uuml;ck');
DEFINE('_ADMIN_MANAGE_MEDIA_4_SUBJECT', 'New media note for ');
DEFINE('_ADMIN_MANAGE_MEDIA_4_BODY1', 'A new media has been borrowed by ');
DEFINE('_ADMIN_MANAGE_MEDIA_4_BODY2', 'Please login to the parents interface website for details. Thanks - The Principal');

