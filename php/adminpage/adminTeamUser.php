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
    <h3 align="center">User in <?= $team1['name']; ?> team</h3>
  </div> <br>

  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add user</button>
  </div>


      <div class="clearfix"></div>

  
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
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
                      


                              <td class="" align="center"><?= $user['username']; ?></a>
                              </td>

                               <td class="" align="center"><?= $user['email']; ?>
                              </td>


                              <td class="" align="center"><?= $user['phone']; ?>
                              </td>

                              <td class="" align="center"><?= $user['salary']; ?>
                              </td>

                              <td class="" align="center"><?= $user['address']; ?>
                              </td>


                                

                                 <td class="" align="center"><?= $departmentName['name']; ?>
                              </td>                               

                                 <td class="" align="center"><?= $teamName['name']; ?>
                              </td>   


                               <td class="" align="center"><?= $roleName['name']; ?>
                              </td>

                            

                              <td class="" align="center"><?php if(isset($user['date_created'])) { echo date("d-m-Y",strtotime($user['date_created'])); } ?>
                              </td>

                         <td align="center">
                      

                        <a href = "admin.php?adminpage=deleteTeamUser&IDteam=<?=$user['id_team'];?>&ID=<?=$user['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
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




<?php  
    if(isset($_GET['IDteam'])) {
      $IDteam1 = $_GET['IDteam'];
    if(isset($_POST['add'])) {

      if(isset($_POST['userTeam'])) {
       $userTeam = $_POST['userTeam'];
       $userT = "";


      foreach($userTeam as $userT) 
 {

       $userUpdate = "UPDATE user set id_team = '$IDteam1' where username = '$userT' ";
       $userUpdate_query = mysqli_query($db, $userUpdate);
       

  }  

      echo "<script>
alert('add successfully');
window.location.href='admin.php?adminpage=adminTeamUser&IDteam=$IDteam1';
</script>";
         }  

          }

    $user_sql = "SELECT * FROM user where id_team != '$IDteam1'";
    $user_query = mysqli_query($db,$user_sql);
    $user = mysqli_fetch_assoc($user_query);

  ?>
    

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="admin.php?adminpage=adminTeamUser&IDteam=<?=$IDteam1;?>" class="beta-form-checkout">

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
            <label><input type="checkbox" name="userTeam[]" value="<?= $user['username']; ?>"> <?= $user['username']; ?> </label>
            </div>

            <?php
             } while($user = mysqli_fetch_assoc($user_query));
             } else {
              echo "There are no users in other teams!";
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
