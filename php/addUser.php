	<?php
	//including the database connection file
	include_once("config.php");

	if(isset($_POST['Submit'])) {	
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
		if(empty($userName) || empty($password) || empty($email)) {
					
			if(empty($userName)) {
				echo "<font color='red'>Name field is empty.</font><br/>";
			}
			
			if(empty($password)) {
				echo "<font color='red'>password field is empty.</font><br/>";
			}
			
			if(empty($email)) {
				echo "<font color='red'>Email field is empty.</font><br/>";
			}
			
			//link to the previous ppassword
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		} else { 
			// if all the fields are filled (not empty) 

			//insert data to database	
			echo $userName, $password, $email, $phone, $address, $salary, $department, $team, $role;
			$insertResult = mysqli_query($mysqli, "INSERT INTO user(`name`, password, email, phone, address, salary) VALUES('$userName','$password','$email')");
			
			//display success message
			echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='index.php'>View Result</a>";
		}
	}

			$roleResult = mysqli_query($mysqli, "SELECT * FROM role ORDER BY id DESC"); // using mysqli_query instead
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Add Data</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="style/add.css">
		<link rel="stylesheet" href="style/manager/header.css">

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php include 'include/manager/header.html';?>

		<div class="container">
			<div class="head">
				<a href="index.php" class="text1">Home</a>
				>
				<a href="addUser.php" class="text2">Add new data</a>	
			</div>

			<div class="main">
				<h2 style="text-align: center;">Add new data</h2>
				<form action="addUser.php" method="post" name="form1" class="form">
				  <div class="form-group">
				    <label for="name">User Name:</label>
				    <input type="text" class="form-control" name="user-name" placeholder="Enter user name">
				  </div>
				  <div class="form-group">
				    <label for="password">Password:</label>
				    <input type="password" class="form-control" name="password" placeholder="Enter password">
				  </div>
				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="text" class="form-control" name="email" placeholder="Enter email">
				  </div>
				   <div class="form-group">
				    <label for="phone">Phone:</label>
				    <input type="text" class="form-control" name="phone" placeholder="Enter phone">
				  </div>
				  <div class="form-group">
				    <label for="address">Address:</label>
				    <input type="text" class="form-control" name="address" placeholder="Enter address">
				  </div>
				  <div class="form-group">
				    <label for="salary">Salary:</label>
				    <input type="text" class="form-control" name="salary" placeholder="Enter salary">
				  </div>
				  <div class="form-group">
				    <label for="department">Department:</label>
				    <input type="text" class="form-control" name="department" placeholder="Enter department">
				  </div>
				  <div class="form-group">	
				    <label for="team">Team:</label>
				    <input type="text" class="form-control" name="team" placeholder="Enter team">
				  </div>
				    <div class="form-group">
					   <select class="custom-select" name="role">
					   		<?php
					   		while($res = mysqli_fetch_array($roleResult)) { ?> 
					      	<option class="dropdown-item" value=<?php echo "<td>".$res['name']."</td>"?>>

					      	 <?php echo "<td>".$res['name']."</td>"?>    		
					      	</option>									
							<?php
						 }
						?>
						</select>
						
					
					  </div>
					</div>
				  </div>

				   	<button type="reset" class="btn btn-danger float-right" name="cancel">Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>

				  <div class="clearfix"></div>
				</form>
			</div>
		</div>
	</body>
	</html>

