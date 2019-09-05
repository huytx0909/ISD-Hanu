<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);	
	
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {	
			
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE user SET name='$name',age='$age',email='$email' WHERE id=$id");
		
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
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style/edit.css">
	<link rel="stylesheet" href="style//manager/header.css">

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
			<a href="add.html" class="text2">Edit</a>	
		</div>

		<div class="main">
			<h2 style="text-align: center;">Edit</h2>
			<form action="add.php" method="post" name="form1" class="form">
			  <div class="form-group">
			    <label for="name">Name:</label>
			    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
			  </div>
			  <div class="form-group">
			    <label for="age">Age:</label>
			    <input type="text" class="form-control" name="age" value="<?php echo $age;?>">
			  </div>
			  <div class="form-group">
			    <label for="email">Email:</label>
			    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
			  </div>
			  <div class="form-group">
			    <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
			  </div>
			  	
			   	<button type="reset" class="btn btn-danger float-right" name="cancel">Cancel</button>
			  	<button type="submit" class="btn btn-primary float-right" name="update">Update</button>

			  <div class="clearfix"></div>
			</form>
		</div>
	</div>
</body>
</html>
