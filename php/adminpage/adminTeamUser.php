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

  
  <div class="container">
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