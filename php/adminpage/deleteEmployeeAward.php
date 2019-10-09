<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
 $delete_sql = "DELETE FROM employee_award WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	$_SESSION['success'] = "Success.";
 	echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeAward';
    </script>";
 }


}

?>