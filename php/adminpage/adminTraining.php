<?php 
	
  $training_sql = "SELECT * FROM training ORDER BY training_name ASC";
  if($training_query = mysqli_query($db,$training_sql)) {
  $training = mysqli_fetch_assoc($training_query);

 }

    $todayDate = date("Y-m-d");


 $list = 0;
 ?>
  
  <div class = "header">
    <h2>Training course</h2>
  </div>
  
  <div class="container">
  <?php
  
  if (isset($_SESSION['message'])) {
    echo "<div class='error' id='error'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
  }
  ?>
    <div class="float-left">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addTraining">Add new training course</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTraining">
            <button class="btn btn-outline-success" type="submit" name="searchTraining">Search</button>
          </form>
  </div>

      <div class="clearfix"></div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th>List</th>                  
                      <th>Training Course Name</th> 
                      <th>Trainer</th>                                                                              
                      <th>Description</th>
                      <th>Max Number of Trainees</th> 
                      <th>Number of Trainees</th> 
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
                      }?>
                    
                      <td align="center"> 
                        <?= $list; ?>                  
                      </td>
                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminTrainee&IDtraining=<?=$training['id'];?>"><strong><?= $training['training_name']; ?></strong></a></td>
                      <td align="center" class="cell-breakWord"><?= $trainer['username']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $training['description']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $training['max_trainees']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $training['number_trainees']; ?></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($training['start_date'])) {  echo date("d-m-Y",strtotime($training['start_date'])); } ?></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($training['end_date'])) {  echo date("d-m-Y",strtotime($training['end_date'])); } ?></td>                                                               
                      <td align="center">
                          <?php
                          if($training['number_trainees'] < $training['max_trainees'] && $todayDate < $training['start_date'] ) {
                          ?>
                          <a href = "admin.php?adminpage=addTrainee&IDtraining=<?=$training['id'];?>" class="btn btn-success" data-toogle="tooltip" title="Enroll">
                            <i class="fas fa-user-plus"></i></a>

                        <?php
                          }
                          ?>
                        <a href = "admin.php?adminpage=editTraining&ID=<?=$training['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                          <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTraining&ID=<?=$training['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="confirm('Are you sure you want to delete this');">
                          <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($training = mysqli_fetch_assoc($training_query));
                   ?>
                 
                </tbody>

            </table>

</div>


