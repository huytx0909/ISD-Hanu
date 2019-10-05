<?php

if(isset($_GET['ID'])) {
  $IDholiday = $_GET['ID'];
 
if (isset($_POST['update'])) {
	  $name = $_POST['name'];
	  $description = $_POST['description'];
	  $startDate = $_POST['start_date'];
	  $endDate = $_POST['end_date'];


    
    
	$sql1 = "SELECT * FROM holiday WHERE event_name = '$name' and id != '$IDholiday'";
	$result1 = mysqli_query($db, $sql1); 
	if (empty($name) || empty($description) || empty($startDate) || empty($endDate)) {
			$_SESSION['error'] =  "All fields are required."; 
	} 
	 else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] = "Holiday existed in database.";
	}
	else  {

         if($startDate < $endDate) {

		 $holiday_sql = " UPDATE holiday SET event_name = '$name', description = '$description', start_date = '$startDate', end_date = '$endDate' WHERE id ='$IDholiday'";

		 $holiday_query = mysqli_query($db,$holiday_sql); 
			
			$_SESSION['success'] = "Success."; 
			header("Location:admin.php?adminpage=adminHoliday");
               
           } else {
               
               	$_SESSION['error'] = "Start date can not be later than end date.";


           }

	
			} 

}


 $holiday0_sql = "SELECT * FROM holiday WHERE id = '$IDholiday'";
    $holiday0_query = mysqli_query($db, $holiday0_sql);
    $holiday0 = mysqli_fetch_assoc($holiday0_query);
   
?>

<div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminHoliday">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Edit Holiday</h2>
</div>
<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
		<form method="POST" action="admin.php?adminpage=editHoliday&ID=<?= $IDholiday; ?>"  class="form beta-form-checkout">
			<div class="form-group">
				 <?php 
					if (isset($_SESSION['error'])) {
						echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
						unset($_SESSION['error']);
					} 
					?>
				<label for="name">Holiday Event name:</label>
				<input type="text" name="name" class="form-control" value="<?= $holiday0['event_name']; ?>">	
			</div>

			<div class="form-group">
				<label for="description">Description:</label>
				<input type="text" name="description" class="form-control" value="<?= $holiday0['description']; ?>">
			</div>

			<div class="form-group">
				<label for="date">Start Date:</label>
				<input type="date" name="start_date" class="form-control" value="<?= $holiday0['start_date']; ?>">
			</div>

			<div class="form-group">
				<label for="date">End Date:</label>
				<input type="date" name="end_date" class="form-control" value="<?= $holiday0['end_date']; ?>" required>
			</div>

		
	 		
				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="update">Update</button>
			
		
			<div class="clearfix"></div>
		</table>
	</form>
</div>
</div>
</div>
</div>
<?php
}
?>
