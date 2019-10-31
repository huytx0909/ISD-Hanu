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



	
  $trainee_sql = "SELECT * FROM trainee WHERE id_user = '$userID'";
  $trainee_query = mysqli_query($db,$trainee_sql);
 

 


?>
	




	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container training">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<a class="btn btn-secondary team-btn" href="user.php?userpage=trainingCourses" data-aos="fade-down">back</a>
				<div class="training-courses" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						<h2> Courses enrolled</h2>

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

						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($trainee_query) > 0) {
						  	$list = 0;
						  	while($trainee = mysqli_fetch_assoc($trainee_query)) {
						  		$list = $list + 1;

						  		$IDtraining = $trainee['id_training'];

						  		$training_query = mysqli_query($db,"SELECT * FROM training WHERE id = '$IDtraining' ");
						  		$training = mysqli_fetch_assoc($training_query);

						  		 $IDtrainer = $training['id_trainer'];
                            $trainer_query = mysqli_query($db,"SELECT * FROM user where id = '$IDtrainer'");
                             $trainer = mysqli_fetch_assoc($trainer_query);

                            

						  	?>

						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><a href="user.php?userpage=trainee&IDtraining=<?=$training['id'];?>"><?= $training['training_name']; ?></a></td>
						      <td align="center" class="cell-breakWord"><?= $trainer['username']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $training['description']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $training['max_trainees']; ?></td>
						      <td align="center" class="cell-breakWord"><?= $training['number_trainees']; ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($training['start_date'])) {  echo date("d/m/Y",strtotime($training['start_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($training['end_date'])) {  echo date("d/m/Y",strtotime($training['end_date'])); } ?></td>
					         

						    </tr>
						    <?php
						    }
							} else {
								?>

								<h6>No training courses enrolled</h6>
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