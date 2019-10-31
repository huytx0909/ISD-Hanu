<?php


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);
 $userID = $user['id'];

    $todayDate = date("Y-m-d");

	
  $training_sql = "SELECT * FROM training WHERE start_date > '$todayDate' ORDER BY training_name ASC";
  $training_query = mysqli_query($db,$training_sql);
 

 


?>
	




	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container training">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextTraining" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchTraining" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<a class="btn btn-primary team-btn" href="user.php?userpage=myTraining" data-aos="fade-down">My training courses</a>
				<div class="training-courses" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">List</th>
						      <th scope="col">Name</th>
						      <th scope="col">Trainer</th>
						      <th scope="col">Description</th>
						      <th scope="col">Max Trainees</th>
						      <th scope="col"> Trainees</th>
						      <th scope="col">Start Date</th>
						      <th scope="col">End Date</th>
						      <th>Actions</th>

						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($training_query) > 0) {
						  	$list = 0;
						  	while($training = mysqli_fetch_assoc($training_query)) {
						  		$list = $list + 1;

						  		 $IDtrainer = $training['id_trainer'];
                            $trainer_sql = "SELECT * FROM user where id = '$IDtrainer'";
                            $trainer_query = mysqli_query($db,$trainer_sql);
                             $trainer = mysqli_fetch_assoc($trainer_query);

                             $trainingID = $training['id'];

                             $trainee_query = mysqli_query($db,"SELECT * FROM trainee WHERE id_training = '$trainingID' and id_user = '$userID'");

						  	?>

						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><?= $training['training_name']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $trainer['username']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $training['description']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $training['max_trainees']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $training['number_trainees']; ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($training['start_date'])) {  echo date("d/m/Y",strtotime($training['start_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($training['end_date'])) {  echo date("d/m/Y",strtotime($training['end_date'])); } ?></td>
					          <td align="center" class="cell-breakWord">
					          	
					          	  <?php
                          if($training['number_trainees'] < $training['max_trainees'] && mysqli_num_rows($trainee_query) == 0 ) {
                          ?>
                          <a href = "user.php?userpage=enrollTraining&IDtraining=<?=$training['id'];?>" class="btn btn-success" data-toogle="tooltip" title="Enroll">
                            <i class="fas fa-user-plus"></i></a>

                        <?php
                          } else if(mysqli_num_rows($trainee_query) == 1) {
                          	?>

                          	  <a href = "user.php?userpage=deleteEnroll&ID=<?=$training['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">unenrol </a>

                          	<?php
                          }
                          ?>


					          </td>

						    </tr>
						    <?php
						    }
							} else {
								?>

								<h6>No training courses available</h6>
								<?php
							}
						    ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

