<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['admin_email']){
	header("location:admin_login.php");
}
?><!DOCTYPE html>
<html>
<head>
	<title>Update Id Request</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div class="container">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<?php  

			$conn = new mysqli("localhost","root","","votingsystem_db");
			
			 $id = $_GET['id'];
			 $select = mysqli_query($conn,"select * from idrequest_tb where id='$id'");

			if (mysqli_num_rows($select)>0){
				while($row = mysqli_fetch_array($select)){
						$user_email= $row['user_email'];
						$user_state= $row['user_state'];
						
						}
						switch ($user_state) {
							case 'Daman&Diu':
								$prefix="dd";
								$rand = rand(9999999,1234567);
								$postfix = "xyz";
								$id_generate=$prefix.$rand.$postfix;
								break;
							case 'Gujarat':
								$prefix="guj";
								$rand = rand(9999999,1234567);
								$postfix = "uvw";
								$id_generate=$prefix.$rand.$postfix;
								break;
							case 'Maharashtra':
								$prefix="mh";
								$rand = rand(9999999,1234567);
								$postfix = "mno";
								$id_generate=$prefix.$rand.$postfix;
								break;
							case 'Punjab':
								$prefix="pun";
								$rand = rand(9999999,1234567);
								$postfix = "pqr";
								$id_generate=$prefix.$rand.$postfix;
								break;
							case 'Rajasthan':
								$prefix="raj";
								$rand = rand(9999999,1234567);
								$postfix = "abc";
								$id_generate=$prefix.$rand.$postfix;
								break;		
							default:
								# code...
								break;
						}
					
					?>
					<br>
					<form method="post">
					<div class="form-group">
						<label for="Email">Email:</label>
						<input type="email" name="user_email" class="form-control text text-center" placeholder="Email" required value="<?php echo $user_email?>" readonly>
					</div>
					<div class="form-group">
						<label for="state">State:</label>
						<input type="text" name="user_state" class="form-control text text-center" placeholder="State" required value="<?php echo $user_state?>" readonly>
					</div>
					<div class="form-group">
						<label for="id_generate">User ID Generated by System</label>
						<input type="text" name="user_id_generate" class="form-control text text-center" placeholder="ID" required value="<?php echo strtoupper($id_generate);?>" readonly>
					</div>
			<div class="form-group ">
				<input  type="submit" class="form-control btn btn-success" value="Update User ID" name="update">
			</div>
		</form>
			<?php		
			 
		}
		else{
			echo "Record Not found";
		}
			?>
		
		</div>
		<div class="col-sm-3">
			
		</div>
	</div>
</body>
</html>	
<?php
if(isset($_POST['update'])){
	$user_email=$_POST['user_email'];
    $user_id_generate =$_POST['user_id_generate'];
	
	$update = mysqli_query($conn,"update users_tb set user_id_generate ='$user_id_generate' where user_email = '$user_email'");
	if ($update) {
		$delete = mysqli_query($conn,"delete from idrequest_tb where user_email = '$user_email'");
		if($delete){
			echo "<script>alert('Successfully Updated and Deleted') </script>";
			echo "<script>window.location.href='idrequest.php' </script>";
		}
	}else{
		echo "<script>alert('Something Went Wrong') </script>";
	}
}

?>