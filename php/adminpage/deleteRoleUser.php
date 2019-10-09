<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
   if(isset($_GET['IDrole'])) {

       $IDrole = "";
       $IDrole = $_GET['IDrole'];

 $delete_sql = "UPDATE user SET id_role = null WHERE id= '$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	echo "<script>
    window.location.href='admin.php?adminpage=adminRoleUser&IDrole=$IDrole';
    </script>";
 }

}
}

?>