<?php

 require_once 'dbase/dbase.php';
	 include 'include/head.php';
	 date_default_timezone_set("Asia/Ho_chi_Minh");
if(isset($_GET['key']) && isset($_GET['email']) && $_GET['username']) {

  $email = $_GET['email'];
  $key = $_GET['key'];	
  $curDate = date("Y-m-d H:i:s");
    $username = $_GET['username'];


   $query = mysqli_query($db,
  "SELECT * FROM `password_reset_temp` WHERE `key`= '$key' and `email`='$email';");
  $row = mysqli_num_rows($query);
  if($row != 1) {
  	 $_SESSION['error'] = '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="hhttp://localhost/ISD-Hanu/php/resetPassword.php">
Click here</a> to reset password.</p>';
  } else{
  $row1 = mysqli_fetch_assoc($query);
  $expDate = $row1['expDate'];
  if ($expDate >= $curDate){




?>



<body>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="adminLogin.php">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>New Password</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
			<form method="POST" action="reset.php?username=<?=$username;?>&&email=<?=$email;?>"  class="form beta-form-checkout">

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
					<label for="password">New Password:</label>
					<input type="password" name="password" class="form-control" required="">
				</div>

				<div class="form-group">
					
					<label for="password1">Confirm New Password:</label>
					<input type="password" name="password1" class="form-control" required="">
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



} else{
$_SESSION['error'] = "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }

			}
}
if(isset($_POST['Submit'])) {
	$pass1 = mysqli_real_escape_string($db,$_POST["password"]);
$pass2 = mysqli_real_escape_string($db,$_POST["password1"]);
$username = $_GET['username'];
$email = $_GET['email'];
  
  if ($pass1!=$pass2){
$_SESSION['error'] = "<p>Password do not match, both password should be same.<br /><br /></p>";
  } else {

  		$pass1 = md5($pass1);
mysqli_query($db,
"UPDATE `user` SET `password`='$pass1' WHERE `email`='$email' AND `username` = '$username';"
);

mysqli_query($db,"DELETE FROM `password_reset_temp` WHERE `email`='$email';");
		
			
		echo "<script>
		alert('Reset password successfully. Please login with your new password.');
    window.location.href='adminLogin.php';
    </script>";

  }


}			




?>


