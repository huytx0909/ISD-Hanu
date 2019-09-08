<?php 
if (isset($_POST['register_button'])) {
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

 $departmen1_sql = "SELECT * from department";
 if($departmen1_query = mysqli_query($db,$departmen1_sql)) {
  $departmen1 = mysqli_fetch_assoc($departmen1_query);
 }

  $departmentID = $team['id_department'];
$department2_sql = "SELECT * from department where id = '$departmentID'";
 if($department2_query = mysqli_query($db,$department2_sql)) {
  $department2 = mysqli_fetch_assoc($department2_query);
 }
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Edit team </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=editTeam&ID=<?= $team_ID; ?>"  class="beta-form-checkout">
		<table>
			 <div class="form-group">
			<tr>
				<td>Team name: </td>
				<td><input type="text" name="name" class="form-control" value="<?=$team['name'];?>" required></td>
			</tr>
		</div>


			 <div class="form-group">
			<tr>
				<td>Team description: </td>
				<td><div class="form-group">
 				 <textarea class="form-control" rows="5" id="description"  name="description"><?=$team['description'];?>
 				 	
 				 </textarea>
				</div></td>
			</tr>
	     	</div>


	     	<div class="form-group">
        <tr>
        	<td>Department: </td>
        	<td>
    <select  class="form-control" id="department" name="department" required>
      <?php
           do {
      ?>
      <option value="<?= $departmen1['name'] ?>"  <?php if($department2['name'] == $departmen1['name']) { ?> selected="selected"  <?php } ?>    ><?= $departmen1['name'] ?></option>
      <?php
        } while($department1 = mysqli_fetch_assoc($department1_query));
      ?>
    </select> </td>
</tr>
  </div>

			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="edit" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>

<?php
}
?>