<?php
$success = "";
if (isset($_POST['Submit'])) {
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
	if (empty($name) || empty($trainer) || empty($description) || empty($startDate)
			|| empty($endDate) || empty($maxTrainee)) {
			$_SESSION['message'] =  "All fields are required."; 
	}else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "training course existed in database";
	}else if (mysqli_num_rows($trainer_query) == 1) {
		$trainer = mysqli_fetch_assoc($trainer_query); 
		$IDuser = $trainer['id'];

        if($startDate < $endDate && $startDate > $todayDate) {

			$training_sql = "INSERT INTO `training`(training_name, id_trainer, description, start_date, end_date, max_trainees, number_trainees) VALUES('$name', '$IDuser','$description', '$startDate', '$endDate', '$maxTrainee', '0')";

		 	$training_query = mysqli_query($db,$training_sql); 
			
			$success = "<div class='success' id='success'>
							Success.
				  		</div>"; 
               
        }else {
            $_SESSION['message'] = "Start date can not be later than end date and earlier than the date of today";
        }	
	} else {
		$_SESSION['message'] = "There is no such trainer";
	}
}
?>

  <div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminTraining">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add Training Course</h2>
</div>

<div class="container">
	<div class="main">
	<form method="POST" action="admin.php?adminpage=addTraining"  class="form beta-form-checkout">
		<div class="form-group">
			<?php 
				echo $success;
				if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
				} 
				?>
			<label for="name">Training Course Name:</label>
			<input type="text" name="name" class="form-control">
		</div>

		<div class="form-group">
			<label for="name">Trainer Username:</label>
			<input type="text" name="trainer" class="form-control">
		</div>

		<div class="form-group">
			<label for="description">Description:</label>
			<textarea class="form-control" rows="5" type="text" name="description"></textarea>
		</div>

		<div class="form-group">
			<label for="date">Start Date:</label>
			<input type="date" name="start_date" class="form-control">
		</div>

		<div class="form-group">
			<label for="date">End Date:</label>
			<input type="date" name="end_date" class="form-control">
		</div>

		<div class="form-group">
			<label for="number">Max Number of Trainees:</label>
			<input type="number" name="max_trainees" class="form-control">
		</div>
	 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>

