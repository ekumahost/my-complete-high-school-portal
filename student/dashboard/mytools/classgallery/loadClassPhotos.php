<?php 
require ( '../../../../php.files/classes/pdoDB.php');
require ( '../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/student_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}
$startLimit = $load * 20;

	$galleryPicx = "SELECT * FROM student_grade_year AS sgy, studentbio AS sb 
		WHERE sgy.student_grade_year_grade = '".$user_student_grade_year_grade_id."' 
		AND sgy.student_grade_year_year = '".$current_year_id."'
		AND sb.studentbio_pictures != 'empty' AND sb.studentbio_fname != '' AND sb.studentbio_lname != ''
		AND sb.studentbio_id = sgy.student_grade_year_student LIMIT ".$startLimit.", 20";
		
		$db_galleryPicx = $dbh->prepare($galleryPicx);
		$db_galleryPicx->execute();		
		
			while ($showPicx = $db_galleryPicx->fetch(PDO::FETCH_OBJ)) {
				print '<img src="'.$kas_framework->server_root_dir('pictures/').$showPicx->studentbio_pictures.'" 
					alt="'.$showPicx->studentbio_fname .' '. $showPicx->studentbio_lname.'" 
					title="'.$showPicx->studentbio_lname .' '. $showPicx->studentbio_fname.'"
					href="'.$kas_framework->server_root_dir('pictures/').$showPicx->studentbio_pictures.'" data-fancybox-group="gallery" style="cursor:pointer" class="fancybox fancybox.image margin" />';
				}
		$db_galleryPicx = null;
?>