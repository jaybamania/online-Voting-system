<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_id_generate']){
	header('location:elections.php');
}

?>
<?php

					
					require("include/connect.php");
					$select="select * from elections_tbl";
					$run=$conn->query($select);
?>
<br>

<div class="container">
	<div class="col-sm-6 col-sm-offset-3">
		<?php   echo "hell0";?>
		<h1 class="text text-center text-info">Result Portion</h1>
		<p class="text text-danger">In this section those election results will display which are closed or date expire </p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group">
				<select class="form-control" name="election_name" >
					<option selected="selected" value="">Select Election</option>
					<?php
					
					if ($run->num_rows>0){ 
			
				    	 while($row = $run->fetch_array()){
				    	 	$election_name=$row['election_name'];
				    	 	$election_start_date=$row['election_start_date'];
				    	 	$election_end_date=$row['election_end_date'];
					?>
					<?php 
						$current_ts=time();
						$election_end_date_ts=strtotime($election_end_date);
						if($election_end_date_ts<$current_ts)
						{
					?>
					<option value="<?php echo $row['election_name']; ?>"><?php echo $row['election_name']; ?> </option>
					<?php 
							}
						}
					}
					
					?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" name="search_results" class="btn btn-success" value="Search Result">
			</div>
		</form>
		<table class="table table-responsive table-hover table-bordered table-centered">
			<td>#</td>
			<td>Candidate Name</td>
			<td>Obtain Votes</td>
			<td>Winning Status</td>
			<?php

		if(isset($_POST['search_results'])){
		echo $election_name=$_POST['election_name'];
		$select="select * from result_tbl where election_name='$election_name'";
		$run=$conn->query($select);
		if($run->num_rows>0){
			$total_election_votes=0;
			while($row=$run->fetch_array()){
				$total_election_votes=$total_election_votes+1;
			}
		}
		$select1="select * from candidates_tbl where election_name='$election_name'";
		$run1=$conn->query($select1);
		if($run1->num_rows>0){
			$i=0;
			while($row2=$run1->fetch_array()){
				$i = $i+1;
				$candidate_name=$row2['candidate_name'];
				$total_votes=$row2['total_votes'];
				$percentage=(($total_votes/$total_election_votes)*100);
				?>

				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo $candidate_name; ?></td>
					<td><?php  echo $total_votes;  ?></td>
					<td>
					<?php
					if($percentage>50){
						?>
						<div class="progress">
 						 <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php  echo $percentage; ?>"
 							 aria-valuemin="0" aria-valuemax="<?php  echo $percentage; ?>" style="width:<?php  echo $percentage; ?>%">
   							<?php  echo round($percentage); ?>%
 						 </div>
						</div>
						<?php
					}
					else if($percentage>40){
						?>
						<div class="progress">
 						 <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php  echo $percentage; ?>"
 							 aria-valuemin="0" aria-valuemax="<?php  echo $percentage; ?>" style="width:<?php  echo $percentage; ?>%">
   							<?php  echo round($percentage); ?>%
 						 </div>
						</div>
						<?php
					}else{
						?>
						<div class="progress">
 						 <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php  echo $percentage; ?>"
 							 aria-valuemin="0" aria-valuemax="<?php  echo $percentage; ?>" style="width:<?php  echo $percentage; ?>%">
   							<?php  echo round($percentage); ?>%
 						 </div>
						</div>
						<?php
					}
					?>					
					</td>
				</tr>
				<?php
			}?>
			<tr>
				<td colspan="2">Total votes</td>
				<td><?php  echo $total_election_votes ; ?></td>
			</tr>

			<?php
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


