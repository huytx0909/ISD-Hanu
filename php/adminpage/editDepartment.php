<?php 
if (isset($_POST['update'])) {
if(isset($_GET['ID'])) {
$department_ID = "";
 $department_ID = $_GET['ID']; 
	
	$name = $_POST['name'];
    $description = $_POST['description'];
    $department_pattern = '/^[a-zA-Z ]*$/';
   
	$sql1 = "SELECT * FROM department WHERE name = '$name' and id != '$department_ID'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "department existed in database";
	} else {
		
       if(!preg_match($department_pattern, $name) || strlen($name) > 255) {
       $_SESSION['message'] = "Only alphabets and white space allowed";
                  }
            else { 	
		 $sql = " UPDATE department SET name = '$name', description = '$description' WHERE id ='$department_ID'";
			$result = mysqli_query($db, $sql);
			

			header("location: admin.php?adminpage=adminDepartment"); //redirect to home after registering successfully
               
			
		} 
	}
  }	
}
if(isset($_GET['ID'])) {
 $department_ID = "";
 $department_ID = $_GET['ID'];
 $department_sql = "SELECT * from department where id = '$department_ID'";
 if($department_query = mysqli_query($db,$department_sql)) {
  $department = mysqli_fetch_assoc($department_query);
 }
?>


<div class = "header">
	<h2>Edit Department</h2>
</div>

<div class="container">
	<div class="main">
		 <?php 
			if (isset($_SESSION['message'])) {
				echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
				unset($_SESSION['message']);
			} 
			?>
			</div>


			<form method="POST" action="admin.php?adminpage=editDepartment&ID=<?= $department_ID; ?>"  class="form beta-form-checkout">
				<div class="form-group">
					<label for="name">Department Name:</label>
					<input type="text" name="name" class="form-control" value="<?=$department['name'];?>" required>
				</div>

				<div class="form-group">
					<label for="description">Department Description:</label>
					<textarea class="form-control" rows="5" id="description"  name="description"><?=$department['description'];?></textarea>
			    </div>

					 		
					<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="update">Update</button>

			  	<div class="clearfix"></div>
			</form>
	</div>
</div>

<?php
}
?>