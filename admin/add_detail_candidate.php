<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['admin_email']){
	header("location:admin_login.php");
}
?><!DOCTYPE html>
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
		<form method="post" enctype="multipart/form-data">
		<?php

		$conn = new mysqli("localhost","root","","votingsystem_db");
	 	$election_name=$_GET['election_name'];
		$total_candidate=$_GET['total_candidate'];
		$candidate_profile="male.jpg";
		?>
		<label>Election Name:</label>
		<input type="text" name="election_name" class="form-control" value="<?php  echo $election_name; ?>" readonly>
		<?php
		for ($i=1; $i<=$total_candidate ; $i++) { 
			?><br>
			<label class="text text-info">Candidate Name <?php echo $i; ?></label>
			<!-- <img src="user_image/<?php echo $candidate_profile.$i;?>" class="img img-responsive " width="150" height="150" style="border-radius: 50%; margin:0 auto;"alt="<?php echo $candidate_profile; ?>"> -->
			<div class="form-group" style="padding: 5px;">
				<!-- <input type="file" name="candidate_profile<?php echo $i; ?>"  class="form-control text text-center"/> -->
				<input type="text" name="candidate_name<?php echo $i; ?>" placeholder="Candidate Name" class="form-control">
			</div>
			<?php
		}
		?>
		<input type="submit" class="btn btn-success" name="add_detail_candidate">
		</form>
	</div>

</body>
</html>

<?php
if(isset($_POST['add_detail_candidate'])){
	$total_candidate=$_GET['total_candidate'];
	$election_name=$_POST['election_name'];

	// $target_dir = 'admin/user_image/';

	// for ($i=1; $i<=$total_candidate ; $i++) { 
	// 	$target_file = $target_dir.basename($_FILES["candidate_profile".$i]["name"][$i]);
	// 	 $candidate_profile =$_FILES['candidate_profile'.$i]['tmp_name'][$i];
	// 	 move_uploaded_file($_FILES['candidate_profile'.$i]['tmp_name'][$i],$target_dir.$candidate_profile);
	// }
	for($i=1; $i<=$total_candidate;$i++){
	$candidate_name[]=$_POST['candidate_name'.$i];
	}
	for ($i=0; $i<$total_candidate; $i++) { 
		$runn=mysqli_query($conn,"insert into candidates_tbl(candidate_name,candidate_profile,election_name)values('$candidate_name[$i]','$candidate_profile','$election_name')");
	}
	
	if($runn){
		$added= "<h4 class='text text-center text-success'>Candidate Added Successfully</h4>";
		echo "$added";

	}else{
		echo "Error: " . $runn . "    " . mysqli_error($conn);
	}
}
?>
