<?php 
if (isset($_POST['Submit'])) {
	
	  $name = $_POST['name'];
      $description = $_POST['description'];

      $role_pattern = '/^[a-zA-Z ]*$/';

    
	$sql1 = "SELECT * FROM role WHERE name = '$name'";
	$result1 = mysqli_query($db, $sql1);

	if (empty($name) || empty($description)) {
			$_SESSION['error'] =  "All fields are required."; 
		}
	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] =  "Role existed in database."; 
	} else {
		 if(!preg_match($role_pattern, $name) || strlen($name) > 255){
       		$_SESSION['error'] = "Only alphabets and white space allowed."
					; 
        }else { 	
			$sql = "INSERT INTO role(name, description) VALUES('$name', '$description')";
			$result = mysqli_query($db, $sql);
			

			$_SESSION['success'] = "Success."; 
			echo "<script>
    window.location.href='admin.php?adminpage=adminRole';
    </script>"; 	              	
		} 
	}
}
?>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminRole">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Add Role</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
			<form method="POST" action="admin.php?adminpage=addRole"  class="form beta-form-checkout">
				<div class="form-group">
					<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
					<label for="name">Role Name:</label>
					<input type="text" name="name" class="form-control">
				</div>

				<div class="form-group">
					<label for="description">Role Description:</label>
					<textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div>
				 		
					<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
				
				<div class="clearfix"></div>
		</form>
	</div>
</div>
</div>
</div>