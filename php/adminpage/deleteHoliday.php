<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
 $delete_sql = "DELETE FROM holiday WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	echo "<script>
    window.location.href='admin.php?adminpage=adminHoliday';
    </script>";
 }


}

?>