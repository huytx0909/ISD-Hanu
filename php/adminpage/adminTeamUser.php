<?php 
  if(isset($_GET['IDteam'])) {
    $IDteam = $_GET['IDteam'];
	
  $user_sql = "SELECT * FROM user where id_team = '$IDteam'";
  if($user_query = mysqli_query($db,$user_sql)) {
  $user = mysqli_fetch_assoc($user_query);

 }

  $team1_sql = "SELECT * FROM team where id = '$IDteam'";
  if($team1_query = mysqli_query($db,$team1_sql)) {
  $team1 = mysqli_fetch_assoc($team1_query);

 }

 $list = 0;
 ?>

  
  <div class = "header">
    <h2>User in <?= $team1['name']; ?> Team</h2>
  </div>
  
  <div class="container">
    <div class="float-left">
        <button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
        <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminRole" > User Role</a></button>
      </div>

      <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextUser">
            <button class="btn btn-outline-success" type="submit" name="searchUser">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th>list</th>                  
                      <th>Username</th>               
                      <th>Email</th>
                      <th>Phone</th>                        
                      <th>Salary</th>
                      <th>Address</th>
                      <th>Department</th>
                      <th>Team</th>
                      <th>Role</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody>   
                    <tr>
                        <?php 
                          do {
                            $list = $list + 1;  
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
                      

                        <td align="center">
                          <?= $list; ?>                
                        </td>

                        <td align="center" class="cell-breakWord"><?= $user['username']; ?></a></td>
                        <td align="center" class="cell-breakWord"><?= $user['email']; ?></td>
                        <td align="center" class="cell-breakWord"><?= $user['phone']; ?></td>
                        <td align="center" class="cell-breakWord"><?= $user['salary']; ?></td>
                        <td align="center" class="cell-breakWord"><?= $user['address']; ?></td>
                        <td align="center" class="cell-breakWord"><?= $departmentName['name']; ?></td>  
                        <td align="center" class="cell-breakWord"><?= $teamName['name']; ?></td>   
                        <td align="center" class="cell-breakWord"><?= $roleName['name']; ?></td>
                        <td align="center" class="cell-breakWord"><?php if(isset($user['date_created'])) { echo date("d-m-Y",strtotime($user['date_created'])); } ?></td>

                        <td align="center">
                          <a href = "admin.php?adminpage=deleteTeamUser&IDteam=<?=$user['id_team'];?>&ID=<?=$user['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($user = mysqli_fetch_assoc($user_query));
                   ?>

                </tbody>
            </table>            
        </div>
    </div>
</div>


<?php 
 }
?>