<?php

if(isset($_GET['ID'])) {
  $IDholiday = $_GET['ID'];
 
if (isset($_POST['register_button'])) {
	  $name = $_POST['name'];
	  $description = $_POST['description'];
	  $startDate = $_POST['start_date'];
	  $endDate = $_POST['end_date'];


    
    
	$sql1 = "SELECT * FROM holiday WHERE event_name = '$name' and id != '$IDholiday'";
	$result1 = mysqli_query($db, $sql1); 
	if (empty($name) || empty($description) || empty($startDate) || empty($endDate)) {
			$_SESSION['message'] =  "All fields are required."; 
	} 
	 else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "Holiday existed in database";
	}
	else  {

         if($startDate < $endDate) {

		 $holiday_sql = " UPDATE holiday SET event_name = '$name', description = '$description', start_date = '$startDate', end_date = '$endDate' WHERE id ='$IDholiday'";

		 $holiday_query = mysqli_query($db,$holiday_sql); 
			
			header("location: admin.php?adminpage=adminHoliday"); //redirect to home after registering successfully
               
           } else {
               
               	$_SESSION['message'] = "start date can not be later than end date";


           }

	
			} 

}


 $holiday0_sql = "SELECT * FROM holiday WHERE id = '$IDholiday'";
    $holiday0_query = mysqli_query($db, $holiday0_sql);
    $holiday0 = mysqli_fetch_assoc($holiday0_query);
   
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Edit holiday event </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'><span class = 'error'>".$_SESSION['message']."</span></div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=editHoliday&ID=<?= $IDholiday; ?>"  class="beta-form-checkout">
		<table>
			 <div class="form-group" align="center">
			<tr>
				<td><strong>Holiday event name: </strong></td>
				<td><input type="text" name="name" class="form-control" value="<?= $holiday0['event_name']; ?>" required></td>
			</tr>
		</div>

		

		<div class="form-group" align="center">
			<tr>
				<td><strong>Description: </strong></td>
				<td><input type="text" name="description" class="form-control" value="<?= $holiday0['description']; ?>" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>Start Date: </strong></td>
				<td><input type="date" name="start_date" class="form-control" value="<?= $holiday0['start_date']; ?>" required></td>
			</tr>
		</div>

		<div class="form-group" align="center">
			<tr>
				<td><strong>End Date: </strong></td>
				<td><input type="date" name="end_date" class="form-control" value="<?= $holiday0['end_date']; ?>" required></td>
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
