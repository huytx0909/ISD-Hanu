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
    <h2>Users Take Part in <?= $training['training_name']; ?> Training Course</h2>
  </div> 

  
  <div class="container">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th>List</th>                  
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

                          <td align="center" class="cell-breakWord"><?= $user['username']; ?></td>
                          <td align="center" class="cell-breakWord"><?= $user['email']; ?></td>
                          <td align="center" class="cell-breakWord"><?= $user['phone']; ?></td>
                          <td align="center" class="cell-breakWord"><?= $user['salary']; ?></td>
                          <td align="center" class="cell-breakWord"><?= $user['address']; ?></td>
                          <td align="center" class="cell-breakWord"><?= $departmentName['name']; ?></td>   
                          <td align="center" class="cell-breakWord"><?= $teamName['name']; ?></td>   
                          <td align="center" class="cell-breakWord"><?= $roleName['name']; ?></td>
                          <td align="center" class="cell-breakWord"><?php if(isset($user['date_created'])) { echo date("d-m-Y",strtotime($user['date_created'])); } ?></td>

                         <td align="center">
                          <a href = "admin.php?adminpage=deleteTrainee&ID=<?=$trainee['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="confirm('Are you sure you want to delete this');">
                              <i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                  <?php 

                      } while($trainee = mysqli_fetch_assoc($trainee_query));
                   ?>             
              </tbody>
            </table>      
</div>


<?php 
 }
?>