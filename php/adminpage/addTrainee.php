<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
 if(isset($_GET['IDtraining'])) { 
   $IDtraining = $_GET['IDtraining'];

if (isset($_POST['Submit'])) {
	  $username = $_POST['username'];


	$sql1 = "SELECT * FROM user WHERE username = '$username'";
	$result1 = mysqli_query($db, $sql1);

	if (mysqli_num_rows($result1) == 1) {
	
			$user = mysqli_fetch_assoc($result1); 
			$IDuser = $user['id'];
	 $sql2 = "SELECT * FROM trainee where id_training = '$IDtraining' and id_user = '$IDuser'";
	  $result2 = mysqli_query($db, $sql2);
	  	if (empty($username)) {
			$_SESSION['error'] =  "All fields are required."; 
	    }else if(mysqli_num_rows($result2) == 0) {

		     	$sql = "INSERT INTO trainee(id_training, id_user) VALUES('$IDtraining', '$IDuser')";

		     	$result = mysqli_query($db, $sql);

		     	$training0_sql = "SELECT * from training where id = '$IDtraining'";
				$training0_query = mysqli_query($db,$training0_sql);
				$training0 = mysqli_fetch_assoc($training0_query);
				$numberTrainee = $training0['number_trainees'] + 1;

		     	$training1_sql = "UPDATE training set number_trainees = '$numberTrainee' where id = '$IDtraining'";
				$training1_query = mysqli_query($db,$training1_sql);
		     
				$_SESSION['success'] = "Success."; 
				header("Location:admin.php?adminpage=adminTrainee&IDtraining=<?=$IDtraining;?>"); 	 
               } else {
               		$_SESSION['error'] = "User has already enrolled in the training.";
               }           
	
			} else {

				$_SESSION['error'] = "There is no such user.";
			}

}

		$training_sql = "SELECT * from training where id = '$IDtraining'";
		$training_query = mysqli_query($db,$training_sql);
		$training = mysqli_fetch_assoc($training_query);
?>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminTraining">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Enroll Trainee in <?= $training['training_name']; ?> </h2>
</div>

<div class="container">
	<div class="main">
		<form method="POST" action="admin.php?adminpage=addTrainee&IDtraining=<?=$IDtraining;?>" class="form beta-form-checkout">
			<div class="form-group">
				<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
				<label for="name">Username:</label>
				<input type="text" name="username" class="form-control">
			</div>
				 		
				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
				
				<div class="clearfix"></div>
		</form>
	</div>
</div>

<?php
}
?>