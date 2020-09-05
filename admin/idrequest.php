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
	<h2 class="text text-center text-info">All Requested Data</h2>
	<div class="container col-sm-6 col-sm-offset-3">
		<table class="table table-responsive table-hover">
			<tr>
				<td>#</td>
				<td>Profile</td>
				<td>User Name</td>
				<td>State</td>
				<td>Action</td>
			</tr>
			<?php  
			
			$conn = new mysqli("localhost","root","","votingsystem_db");
			$retrieve=mysqli_query($conn,"select *from user_images");
			if (mysqli_num_rows($retrieve)>0){
			    
				while($rows = mysqli_fetch_array($retrieve)){
				$user_email=$rows['user_email'];
				$profile = $rows['image'];}
			}
			$update=mysqli_query($conn,"update idrequest_tb set image='$profile' where user_email='$user_email'");
			
			$select = mysqli_query($conn,"select * from idrequest_tb");
			// $select1 = mysqli_query($conn,"select * from users_tb where user_email = '$user_email'");

			if (mysqli_num_rows($select)>0){
			    $total = 0;
				while($row = mysqli_fetch_array($select)){
				$total=$total+1;
				$id = $row['id'];
				$profile = $row['image'];
			?>
			<tr class="text text-primary" style="font-size: 20px;">
				<td><?php echo $total; ?></td>
				<td><img src="user_image/<?php echo $profile; ?>" class="img img-responsive " width="70" height="70" style="border-radius: 50%; margin:0 auto;"alt="<?php echo $profile; ?>"></td>
				<td><?php echo $row['user_email']; ?></td>
				<td><?php echo $row['user_state']; ?></td>
				<td><a href="updateid.php?id=<?php echo $id; ?>">Update</a></td>
			</tr>
			<?php	
			}
		} else {
			?>
				<tr>
					<td colspan="4">No Records</td>
				</tr>
			<?php
		}
		?>
		</table>
	</div>

</body>
</html>