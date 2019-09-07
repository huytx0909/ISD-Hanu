<?php
    if(isset($_SESSION['IDstudent'])) {
   $IDstu = $_SESSION['IDstudent'];
  $stu_sql = "SELECT * from student where student_id = '$IDstu'";
  $stu_query = mysqli_query($db, $stu_sql);
  $stu = mysqli_fetch_assoc($stu_query);
   }

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php?">HANU COURSE REGISTRATION</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     


      <li class="nav-item active">
        <a class="nav-link" href="index.php?page=subject
">Subject <span class="sr-only">(current)</span></a>
      </li>
    


       <?php 
        if(isset($_SESSION['IDstudent'])) {
        ?>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong> <?php echo $stu['full_name']; ?></strong> </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        
         <a class="dropdown-item" href="index.php?page=courseRegistered"> student home </a>
        <a class="dropdown-item" href="index.php?page=changeInfor"> change information </a>
              
         <a class="dropdown-item" href="index.php?page=changePassword"> change password </a>         
        </div>

         
        
      </li> 
       <?php } else { ?>
<li class="nav-item">
        <a class="nav-link" href="index.php?page=login
"> Log in </a>
      </li>
      <?php } ?>


       <li class="nav-item">
        <a class="nav-link" href="index.php?page=logout
"> Log out  </a>
      </li>
    </ul>
   

    <form class="form-inline" action="index.php?page=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
      <button class="btn btn-outline-success" type="submit" name="search">Search</button>
    </form>
  </div>
</nav>
