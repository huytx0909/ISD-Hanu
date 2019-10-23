
<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="admin.php?" style="width: 300px">Infore</a>
  <div>
    <ul class="navbar-nav">
      <?php
        if(isset($_SESSION['admin'])) {
          $admin = $_SESSION['admin'];
       ?>
      <li class="nav-item">
        <a class="nav-link" href="admin.php?adminpage=adminProfile"> 
          <?= $admin; ?>
          </a>
      </li>
      <?php
      }
      ?>

       <li class="nav-item">
        <a class="nav-link" href="adminLogout.php"> Log out 
          <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>
</nav>

<div class="sidebar navbar-light bg-light">
  <ul>
      <li class="img">
        <a href="admin.php?adminpage=adminProfile
  "><img src="img/tải xuống.png" alt="admin" height="70" width="70"></a>
        <a href="admin.php?adminpage=adminProfile
  " style="color: black;"><h4>Admin</h4></a>
      </li>
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
        <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminHoliday
"> Holiday List <span class="sr-only"></span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminLeaveApplication
"> Leave Application <span class="sr-only"></span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminTask
"> Task Assign <span class="sr-only"></span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminEmployeeAward
"> Employee Award <span class="sr-only"></span></a>
      </li>

         <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminEmployeeSalary"> Employee Salary List <span class="sr-only"></span></a>
      </li>

        <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminEmployeeDeduction"> Employee Penalty List <span class="sr-only"></span></a>
      </li>

        <li class="nav-item active">
        <a class="nav-link" href="admin.php?adminpage=adminAnnouncement"> Announcement List <span class="sr-only"></span></a>
      </li>
      
    </ul>
</div>
</header>

<script>
  window.addEventListener("beforeunload",function(e){
    NProgress.start();
    NProgress.done();
    NProgress.configure({ showSpinner: true });
},false);
</script>
