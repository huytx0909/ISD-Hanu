<?php 
if (isset($_POST['register_button'])) {
	
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






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Add Department </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=addDepartment"  class="beta-form-checkout">
		<table>
			 <div class="form-group">
			<tr>
				<td>Department name: </td>
				<td><input type="text" name="name" class="form-control" required></td>
			</tr>
		</div>

			 <div class="form-group">
		<tr>
				<td>Department description: </td>
				<td><div class="form-group">
 				 <textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div></td>
			</tr>
			</div>
			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="add" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>