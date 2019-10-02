<?php
 $success = "";

if (isset($_POST['Submit'])) {
	  $name = $_POST['name'];
	  $description = $_POST['description'];
	  $startDate = $_POST['start_date'];
	  $endDate = $_POST['end_date'];

		$todayDate = date("Y-m-d");


	
    
    $sql1 = "SELECT * FROM holiday WHERE event_name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (empty($name) || empty($description) || empty($startDate) || empty($endDate)) {
			$_SESSION['message'] =  "All fields are required."; 
	} 
	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "holiday event existed in database";
	}   
	  else {
	
		
         if($startDate < $endDate) {

		 $holiday_sql = "INSERT INTO `holiday`(event_name, description, start_date, end_date) VALUES('$name', '$description', '$startDate', '$endDate')";

		 $holiday_query = mysqli_query($db, $holiday_sql); 
			
				$success = "<div class='success' id='success'>
							Success.
				  		</div>";            
           } else {
               
               				$_SESSION['message'] = "start date can not be later than end date";


           }

	
			} 

}
?>

<div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminHoliday">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add Holiday</h2>
</div>
<div class="container">
	<div class="main">
	<form method="POST" action="admin.php?adminpage=addHoliday"  class="form beta-form-checkout">
			 <div class="form-group">
			<?php 
				echo $success;
				if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
				} 
				?>
			<label for="name">Event name:</label>
			<input type="text" name="name" class="form-control">
		</div>


		<div class="form-group">
					<label for="description">Description:</label>
					<textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div>

		<div class="form-group">
			<label for="date">Start Date:</label>
			<input type="date" name="start_date" class="form-control">
		</div>

		<div class="form-group">
			<label for="date">End Date:</label>
			<input type="date" name="end_date" class="form-control">
		</div>

			 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>
