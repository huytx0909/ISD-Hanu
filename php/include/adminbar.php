<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="admin.php?">HR management</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <?php if(isset($_SESSION['admin'])) { ?>
        <a class="nav-link" href="#"><strong> <?=$_SESSION['admin']; ?> </strong> </a>
       <?php }  else { ?>
              <a class="nav-link" href="adminLogin.php"> Log in </a>
              <?php } ?>
      </li> 
      
       <li class="nav-item">
        <a class="nav-link" href="adminLogin.php"> Log out  </a>
      </li>
    </ul>
  </div>
</nav>

<div class="sidebar navbar-light bg-light">
 
  <ul>
      <li class="nav-item active">
          <a class="nav-link" href="admin.php?adminpage=adminUser
  ">User  <span class="sr-only">(current)</span></a>
        </li>
         <li class="nav-item active">
          <a class="nav-link" href="admin.php?adminpage=adminBook
  ">Book  <span class="sr-only"></span></a>
        </li>

         <li class="nav-item active">
          <a class="nav-link" href="admin.php?adminpage=adminDepartment
  "> Department <span class="sr-only"></span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="admin.php?adminpage=adminTeam
  "> Team <span class="sr-only"></span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="admin.php?adminpage=adminTraining
  "> Training <span class="sr-only"></span></a>
        </li>
    </ul>
</div>
</header>