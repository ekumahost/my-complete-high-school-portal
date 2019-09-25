<?php 

class student extends kas_framework {
	function __construct() {
		//log the student out if the student can log in has been set to 0
		global $dbh;
		$querySQL = "SELECT * FROM tbl_app_config WHERE module = 'student_login' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;		
		
		if ($paramGetFields->status == '0') {
			unset($_SESSION['tapp_std_username']); //destroy the users session
			unset($_SESSION['BasicPlanStudent']); // destroys the basic users account too
			print '<script> self.location = "'.$this->server_root_dir('').'" </script>';
		}
	}
	
	public function getAllUniquesValsWithUsername($table, $unique, $value){
		global $dbh;
		//if (($mcy = mc_get('uniqueUsername_'.$table.'_'.$value)) !== false)
		//	return $mcy;
		$querySQL = "SELECT COUNT(*) AS cnt FROM `$table` WHERE $unique = '".$value."'";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
		$count = $paramGetFields->cnt;
		//mc_set('uniqueUsername_'.$table.'_'.$value, $total);
		return $count;
	}
	
	public function countallStudentsinMyGallery($user_student_grade_year_grade_id, $current_year_id){
		//if (($mcm = mc_get('stdInGallery')) !== false)
		//	return $mcm;
		global $dbh;
			$querySQL = "SELECT COUNT(*) AS cnt FROM student_grade_year AS sgy, studentbio AS sb 
			WHERE sgy.student_grade_year_grade = '".$user_student_grade_year_grade_id."' 
			AND sgy.student_grade_year_year = '".$current_year_id."'
			AND sb.studentbio_pictures != ''
			AND sb.studentbio_fname != ''
			AND sb.studentbio_lname != ''
			AND sb.studentbio_id = sgy.student_grade_year_student";
			
			$db_handle = $dbh->prepare($querySQL);
			$db_handle->execute();
			$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
			$total_gallery_shit = $paramGetFields->cnt;
			$db_handle = null;	
			//mc_set('stdInGallery', $total);
			return $total_gallery_shit;
	}
	
	public function BasicPlanStudent() {
		return isset($_SESSION['BasicPlanStudent'])?true: false;
	}
	
	public function display_accessLevel() {
			print ($this->BasicPlanStudent() === true)?'<small> ...Classic Plan </small>': '<small> ...Premium Plan </small>';
		}
		
	public function showAvailableBalance($bal, $date) {
		return '<div class="row"><div class="col-md-12">
                     <div class="box box-primary"><div class="box-header">
						<i class="fa fa-credit-card text-ult_custom2"></i>
						<h3 class="box-title">&nbsp;&nbsp; Account Balance: 
						<span style="text-decoration:line-through">N</span><span id="user_classic_balance">'. number_format($bal) .'</span></h3>
						<span style="float:right; padding:10px 10px 0 0">Last Used:'. $date .'</span>
					</div></div></div></div>';
	}
	
	public function checkBasicPlanStudent() {
		if ($this->BasicPlanStudent() === true) { 
				exit('<center>
				<img src="'.$this->server_root_dir('img/restricted.png').'" width="60%"/>
				<img src="'.$this->server_root_dir('img/sorry.png').'" width="50%"/>
				'.$this->showDangerCallout('Your Current Package do not have the Priviledge to View this Page. Looks like you are on Kastech Classic Plan. This Page is for Premium Package Users Only').'</center>');
			}
	}
	
}

$student = new student();
?>