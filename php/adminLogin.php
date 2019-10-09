<?php
 require_once 'dbase/dbase.php';
 
      include 'include/sign-in.php';


if (isset($_POST['login_button'])) {
	$admin = mysqli_real_escape_string($db, $_POST['admin']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	$password = md5($password); // hash password to match.
	$sql = " SELECT * FROM admin WHERE admin = '$admin' AND password = '$password' ";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) == 1) { 
		$_SESSION['message'] = "Logged in!";	
		$_SESSION['admin'] = $admin;
		if(isset($_SESSION['admin'])) {
			header("location: admin.php");
		} else {
		header("location: adminUser.php"); //redirect to home page
	           }
	} else {
		 $_SESSION['message'] = "Incorrect password or username";
	}
}

 ?>


<?php 
if (isset($_SESSION['message'])) {
 	echo "<div id = 'error_msg'>".$_SESSION['message']."</div>";
 	unset($_SESSION['message']);
 } ?>

<div class = "container">
<div class="login-form">
			<div class="icon">
				<i class="far fa-user"></i>
			</div>
			<h1>Sign In</h1>
			
			<form action="admin.php" method="POST" role="form" class="beta-form-checkout">
				<div class="form-group">
					<input type="text" name="admin" class="form-control" id="" placeholder="Username" required="">
				</div>
				<div class="form-group">
					
					<input  type="password" name="password" class="form-control" id="" placeholder="Password" required="">
				</div>
				<button  type="submit" name="login_button" class="btn btn-primary">Login</button>

				<div class="float-right">
					<a href="#">Forgot Password?</a>
				</div>

				<div class="float-left">
			      <input type="checkbox" value="" class="checkbox">
			  	  <a style="text-decoration: none;position: absolute;bottom:2px;left:30px;">Remember me</a>
			    </div>
			</form>

			
		</div>
</div>

<?php
include 'include/footer.php';
?>

