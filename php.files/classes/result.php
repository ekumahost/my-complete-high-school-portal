<?php 

class result extends kas_framework {
 /* senior secondary grading system */
	public function gradeSeniorSecondary($score) {
		if ($score > 0 and $score <= 39) {
			$grade = 'F<sub>9</sub>';
		} else if ($score >= 40 and $score <= 45) {
			$grade = 'E<sub>8</sub>';
		} else if ($score > 45 and $score <= 50) {
			$grade = 'D<sub>7</sub>';
		} else if ($score > 50 and $score <= 60) {
			$grade = 'C<sub>6</sub>';
		} else if ($score > 60 and $score <= 65) {
			$grade = 'C<sub>5</sub>';
		} else if ($score > 65 and $score <= 70) {
			$grade = 'C<sub>4</sub>';
		} else if ($score > 70 and $score <= 75) {
			$grade = 'B<sub>3</sub>';
		} else if ($score > 75 and $score <= 85) {
			$grade = 'B<sub>2</sub>';
		} else if ($score > 85 and $score <= 100) {
			$grade = 'A<sub>1</sub>';
		}
		return $grade;
	}
	
	public function commentSeniorSecondary($score) {
				if ($score > 0 and $score <= 39) {
			$grade = 'Poor';
		} else if ($score >= 40 and $score <= 45) {
			$grade = 'Fair';
		} else if ($score > 45 and $score <= 50) {
			$grade = 'B.Average';
		} else if ($score > 50 and $score <= 65) {
			$grade = 'Average';
		} else if ($score > 65 and $score <= 75) {
			$grade = 'Good';
		} else if ($score > 75 and $score <= 85) {
			$grade = 'V.Good';
		} else if ($score > 85 and $score <= 100) {
			$grade = 'Excellent';
		}
		return $grade;
	}
	/* senior secondary grading system ends */
	
	 /* junior secondary grading system */
	public function gradeJuniorSecondary($score) {
		if ($score >= 0 and $score <= 39) {
			$grade = 'F';
		} else if ($score >= 40 and $score <= 45) {
			$grade = 'E';
		} else if ($score > 45 and $score <= 49) {
			$grade = 'D';
		} else if ($score > 49 and $score <= 59) {
			$grade = 'C';
		} else if ($score > 59 and $score <= 69) {
			$grade = 'B3';
		} else if ($score > 69 and $score <= 79) {
			$grade = 'B';
		} else if ($score > 79 and $score <= 100) {
			$grade = 'A';
		}
		return $grade;
	}
	
	public function commentJuniorSecondary($score) {
		if ($score >= 0 and $score <= 39) {
			$grade = 'Fail';
		} else if ($score >= 40 and $score <= 45) {
			$grade = 'Poor';
		} else if ($score > 45 and $score <= 49) {
			$grade = 'Fair';
		} else if ($score > 49 and $score <= 59) {
			$grade = 'Average';
		} else if ($score > 59 and $score <= 69) {
			$grade = 'Good';
		} else if ($score > 69 and $score <= 79) {
			$grade = 'V.Good';
		} else if ($score > 79 and $score <= 100) {
			$grade = 'Excellent';
		}
		return $grade;
	}
	/* senior junior grading system ends */
	
	 /* primary school grading system */	
	public function commentPrimary($score) {
		if ($score > 0 and $score <= 39) {
			$grade = 'Poor';
		} else if ($score >= 40 and $score <= 45) {
			$grade = 'Fair';
		} else if ($score > 45 and $score <= 50) {
			$grade = 'B.Average';
		} else if ($score > 50 and $score <= 65) {
			$grade = 'Average';
		} else if ($score > 65 and $score <= 75) {
			$grade = 'Good';
		} else if ($score > 75 and $score <= 85) {
			$grade = 'V.Good';
		} else if ($score > 85 and $score <= 100) {
			$grade = 'Excellent';
		}
		return $grade;
	}
	/* primary school grading system ends */	 
	
	/* primary school grading system */	
	public function commentNursery($score) {
		if ($score > 0 and $score <= 39) {
			$grade = 'Poor';
		} else if ($score >= 40 and $score <= 45) {
			$grade = 'Fair';
		} else if ($score > 45 and $score <= 50) {
			$grade = 'B. Average';
		} else if ($score > 50 and $score <= 65) {
			$grade = 'Average';
		} else if ($score > 65 and $score <= 75) {
			$grade = 'Good';
		} else if ($score > 75 and $score <= 85) {
			$grade = 'V.Good';
		} else if ($score > 85 and $score <= 100) {
			$grade = 'Excellent';
		}
		return $grade;
	}
	/* primary school grading system ends */
	
	public function getSuffixOfResult($number) {
		$last_str_position = substr($number, -1);
			if ($last_str_position == '1') {
				$suffix_add = $number. '<sup>st</sup>';
 			} else if ($last_str_position == '2') {
				$suffix_add = $number. '<sup>nd</sup>';
			} else if ($last_str_position == '3') {
				$suffix_add = $number. '<sup>rd</sup>';
			} else {
				$suffix_add = $number. '<sup>th</sup>';
			}
			return $suffix_add;
	}
}

$result = new result();
?>