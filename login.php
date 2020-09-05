<?php
session_start();
include("include/header.php");
?>
<?php
require("include/connect.php");
if(isset($_POST['login'])) {
	 $user_email = $_POST['email'];
	 $user_password = $_POST['password'];
	$select=mysqli_query($conn,"select * from users_tb where user_email='$user_email' AND user_password='$user_password' ");
	if (mysqli_num_rows($select)>0){
		$row = mysqli_fetch_array($select);
		if(is_array($row)) {
		// $_SESSION["login"] = $row['user_name'];
			$_SESSION['user_name']=$user_name = $row['user_name'];
			$_SESSION['user_email']=$user_email= $row['user_email'];
			// $success="<h1 align=center>Hye $user_name! you are sucessfully login!!!</h1>";
			header("Location:welcome.php");
		}

	}else{
		$msg="found";
	}
}
?>
<body>
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2 alert alert-success ">
			<form method="post">
				<h4 class="text text-center alert bg-primary" style="color: white">User Login Area</h4>
				<?php if (isset($success))
						{
							echo $success;
							exit;
						}
				?>
			<?php
		  	if(isset($msg))
		  	{
		  		echo '<p class="text text-center text-danger">Invalid user id or password<br><a href="index.php">Please try again</p>';
		  	}
		  	?>
					<div class="form-group">
						<label for="Email">Email:</label>
						<input type="email" name="email" class="form-control text text-center" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="Password">Password:</label>
						<input type="password" name="password" class="form-control text text-center" placeholder="Password">
					</div>
					<div class="form-group ">
						<button type="submit" class="btn btn-success btn-block" name="login">Submit</button>
					</div>
					<p>New User? <a href="reg.php">Register Here</a></p>
			</form>
		</div>
		
	</div>
<?php
include("include/footer.php");
?>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>