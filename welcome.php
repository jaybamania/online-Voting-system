<?php
session_start();
include("include/loginheader.php");
if(!$_SESSION['user_email']){
	header("location:login.php");
}
?>


	
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="text text-center text-info alert bg-primary">How to Cast Your Vote</h4>
				<ul>
					<li>First select <b>"ID Generate"</b> from the Navigation bar</li>
					<li>Cast your ballot with any device with access to the internet from anywhere in the world</li>
					<li>The Secrecy of your ballot is maintained under the high security standards adhered to by Online Voting Software</li>
					<li>Your vote remains anonymous as our system's architecture strictly seperates your personal data from the electronic ballot</li>
				</ul>
			</div>
			<div class="col-sm-6" style="margin: 10px 0px;">
				<img src="welcome.png"  class="img img-responsive">
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