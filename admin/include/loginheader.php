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
					<li><a href="index.php">Home</a></li>
					<li><a href="">Parties</a></li>
					<li><a href="idrequest.php">ID Request</a></li>
					<li><a href="add_new_elections.php">New Election</a></li>
					<li><a href="add_candidate.php">New Candidates</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href=""><?php echo $_SESSION['admin_name']?></a></li>
				</ul>
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