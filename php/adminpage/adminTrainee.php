<?php 
  if(isset($_GET['IDtraining'])) {
    $IDtraining = $_GET['IDtraining'];
	
  $trainee_sql = "SELECT * FROM trainee where id_training = '$IDtraining'";
  if($trainee_query = mysqli_query($db,$trainee_sql)) {
  $trainee = mysqli_fetch_assoc($trainee_query);

 }

   $training_sql = "SELECT * FROM training where id ='$IDtraining'";
  if($training_query = mysqli_query($db,$training_sql)) {
  $training = mysqli_fetch_assoc($training_query);

 }


 $list = 0;
 ?>

 



  
  <div class = "header">
    <h3 align="center">Users take part in <?= $training['training_name']; ?> training course</h3>
  </div> <br>

  
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Username</th>
                       <th>Fullname</th>               
               
                        <th>Email</th>
                        <th>Phone</th>                        
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
                            $IDuser = $trainee['id_user'];
                            $user_sql = "SELECT * FROM user where id ='$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


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

                              <td class="" align="center"><?= $user['fullName']; ?></a>
                              </td>

                               <td class="" align="center"><?= $user['email']; ?>
                              </td>


                              <td class="" align="center"><?= $user['phone']; ?>
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
                      

                            <a href = "admin.php?adminpage=deleteTrainee&ID=<?=$trainee['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($trainee = mysqli_fetch_assoc($trainee_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
            
        </div>
    </div>
</div>


<?php 
 }
?>