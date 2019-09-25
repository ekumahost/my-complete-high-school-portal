<?php
session_start();
if(!isset($_SESSION['UserID']) || @$_SESSION['UserType'] != "A")
  {
echo "Admin session expired, please login again to continue";	exit;
}
?>
<!doctype html>
<html>
<head>
	<title>Send SMS settings</title>
	<link rel="stylesheet" href="../bootstrap.min.css"> <!-- load bootstrap via CDN -->

	<script src="jquery.min.js"></script> <!-- load jquery via CDN -->
	 <!--<script src="pinmagic.js"></script> load our javascript file -->
</head>
<body>
<div class="col-sm-6 col-sm-offset-3">

	<a href="sendsms_bulk.php"> &lt;&lt;Go back</a>&nbsp;
	<h4>SCHOOL SMS SENDER  </h4> <font color="red"><i>Sending over 1m at a time may not make sense</i></font>

	<!-- OUR FORM -->
	<form action="" method="POST">
		
		<!-- NAME -->
		<div id="q-group" class="form-group">
			<label for="q">MY SMS Server IP </label>
			: <i>this thing is usually 5 digits. </i>
			<input type="number" class="form-control" name="q" placeholder="how many pins to generate, eg 1000">
			<!-- errors will go here -->
		</div>
		<!-- NAME -->
<div id="d-group" class="form-group">
			<label for="d">My API DESCRIPTION </label>
			<input type="text" class="form-control" name="d" placeholder="who will use this pin? eg its for SS1 school fee">
			<!-- errors will go here -->
	  </div>
		<div id="div" class="form-group">
          <label for="d">SMS SERVER USERNAME </label>
          <input type="text" class="form-control" name="d2" placeholder="who will use this pin? eg its for SS1 school fee">
          <!-- errors will go here -->
        </div>
		<div id="div2" class="form-group">
          <label for="d">SMS SERVER PASSWORD </label>
          <input type="text" class="form-control" name="d3" placeholder="who will use this pin? eg its for SS1 school fee">
          <!-- errors will go here -->
        </div>
		<!-- NAME -->
		<div id="a-group" class="form-group">
			<label for="a"></label>
			<input type="text" class="form-control" name="a" placeholder="eg:N5,000.00">
			<!-- errors will go here -->
		</div>
		<button type="submit" class="btn btn-success">Save Configuration <span class="fa fa-arrow-right"></span></button>

	</form>

</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>
