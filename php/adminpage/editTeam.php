<?php
$success = "";
if (isset($_POST['update'])) {
if(isset($_GET['ID'])) {
$team_ID = "";
 $team_ID = $_GET['ID']; 
	
	$name = $_POST['name'];
    $description = $_POST['description'];
    $department = $_POST['department'];

    $department_sql = "SELECT * from department where name = '$department'";
    if($department_query = mysqli_query($db, $department_sql)){
    $departmentTeam = mysqli_fetch_assoc($department_query);
         }
    	$IDdepartment = $departmentTeam['id'];
    

	$sql1 = "SELECT * FROM team WHERE name = '$name' and id != '$team_ID'";
	$result1 = mysqli_query($db, $sql1); 
	 if (empty($name) || empty($description) || empty($department)) {
			$_SESSION['error'] =  "All fields are required."; 
		}
	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] = "Team existed in database.";
	}  else {
		$sql = " UPDATE team SET name = '$name', description = '$description', id_department = '$IDdepartment' WHERE id ='$team_ID'";
		$result = mysqli_query($db, $sql);
			

		$_SESSION['success'] = "Success."; 
		echo "<script>
    window.location.href='admin.php?adminpage=adminTeam';
    </script>"; 	   	 	
	}
  }	
}
if(isset($_GET['ID'])) {
 $team = "";
 $team_ID = $_GET['ID'];
 $team_sql = "SELECT * from team where id = '$team_ID'";
 if($team_query = mysqli_query($db,$team_sql)) {
  $team = mysqli_fetch_assoc($team_query);
 }

 $department1_sql = "SELECT * from department";
 if($department1_query = mysqli_query($db,$department1_sql)) {
  $department1 = mysqli_fetch_assoc($department1_query);
 }

  $departmentID = $team['id_department'];
$department2_sql = "SELECT * from department where id = '$departmentID'";
 if($department2_query = mysqli_query($db,$department2_sql)) {
  $department2 = mysqli_fetch_assoc($department2_query);
 }
?>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminTeam">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Edit Team</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
		<form method="POST" action="admin.php?adminpage=editTeam&ID=<?= $team_ID; ?>" class="form beta-form-checkout">
			<div class="form-group">
				<?php 
					echo $success;
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
				<label for="name">Team Name:</label>
				<input type="text" name="name" class="form-control" value="<?=$team['name'];?>">
			</div>

			<div class="form-group">
				<label for="description">Team Description:</label>
		 		<textarea class="form-control" rows="5" id="description"  name="description"><?=$team['description'];?></textarea>
			</div>

			<div class="form-group">
		        <label for="department">Department:</label>
		    	<select  class="form-control" id="department" name="department">
			      	<?php
			           do {
			      	?>
			      	<option value="<?= $department1['name'] ?>"  <?php if($department1['name'] == $department2['name']) { ?> selected="selected"  <?php } ?>    > <?= $department1['name'] ?> </option>

			      	<?php
			        } while($department1 = mysqli_fetch_assoc($department1_query));
			      	?>
		    	</select>
		  	</div>

					 		
				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="update">Update</button>

			  	<div class="clearfix"></div>
			</form>
	</div>
</div>
</div>
</div>
<?php
}
?>
