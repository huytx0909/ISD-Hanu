<?php
function logConsole($msg) {
  echo "<script>console.log(" . json_encode($msg) . ")</script>";
}

//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($db, "SELECT * FROM user WHERE id=$id");
while ($res = mysqli_fetch_array($result)) {
	$userName = $res['username'];
	$fullName = $res['fullName'];
	$password = $res['password'];
	$email = $res['email'];
	$phone = $res['phone'];
	$address = $res['address'];
	$salary = $res['salary'];
	$level = $res['level'];


	$departmentId = $res['id_department'];
	$teamId = $res['id_team'];
	$roleId = $res['id_role'];

	//get the name of 3 fields from id
	$departmentSql = "SELECT name FROM department WHERE id = '$departmentId'";
	$teamSql = "SELECT name FROM team WHERE id = '$teamId'";
	$roleSql = "SELECT name FROM role WHERE id = '$roleId'";

	$departmentNameRs = mysqli_query($db, $departmentSql);
	$teamNameRs = mysqli_query($db, $teamSql);
	$roleNameRs = mysqli_query($db, $roleSql);

	$departmentName = mysqli_fetch_array($departmentNameRs);
	$teamName = mysqli_fetch_array($teamNameRs);
	$roleName = mysqli_fetch_array($roleNameRs);

	// get all possible options
	$roleResult = mysqli_query($db, "SELECT * FROM role ORDER BY id DESC");
	$departmentResult = mysqli_query($db, "SELECT * FROM department ORDER BY id DESC");
	$teamResult = mysqli_query($db, "SELECT * FROM team ORDER BY id DESC");
}

if (isset($_POST['update'])) {
	$userName = mysqli_real_escape_string($db, $_POST['username']);
	$fullName = mysqli_real_escape_string($db, $_POST['fullName']);

	$password = mysqli_real_escape_string($db, $_POST['password']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$salary = mysqli_real_escape_string($db, $_POST['salary']);

	$departmentName = mysqli_real_escape_string($db, $_POST['id_department']);
	$teamName = mysqli_real_escape_string($db, $_POST['id_team']);
	$roleName = mysqli_real_escape_string($db, $_POST['id_role']);
	$level = mysqli_real_escape_string($db, $_POST['level']);

	// echo $password, $email, $phone, $address, $salary, $departmentName, $teamName, $roleName;

	// checking empty fields
	   $sql1 = "SELECT * FROM user WHERE username = '$userName' and id != '$id'";
		$result1 = mysqli_query($db, $sql1); 

if (empty($userName) || empty($password) || empty($email) || empty($phone) || empty($address) || empty($salary) || empty($department) || empty($team) || empty($role) || empty($fullName) || empty($level)) {
			$_SESSION['error'] =  "All fields are required."; 
		}

	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] =  "User existed in database.";
	} else { 
	 	if(ctype_alpha(str_replace(' ', '', $fullName)) === false) {
			$_SESSION['error'] = "Full Name could not contain numbers.";
		}  else if(!is_numeric($salary) || $salary < 0) {
	       $_SESSION['error'] = "Salary has to be numberic and greater than 0.";
		}

		 else {
		// query id from name
		$departmentIdRs = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM department WHERE name = '$departmentName'"));
		$teamIdRs = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM team WHERE name = '$teamName'"));
		$roleIdRs = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM role WHERE name = '$roleName'"));
		//updating the table
		// logConsole($userName);
		// logConsole($password);
		// logConsole($email);
		// logConsole($phone);
		// logConsole($address);
		// logConsole($salary);
		// logConsole($teamIdRs[0]);
		// logConsole($roleIdRs[0]);
		// logConsole($departmentIdRs[0]);

		$result = mysqli_query($db, "UPDATE user SET username = '$userName', fullName = '$fullName', password = '$password', email = '$email', phone = '$phone',
		address = '$address', salary = '$salary', id_department = $departmentIdRs[0], id_team=$teamIdRs[0], id_role=$roleIdRs[0], level = '$level' WHERE id=$id");
		$_SESSION['success'] = "Success."; 
		header("Location:admin.php?adminpage=adminUser"); 
	}
}
}
?>

<body>
	<div class = "header">
		<button type="submit" class="btn btn-dark float-left" name="Submit">
				<a href="admin.php?adminpage=adminUser">
					<i class="fas fa-chevron-left"></i>
					Back
				</a>
		</button>
		<h2>Edit User</h2>
	</div>

	<div class="container">
		<div class="main">
			<form action="" method="post" name="form1" class="form">

				  <div class="form-group">
				  	<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
				    <label for="username">User Name:</label>
				    <input type="text" class="form-control" name="username" value=<?php echo $userName; ?>>
				  </div>

				   <div class="form-group">
				    <label for="name">Full Name:</label>
				    <input type="text" class="form-control" name="fullName" value=<?php echo $fullName; ?>>
				  </div>

				  <div class="form-group">
				    <label for="password">Password:</label>
				    <input type="password" class="form-control" name="password" value=<?php echo $password; ?>>
				  </div>

				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="text" class="form-control" name="email" value=<?php echo $email; ?>>
				  </div>

				   <div class="form-group">
				    <label for="phone">Phone:</label>
				    <input type="text" class="form-control" name="phone" value=<?php echo $phone; ?>>
				  </div>

				  <div class="form-group">
				    <label for="address">Address:</label>
				    <input type="text" class="form-control" name="address" value=<?php echo $address; ?>>
				  </div>

				  <div class="form-group">
				    <label for="salary">Salary:</label>
				    <input type="text" class="form-control" name="salary" value=<?php echo $salary; ?>>
				  </div>
				<div class="select-group">
				  <div class="form-group select">
				  		<label for="id_department">Department:</label>
				    	<select class="form-control" name="id_department">
							<?php
while ($res = mysqli_fetch_array($departmentResult)) {?>
					      	<option value=<? echo $departmentName; ?>></option>
							<?php
}
?>
						</select>
				  </div>

				  <div class="form-group select">
				  		<label for="id_team">Team:</label>
				    	<select class="form-control" name="id_team">
							<?php
while ($res = mysqli_fetch_array($teamResult)) {?>
								<option value="<?php echo "<td>" . $res['name'] . "</td>" ?>"></option>
								<?php
}
?>
						</select>
				  </div>

				    <div class="form-group select">
				    	<label for="id_role">Role:</label>
					   	<select class="form-control" name="id_role">
							<?php
while ($res = mysqli_fetch_array($roleResult)) {?>
								<option value="<?php echo "<td>" . $res['name'] . "</td>" ?>"></option>
								<?php
}
?>
						</select>

					</div>
   				<div class="form-group select">
    				<label for="level">Level:</label>
    				<select  class="form-control" id="level" name="level">
    					<option></option>
      					<option value="level 1" <?php if($level == "level 1") { ?> selected="selected"  <?php } ?> >level 1</option>
      					<option value="level 2" <?php if($level == "level 2") { ?> selected="selected"  <?php } ?> >level 2</option>
    				</select>
  				</div>


				</div>

			   		<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="update">Update</button>

			  <div class="clearfix"></div>
			</form>
		</div>
	</div>
</body>
</html>


