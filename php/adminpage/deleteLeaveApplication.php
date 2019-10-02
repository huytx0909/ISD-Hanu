<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
 $delete_sql = "DELETE FROM leave_application WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	header("Location: admin.php?adminpage=adminLeaveApplication");
 }


}

?>