<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
 $delete_sql = "DELETE FROM team WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	header("Location: admin.php?adminpage=adminTeam");
 }


} else if(isset($_GET['IDteam'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['IDteam'];
 $delete_sql = "DELETE FROM team WHERE id='$delete_ID'";
 
 $team_sql = "SELECT * FROM team where id='$delete_ID'";
 if($team_query = mysqli_query($db, $team_sql)){
 	$team = mysqli_fetch_assoc($team_query);
 }
 $IDdepartment = $team['id_department'];
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	header("Location: admin.php?adminpage=adminDepartmentTeam&IDdepartment=$IDdepartment");
 }


}



?>