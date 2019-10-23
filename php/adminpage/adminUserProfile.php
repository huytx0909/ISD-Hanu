<?php
 if(isset($_GET['ID'])) {
$IDuser = $_GET['ID'];
$user_sql = "SELECT * from user WHERE id = '$IDuser'";
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

<div class="header">
	<h2> <?= $userName; ?> Profile</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<?php 
				if (isset($_SESSION['success'])) {
				echo "<div class='success' id='msg'>".$_SESSION['success']."</div>";
				unset($_SESSION['success']);
				} 
			?>
			<?php 
				if (isset($_SESSION['error'])) {
				echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
				unset($_SESSION['error']);
				} 
			?>
		<div class="row">
			<div class="col-md-3">
				<div class="profile-pic">
					<img src="img/<?= $image['url'];?>" alt="pic" height="250">
				</div>
				<button type="button" class="btn btn-primary edit-profile"><a href = "admin.php?adminpage=editUser&ID=<?=$res['id'];?>">Edit profile</a></button>
			</div>
			<div class="col-md-4">
				<div class="info">
					<div>
						<strong>Full Name:</strong> <?= $fullName; ?>
					</div>
					<div class="item">
						<strong>Gender:</strong> <?= $gender; ?>
					</div>
					<div class="item">
						<strong>Date of Birth:</strong> <?php $dob1 = date("d/m/Y",strtotime($dob)); echo $dob1; ?>
					</div>
					<div class="item">
						<strong>Address:</strong> <?= $address; ?>
					</div>
					<div class="item">
						<strong>Phone Number:</strong> <?= $phone; ?>
					</div>
					<div class="item">
						<strong>Email:</strong> <?= $email; ?>
					</div>

				</div>
			</div>
			<div class="col-md-5">
				<div class="info">
					<div>
						<strong>Username:</strong> <?= $userName; ?>
					</div>
					

					<div class="item">
						<strong>Department:</strong> <?= $departmentName['name']; ?>
					</div>

					<div class="item">
						<strong>Team:</strong> <?= $teamName['name']; ?>
					</div>

					<div class="item">
						<strong>Role:</strong> <?= $roleName['name']; ?>
					</div>
					<div class="item">
						<strong>Level:</strong> <?= $level; ?>
					</div>
					<div class="item">
						<strong>Gross Salary(VND):</strong> <?php $salary1 = number_format($salary); echo $salary1; ?>
					</div>
					<div class="item">
						<strong>Net Salary(VND):</strong> <?php $salary2 = number_format($netSalary); echo $salary2; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
}
?>