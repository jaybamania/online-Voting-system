<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['admin_email']){
	header("location:admin_login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Voting System</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<h2 class="text text-center text-info">Add New Candidates</h2>
	<div class="container col-sm-6 col-sm-offset-3">
		<form method="get" action="add_detail_candidate.php">
			<div class="form-group">
				<label>Add Candidate Name:</label>
				<select name="election_name" class="form-control">
			<option value="">Select Election</option>
			<?php
			$conn = new mysqli("localhost","root","","votingsystem_db");
			$select=mysqli_query($conn,"select * from elections_tbl ");
			if (mysqli_num_rows($select)>0){ 
			
			 while($row = mysqli_fetch_array($select)){
			?>
			<option value="<?php echo $row['election_name'];?>"><?php echo $row['election_name'];?></option>
			<?php }
				}
			?>
			</select>
			<br>
		   </div>
		   <div class="form-group">
		   	<label>No of Candidates:</label>
		   	<input type="text" name="total_candidate" class="form-control" >
		   </div>
			<input type="submit" name="add_election" class="btn btn-success">
		</form>
	</div>

</body>
</html>
