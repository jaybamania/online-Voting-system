<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_id_generate']){
	header('location:elections.php');
	exit();
}

?>
<br>
<div class="container">
	<h3 class="text text-center text-info">Below are the Candidates who have participated in the Election</h3>
	<div class="col-sm-6 col-sm-offset-3">
		<form method="post" action="">
			<?php
			require("include/connect.php");
			$election_name = $_GET['election_name'];
			$election_name= str_replace('-', ' ', $election_name);
			?>
			<div class="form-group"><h4>Election Name :</h4> <input type='text' value='<?php echo $election_name;?>' class='form-control' readonly></div>
			<?php
			$select = mysqli_query($conn,"select * from candidates_tbl where election_name='$election_name'");
			if(mysqli_num_rows($select)>0){
				$i=0;
				while($row = mysqli_fetch_array($select)){
					$i=$i+1;
					?>
					<div class="form-group " style="font-size: 24px; color: teal;">
					<label style="color: black;"><?php echo $i.")  " ;?></label>
					<input type="radio" name="candidate_name" class="list-group" value="<?php echo $row['candidate_name']; ?>">
					<label><?php echo $row['candidate_name'];   ?></label>
					</div>
					<?php
				}
			}
			?>
			<input type="submit" name="vote_caste" class="bt btn-success" value="Now Cast Your Vote">
		</form>
	</div>
</div>
<?php
if(isset($_POST['vote_caste'])){
	$candidate_name = $_POST['candidate_name'];
	$user_email=$_SESSION['user_email'];
	$select=mysqli_query($conn,"select * from result_tbl where user_email='$user_email' and election_name='$election_name' ");
	if(mysqli_num_rows($select)){
		echo "<h4 class='text text-center text-danger'>You have already caste your vote </h4>";
	}else{
		$insert="insert into result_tbl(user_email,candidate_name,election_name)values('$user_email','$candidate_name','$election_name')";
	$runn=mysqli_query($conn,$insert);
	if($runn){
		$update="update candidates_tbl set total_votes= `total_votes`+ '1' where candidate_name='$candidate_name' and election_name='$election_name'";
		$exe = mysqli_query($conn,$update);
		if($exe){
			$added= "<h4 class='text text-center text-success'>Your Vote is Added Successfully</h4>";
			echo "$added";
		}else{
			echo "<h4 class='text text-center text-danger'>Your Vote is Not Added Successfully</h4>";
		}

	}else{
		echo "Error: " . $insert . "    " . mysqli_error($conn);
	}
	}
}
?>

