<?php 
$success = "";
if (isset($_POST['Submit'])) {
	
	  $name = $_POST['name'];
      $description = $_POST['description'];
      $department = $_POST['department'];
      
      $department_sql = "SELECT * FROM department WHERE name = '$department'";
      $department_query = mysqli_query($db, $department_sql);
      if($departmentofTeam = mysqli_fetch_assoc($department_query)) {
      	 $IDdepartment = $departmentofTeam['id'];
      }

	$sql1 = "SELECT * FROM team WHERE name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "Team existed in database";
	} else {
		if (empty($name) || empty($description) || empty($department)) {
			$_SESSION['message'] =  "All fields are required."; 
		}else{
		 	$sql = "INSERT INTO team(name, description, id_department) VALUES('$name', '$description', '$IDdepartment')";
			$result = mysqli_query($db, $sql);
			
			$success = "<div class='success' id='success'>
							Success.
				  		</div>";  	 
		}	
	}
}
 		$department_sql = "SELECT * FROM department";
      if($department_query = mysqli_query($db, $department_sql)) {
      $department = mysqli_fetch_assoc($department_query);
              }
?>

<div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminTeam">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Add Team</h2>
</div>

<div class="container">
	<div class="main">
			<form method="POST" action="admin.php?adminpage=addTeam"  class="form beta-form-checkout">
				<div class="form-group">
					<?php 
					echo $success;
					if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
					} 
					?>
					<label for="name">Team Name:</label>
					<input type="text" name="name" class="form-control">
				</div>

				<div class="form-group">
					<label for="description">Team Description:</label>
					<textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div>

		       <div class="form-group">
		        	<label for="department">Department:</label>
		       		<select class="form-control" id="department" name="department">
			      		<?php
			           		do {
			      		?>
			      		<option></option>
			      		<option value="<?= $department['name']; ?>"><?= $department['name']; ?></option>
			      		<?php
			        		} while($department = mysqli_fetch_assoc($department_query));
			      		?>
		    		</select>
		  		</div>

					<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
				
				<div class="clearfix"></div>
			</form>
	</div>
</div>