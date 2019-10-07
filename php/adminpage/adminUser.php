
<?php
//including the database connection file

//fetching data in descending order (lastest entry first)
$result = mysqli_query($db, "SELECT * FROM user ORDER BY id DESC");
?>
	<div class = "header">
		<h2>User table</h2>
	</div>
	
	<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-sm-11 col-xl-12">
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
			</div>
		</div>	
		<div class="row">
			<div class="col-6 col-xl-8">	
					<button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
					        <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminRole" > User Role</a></button>
			</div>
			<div class="col-6 col-xl-4">
				<div class="float-right">
					<form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
				      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextUser">
				      <button class="btn btn-outline-success" type="submit" name="searchUser">Search</button>
				    </form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="row">
			<div class="col-11 col-md-11 col-xl-12 table-responsive">
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th>Username</th>
			      <th>Password</th>
			      <th>Full Name</th>
			      <th>Email</th>
			      <th>Phone</th>
			      <th>Address</th>
			      <th>Salary(VND)</th>
			      <th>Department</th>
			      <th>Team</th>
			      <th>Role</th>
			      <th>Level</th>
			      <th>Date Created</th>
			      <th>Actions</th>
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
	if($departmentResult = mysqli_query($db, $departmentSql)){
	$departmentName = mysqli_fetch_array($departmentResult);
         $depart = $departmentName[0];      	
               	} else {
               		$depart = "none";
               	}
	
	if($teamResult = mysqli_query($db, $teamSql)){
	$teamName = mysqli_fetch_array($teamResult);
	  $team = $teamName[0];
	} else {
		$team = "none";
	}

	if(	$roleResult = mysqli_query($db, $roleSql)){
	$roleName = mysqli_fetch_array($roleResult);
	$role = $roleName[0];
        } else {
        	$role = "none";
        }
       ?>
	<tr>
		<td class="cell-breakWord" align="center"><?=$res['username']; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['password']; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['fullName']; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['email']; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['phone']; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['address']; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['salary']; ?></td>
		<td class="cell-breakWord" align="center"><?=$depart; ?></td>
		<td class="cell-breakWord" align="center"><?=$team; ?></td>
		<td class="cell-breakWord" align="center"><?=$role; ?></td>
		<td class="cell-breakWord" align="center"><?=$res['level']; ?></td>
		<td class="cell-breakWord" align="center"><?=date("d-m-Y",strtotime($res['date_created'])); ?></td>
		<td align="center">
			<button type="button" class="btn btn-primary edit"><a href="admin.php?adminpage=editUser&id=$res[id]" data-toogle="tooltip" title="Edit"><i class="far fa-edit"></i></a></button>  
			<button type="button" class="btn btn-danger" id="delete" data-toogle="tooltip" title="Delete" data-toggle="modal" data-target="#deleteModal" data-id="<?=$res['id'];?>"><a><i class="far fa-trash-alt"></i></a></button>
		</td>
	</tr>

<?php
}
?>
			  </tbody>
			</table>
		</div>
	</div>
</div>
</div>
<?php include 'deleteUser.php';?>
 