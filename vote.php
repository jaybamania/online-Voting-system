<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_id_generate']){
	header('location:elections.php');
}
$user_name=$_SESSION['user_name'];

?>
<br>
<div class="container">
	<div class="col-sm-6 col-sm-offset-3">
		 <h3 class="text text-center text-success alert">Welcome <b><i><?php echo $user_name; ?></i></b> Into Voting Area</h3>
		<form method="post">
			<label>Election Name:</label>
			<select name="election_name" class="form-control">
			<option value="">Select Election</option>
			<?php
			require("include/connect.php");
			$select=mysqli_query($conn,"select * from elections_tbl ");
			if (mysqli_num_rows($select)>0){ 
			
			 while($row = mysqli_fetch_array($select)){
			?>
			<option value="<?php echo $row['election_name'];?>" ><?php echo $row['election_name'];?></option>
			<?php }
				}
			?>
			</select>
			<br>
			<input type="submit" name="search_candidate" class="btn btn-success" value="Search Candidate">
		</form>
	</div>
</div>
<?php
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['search_candidate'])){
	$election_name=$_POST['election_name'];
	
	$select=mysqli_query($conn,"select * from elections_tbl where election_name='$election_name'");
	if(mysqli_num_rows($select)>0){
		while ($row= mysqli_fetch_array($select)) {
		$election_start_date=$row['election_start_date'];
		$election_end_date=$row['election_end_date'];

		}
	}
	$current_ts=time();
	$election_start_date_ts=strtotime($election_start_date);
	$election_end_date_ts=strtotime($election_end_date);
	if($election_start_date_ts>$current_ts){
		$msg = "<h4 class='text text-center text-info'> Election did not start yet! Please wait...</h4>";
		echo $msg;
	}
	else if($current_ts>$election_end_date_ts){
		$msg = "<h4 class='text text-center text-danger'> Election Date has been over for this particular election,So now you did not able to caste your vote</h4>";
		echo $msg;
	}
	else{?>
			 <a href="votecaste.php?election_name=<?php echo str_replace(' ', '-', $election_name)?>"><h4 class="text text-center text-success">Click here to select the Candidate</a></h4>
		<?php
	}
}

?>
