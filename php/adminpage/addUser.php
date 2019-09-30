	<?php
//including the database connection file
date_default_timezone_set("Asia/Ho_Chi_Minh");
$success = "";
if (isset($_POST['Submit'])) {

	$userName = mysqli_real_escape_string($db, $_POST['username']);
	$fullName = mysqli_real_escape_string($db, $_POST['fullName']);
	$password = md5(mysqli_real_escape_string($db, $_POST['password']));
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$salary = mysqli_real_escape_string($db, $_POST['salary']);
	$level = mysqli_real_escape_string($db, $_POST['level']);

	$date = date("Y/m/d");

	$department = mysqli_real_escape_string($db, $_POST['department']);
	$team = mysqli_real_escape_string($db, $_POST['team']);
	$role = mysqli_real_escape_string($db, $_POST['role']);

	$departmentIdResult = mysqli_query($db, "SELECT id FROM department WHERE name = '$department'");
	$teamIdResult = mysqli_query($db, "SELECT id FROM team WHERE name = '$team'");
	$roleIdResult = mysqli_query($db, "SELECT id FROM role WHERE name = '$role'");

	$departmentId = mysqli_fetch_array($departmentIdResult);
	$teamId = mysqli_fetch_array($teamIdResult);
	$roleId = mysqli_fetch_array($roleIdResult);

	$sql1 = "SELECT * FROM user WHERE username = '$userName'";
	$result1 = mysqli_query($db, $sql1);

	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] =  "User existed in database.";
	} else{ 
		if (empty($userName) || empty($password) || empty($email) || empty($phone) || empty($address) || empty($salary) || empty($department) || empty($team) || empty($role) || empty($fullName) || empty($level)) {
			$_SESSION['message'] =  "All fields are required."; 
		}else if(!ctype_alpha(str_replace(' ', '', $fullName))) {
			$_SESSION['message'] = "Full Name could not contain numbers.";
		} else {
		// if all the fields are filled (not empty)

		//insert data to database
		// echo $userName, $password, $email, $phone, $address, $salary, $departmentId[0], $teamId[0], $roleId[0];

		$insertResult = mysqli_query($db, "INSERT INTO user(username, fullName, password, email, phone, address, salary, id_department, id_team, id_role, date_created, level)
			VALUES('$userName', '$fullName', '$password', '$email', '$phone', '$address', '$salary', '$departmentId[0]' ,'$teamId[0]', '$roleId[0]', '$date', '$level')");
		$success = "<div class='success' id='success'>
							Success.
				  		</div>";  
		}
	}
}
$roleResult = mysqli_query($db, "SELECT * FROM role ORDER BY id DESC");
$departmentResult = mysqli_query($db, "SELECT * FROM department ORDER BY id DESC");
$teamResult = mysqli_query($db, "SELECT * FROM team ORDER BY id DESC");
?>
	<body>
		<div class = "header">
			<button type="submit" class="btn btn-primary float-left" name="Submit">
				<a href="admin.php?adminpage=adminUser">
					<i class="fas fa-chevron-left"></i>
					Back
				</a>
			</button>
			<h2>Add User</h2>
		</div>

		<div class="container">
			<div class="main">
				<form action="admin.php?adminpage=addUser" method="post" name="form1" class="form">
				  <div class="form-group">
				  	<?php 
					echo $success;
					if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
					} 
					?>
				    <label for="name">User Name:</label>
				    <input type="text" class="form-control" name="username" placeholder="Enter user name">
				  </div>

				  <div class="form-group">
				    <label for="name">Full Name:</label>
				    <input type="text" class="form-control" name="fullName" placeholder="Enter full name">
				  </div>

				  <div class="form-group">
				    <label for="password">Password:</label>
				    <input type="password" class="form-control" name="password" minlength="8" placeholder="Enter password">
				  </div>

				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="email" class="form-control" name="email" placeholder="Enter email">
				  </div>

				   <div class="form-group">
				    <label for="phone">Phone:</label>
				    <input type="text" class="form-control" name="phone" minlength="10" placeholder="Enter phone">
				  </div>

				  <div class="form-group">
				    <label for="address">Address:</label>
				    <input type="text" class="form-control" name="address" placeholder="Enter address">
				  </div>

				  <div class="form-group">
				    <label for="salary">Salary:</label>
				    <input type="number" class="form-control" name="salary" placeholder="Enter salary">
				  </div>

				<div class="select-group">
				  <div class="form-group select">
				  		<label for="department">Department:</label>
				    	<select class="form-control" name="department">
				    		<option></option>
					   		<?php
while ($res = mysqli_fetch_array($departmentResult)) {?>
					      	<option>
					      	 <?php echo "<td>" . $res['name'] . "</td>" ?>
					      	</option>
							<?php
}
?>
						</select>
				  </div>

				  <div class="form-group select">
				  		<label for="team">Team:</label>
				    	<select class="form-control" name="team">
				    		<option></option>
					   		<?php
while ($res = mysqli_fetch_array($teamResult)) {?>
					      	<option>
					      	 <?php echo "<td>" . $res['name'] . "</td>" ?>
					      	</option>
							<?php
}
?>
						</select>
				  </div>


				    <div class="form-group select">
				    	<label for="role">Role:</label>
					   	<select class="form-control" name="role">
					   		<option></option>
					   		<?php
while ($res = mysqli_fetch_array($roleResult)) {?>
					      	<option>
					      	 <?php echo "<td>" . $res['name'] . "</td>" ?>
					      	</option>
							<?php
}
?>
						</select>

					</div>

                 <div class="form-group select">
				    <label for="level">Level:</label>
				    <select  class="form-control" id="level" name="level">
				    	<option></option>
				    	<option value="level 1">level 1</option>
				    	<option value="level 2">level 2</option>
				    </select>
  				</div>

				</div>
				 
				   	<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
				
				  <div class="clearfix"></div>
				</form>
			</div>
		</div>
	</body>


