<?php 
      require_once 'dbase/dbase.php';
      include 'include/head.php';
      include 'include/adminbar.php';

 ?>
<!-- header -->
<body>

		
 <?php
  if(!isset($_SESSION['admin'])) {
      echo "<script>
    window.location.href='adminLogin.php';
    </script>"; 
       } else {

if(!isset($_GET['adminpage'])){
  include 'adminpage/adminUser.php';
} else {
  $adminpage=$_GET['adminpage'];
  include 'adminpage/'.$adminpage.'.php';
} 
  
}

 ?>

 <script type="text/javascript">
setTimeout(function() {
   $("#msg").hide(1000); 
},2000); 

 function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }
</script>
 
</body>
