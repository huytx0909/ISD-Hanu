<?php 
if (isset($_POST['Submit'])) {
	
	  $name = $_POST['name'];
      $description = $_POST['description'];

      $role_pattern = '/^[a-zA-Z ]*$/';

    
	$sql1 = "SELECT * FROM role WHERE name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "role existed in database";
	} else {
		
       if(!preg_match($role_pattern, $name) || strlen($name) > 255) {
       $_SESSION['message'] = "Only alphabets and white space allowed";
                  }
            else { 	
		 $sql = "INSERT INTO role(name, description) VALUES('$name', '$description')";
			$result = mysqli_query($db, $sql);
			

			$message = "add successfully";
			echo "<script type='text/javascript'>alert('$message');</script>";               
               
			
		} 
	}
	
}
?>

<div class = "header">
	<h2>Add Role</h2>
</div>

<div class="container">
	<div class="main">
	<?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'><span class='error'>".$_SESSION['message']."</span></div>";
		unset($_SESSION['message']);
	} 
	?>
		<form method="POST" action="admin.php?adminpage=addRole"  class="form beta-form-checkout">
				<div class="form-group">
					<label for="name">Role Name:</label>
					<input type="text" name="name" class="form-control" required>
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