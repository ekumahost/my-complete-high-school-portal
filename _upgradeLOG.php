<?php
	require ('pdoDB.php');
	$querySQL = ;
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$paramObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;

	//if (($mcx = mc_get('count-bday')) !== false)
	//	return $mcx;

	//mc_set('count-bday', $total);

	/*
	$no_of_display = 50;
	$page = @$_GET['stream']; $page = ($page == '')? '0' : $page;												
	if ($page < 0) { exit; } 
	*/

	$parameter = "SELECT * FROM studentbio WHERE studentbio_school = '".$staff_school."' AND admit = '1'";
	$db_parameter = $dbh->prepare($parameter);
	$db_parameter->execute();
	//$countAll_Returned = $db_parameter->rowCount();
	$db_handle = null;
	/*
	$total_page = ceil($countAll_Returned / $no_of_display);
	$total_page = ($total_page === 0)? '1': $total_page; $current_page = $page + 1; 
	$next_determiner = ($page + 1) * $no_of_display; $startLimit = $page * $no_of_display;

	$parameter .= " LIMIT ".$startLimit.", ".$no_of_display."";
	$db_parameterX = $dbh->prepare($parameter);
	$db_parameterX->execute();

	// pass "db_parameterX" to the $viewStdList->viewStdList

	*/
	$viewStdList->viewStdList($db_parameter);	

?>


<div class="row">
	<div class="col-md-4">
		<p class="category-pagination-sign"><?php echo $countAll_Returned ?> result found.<br />
		Showing Page <?php echo (isset($_GET['stream']))? $_GET['stream']+1: 1; ?> of <?php echo $total_page ?>. <br />
		Page is Grouped in <?php echo $no_of_display ?></p>
	</div>
	<div class="col-md-8">
		<nav>
			<ul class="pagination category-pagination pull-right">
					<?php
						$buildSort = false;
						if (isset($_GET['search'])) { $buildSort = true; }											
						if ($page > 0) {
							$previous_stream_no = $page - 1;
								if ($buildSort == true) {
									echo '<li class="last"><a href="'.$ingnix_framework->urlBuildQuery('KDG/members', 'stream', $previous_stream_no).'"><i class="fa fa-long-arrow-left"></i></a> </li>';
								} else {
									echo '<li class="last"><a href="members?stream='.$previous_stream_no.'"><i class="fa fa-long-arrow-left"></i></a> </li>';
								}
						}
							/* getting the page loop counter: 28 is the cut limit for us */
						if ($total_page > 1 and $total_page < 28) {
							for ($controller = 0; $controller < $total_page; $controller++) {
							$controller_display = $controller + 1;
								if ($buildSort == true) {
									echo '<li class="'.$ingnix_framework->getSelected('stream', $controller, 'active').'">
											<a href="'.$ingnix_framework->urlBuildQuery('KDG/members', 'stream', $controller).'">'.$controller_display.'</a> </li>';
								} else {
									echo '<li class="'.$ingnix_framework->getSelected('stream', $controller, 'active').'">
											<a href="members?stream='.$controller.'">'.$controller_display.'</a> </li>';
								}
							}
						} else if ($total_page > 28) {
							/* use the total page to get the pages in a select tag */
							echo '<select class="form-control" style="padding:8px; margin-left:4px" onchange="location=this.value">
										<option value="">-- Select Page --</option>';
								for ($i=0; $i<$total_page; $i++) {
									$page_i = $i + 1;
									if ($buildSort == true) {
										echo '<option '.$ingnix_framework->getSelected('stream', $i, 'selected').' value="'.$ingnix_framework->urlBuildQuery('KDG/members', 'stream', $i).'">Stream '.$page_i.'</option>';
									} else {
										echo '<option '.$ingnix_framework->getSelected('stream', $i, 'selected').' value="members?stream='.$i.'">Stream '.$page_i.'</option>';
									}
								}
							echo '</select>';
						}
						
					if ($next_determiner < $countAll_Returned) {
						$next_stream_no = $page + 1;
						if ($buildSort == true) {
							echo '<li class="last"><a href="'.$ingnix_framework->urlBuildQuery('KDG/members', 'stream', $next_stream_no).'"><i class="fa fa-long-arrow-right"></i></a> </li>';
						} else {
							echo '<li class="last"><a href="members?stream='.$next_stream_no.'"><i class="fa fa-long-arrow-right"></i></a> </li>';
						}
					}
				?>                                    
			</ul>
		</nav>
	</div>
</div>


Discipline for Staff, 
Report for staff attitude by students, 
promotion variables for staff such as attendance and performance etc., 
Health: Genotype and Blood group etc and prone diseases and drug alergies, 
possible exceptional good behavoiur column for student
Fingerprint profile for students, 
Payment installment of school fees with mailings