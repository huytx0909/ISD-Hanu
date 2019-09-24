<?php 
      require_once 'dbase/dbase.php';
      include 'include/head.php';
      include 'include/adminbar.php';

 ?>
<!-- header -->

     <div id="main">
 <?php
if(!isset($_GET['adminpage'])){
  include 'adminpage/adminUser.php';
} else {
  $adminpage=$_GET['adminpage'];
  include 'adminpage/'.$adminpage.'.php';
}


 ?>

</div>
<?php
include 'include/footer.php';
?>