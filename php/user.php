<?php 
      require_once 'dbase/dbase.php';
      include 'include/user-head.php';
      include 'include/user-header.php';

 ?>
<!-- header -->

<body>    	

 <?php




if(!isset($_GET['userpage'])){
  include 'userpage/index.php';
  
} else {
  $userpage=$_GET['userpage'];
  include 'userpage/'.$userpage.'.php';
}


 ?>
<script>   
  AOS.init();
</script>

 </body>

<?php
	include 'include/user-footer.php';
?>

