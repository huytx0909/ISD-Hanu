<?php


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}





$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
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
		$netSalary = $res['net_salary'];



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

	$IDimage = $res['id_image'];
					
	 $image_sql = "SELECT * FROM image where id = '$IDimage'";
      if($image_query = mysqli_query($db,$image_sql)) {
         $image = mysqli_fetch_assoc($image_query);
                                                          }

?>



	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container profile">
		<div class="row">
			<div class="col-md-3">	
				<div class="user-pic" data-aos="fade-down">
					<img src="img/<?= $image['url'];?>" width="234" height = "200" alt="pic">
					<button type="button" class="btn btn-primary edit-profile"><a href = "user.php?userpage=editUserProfile">Edit profile</a></button>

				</div>
			</div>
			
			<div class="col-md-5">
				<div class="info" data-aos="fade-down">
					<div>
						<strong>Full Name:</strong> <?= $fullName; ?>
					</div>
					<div class="user-info">
						<strong>Gender:</strong> <?= $gender; ?>
					</div>
					<div class="user-info">
						<strong>Date of Birth:</strong> <?php $dob1 = date("d/m/Y",strtotime($dob)); echo $dob1; ?>
					</div>
					<div class="user-info">
						<strong>Address:</strong>  <?= $address; ?>
					</div>
					<div class="user-info">
						<strong>Phone Number:</strong>  <?= $phone; ?>
					</div>
					<div class="user-info">
						<strong>Email:</strong>  <?= $email; ?>
					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class="info" data-aos="fade-down">
					<div>
						<strong>Username:</strong> <?= $userName; ?>
					</div>
					
					<div class="user-info">
						<strong>Department:</strong> <?= $departmentName['name']; ?>
					</div>
					<div class="user-info">
						<strong>Team:</strong> <?= $teamName['name']; ?>
					</div>
					<div class="user-info">
						<strong>Role:</strong> <?= $roleName['name']; ?>
					</div>
					<div class="user-info">
						<strong>Level:</strong> <?= $level; ?>
					</div>
					<div class="user-info">
						<strong>Net Salary(VND):</strong> <?php $salary2 = number_format($netSalary); echo $salary2; ?>
					</div>
					<div class="user-info">
						<a href="user.php?userpage=changePassword" style="margin-top: 10px; margin-right: 2px;" class="btn btn-warning edit-profile" name="cancel" >update password</a>
					</div>
				</div>
			</div>
		</div>
	</div>