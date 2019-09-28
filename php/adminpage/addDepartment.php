<?php 
if (isset($_POST['Submit'])) {
	
	  $name = $_POST['name'];
      $description = $_POST['description'];

      $department_pattern = '/^[a-zA-Z ]*$/';

    
	$sql1 = "SELECT * FROM department WHERE name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "department existed in database";
	} else {
		
       if(!preg_match($department_pattern, $name) || strlen($name) > 100) {
       $_SESSION['message'] = "Only alphabets and white space allowed";
                  }
            else { 	
		 $sql = "INSERT INTO department(name, description) VALUES('$name', '$description')";
			$result = mysqli_query($db, $sql);
			

			header("location: admin.php?adminpage=adminDepartment"); //redirect to home after registering successfully
               
			
		} 
	}
	
}
?>

<div class = "header">
	<h2>Add Department</h2>
</div>

<div class="container">
	<div class="main">
		 <?php 
			if (isset($_SESSION['message'])) {
				echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
				unset($_SESSION['message']);
			} 
			?>

			<form method="POST" action="admin.php?adminpage=addDepartment"  class="form beta-form-checkout">
				<div class="form-group">
					<label for="name">Department Name:</label>
					<input type="text" name="name" class="form-control" required>
				</div>

				<div class="form-group">
					<label for="description">Department Description:</label>
					<textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div>

					<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
				
				<div class="clearfix"></div>
			</form>
	</div>
</div>