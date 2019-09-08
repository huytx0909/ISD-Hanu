<?php
// including the database connection file
$nameErr = $passwordErr = $emailErr = $phoneErr = $addressErr = $salaryErr = $departmentErr = $teamErr = $roleErr = "";

function logConsole($msg) {
	echo "<script>console.log(" . json_encode($msg) . ")</script>";
}

//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($db, "SELECT * FROM user WHERE id=$id");
while ($res = mysqli_fetch_array($result)) {
	$userName = $res['username'];
	$password = $res['password'];
	$email = $res['email'];
	$phone = $res['phone'];
	$address = $res['address'];
	$salary = $res['salary'];

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
	logConsole($id);
	$userName = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$salary = mysqli_real_escape_string($db, $_POST['salary']);

	$departmentName = mysqli_real_escape_string($db, $_POST['id_department']);
	$teamName = mysqli_real_escape_string($db, $_POST['id_team']);
	$roleName = mysqli_real_escape_string($db, $_POST['id_role']);

	// echo $password, $email, $phone, $address, $salary, $departmentName, $teamName, $roleName;

	// checking empty fields
	if (empty($userName) || empty($password) || empty($email) || empty($phone) || empty($address) || empty($departmentName) || empty($teamName) || empty($roleName)) {

		if (empty($userName)) {
			$nameErr = "Name field is empty";
		}

		if (empty($password)) {
			$passwordErr = "Password field is empty";
		}

		if (empty($email)) {
			$emailErr = "Email field is empty";
		}

		if (empty($phone)) {
			$phoneErr = "Phone field is empty";
		}

		if (empty($address)) {
			$addressErr = "Address field is empty";
		}

		if (empty($departmentName)) {
			$departmentErr = "Department field is empty";
		}

		if (empty($teamName)) {
			$teamErr = "Team field is empty";
		}

		if (empty($roleName)) {
			$roleErr = "Role field is empty";
		}
	} else {
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
		logConsole($id);

		$result = mysqli_query($db, "UPDATE user SET username = '$userName', password = '$password', email = '$email', phone = '$phone',
		address = '$address', salary = '$salary', id_department = $departmentIdRs[0], id_team=$teamIdRs[0], id_role=$roleIdRs[0] WHERE id=$id");
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
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
			<form action="" method="post" name="form1" class="form">
				  <div class="form-group">
				    <label for="username">User Name:</label><br>
				    <span class="error"><?php echo $nameErr; ?></span>
				    <input type="text" class="form-control" name="username" value=<?php echo $userName; ?>>
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
				  		<label for="id_department">Department:</label><br>
				  		<span class="error"><?php echo $departmentErr; ?></span>
				  		<br>
				    	<select class="custom-select" name="id_department">
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
				  		<label for="id_team">Team:</label><br>
				  		<span class="error"><?php echo $teamErr; ?></span>
				  		<br>
				    	<select class="custom-select" name="id_team">
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
				    	<label for="id_role">Role:</label><br>
				    	<span class="error"><?php echo $roleErr; ?></span>
				    	<br>
					   <select class="custom-select" name="id_role">
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
				</div>

			   	<button type="reset" class="btn btn-danger float-right" name="cancel">Cancel</button>
			  	<button type="submit" class="btn btn-primary float-right" name="update">Update</button>

			  <div class="clearfix"></div>
			</form>
		</div>
	</div>
</body>
</html>


