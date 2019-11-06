<?php

 require_once 'dbase/dbase.php';
	 include 'include/head.php';
	 date_default_timezone_set("Asia/Ho_chi_Minh");


	 if(isset($_POST['Submit'])) {

	 	$username = $_POST['username'];
	 	$email = $_POST['email'];

	 	$check_sql = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";
	 	$check_query = mysqli_query($db, $check_sql);

	 	if(mysqli_num_rows($check_query) == 1) {
	 		   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5($email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
mysqli_query($db,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");
$link = "http://localhost/ISD-Hanu/php/reset.php?key=".$key."&&email=".$email."&&username=".$username;

			$_SESSION["infoEmailArr"] = array("recipient" => $email,"subject" => "Reset password for Infore user",
			"Username" => $username,
			"Expired date" => $expDate,
		     "Click this link to reset your password" => $link);

               		$_SESSION['success'] = "please check your email to obtain a code to reset your password";


				echo "<script>
				alert('mail has been sent. please check your email to obtain a link to reset your password.');
    window.location.href='email/email.php';
    </script>";

	 	} else {
	 		echo "<script>
				alert('wrong username or email');
    </script>";

	 	}

	 }
	
?>
<body>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="adminLogin.php">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Reset Password</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
			<form method="POST" action="resetPassword.php"  class="form beta-form-checkout">

				<div class="form-group">
						<?php 
				if (isset($_SESSION['success'])) {
				echo "<div class='success' id='msg'>".$_SESSION['success']."</div>";
				unset($_SESSION['success']);
				} 
			?>
			<?php 
				if (isset($_SESSION['error'])) {
				echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
				unset($_SESSION['error']);
				} 
			?>
					<label for="email">Username:</label>
					<input type="text" name="username" class="form-control" required="">
				</div>

				<div class="form-group">
					
					<label for="email">Email:</label>
					<input type="text" name="email" class="form-control" required="">
				</div>


				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Submit</button>
				
				<div class="clearfix"></div>
			</form>
	</div>
</div>
</div>
</div>
</body>
<?php

include 'include/footer.php';

?>


