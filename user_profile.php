<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_email']){
	header('location:login.php');
}

?>
<style type="text/css">
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}
.title {
  color: grey;
  font-size: 18px;
}

#button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
  height: 40px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

#button:hover, a:hover {
  opacity: 0.7;
}
</style>
<?php

$msg="";
if(isset($_POST['but_upload'])){
  $user_email=$_SESSION['user_email'];
  
  $target_dir = 'admin/user_image/';
  $target_file = $target_dir . basename($_FILES["user_image"]["name"]);

  require("include/connect.php");

  $image =$_FILES['user_image']['name'];
  if( move_uploaded_file($_FILES['user_image']['tmp_name'],$target_dir.$image)){
  $runn=mysqli_query($conn,"select * from users_tb where user_email='$user_email'");
  if (mysqli_num_rows($runn)>0){
  	$select="update user_images set image='$image' where user_email='$user_email'";
  	$run = mysqli_query($conn,$select);
  	if($run){ $retrieve= "Updated Successfully";}
  		else{   echo "Not Updated";}
  }
	//fetching....  
  	if($retrieve)	{
  		$runn=mysqli_query($conn,"select * from user_images where user_email='$user_email'");
  		if (mysqli_num_rows($runn)>0){
		
		while($row = mysqli_fetch_array($runn)) {
		// $_SESSION["login"] = $row['user_name'];
			 $image = $done=$row['image'];
			 $user_email= $row['user_email'];
			 $user_name = $row['user_name']; ?>
			 

			 <?php
			 
		}

	}
  	}else{
  		echo "Retrieve fail";
  	}
  // Check extension
//   if( move_uploaded_file($_FILES['user_image']['tmp_name'],$target_dir.$image)){
 
//     $msg="Image Inserted Successfully";
//     echo $msg;
//     $selecet="select * from user_images where user_email='$user_email'";
// }else{
// 	$msg="There was a problem uploading image";
// 	echo $msg;
// }
 
}else{ echo "You may have folder problem";}
}
?>

<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2" style="margin-top: 10px;">
			<?php if(isset($done)){$profile =$done;
			}else{ 
				$user_email=$_SESSION['user_email'];
				$profile="male.jpg" ;
				require("include/connect.php");
				$runn=mysqli_query($conn,"select * from user_images where user_email='$user_email'");
			if (mysqli_num_rows($runn)>0){
		
		while($row = mysqli_fetch_array($runn)) {
		// $_SESSION["login"] = $row['user_name'];
			 $image = $profile=$row['image'];
			 $user_email= $row['user_email'];
			 $user_name = $row['user_name'];
			  }
			}

		}?>
		<div class="card">
  		 	 <img src="admin/user_image/<?php echo $profile; ?>" class="img img-responsive " width="150" height="150" style="/*border-radius: 50%;*/ width: 100%; margin:0 auto;"alt="<?php echo $profile; ?>">
 			 <h1><?php  echo $user_name; ?></h1>
 		     <p class="title"><?php echo $user_email; ?></p>
 			 <p>Harvard University</p>
 			 
		
		<form action="user_profile.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
    		<input id="button" type="file" name="user_image" value="Update"  class="form-control text text-center"/>
    		<input type='submit' value='Save name' name='but_upload' class="btn btn-success">
    </div>
</form>	
</div>	
		</div>
	</div>

</div>
