<?php 
if (isset($_POST['register_button'])) {
	
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






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Add Role </h1>
 
	</div>

	<?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'><span class='error'>".$_SESSION['message']."</span></div>";
		unset($_SESSION['message']);
	} 
	?>


	<form method="POST" action="admin.php?adminpage=addRole"  class="beta-form-checkout">
		<table>
			 <div class="form-group">
			<tr>
				<td>Role name: </td>
				<td><input type="text" name="name" class="form-control" required></td>
			</tr>
		</div>

			 <div class="form-group">
		<tr>
				<td>Role description: </td>
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