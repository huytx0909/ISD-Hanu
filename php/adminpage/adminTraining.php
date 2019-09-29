<?php 
	
  $training_sql = "SELECT * FROM training";
  if($training_query = mysqli_query($db,$training_sql)) {
  $training = mysqli_fetch_assoc($training_query);

 }

    $todayDate = date("Y-m-d");


 $list = 0;
 ?>




  
  <div class = "header">
    <h3 align="center">Training course</h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTraining" >Add new training course</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTraining">
            <button class="btn btn-outline-success" type="submit" name="searchTraining">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>List</th>                  
                        <th>Training Course Name</th> 
                        <th>Trainer</th>                                                                               
                        <th>Description</th>
                        <th> Max number of trainees</th> 
                      <th>  number of trainees</th> 
                        <th>Start Date</th>
                       <th>End Date</th>                        
                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   

                            $IDtrainer = $training['id_trainer'];
                            $trainer_sql = "SELECT * FROM user where id = '$IDtrainer'";
                          if($trainer_query = mysqli_query($db,$trainer_sql)) {
                           $trainer = mysqli_fetch_assoc($trainer_query);
                                                                            }            


                            ?>
                      

                                <td>
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td class="" align="center"><a href="admin.php?adminpage=adminTrainee&IDtraining=<?=$training['id'];?>" style="color: black;"><strong><?= $training['training_name']; ?></strong>
                             </td>

                              <td class="" align="center"><?= $trainer['username']; ?>
                              </td>

                               <td class="" align="center"><?= $training['description']; ?>
                              </td>

                               <td class="" align="center"><?= $training['max_trainees']; ?>
                              </td>

                               <td class="" align="center"><?= $training['number_trainees']; ?>
                              </td>

                               <td class="" align="center"><?php if(isset($training['start_date'])) {  echo date("d-m-Y",strtotime($training['start_date'])); } ?>
                              </td>

                               <td class="" align="center"><?php if(isset($training['end_date'])) {  echo date("d-m-Y",strtotime($training['end_date'])); } ?>
                              </td>

                                                                                       

                         <td align="center">
                          <?php
                          if($training['number_trainees'] < $training['max_trainees'] && $todayDate < $training['start_date'] ) {
                          ?>
                         <a href = "admin.php?adminpage=addTrainee&IDtraining=<?=$training['id'];?>" class="btn btn-success">enroll</a>

                        <?php
                          }
                          ?>

                        <a href = "admin.php?adminpage=editTraining&ID=<?=$training['id'];?>" class="btn btn-primary">
                             Edit</a>
                        <a href = "admin.php?adminpage=deleteTraining&ID=<?=$training['id'];?>" class="btn btn-danger">
                            </span>Delete</a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($training = mysqli_fetch_assoc($training_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
             
        </div>
    </div>
</div>

