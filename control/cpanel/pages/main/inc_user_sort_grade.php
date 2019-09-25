 <hr>
 <div style="margin-left:30px">
	  <?php
		
	  	  $queryj = "SELECT * from grades";
		  $dbh_queryj = $dbh->prepare($queryj); $dbh_queryj->execute();
		//$mygrade = mysql_num_rows($queryj);
	  
		while ($get_grades = $dbh_queryj->fetch(PDO::FETCH_OBJ)) {
			//is decoded gid ==get_grades->grades_id then change theme
			if($get_grades->grades_id==$gid){
				$theme='primary';
			} else {$theme='default'; }
			// do we have grades set add to url
			if(isset($_GET['graduates'])){
				$urlgd = '&graduates=true';	
			} else {$urlgd = '#';	}
			
			// do we have others set to add to url
			if(isset($_GET['Others'])){
				$urlo = '&Others=set';	
			} else{$urlo = '';	}
			
			print '<a class="btn btn-sm btn-'.$theme.'" style="margin:4px" href="main?page=users&smoosh=1&gid='.EncoderToken($get_grades->grades_id).$urlo.$urlgd.'">'.$get_grades->grades_desc.'</a>';
		}	  
		$dbh_queryj = null;
	  ?>
</div>