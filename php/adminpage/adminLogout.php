<?php 
session_destroy();
unset($_SESSION['admin']);
$SESSION['message'] = "Logged out";
header("location: adminLogin.php");
 ?>