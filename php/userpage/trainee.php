<?php

if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



if(isset($_GET['IDtraining'])) {
$IDtraining = $_GET['IDtraining'];

 $trainee_query = mysqli_query($db,"SELECT * FROM trainee where id_training = '$IDtraining'");

 $training_sql = "SELECT * FROM training WHERE id = '$IDtraining'";
  $training_query = mysqli_query($db,$training_sql);
  $training = mysqli_fetch_assoc($training_query);


?>



	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container team">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="members" data-aos="fade-down">
					<div class="item table-responsive">
						<h2><?=$training['training_name'];?></h2>
						<h6>total trainees: <?php echo mysqli_num_rows($trainee_query); ?></h6>
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Username</th>
						       <th scope="col">Full Name</th>

						      <th scope="col">Email</th>
						      <th scope="col">Phone</th>
						      <th scope="col">Team</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	$list = 0;
					 while ($trainee = mysqli_fetch_assoc($trainee_query)) {
					 		$list = $list + 1;
					 		$traineeID = $trainee['id_user'];

					 		 $user_query = mysqli_query($db,"SELECT * FROM user where id = '$traineeID'");
					 		 $user = mysqli_fetch_assoc($user_query);


					 		$teamID = $user['id_team'];

					 		$team_query = mysqli_query($db, "SELECT * FROM team where id = '$teamID'");
							$team = mysqli_fetch_assoc($team_query);

							?>
						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord" <?php if($user['username'] == $_SESSION['user']) { ?> style="color: blue;" <?php } ?> ><?=$user['username'];?></td>
						      <td align="center" class="cell-breakWord"><?=$user['fullName'];?></td>
						      <td align="center" class="cell-breakWord"><?=$user['email'];?></td>
						      <td align="center" class="cell-breakWord"><?=$user['phone'];?></td>
						      <td align="center" class="cell-breakWord"><?=$team['name'];?></td>

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
	</div>
<?php
}
?>