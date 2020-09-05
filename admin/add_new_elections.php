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
	<h2 class="text text-center text-info">Add New Elections</h2>
	<div class="container col-sm-6 col-sm-offset-3">
		<form method="post">
			<div class="form-group">
				<label>Add Election Name:</label>
				<input type="text" name="election_name" class="form-control">
			</div>
			<div class="form-group">
				<label>Election StartName:</label>
				<input type="date" name="election_start_date" class="form-control">
			</div>
			<div class="form-group">
				<label>Election End Date:</label>
				<input type="date" name="election_end_date" class="form-control">
			</div>
			<input type="submit" name="add_election" class="btn btn-success">
			<br>
			<input type="submit" name="recent_election" value="Display Recent Election" style="margin: 20px 0px;" class="btn btn-info">
		</form>

	</div>

</body>
</html>
<?php
$conn = new mysqli("localhost","root","","votingsystem_db");
if(isset($_POST['add_election'])){
	 $election_name=$_POST['election_name'];
	 $election_start_date=$_POST['election_start_date'];
	 $election_end_date=$_POST['election_end_date'];
	 

	 $insert="insert into elections_tbl(election_name,election_start_date,election_end_date) values('$election_name','$election_start_date','$election_end_date')";
	 $runn=mysqli_query($conn, $insert);
	 if($runn){
		$created= "<h4 class='text text-center text-success'>Election Added Successfully</h4>";
		echo "$created";

	}else{
		echo "Error: " . $insert . "    " . mysqli_error($conn);
	}
}
?>

<?php
include("include/connect.php");

if(isset($_POST['recent_election'])){
	?>

	<div class="container">
		<div class="col-sm-6 col-sm-offset-3">
		<?php   echo "hell0";?>
		<h1 class="text text-center text-info">Recent Elections</h1>

		<table class="table table-responsive table-hover table-bordered table-centered">
			<td>#</td>
			<td>Election Name</td>
			<td>Start Date</td>
			<td>Last Date</td>
			<td colspan="2">Action</td>
	<?php
	$select="SELECT * FROM elections_tbl";
	$run=$conn->query($select);
		if($run->num_rows>0){
			$i=0;
			while($row=$run->fetch_array()){
				$i = $i+1;
				$election_name=$row['election_name'];
				$election_start_date=$row['election_start_date'];
				$election_end_date=$row['election_end_date'];
				?>

				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo $election_name; ?></td>
					<td><?php  echo $election_start_date;  ?></td>
					<td><?php  echo $election_end_date;  ?></td>
					<td><a href="#">Update</a></td>
					<td><a href="#">Delete</a></td>
				</tr>
				<?php
			}
		}else{
			?>
			<tr>
				<td colspan="4">No Records Found</td>
			</tr>
			<?php
		}
		
		}
		?>
		</table>
	</div>
</div>

