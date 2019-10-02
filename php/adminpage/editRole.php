<?php 
$success =  "";
if (isset($_POST['update'])) {
	if(isset($_GET['ID'])) {
		$role_ID = "";
 		$role_ID = $_GET['ID']; 
	
		$name = $_POST['name'];
    	$description = $_POST['description'];
    	$role_pattern = '/^[a-zA-Z ]*$/';
   
		$sql1 = "SELECT * FROM role WHERE name = '$name' and id != '$role_ID'";
		$result1 = mysqli_query($db, $sql1);

		 if (empty($name) || empty($description)) {
			$_SESSION['message'] =  "All fields are required."; 
		}

		else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] =  "Role existed in database."; 
		}  else {
			if(!preg_match($role_pattern, $name) || strlen($name) > 255){
       			$_SESSION['message'] = "Only alphabets and white space allowed."; 
        	}else { 	
				$sql = "UPDATE role SET name = '$name', description = '$description' WHERE id ='$role_ID'";
				$result = mysqli_query($db, $sql);
				$success = "<div class='success' id='success'>
								Success.
				  			</div>";              	
			} 
		}
 	}	
}
if(isset($_GET['ID'])) {
 $role_ID = "";
 $role_ID = $_GET['ID'];
 $role_sql = "SELECT * from role where id = '$role_ID'";
 if($role_query = mysqli_query($db,$role_sql)) {
  $role = mysqli_fetch_assoc($role_query);
 }
?>

<div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminRole">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Edit Role</h2>
</div>

<div class="container">
	<div class="main">
		<form method="POST" action="admin.php?adminpage=editRole&ID=<?= $role_ID; ?>"  class="form beta-form-checkout">
				<div class="form-group">
					<?php 
						echo $success;
						if (isset($_SESSION['message'])) {
						echo "<div class = 'error'>".$_SESSION['message']."</div>";
						unset($_SESSION['message']);
					}?>
					<label for="name">Role Name:</label>
					<input type="text" name="name" class="form-control" value="<?=$role['name'];?>" required>
				</div>

				<div class="form-group">
					<label for="description">Role Description:</label>
					<textarea class="form-control" rows="5" id="description"  name="description"><?=$role['description'];?></textarea>
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