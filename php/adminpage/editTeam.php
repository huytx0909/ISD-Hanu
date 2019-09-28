<?php 
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
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "team existed in database";
	} else {
		
       
		 $sql = " UPDATE team SET name = '$name', description = '$description', id_department = '$IDdepartment' WHERE id ='$team_ID'";
			$result = mysqli_query($db, $sql);
			

			header("location: admin.php?adminpage=adminTeam"); //redirect to home after registering successfully
               
			
		
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
	<h2>Edit Team</h2>
</div>

<div class="container">
	<div class="main">
		<?php 
			if (isset($_SESSION['message'])) {
				echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
				unset($_SESSION['message']);
			} 
		?>


		<form method="POST" action="admin.php?adminpage=editTeam&ID=<?= $team_ID; ?>" class="form beta-form-checkout">
			<div class="form-group">
				<label for="name">Team Name:</label>
				<input type="text" name="name" class="form-control" value="<?=$team['name'];?>" required>
			</div>

			<div class="form-group">
				<label for="description">Team Description:</label>
		 		<textarea class="form-control" rows="5" id="description"  name="description"><?=$team['description'];?></textarea>
			</div>

			<div class="form-group">
		        <label for="department">Department:</label>
		    	<select  class="form-control" id="department" name="department" required>
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

<?php
}
?>
