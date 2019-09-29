<?php
$success = "";
if(isset($_GET['ID'])) {
  $IDtraining = $_GET['ID'];
 
if (isset($_POST['update'])) {
	$name = $_POST['name'];
	$trainer = $_POST['trainer'];
	$description = $_POST['description'];
	$startDate = $_POST['start_date'];
	$endDate = $_POST['end_date'];
	$maxTrainee = $_POST['max_trainees'];
	$todayDate = date("Y-m-d");

	$trainer_sql = "SELECT * FROM user WHERE username = '$trainer'";
	$trainer_query = mysqli_query($db,$trainer_sql);
    
    
	$sql1 = "SELECT * FROM training WHERE training_name = '$name' and id != '$IDtraining'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "Training course existed in database";
	}else if (mysqli_num_rows($trainer_query) == 1) {
		$trainer = mysqli_fetch_assoc($trainer_query); 
		$IDuser = $trainer['id'];

        if($startDate < $endDate && $startDate > $todayDate) {

			$training_sql = " UPDATE training SET training_name = '$name', description = '$description', id_trainer = '$IDuser', start_date = '$startDate', end_date = '$endDate', max_trainees = '$maxTrainee' WHERE id ='$IDtraining'";

		 	$training_query = mysqli_query($db,$training_sql); 
			
			$success = "<div class='success' id='success'>
							Success.
				  		</div>";     
        }else {
            $_SESSION['message'] = "start date can not be later than end date and earlier than the date of today";
        }

	
	}else{
		$_SESSION['message'] = "there is no such trainer";
	}

}

 $training0_sql = "SELECT * FROM training WHERE id = '$IDtraining'";
    $training0_query = mysqli_query($db, $training0_sql);
    $training0 = mysqli_fetch_assoc($training0_query);
    $IDuser0 = $training0['id_trainer'];

    $trainer0_sql = "SELECT * FROM user WHERE id = '$IDuser0'";
     $trainer0_query = mysqli_query($db, $trainer0_sql);
    $trainer0 = mysqli_fetch_assoc($trainer0_query);
?>

  <div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminTraining">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Edit Training Course</h2>
</div>

<div class="container">
	<div class="main">
	<form method="POST" action="admin.php?adminpage=editTraining&ID=<?= $IDtraining; ?>"  class="beta-form-checkout">
		<div class="form-group">
			<?php 
				echo $success;
				if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
				} 
			?>
			<label for="name">Training Course Name:</label>
			<input type="text" name="name" class="form-control" value="<?= $training0['training_name']; ?>" required>
		</div>

		<div class="form-group">
			<label for="name">Trainer Username:</label>
			<input type="text" name="trainer" class="form-control" value="<?= $trainer0['username']; ?>" required>
		</div>

		<div class="form-group">
			<label for="description">Description:</label>
			<textarea class="form-control" rows="5" type="text" name="description" value="<?= $training0['description']; ?>"></textarea>
		</div>

		<div class="form-group">
			<label for="date">Start Date:</label>
			<input type="date" name="start_date" class="form-control" value="<?= $training0['start_date']; ?>">
		</div>

		<div class="form-group">
			<label for="date">End Date:</label>
				<td><input type="date" name="end_date" class="form-control" value="<?= $training0['end_date']; ?>">
		</div>

		<div class="form-group">
			<label for="number">Max Number of Trainees:</label>
			<input type="number" name="max_trainees" class="form-control" value="<?= $training0['max_trainees']; ?>">
		</div>	
			 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="update">Update</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>
<?php
}
?>
