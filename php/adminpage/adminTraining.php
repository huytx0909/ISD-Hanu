<?php 
	
  $training_sql = "SELECT * FROM training ORDER BY training_name ASC";
  $training_query = mysqli_query($db,$training_sql);

 

    $todayDate = date("Y-m-d");


 $list = 0;
 ?>
  
  <div class = "header">
    <h2>Training course</h2>
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
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addTraining">Add new training course</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTraining">
            <button class="btn btn-outline-success" type="submit" name="searchTraining">Search</button>
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
                          while($training = mysqli_fetch_assoc($training_query)) {
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
                      <td align="center" class="cell-breakWord"><?php if(isset($training['start_date'])) {  echo date("d/m/Y",strtotime($training['start_date'])); } ?></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($training['end_date'])) {  echo date("d/m/Y",strtotime($training['end_date'])); } ?></td>                                                               
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
                        <a href = "admin.php?adminpage=deleteTraining&ID=<?=$training['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
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