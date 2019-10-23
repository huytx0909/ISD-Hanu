<?php
function logConsole($msg) {
  echo "<script>console.log(" . json_encode($msg) . ")</script>";
}

//getting id from url
$id = $_GET['ID'];

//selecting data associated with this particular id

if (isset($_POST['update'])) {
	$userName = mysqli_real_escape_string($db, $_POST['username']);
	$fullName = mysqli_real_escape_string($db, $_POST['fullName']);

	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$salary = mysqli_real_escape_string($db, $_POST['salary']);

	$departmentName = mysqli_real_escape_string($db, $_POST['id_department']);
	$teamName = mysqli_real_escape_string($db, $_POST['id_team']);
	$roleName = mysqli_real_escape_string($db, $_POST['id_role']);
	$level = mysqli_real_escape_string($db, $_POST['level']);
	$dob = mysqli_real_escape_string($db, $_POST['DOB']);
	$gender = mysqli_real_escape_string($db, $_POST['gender']);
	$image = mysqli_real_escape_string($db, $_POST['image']);

	// echo $password, $email, $phone, $address, $salary, $departmentName, $teamName, $roleName;

	// checking empty fields
	   $sql1 = "SELECT * FROM user WHERE username = '$userName' and id != '$id'";
		$result1 = mysqli_query($db, $sql1); 

if (empty($userName) || empty($email) || empty($phone) || empty($address) || empty($salary) || empty($departmentName) || empty($teamName) || empty($roleName) || empty($fullName) || empty($level) || empty($dob) || empty($gender)) {
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
		$IDdepartment = $departmentIdRs[0];
		$IDteam = $teamIdRs[0];
		$IDrole = $roleIdRs[0];



 if(!empty($image)) {


    $image0_sql= "SELECT * from image where url = '$image'";
    $image0_query = mysqli_query($db, $image0_sql);
    $countRow = mysqli_num_rows($image0_query);

		if($countRow == 0) {

    $image_sql = "INSERT INTO image(url) VALUES ('$image')";
    $image_query = mysqli_query($db, $image_sql);
      }
    
   
    $image1_sql = "SELECT * from image where url = '$image'";
    $image1_query = mysqli_query($db, $image1_sql);
    if($image1 = mysqli_fetch_assoc($image1_query)) {
    $IDimage = $image1['id'];
     }

     	$updateUser_sql = "UPDATE user SET username = '$userName', fullName = '$fullName', email = '$email', phone = '$phone', address = '$address', gross_salary = '$salary', id_department = '$IDdepartment', id_team = '$IDteam', id_role = '$IDrole', level = '$level', gender = '$gender', DOB = '$dob', id_image = '$IDimage' WHERE id = '$id' ";
		$update_query = mysqli_query($db, $updateUser_sql);

		$_SESSION['success'] = "Success."; 
		if($userName == $_SESSION['admin']) {
			echo "<script>
    window.location.href='admin.php?adminpage=adminProfile';
    </script>"; 
		} else {
		echo "<script>
    window.location.href='admin.php?adminpage=adminUser';
    </script>"; 
    }   
               
          }  else {


           	$updateUser_sql = "UPDATE user SET username = '$userName', fullName = '$fullName', email = '$email', phone = '$phone', address = '$address', gross_salary = '$salary', id_department = '$IDdepartment', id_team = '$IDteam', id_role = '$IDrole', level = '$level', gender = '$gender', DOB = '$dob' WHERE id = '$id' ";
		$update_query = mysqli_query($db, $updateUser_sql);

		$_SESSION['success'] = "Success."; 
		if($userName == $_SESSION['admin']) {
			echo "<script>
    window.location.href='admin.php?adminpage=adminProfile';
    </script>"; 
		} else {
		echo "<script>
    window.location.href='admin.php?adminpage=adminUser';
    </script>"; 
    }         
           }




	 
	}
}
}

$user_sql = "SELECT * from user WHERE id = '$id'";
$result = mysqli_query($db, $user_sql);
	$res = mysqli_fetch_assoc($result);
	$userName = $res['username'];
	$fullName = $res['fullName'];
	$email = $res['email'];
	$phone = $res['phone'];
	$address = $res['address'];
	$salary = $res['gross_salary'];
	$level = $res['level'];
	$dob = $res['DOB'];
	$gender = $res['gender'];


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

	<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
			<form method="POST" action="admin.php?adminpage=editUser&ID=<?= $id; ?>" class="form">

				  <div class="form-group">
				  	<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
				    <label for="username">User Name:</label>
				    <input type="text" class="form-control" name="username" value="<?= $userName; ?>">
				  </div>

				   <div class="form-group">
				    <label for="name">Full Name:</label>
				    <input type="text" class="form-control" name="fullName" value="<?= $fullName; ?>" >
				  </div>

				  <div class="form-group">
	    		<label for="image">Image</label>
	    		<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
	  		</div>

			<div class="form-group">
			<label for="date">Date of birth:</label>
			<input type="date" name="DOB" class="form-control" value="<?= $dob; ?>">
					</div>

					<div class="form-group">
					<label for="date">Gender:</label>
					<div class="form-check">
  					<input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" <?php if($gender == "male") { ?> checked <?php } ?>  >
 					 <label class="form-check-label" for="gender">
  								  Male
 					 </label>
 					
 					</div>
 					<div class="form-check">
 					 <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="female" <?php if($gender == "female") { ?> checked <?php } ?>>
 					 <label class="form-check-label" for="gender">
  								  female
 					 </label>
 					</div>
					</div>

				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="text" class="form-control" name="email" value= "<?= $email; ?>">
				  </div>

				   <div class="form-group">
				    <label for="phone">Phone:</label>
				    <input type="text" class="form-control" name="phone" value="<?= $phone; ?>">
				  </div>

				  <div class="form-group">
				    <label for="address">Address:</label>
				    <input type="text" class="form-control" name="address" value= "<?= $address; ?>">
				  </div>

				  <div class="form-group">
				    <label for="salary">Salary(VND):</label>
				    <input type="number" class="form-control" name="salary" value="<?= $salary; ?>">
				  </div>
				<div class="select-group">
				  <div class="form-group select">
				  		<label for="id_department">Department:</label>
				    	<select class="form-control" name="id_department">
    					<option></option>				    		
							<?php
while ($res = mysqli_fetch_array($departmentResult)) {?>
					      	<option value="<?= $res['name']; ?>" <?php if($departmentId == $res['id']) { ?> selected="selected"  <?php } ?> > <?= $res['name']; ?> </option>
							<?php
}
?>
						</select>
				  </div>

				  <div class="form-group select">
				  		<label for="id_team">Team:</label>
				    	<select class="form-control" name="id_team">
				    	<option></option>
							<?php
while ($res = mysqli_fetch_array($teamResult)) {?>
								<option value="<?= $res['name']; ?>" <?php if($teamId == $res['id']) { ?> selected="selected"  <?php } ?> > <?= $res['name']; ?> </option>
								<?php
}
?>
						</select>
				  </div>

				    <div class="form-group select">
				    	<label for="id_role">Role:</label>
					   	<select class="form-control" name="id_role">
						<option></option>
							<?php
while ($res = mysqli_fetch_array($roleResult)) {?>
								<option value="<?= $res['name']; ?>" <?php if($roleId == $res['id']) { ?> selected="selected"  <?php } ?> > <?= $res['name']; ?> </option>
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
</div>
</div>


