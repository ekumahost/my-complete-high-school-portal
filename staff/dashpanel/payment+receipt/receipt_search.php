<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();

extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('This File is Classified');
}

$receipt_query = "SELECT * FROM payment_receipts  WHERE tution_paid_sch_years LIKE '".$school_years."' AND tution_paid_grade LIKE '".$school_grade."' 
				AND tution_paid_terms LIKE '".$school_term."' AND tution_paid_type LIKE '".$receipt_type."' ORDER BY tuition_history_id DESC";
				$db_receipt_query = $dbh->prepare($receipt_query);
				$db_receipt_query->execute();
				$get_receipt_query_rows = $db_receipt_query->rowCount();						
				
			$serial = 0;
			/* getting the title table */
			$gradeGotten = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $school_grade);
			$gradeGotten = ($gradeGotten == '')? 'All Grade': $gradeGotten;
			
			$termGotten = $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $school_term);
			$termGotten = ($termGotten == '')? 'All Term': $termGotten;
			
			$paidType = $kas_framework->getValue('tuition_codes_desc', 'tuition_codes', 'tuition_codes_id', $receipt_type);
			$paidType = ($paidType == '')? 'All Payments': $paidType;
			
				print '<div class="col-xs-12">
					<div class="box">
					 <div class="box-header">
							<h4 class="box-title">'.$get_receipt_query_rows.' Result(s) - '.$gradeGotten.' &raquo; '.$termGotten.' : '.$paidType.'</h4>                                    
						</div>
						<div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							   <thead>
									<tr>
										<th>Serial</th>
										<th>Fullname</th>';
										print ($school_grade == '%%')? '<th>Grade</th>': '';
										print ($school_term == '%%')? '<th>Term</th>': '';
										print '<th>Paid By</th>
										<th>Item (Description)</th>
										<th>Amnt. Paid</th>';
										print ($receipt_type != '1')? '<th>Qty</th>': '';
										print '<th>Date Paid</th>
										<th>Clear</th>
									</tr>
								</thead>
								<tbody>';
									while ($receiptObj = $db_receipt_query->fetch(PDO::FETCH_OBJ)) {
										/* getting all the full details used in the table */
										$lname = $kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $receiptObj->tution_paid_by_user_id);
										$fname = $kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $receiptObj->tution_paid_by_user_id);
										$mname = $kas_framework->getValue('studentbio_mname', 'studentbio', 'studentbio_id', $receiptObj->tution_paid_by_user_id);
										$picx = $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $receiptObj->tution_paid_by_user_id);
										$sex = $kas_framework->getValue('studentbio_gender', 'studentbio', 'studentbio_id', $receiptObj->tution_paid_by_user_id);
										$title = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $kas_framework->getValue('studentbio_title', 'studentbio', 'studentbio_id', $receiptObj->tution_paid_by_user_id));
										$fullname = $title .' '.$lname .' '.$fname.' '.$mname;
										$get_item_name = $kas_framework->getValue('school_item_name', 'school_item_price', 'id', $receiptObj->school_item_price_relid);
										$get_item_description = $kas_framework->getValue('school_item_desc', 'school_item_price', 'id', $receiptObj->school_item_price_relid);
										$get_item_name = ($get_item_name  == '')? 'School Fees': $get_item_name;
										$get_item_description = ($get_item_description  == '')? '-': $get_item_description;
										$tution_paid_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $receiptObj->tution_paid_grade);
										$tution_paid_term = $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $receiptObj->tution_paid_terms);
										$Quantity = ($receiptObj->qty == '0')? '-': $receiptObj->qty;
										
										/* cleared and uncleared */
										$uncleared = '<span id="del'.$receiptObj->tuition_history_id.'"><a href="#" id="'.$receiptObj->tuition_history_id.'" class="btn bg-blue cleared_button" title="Cleared this Payment?">
													<i class="fa fa-check"></i></a></span>';
										$cleared = '<a href="#" class="btn bg-green" disabled="disabled"><i class="fa fa-dot-circle-o"></i></a>';
										$check_cleared = ($receiptObj->cleared == '1')? $cleared : $uncleared;
										
										$fancyRetrieve = $kas_framework->imageDynamic($picx, $sex);	
										/* getting all the full details used in the table */
											$serial = $serial + 1;	
												print '<tr><td>'.$serial.'</td>';
												print '<td>'.$fullname.' <a href="'.$fancyRetrieve.'" class="fancybox fancybox.image no-print" width="50" title="Picture of '.$fullname.'"><i class="fa fa-picture-o"></i></a></td>';
												print ($school_grade == '%%')? '<td>'.$tution_paid_grade.'</td>': '';
												print ($school_term == '%%')? '<td>'.$tution_paid_term.'</td>': '';
												print '<td>'.$receiptObj->tution_paid_by_std_par.'</td>';
												print '<td>'.$get_item_name.' ('.$get_item_description.') </td>';
												print '<td><span style="text-decoration:line-through">N</span>'.number_format($receiptObj->tution_amount_paid).'</td>';
												print ($receipt_type != '1')?'<td>'.$Quantity.'</td>': '';
												print '<td>'.$receiptObj->tution_paid_date.'</td>';
												print '<td>'.$check_cleared.'</td></tr>';
											}
									$db_receipt_query = null;
								print '</tbody>
							</table>
						</div>
						<div class="box-footer">
							<button class="btn btn-default no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
						</div>
					</div>
				</div>';
		print '<span id="free_span"></span>';
		
?>
	<script type="text/javascript">
		
		$('.cleared_button').click(function(e){
			$(this).html('<?php print '<img src="'.$kas_framework->server_root_dir('/img/ajax-loader.gif').'" width="20" />'; ?>');
			passing_id = $(this).attr('id');
			byepass = 'oiyuv54ce5676908787';
			$.post('cleared_processing', {passing_id:passing_id, byepass:byepass}, function(data) {
					$('#free_span').html(data);
					
				});
			return false;
		})
	</script>