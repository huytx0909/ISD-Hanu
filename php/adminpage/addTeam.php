<?php 
if (isset($_POST['register_button'])) {
	
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
		$_SESSION['message'] = "team existed in database";
	} else {
		 	
		 $sql = "INSERT INTO team(name, description, id_department) VALUES('$name', '$description', '$IDdepartment')";
			$result = mysqli_query($db, $sql);
			

			header("location: admin.php?adminpage=adminTeam"); //redirect to home after registering successfully
			
		 
	}
	
}


 		$department_sql = "SELECT * FROM department";
      if($department_query = mysqli_query($db, $department_sql)) {
      $department = mysqli_fetch_assoc($department_query);
              }
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Add Team </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=addTeam"  class="beta-form-checkout">
		<table>
			 <div class="form-group">
			<tr>
				<td>Team name: </td>
				<td><input type="text" name="name" class="form-control" required></td>
			</tr>
		</div>

			 <div class="form-group">
		<tr>
				<td>Team description: </td>
				<td><div class="form-group">
 				 <textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div></td>
			</tr>
			</div>


         <div class="form-group">
         <td>Department: </td>
       <td>
    <select  class="form-control" id="department" name="department" required>
      <?php
           do {
      ?>
      <option value="<?= $department['name']; ?>"><?= $department['name']; ?></option>
      <?php
        } while($department = mysqli_fetch_assoc($department_query));
      ?>
    </select>
    </td>
  </div>



			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="add" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>