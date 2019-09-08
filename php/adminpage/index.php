
<?php
//including the database connection file
include_once "config.php";

function logConsole($msg) {
	echo "<script>console.log(" . json_encode($msg) . ")</script>";
}

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM user ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style/index.css">
	<link rel="stylesheet" href="style/header.css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<?php include 'include/header.html';?>

	<div class = "header">
		<h3 align="center">User table</h3>
	</div> <br>
	<div class="container" style="margin-top: 50px;">
			<div class="float-left">
				<button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
			</div>

			<div class="float-right">

				<form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
			      <button class="btn btn-outline-success" type="submit" name="search">Search</button>
			    </form>

			</div>

			<div class="clearfix"></div>
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Username</th>
			      <th scope="col">Password</th>
			      <th scope="col">Email</th>
			      <th scope="col">Phone</th>
			      <th scope="col">Address</th>
			      <th scope="col">Salary</th>
			      <th scope="col">Department</th>
			      <th scope="col">Team</th>
			      <th scope="col">Role</th>
			      <th scope="col">Date Created</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			    	<?php
while ($res = mysqli_fetch_array($result)) {
	// prepare query by id
	$departmentSql = "SELECT name FROM department WHERE id = " . $res['id_department'];
	$teamSql = "SELECT name FROM team WHERE id = " . $res['id_team'];
	$roleSql = "SELECT name FROM role WHERE id = " . $res['id_role'];

	// get result
	$departmentResult = mysqli_query($mysqli, $departmentSql);
	$teamResult = mysqli_query($mysqli, $teamSql);
	$roleResult = mysqli_query($mysqli, $roleSql);

	//fetch to array
	$departmentName = mysqli_fetch_array($departmentResult);
	$teamName = mysqli_fetch_array($teamResult);
	$roleName = mysqli_fetch_array($roleResult);

	echo "<tr>";
	echo "<td class=\"cell-breakWord\">" . $res['username'] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $res['password'] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $res['email'] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $res['phone'] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $res['address'] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $res['salary'] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $departmentName[0] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $teamName[0] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $roleName[0] . "</td>";
	echo "<td class=\"cell-breakWord\">" . $res['date_created'] . "</td>";
	echo "<td><button type=\"button\" class=\"btn btn-primary edit\"><a href=\"editUser.php?id=$res[id]\">Edit</a></button> | <button type=\"button\" class=\"btn btn-danger delete\"><a href=\"deleteUser.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></button></td>";
}
?>
			  </tbody>
			</table>
	</div>
</body>
</html>