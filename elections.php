<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_email']){
	header("location:login.php");
}

?>
<br>
<div class="container">
	<div class="col-sm-6 col-sm-offset-3">
		<form method="post">
			
			<div class="form-group">
				<label for="">Your ID</label>
				<input type="text" name="user_id" class="form-control" placeholder="Enter Your Id" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="text" name="user_password" class="form-control" placeholder="Password" autocomplete="off" required>
			</div>
			<div class="form-group">
				
				<button type="submit" name="login" class="btn btn-success btn-block"> Enter Your Id </button>
			</div>
		</form>
	</div>
</div>
<?php
require("include/connect.php");
	if(isset($_POST['login'])){
		$user_id=$_POST['user_id'];
		$user_password = $_POST['user_password'];
		
		$select=mysqli_query($conn,"select*from users_tb where user_password='$user_password' and user_id_generate='$user_id'");
		if (mysqli_num_rows($select)>0){
			while($row = mysqli_fetch_array($select)){
				$_SESSION['user_id_generate']=$user_id_generate=$row['user_id_generate'];
				header('location:vote.php');
			}	
		}else{
			echo "<h4 class='text text-center text-danger alert'> Your Id or Password is Incorrect! </h4>";
		}
}
?>