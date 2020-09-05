<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_email']){
	header("location:login.php");
}
?>
<br>
<div class="container">
			<?php 
			require("include/connect.php");
			$user_email = $_SESSION['user_email']; 
			$run=mysqli_query($conn, "select * from idrequest_tb where user_email='$user_email'");
	 
	 if(mysqli_num_rows($run)>0)
	 {
	 	?>
	 	<div class="col-sm-6 col-sm-offset-3 bg-success" style="padding: 20px;">
	 		<h5 class="text text-center text-danger">Your request have submitted! So Please wait...</h5>
	 	</div>	
	 	<?php

	 }
	 else{

	 	?>
	 	<?php
	 	
	 $select=mysqli_query($conn,"select * from users_tb where user_email='$user_email' ");
	if (mysqli_num_rows($select)>0){
		
		while($row = mysqli_fetch_array($select)) {
		// $_SESSION["login"] = $row['user_name'];
			 $user_name = $row['user_name'];
			 $user_email= $row['user_email'];
			 $user_state= $row['user_state'];
			 $user_id_generate=$row['user_id_generate'];
			 $image=$row['image'];
		}

	}
	if($user_id_generate!="")
	{
	?>
	<div class="col-sm-6 col-sm-offset-3 bg-success alert" style="padding: 20px;">
		<h4 class="text-center">Your ID is "<span class="text text-danger"><?php echo $user_id_generate;?> </span>"</h4>
		<p class="text-center"><b>Note:</b>Use this is with your login password to caste your vote</p>
	</div>	
	<?php	
	}
	else{
	?>
	<br>
	<div class="col-sm-6 col-sm-offset-3 bg-success" style="padding: 20px;">
		<form method="post">
			<div class="form-group">
				<label for="USername">User name:</label>
				<input type="text" name="user_name" class="form-control text text-center" placeholder="Full name" required value="<?php echo $user_name;?>" readonly>
			</div>
			<div class="form-group">
				<label for="Email">Email:</label>
				<input type="email" name="user_email" class="form-control text text-center" placeholder="Email" required value="<?php echo $user_email;?>" readonly>
			</div>
			<div class="form-group">
				<label for="USername">State:</label>
				<input type="text" name="user_state" class="form-control text text-center" placeholder="State" required value="<?php echo $user_state;?>" readonly>
			</div>
			<div class="form-group ">
				<button type="submit" class="btn btn-primary btn-block " name="idrequest">ID Request</button>
			</div>
		</form>

		</div>
	</div>
<?php	
		}
	}
?>

<?php
if(isset($_POST['idrequest'])){
	 $user_email=$_POST['user_email'];
	 $user_state=$_POST['user_state'];

	 require("include/connect.php");
	 $runn=mysqli_query($conn,"select * from user_images where user_email='$user_email'");
			if (mysqli_num_rows($runn)>0){
		
		while($row = mysqli_fetch_array($runn)) {
		// $_SESSION["login"] = $row['user_name'];
          $profile =$row['image'];
				}
			}
	 
	 $insert="insert into idrequest_tb(image,user_email,user_state) values ('$profile','$user_email','$user_state')";
	 $runn=mysqli_query($conn, $insert);
		if($runn){
			$created= "<h4 class='text text-center text-success'>Saved Successfully</h4>";
			echo "<script>Submitted Successfully</script>";
			header("location:idgenerate.php");
		  }else{
		      echo "Error: " . $insert . "    " . mysqli_error($conn);
		}
}

?>
</body>
</html>