<?php
  if(isset($_GET['ID']) && isset($_GET['IDteam'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
     $IDteam = "";
     $IDteam = $_GET['IDteam'];

 $delete_sql = "UPDATE user SET id_team = NULL WHERE id = '$delete_ID'";
 $delete_query = mysqli_query($db, $delete_sql);
 	echo "<script>
    window.location.href='admin.php?adminpage=adminTeamUser&IDteam=$IDteam';
    </script>";
 


}

?>