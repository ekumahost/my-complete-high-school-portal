
<?php
if(!isset($_SESSION['UserID'])) {
	echo "Ahh Admin session expired, please login again to continue";	exit;
}
?>
<h2>Pins Generator  </h2> 

<!-- OUR FORM -->
	<form action="" method="POST">
		
		<!-- NAME -->
		<div id="q-group" class="form-group" style="padding:10px 30px">
			<table  border="0" class="table table-bordered">
              <tr>
                <td>Quantity</td>
                <td><input type="number" class="" name="q" placeholder="eg 200">
                  <i><font color="#FF0000">Max: 1,000 Pins</font> </i></td>
              </tr>
              <tr>
                <td>Description</td>
                <td><input type="text" class="form-control" name="d" placeholder="eg.School Fee"></td>
              </tr>
              <tr>
                <td>Price(Naira)</td>
                <td><input type="number" class="form-control" name="a" placeholder="eg:50000"></td>
              </tr>
              <tr>
                <td>Type</td>
                <td><font color="#0033CC"><b>
                  <?php  
					$tools=$_GET['myaction'];
								if ($tools=="wallet") {echo"Web Wallet";}
								if ($tools=="registration") {echo"Registration/Admission";}
					?> 
                </b></font></td>
              </tr>
				 <?php if ($tools=="registration") {?> 
			  <tr>
                <td>Form</td>
                <td>
				<select name="form">
				<option value="1">New Students(Admission)</option>
				<option value="2">Old Students(Registration)</option>
                 </select>
			
				</td>
              </tr>
			   <?php }?>
			   <tr>
                <td>Action</td>
                <td>
				
			<button type="submit" class="btn btn-success">Generate <span class="fa fa-arrow-right"></span></button>
				</td>
              </tr>
		 </table>
			
			<!-- errors will go here -->
	  </div>
		<!-- NAME -->
		<!-- NAME -->

		<!-- NAME -->
	 
		<input type="hidden" name="type" value="<?php echo $tools;?>"> </input>


	</form>

