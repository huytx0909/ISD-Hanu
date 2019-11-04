<?php
if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}


if(isset($_POST['update'])) {
	$username = $_SESSION['user'];

	$curPassword = $_POST['curPassword'];
	$newpass1 = $_POST['newpass1'];
	$newpass2 = $_POST['newpass2'];

	$curPassword1 = md5($curPassword);

	$user_query = mysqli_query($db,"SELECT * FROM user WHERE username = '$username' AND password = '$curPassword1'");

	if(mysqli_num_rows($user_query) == 1 ) {
		if($newpass1 == $newpass2) {

		 $newpass = md5($newpass2);

	$user1_query = mysqli_query($db,"UPDATE user SET password = '$newpass' WHERE username = '$username'");
	echo "<script>
	alert('update password successfully');
    window.location.href='user.php?userpage=profile';
    </script>"; 

		} else {
			echo "<script>
	alert('wrong confrim new password');
    window.location.href='user.php?userpage=changePassword';
    </script>"; 

		}


	} else {


		echo "<script>
	alert('wrong current password');
    window.location.href='user.php?userpage=changePassword';
    </script>"; 


	}



}
?>



	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container profile">
			<form method="POST" action="user.php?userpage=changePassword" class="form">

		<div class="row">

			<div class="col-md-3">	
				
			</div>
			
			<div class="col-md-5">
				<div class="info" data-aos="fade-down">
					<div>
						<label for="name">Current Password:</label>
						<input type="Password" name="curPassword" minlength="8" class="form-control" required="">
					</div>
					
					<div class="item1">
						<label for="date">New Password:</label>
						<input type="Password" name="newpass1" minlength="8" class="form-control" required>
					</div>
					<div class="item1">
						<label for="date">Confirm New Password:</label>
						<input type="Password" name="newpass2" minlength="8" class="form-control"  required>
					</div>
						<button type="submit" class="btn btn-primary float-right" style="margin-top: 10px; margin-right: 170px;" name="update">Update</button>
			
				</div>

			</div>
			
		</div>
				</form>

	</div>