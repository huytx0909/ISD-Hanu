<?php
// including the database connection file
include_once("config.php");

$nameErr=$passwordErr=$emailErr=$phoneErr=$addressErr=$salaryErr=$departmentErr=$teamErr= $roleErr ="";

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	$userName = mysqli_real_escape_string($mysqli, $_POST['user-name']);
	$password = mysqli_real_escape_string($mysqli, $_POST['password']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
	$address = mysqli_real_escape_string($mysqli, $_POST['address']);
	$salary = mysqli_real_escape_string($mysqli, $_POST['salary']);
	$department = mysqli_real_escape_string($mysqli, $_POST['department']);
	$team = mysqli_real_escape_string($mysqli, $_POST['team']);
	$role = mysqli_real_escape_string($mysqli, $_POST['role']);
	
	// checking empty fields
	if(empty($userName) || empty($password) || empty($email) || empty($phone) || empty($address) || empty($salary) || empty($department) || empty($team) || empty($role)) {
					
			if(empty($userName)) {
				$nameErr = "Name field is empty";
			}
			
			if(empty($password)) {
				$passwordErr = "Password field is empty";
			}
			
			if(empty($email)) {
				$emailErr = "Email field is empty";
			}

			if(empty($phone)) {
				$phoneErr = "Phone field is empty";
			}
			
			if(empty($address)) {
				$addressErr = "Address field is empty";
			}
			
			if(empty($salary)) {
				$salaryErr = "Salary field is empty";
			}

			if(empty($department)) {
				$departmentErr = "Department field is empty";
			}
			
			if(empty($team)) {
				$teamErr = "Team field is empty";
			}
			
			if(empty($role)) {
				$roleErr = "Role field is empty";
			}
			
		} else { 
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE user SET name='$userName',password='$password',email='$email',phone='$phone',address='$address',salary='$salary',department='$department',team='$team',role='$role'WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM user WHERE id=$id");
while($res = mysqli_fetch_array($result))
{
	$userName = $res['name'];
	$password = $res['password'];
	$email = $res['email'];
	$phone = $res['phone'];
	$address = $res['address'];
	$salary = $res['salary'];
	$department = $res['department'];
	$team = $res['team'];
	$role = $res['role'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style/edit.css">
	<link rel="stylesheet" href="style/header.css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<?php include 'include/header.html';?>

	<div class="container">

		<div class="main">
			<h2 style="text-align: center;">Edit</h2>
			<form action="editUser.php" method="post" name="form1" class="form">
			  <span class="success"><?php echo $success; ?></span>
				  <div class="form-group">
				    <label for="name">User Name:</label><br>
				    <span class="error"><?php echo $nameErr; ?></span>
				    <input type="text" class="form-control" name="user-name" value=<?php echo $userName; ?>>
				  </div>

				  <div class="form-group">
				    <label for="password">Password:</label><br>
				    <span class="error"><?php echo $passwordErr; ?></span>
				    <input type="password" class="form-control" name="password" value=<?php echo $password; ?>>
				  </div>

				  <div class="form-group">
				    <label for="email">Email:</label><br>
				    <span class="error"><?php echo $emailErr; ?></span>
				    <input type="text" class="form-control" name="email" value=<?php echo $email; ?>>
				  </div>

				   <div class="form-group">
				    <label for="phone">Phone:</label><br>
				    <span class="error"><?php echo $phoneErr; ?></span>
				    <input type="text" class="form-control" name="phone" value=<?php echo $phone; ?>>
				  </div>

				  <div class="form-group">
				    <label for="address">Address:</label><br>
				    <span class="error"><?php echo $addressErr; ?></span>
				    <input type="text" class="form-control" name="address" value=<?php echo $address; ?>>
				  </div>
				
				  <div class="form-group">
				    <label for="salary">Salary:</label><br>
				    <span class="error"><?php echo $salaryErr; ?></span>
				    <input type="text" class="form-control" name="salary" value=<?php echo $salary; ?>>
				  </div>
				<div class="select-group">
				  <div class="form-group select">
				  		<label for="department">Department:</label><br>
				  		<span class="error"><?php echo $departmentErr; ?></span>
				  		<br>
				  		
				    	<select class="custom-select" name="department">
					   		<?php
					   		while($res = mysqli_fetch_array($departmentResult)) { ?> 
					      	<option  value=<?php echo  $department; ?>>

					      	 <?php echo "<td>".$res['name']."</td>"?>    		
					      	</option>									
							<?php
						 }
						?>
						</select>
				  </div>

				  <div class="form-group select">
				  		<label for="team">Team:</label><br>
				  		<span class="error"><?php echo $teamErr; ?></span>
				  		<br>
				  		
				    	<select class="custom-select" name="team">
					   		<?php
					   		while($res = mysqli_fetch_array($teamResult)) { ?> 
					      	<option value=<?php echo $team;?>>   		
					      	</option>									
							<?php
						 }
						?>
						</select>
				  </div>

				    <div class="form-group select">
				    	<label for="role">Role:</label><br>
				    	<span class="error"><?php echo $roleErr; ?></span>
				    	<br>
				    	
					   <select class="custom-select" name="role">
					   		<?php
					   		while($res = mysqli_fetch_array($roleResult)) { ?> 
					      	<option value=<?php echo $role;?>>
   		
					      	</option>									
							<?php
						 }
						?>
						</select>
						
					</div>
				</div>
			  	
			   	<button type="reset" class="btn btn-danger float-right" name="cancel">Cancel</button>
			  	<button type="submit" class="btn btn-primary float-right" name="update">Update</button>

			  <div class="clearfix"></div>
			</form>
		</div>
	</div>
</body>
</html>
