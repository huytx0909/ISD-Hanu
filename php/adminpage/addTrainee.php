<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

 if(isset($_GET['IDtraining'])) { 
   $IDtraining = $_GET['IDtraining'];

if (isset($_POST['register_button'])) {
	  $username = $_POST['username'];


	$sql1 = "SELECT * FROM user WHERE username = '$username'";
	$result1 = mysqli_query($db, $sql1);

	if (mysqli_num_rows($result1) == 1) {
	
			$user = mysqli_fetch_assoc($result1); 
			$IDuser = $user['id'];
	 $sql2 = "SELECT * FROM trainee where id_training = '$IDtraining' and id_user = '$IDuser'";
	  $result2 = mysqli_query($db, $sql2);
	    if(mysqli_num_rows($result2) == 0) {

        
		     	 $sql = "INSERT INTO trainee(id_training, id_user) VALUES('$IDtraining', '$IDuser')";

		     	 			$result = mysqli_query($db, $sql);

		     	 $training0_sql = "SELECT * from training where id = '$IDtraining'";
				$training0_query = mysqli_query($db,$training0_sql);
				$training0 = mysqli_fetch_assoc($training0_query);
				$numberTrainee = $training0['number_trainees'] + 1;

		     	 $training1_sql = "UPDATE training set number_trainees = '$numberTrainee' where id = '$IDtraining'";
				$training1_query = mysqli_query($db,$training1_sql);
		     
			header("location: admin.php?adminpage=adminTrainee&IDtraining=$IDtraining"); //redirect to home after registering successfully
               } else {
               		$_SESSION['message'] = "User has already enrolled in the training";
               }           
	
			} else {

				$_SESSION['message'] = "there is no such user";
			}

}

		$training_sql = "SELECT * from training where id = '$IDtraining'";
		$training_query = mysqli_query($db,$training_sql);
		$training = mysqli_fetch_assoc($training_query);
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Enroll trainee in <?= $training['training_name']; ?>  </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'><span class = 'error'>".$_SESSION['message']."</span></div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=addTrainee&IDtraining=<?=$IDtraining;?>"  class="beta-form-checkout">
		<table>
			 <div class="form-group" align="center">
			<tr>
				<td><strong>Username: </strong></td>
				<td><input type="text" name="username" class="form-control" required></td>
			</tr>
		</div>


			

			
			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="submit" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>

<?php
}
?>