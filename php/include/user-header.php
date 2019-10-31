<header>
	<nav class="navbar navbar-expand-lg navbar-light"  data-aos="fade-down">
  <a class="navbar-brand" href="user.php" style="color: white;font-size: 66px;padding: 20px;">Infore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <?php
      if(isset($_SESSION['user'])) {
      ?>
      <li class="nav-item">
        <a class="" href="user.php?userpage=index">Homepage</a>
      </li>
      <li class="nav-item">
        <a class="" href="user.php?userpage=userTeams">My Teams</a>
      </li>
      <li class="nav-item">
        <a class="" href="user.php?userpage=trainingCourses">Training Courses</a>
      </li>
      <li class="nav-item">
        <a class="" href="user.php?userpage=leaveApplication">Leave Application</a>
      </li>
      <li class="nav-item">
        <a class="" href="user.php?userpage=order">Order Book</a>
      </li>
      <li class="nav-item">
        <a class="" href="user.php?userpage=announcement">Announcement</a>
      </li>
       <li class="nav-item">
        <div class="dropdown">
          <a class="dropbtn"><?= $_SESSION['user']; ?> 
          <i class="fas fa-caret-down"></i></a>
          <div class="dropdown-content">
            <a class="dropdown-item" href="user.php?userpage=profile">
            <i class="far fa-id-card"></i>Profile</a>
            <a class="dropdown-item" href="user.php?userpage=awards">
            <i class="fas fa-award"></i>Awards</a>
            <a class="dropdown-item" href="user.php?userpage=penalties">
            <i class="fas fa-exclamation-triangle"></i>Penalties</a>
            <a class="dropdown-item" href="user.php?userpage=userOrderHistory">
            <i class="fas fa-shopping-cart"></i>Order History</a>
            <a class="dropdown-item" href="userLogout.php">
            <i class="fas fa-sign-out-alt"></i>Logout</a>
          </div>
        </div>
      </li>
      <?php
      } else {
      ?>
 <li class="nav-item">
        <a class="" href="user.php?userpage=index">Homepage</a>
      </li>
  <li class="nav-item">
        <a class="" href="user.php?userpage=announcement">Announcement</a>
      </li>
        <li class="nav-item">
        <a class="" href="userLogin.php">Sign In</a>
      </li>
      <?php
      }
      ?>
    </ul>

</nav>
</header>

