<?php
class tableFundamental extends kas_framework{ 
	function getWhilePost($parameter) {
		while ($viewMyStds = $parameter->fetch(PDO::FETCH_OBJ)) {
			$stdImage = $viewMyStds->studentbio_pictures;
			$stdSex = $viewMyStds->studentbio_gender;
			$imgUrl = $this->imageDynamic($stdImage, $stdSex, $this->server_root_dir('pictures/'));
				print '<tr>
						<td>'.$viewMyStds->studentbio_internalid.'</td>
						<td>'.$this->getValue('title_desc', 'tbl_titles', 'title_id', $viewMyStds->studentbio_title).' 
						'.$viewMyStds->studentbio_lname.' '.$viewMyStds->studentbio_fname.'<br />
						DOB: '.$viewMyStds->studentbio_dob.'</td>
						<td>Sex: '.$stdSex.'<br />
						Ethnicity: '.$this->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $viewMyStds->studentbio_ethnicity).'<br />
						Resid. State: '.$this->getValue('state_name', 'tbl_states', 'state_css', $viewMyStds->std_bio_resident_state).'</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options <i class="fa fa-angle-down"></i></button>
								<ul class="dropdown-menu" role="menu">
									<li><a target="_blank" href="../handleDiscipline/updateStudent?click='.$this->generateRandomString(20).'&&stdid='.$this->saltifyID($viewMyStds->studentbio_id).'&&ref='.$this->generateRandomString(20).'"><i class="fa fa-meh-o text-green"></i> Discipline</a></li>
									<li><a target="_blank" href="../handleAttendance/updateStudent?click='.$this->generateRandomString(20).'&&stdid='.$this->saltifyID($viewMyStds->studentbio_id).'&&ref='.$this->generateRandomString(20).'"><i class="fa fa-list-alt text-yellow"></i> Attendance</a></li>
									<li><a target="_blank" href="../handleHealth/updateStudent?click='.$this->generateRandomString(20).'&&stdid='.$this->saltifyID($viewMyStds->studentbio_id).'&&ref='.$this->generateRandomString(20).'"><i class="fa fa-plus-square text-maroon"></i> Health</a></li>
								</ul>
							</div>
						</td>
				<td><img src="'.$imgUrl.'" height="60px" href="'.$imgUrl.'" style="cursor:pointer" class="fancybox fancybox.image" /></td>
					</tr>'; 
		}
	}
}
$tableFundamental = new tableFundamental;
?>