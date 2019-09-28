<?php
 
if (isset($_POST['register_button'])) {
	  $name = $_POST['name'];
	  $trainer = $_POST['trainer'];
	  $description = $_POST['description'];
	  $startDate = $_POST['start_date'];
	  $endDate = $_POST['end_date'];
	  $maxTrainee = $_POST['max_trainees'];


		$todayDate = date("Y-m-d");


	$trainer_sql = "SELECT * FROM user WHERE username = '$trainer'";
	$trainer_query = mysqli_query($db,$trainer_sql);
    
    $sql1 = "SELECT * FROM training WHERE training_name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "training course existed in database";
	}   
	  else if (mysqli_num_rows($trainer_query) == 1) {
	
			$trainer = mysqli_fetch_assoc($trainer_query); 
			$IDuser = $trainer['id'];

         if($startDate < $endDate && $startDate > $todayDate) {

		 $training_sql = "INSERT INTO `training`(training_name, id_trainer, description, start_date, end_date, max_trainees, number_trainees) VALUES('$name', '$IDuser','$description', '$startDate', '$endDate', '$maxTrainee', '0')";

		 $training_query = mysqli_query($db,$training_sql); 
			
			header("location: admin.php?adminpage=adminTraining"); //redirect to home after registering successfully
               
           } else {
               
               				$_SESSION['message'] = "start date can not be later than end date and earlier than the date of today";


           }

	
			} else {

				$_SESSION['message'] = "there is no such trainer";
			}

}
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Add Training Course </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'><span class = 'error'>".$_SESSION['message']."</span></div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=addTraining"  class="beta-form-checkout">
		<table>
			 <div class="form-group" align="center">
			<tr>
				<td><strong>Training course name: </strong></td>
				<td><input type="text" name="name" class="form-control" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>Trainer Username: </strong></td>
				<td><input type="text" name="trainer" class="form-control" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>Description: </strong></td>
				<td><input type="text" name="description" class="form-control" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>Start Date: </strong></td>
				<td><input type="date" name="start_date" class="form-control" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>End Date: </strong></td>
				<td><input type="date" name="end_date" class="form-control" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>Max number of trainees: </strong></td>
				<td><input type="number" name="max_trainees" class="form-control" required></td>
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

