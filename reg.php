<?php
include("include/header.php");
?>
<?php
require("include/connect.php");
if(isset($_POST['register'])) {
	 $user_name = $_POST['fullname'];
	 $user_email = $_POST['email'];
	 $user_gender = $_POST['gender'];
	 $user_state = $_POST['state'];
	 $user_password = $_POST['password'];
	  
  $image ="male.jpg";
		
	$duplicate=mysqli_query($conn,"select * from users_tb where user_email='$user_email' ");
	if (mysqli_num_rows($duplicate)>0)
	{
	    $emailError = "<p class='text text-center text-danger'> This email is already registered</p>";
	}	
	// $select = "select * into users_tb where user_email = '$user_email'" ;
	// $exe = mysqli_query($conn,$select);
	// $rows = mysqli_num_rows($exe);
	// echo $rows;
	// if(($rows)>0){
	// 	echo "This email is already registered";
	// }
	else{
	$insert="insert into `users_tb`(`user_name`, `user_email`, `user_gender`, `user_state`, `user_password`,`image`) values('$user_name','$user_email','$user_gender','$user_state','$user_password','$image');";
	$runn=mysqli_query($conn, $insert);
	if($runn){
		$created= "<h4 class='text text-center text-success'>Account Created Successfully</h4>";

	}else{
		echo "Error: " . $insert . "    " . mysqli_error($conn);
	}
	$insert1="insert into user_images(user_name,image,user_email) values ('$user_name','$image','$user_email')";
	$run=mysqli_query($conn,$insert1);
	}

}

?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 alert alert-success ">
				<form method="post" id="reg">
					<?php  $reg="Registeration";?>
					<h4 class="text text-center alert bg-primary" style="color: white"><?php if(isset($created)){echo "$reg Completed!";} else{ echo $reg;} ?></h4>
					<?php 
					if(isset($emailError)){ echo $emailError; }
					if(isset($created)){ echo $created; echo '<p class="text text-center text-primary"><a href="welcome.php">Click here to Start!</p>'; exit; }
					?>
					<div class="form-group">
						<p id="message"></p>
						<label for="USername">Full name:</label>
						<input type="text" name="fullname" id="fullname" class="form-control text text-center" placeholder="Full name" required>
					</div>
					<div class="form-group">
						<label for="Email">Email:</label>
						<input type="email" name="email" id="" class="form-control text text-center" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="Gender">Gender : </label>
						<select name="gender" class="form-control text text-center" required>
							<option value="">Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="form-group">
						<label for="State">State : </label>
						<select name="state" placeholder="Select" class="form-control text text-center" required>
							<option value="">Select</option>
							<option value="Daman&Diu">Daman & Diu</option>
							<option value="Gujarat">Gujarat</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="Password">Password:</label>
						<input type="password" name="password" class="form-control text text-center" placeholder="Password" required>
					</div>
					<div class="form-group ">
						<button type="submit" id="submit" class="btn btn-success btn-block" name="register">Submit</button>
					</div>
				</form>
			</div>	
		</div>

	</div>
	<?php
include("include/footer.php");
?>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
<!-- <script>
	 $(document).ready(function(){
  
  $(document).on('submit', '#reg', function(event){
   event.preventDefault();

   if($('#fullname').val() == '')
   {
    $('#message').html('<div class="alert alert-danger">Please Enter Full</div>');
    return false;
   }
   else
   {
    $('#submit').attr('disabled', 'disabled');
    $.ajax({
     url:"add_task.php",
     method:"POST",
     data:$(this).serialize(),
     success:function(data)
     {

     }
    })
   }
  });
</script> -->