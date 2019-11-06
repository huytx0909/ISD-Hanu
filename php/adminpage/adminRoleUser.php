<?php 
  if(isset($_GET['IDrole'])) {
    $IDrole = $_GET['IDrole'];
	
  $user_sql = "SELECT * FROM user where id_role = '$IDrole'";
  $user_query = mysqli_query($db,$user_sql);

 

  $role1_sql = "SELECT * FROM role where id = '$IDrole'";
  if($role1_query = mysqli_query($db,$role1_sql)) {
  $role1 = mysqli_fetch_assoc($role1_query);

 }

 ?>
  
  <div class = "header">
    <h2>Users have <?= $role1['name']; ?> Role</h2>
  </div>

  <div class="container-fluid"> 
  <div class="main">
    <div class="row">
      <div class="col-sm-11 col-xl-12">
      <?php 
        if (isset($_SESSION['success'])) {
        echo "<div class='success' id='msg'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
        } 
      ?>
      <?php 
        if (isset($_SESSION['error'])) {
        echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
        } 
      ?>
      </div>
    </div>  
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add User</button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search&IDrole=<?=$IDrole;?>" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextRoleUser">
            <button class="btn btn-outline-success" type="submit" name="searchRoleUser">Search</button>
          </form>
        </div>
      </div>
    <div class="clearfix"></div>
    </div>

    <div class="row">
      <div class="col-11 col-md-11 col-xl-12 table-responsive">
        <table class="table">
          <thead class="thead-dark">
              <tr>
                <th>Username</th> 
                <th>Fullname</th>                                 
                <th>Email</th>
                <th>Phone</th>                        
                <th>Gross Salary</th>
                <th>Address</th>
                <th>Department</th>
                <th>Team</th>
                <th>Actions</th>
              </tr>
          </thead>
          <tbody>    
              <tr>
                <?php 
                  while($user = mysqli_fetch_assoc($user_query)) {
                    $IDdepartment = $user['id_department'];
                    $IDteam = $user['id_team'];
                    $IDrole = $user['id_role']; 
                    $departmentSql = "SELECT * FROM department WHERE id = '$IDdepartment'";
                    $teamSql = "SELECT * FROM team WHERE id = '$IDteam' ";
                    $roleSql = "SELECT * FROM role WHERE id = '$IDrole' ";
                    // get result
                  
                    if($departmentResult = mysqli_query($db, $departmentSql)){
                        $departmentName = mysqli_fetch_assoc($departmentResult);

                    }

                           if($teamResult = mysqli_query($db, $teamSql)) {
                             $teamName = mysqli_fetch_assoc($teamResult);
                           }


                           if($roleResult = mysqli_query($db, $roleSql)){

                            $roleName = mysqli_fetch_assoc($roleResult);

                           }

                              //fetch to array

                            ?>     

               

                <td align="center" class="cell-breakWord"><?= $user['username']; ?></td>
                <td align="center" class="cell-breakWord"><?= $user['fullName']; ?></td>                
                <td align="center" class="cell-breakWord"><?= $user['email']; ?></td>
                <td align="center" class="cell-breakWord"><?= $user['phone']; ?></td>
                <td align="center" class="cell-breakWord"><?php $gross_salary = number_format($user['gross_salary']); echo $gross_salary; ?></td>
                <td align="center" class="cell-breakWord"><?= $user['address']; ?></td>
                <td align="center" class="cell-breakWord"><?= $departmentName['name']; ?></td>
                <td align="center" class="cell-breakWord"><?= $teamName['name']; ?></td>   
               
              

                <td align="center">
                    <a href = "admin.php?adminpage=deleteRoleUser&IDrole=<?=$user['id_role'];?>&ID=<?=$user['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                    <i class="far fa-trash-alt"></i></a>
                </td>
                  
              </tr>
              <?php 
                } 
              ?>
                </tbody>
          </table>  
        </div>
    </div>
</div>
</div> 

<?php 
 }
?>


<?php  
    if(isset($_GET['IDrole'])) {
      $IDrole1 = $_GET['IDrole'];
    if(isset($_POST['add'])) {

      if(isset($_POST['userRole'])) {
       $userRole = $_POST['userRole'];
       $userR = "";


      foreach($userRole as $userR) 
 {

       $userUpdate = "UPDATE user set id_role = '$IDrole1' where username = '$userR' ";
       $userUpdate_query = mysqli_query($db, $userUpdate);
       

  }  
      $_SESSION['success'] = "Success."; 
       echo "<script>
    window.location.href='admin.php?adminpage=adminRoleUser&IDrole=$IDrole';
    </script>"; 
         }  

          }

    $user_sql = "SELECT * FROM user where id_role != '$IDrole1' OR id_role IS null ";
    $user_query = mysqli_query($db,$user_sql);
    $user = mysqli_fetch_assoc($user_query);

  ?>
    

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="admin.php?adminpage=adminRoleUser&IDrole=<?=$IDrole1;?>" class="beta-form-checkout">

        <div class="modal-header">
         <div class="float-left">
          <h4 class="modal-title">List of users </h4></div>
        </div>
        <div class="modal-body">
          <?php
              if(mysqli_num_rows($user_query) > 0) {
             do { 
          ?>
                
          <div class="checkbox">
            <label><input type="checkbox" name="userRole[]" value="<?= $user['username']; ?>"> <?= $user['username']; ?> </label>
            </div>

            <?php
             } while($user = mysqli_fetch_assoc($user_query));
             } else {
              echo "There are no users in other roles!";
             }
            ?>

        </div>
        <div class="modal-footer">
          <input type="submit" name="add" value="submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </form>
      </div>
      
    </div>
  </div>



<?php
}
?>
