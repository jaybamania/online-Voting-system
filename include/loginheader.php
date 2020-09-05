<!DOCTYPE html>
<html>
<head>
	<title>Online Voting System</title>
	<meta name=”viewport” content=”width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="#" class="navbar-brand">Online Voting System</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="welcome.php">Home</a></li>
					<li><a href="">Parties</a></li>
					<li><a href="idgenerate.php">ID Generate</a></li>
					<li><a href="elections.php">Election</a></li>
					<li><a href="result.php">Results</a></li>
					<li><a href="vote.php">Vote</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href=""><?php echo $_SESSION['user_name']?></a></li>
				</ul>
				<?php 
				require("include/connect.php");
				$user_email=$_SESSION['user_email'];
				$runn=mysqli_query($conn,"select * from user_images where user_email='$user_email'");
			if (mysqli_num_rows($runn)>0){
		
		while($row = mysqli_fetch_array($runn)) {
		// $_SESSION["login"] = $row['user_name'];
			 $image = $profile=$row['image'];
			  }
			}
				?>
				<a href="user_profile.php"><img src="admin/user_image/<?php echo $profile; ?>" width="40" height="40" class="d-inline-block" alt="" style="border-radius: 50%; margin-top: 5px;"></a>
			</div>		
		</nav>
	</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2  img-thumbnail" style="background-color: aqua;">
					<img src="welcome1.jpg" class="img img-responsive">
				</div>
			</div>
		</div>
</body>
</html>