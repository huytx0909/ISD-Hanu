<?php
 require_once 'dbase/dbase.php';
 
      include 'include/sign-in.php';


if (isset($_POST['login_button'])) {
	$admin = mysqli_real_escape_string($db, $_POST['admin']);
	$password0 = mysqli_real_escape_string($db, $_POST['password']);

	$password = md5($password0); // hash password to match.
	$sql = " SELECT * FROM user WHERE username = '$admin' AND password = '$password' ";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) == 1) { 
		$_SESSION['message'] = "Logged in!";	
		$_SESSION['admin'] = $admin;


		if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["admin"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				}



		if(isset($_SESSION['admin'])) {
			header("location: admin.php");
		} else {
		header("location: adminLogin.php"); //redirect to home page
	           }
	} else {
		 $_SESSION['error'] = "Incorrect password or username";
	}
}

 
 ?>




<div class = "container">
<div class="login-form">
			<div class="icon">
				<i class="far fa-user"></i>
			</div>
			<h1 style="color: white;">Sign in</h1>
			
			
			<form action="adminLogin.php" method="POST" role="form" class="beta-form-checkout">
				<?php 
				if (isset($_SESSION['error'])) {
					echo "<div class='error' style = 'color: red;' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
				} 
				?>
				<div class="form-group">
					
					<input type="text" name="admin" class="form-control" id="" placeholder="Username" required="" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
				</div>
				<div class="form-group">
					
					<input  type="password" name="password" class="form-control" id="" placeholder="Password" required="">
				</div>
				<button  type="submit" name="login_button" class="btn btn-primary">Login</button>

				<div class="float-right">
					<a href="resetPassword.php" style="color: white;">Forgot Password?</a>
				</div>

				<div class="float-left">
			      <input type="checkbox" name="remember" id="remember" value="" class="checkbox" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
			  	  <a style="position: absolute;bottom:2px;left:30px;color: white;cursor: pointer;">Remember me</a>
			    </div>
			</form>

			
		</div>
</div>

<?php
include 'include/footer.php';
?>

