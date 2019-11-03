<?php
   if(isset($_POST['searchMember'])) {

if(isset($_GET['teamID'])) {
$teamID = $_GET['teamID'];

$team_query = mysqli_query($db, "SELECT * FROM team where id = '$teamID'");
$team = mysqli_fetch_assoc($team_query);


  $searchMember=$_POST['searchtextMember'];
  if(empty($searchMember)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=members&teamID=$teamID';
    </script>"; 
  }
  	$role0_query = mysqli_query($db,"SELECT * FROM role where `name` LIKE '%$searchMember%'");
  	$role0 = mysqli_fetch_assoc($role0_query);
  	$roleID = $role0['id'];


   $user_sql = "SELECT * FROM user where `username` LIKE '%$searchMember%' AND id_team = '$teamID' or `fullName` LIKE '%$searchMember%' AND id_team = '$teamID' or `email` LIKE '%$searchMember%' AND id_team = '$teamID' or `phone` LIKE '%$searchMember%' AND id_team = '$teamID' or id_role = '$roleID' AND id_team = '$teamID' ";
 $user_query = mysqli_query($db, $user_sql);

if(mysqli_num_rows($user_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=members&teamID=$teamID';
    </script>";     
 }



?>


	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container team">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search&teamID=<?=$teamID;?>" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextMember" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="search" name="searchMember" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="members" data-aos="fade-down">
					<div class="item table-responsive">
						<h2><?=$team['name'];?></h2>
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Username</th>
						       <th scope="col">Full Name</th>

						      <th scope="col">Email</th>
						      <th scope="col">Phone</th>
						      <th scope="col">Role</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	$list = 0;
					 while ($user = mysqli_fetch_assoc($user_query)) {
					 		$list = $list + 1;

					 		$roleID = $user['id_role'];

					 		$role_query = mysqli_query($db, "SELECT * FROM role where id = '$roleID'");
							$role = mysqli_fetch_assoc($role_query);

							?>
						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><?=$user['username'];?></td>
						      <td align="center" class="cell-breakWord"><?=$user['fullName'];?></td>
						      <td align="center" class="cell-breakWord"><?=$user['email'];?></td>
						      <td align="center" class="cell-breakWord"><?=$user['phone'];?></td>
						      <td align="center" class="cell-breakWord"><?=$role['name'];?></td>

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
}
?>



















<?php
   if(isset($_POST['searchTeam'])) {

if(isset($_GET['departmentID'])) {
$departmentID = $_GET['departmentID'];



  $searchTeam=$_POST['searchtextTeam'];
  if(empty($searchTeam)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=userTeams';
    </script>"; 
  }



   $team_sql = "SELECT * FROM team where `name` LIKE '%$searchTeam%' AND id_department = '$departmentID'";
 $team_query = mysqli_query($db, $team_sql);

if(mysqli_num_rows($team_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=userTeams';
    </script>";     
 }


$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);


 ?>


	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container team">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search&departmentID=<?=$departmentID;?>" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextTeam" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="search" name="searchTeam" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<a class="btn btn-primary team-btn" href="user.php?userpage=userTeamsDetail&teamID=<?=$user['id_team'];?>" data-aos="fade-down">My Team</a>
				<div class="teams" data-aos="fade-down">
					<?php
					 if(mysqli_num_rows($team_query) > 0) {
					while ($team = mysqli_fetch_assoc($team_query)) {
					
					?>
					<div class="item">
						<h2><a href="user.php?userpage=userTeamsDetail&teamID<?=$team['id'];?>" class="team-name"><?=$team['name']; ?></a></h2>
					</div>
					<?php
						} }
						else {
							?>
							<div class="item">
						<h6>No other treams.</h6>
					</div>

							<?php
						}
				?>
				</div>
			</div>
		</div>
	</div>


	<?php
		}
		}
		?>	


















	<?php
	  if(isset($_POST['searchTask'])) {


if(isset($_GET['teamdetailID']))  {
 $teamID = $_GET['teamdetailID'];
  $todayDate = date("Y-m-d");


  $searchTask=$_POST['searchtextTask'];
  if(empty($searchTask)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=userTeamsDetail&teamID=$teamID';
    </script>"; 
  }



   $task_sql = "SELECT * FROM task where `task_name` LIKE '%$searchTask%' AND id_team = '$teamID' OR `description` LIKE '%$searchTask%' AND id_team = '$teamID' OR `deadline` LIKE '%$searchTask%' AND id_team = '$teamID' OR `status` LIKE '%$searchTask%' AND id_team = '$teamID' ";
 $task_query = mysqli_query($db, $task_sql);

if(mysqli_num_rows($task_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=userTeamsDetail&teamID=$teamID';
    </script>";     
 }




 $team_sql = "SELECT * FROM team where id = '$teamID'";
 $team_query = mysqli_query($db, $team_sql);
 $team = mysqli_fetch_assoc($team_query);

  $user_sql = "SELECT * FROM user where id_team = '$teamID'";
 $user_query = mysqli_query($db, $user_sql);

?>



	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container team">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search&teamdetailID=<?=$teamID;?>" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextTask" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="search" name="searchTask" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-8">	
				<div class="teams" data-aos="fade-down">
					<div class="item">
						<h2><?=$team['name'];?> Tasks</h2>
					</div>
					<?php
					if(mysqli_num_rows($task_query) > 0 ) {
					while ($task = mysqli_fetch_assoc($task_query)) {
				
					
					?>
					<div class="assigned-task">
						<h4><?=$task['task_name'];?></h4>
						<p>Desciption: <?=$task['description'];?></p>
						<span <?php if($task['deadline'] < $todayDate) { ?> style="color: red;"  <?php } ?> ><?php if(isset($task['deadline'])) {  echo date("d/m/Y",strtotime($task['deadline'])); } ?></span>
						<span <?php if($task['status'] == "completed") { ?> class="badge badge-success" <?php } else if($task['status'] == "incompleted") { ?>  class="badge badge-danger" <?php } ?>  ><?=$task['status'];?> </span>
					</div>
					<?php
					}
					} else {
						?>
							<div class="assigned-task">
						<h4>No tasks assigned</h4>
						
					</div>

						<?php
					}
					?>
					
				</div>
			</div>
			<div class="col-md-4">	
				<div class="teams" data-aos="fade-down">
					<div class="item">
						<h2><a href="" class="team-name">memebers</a></h2>
					</div>
					<?php
					 while ($user = mysqli_fetch_assoc($user_query)) {
					 
					?>
					<div class="member">
						<h4> <?= $user['fullName']; ?></h4>
					</div>
					<?php
						}
					?>
					
					<div class="member">
						<a href="user.php?userpage=members&teamID=<?=$teamID;?>">More...</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		}
	}
?>




















<?php
	  if(isset($_POST['searchTraining'])) {


  $searchTraining = $_POST['searchtextTraining'];
  if(empty($searchTraining)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=trainingCourses';
    </script>"; 
  }



   $training_sql = "SELECT * FROM training where `training_name` LIKE '%$searchTraining%' OR `description` LIKE '%$searchTraining%' OR `start_date` LIKE '%$searchTraining%' OR `end_date` LIKE '%$searchTraining%' ";
 $training_query = mysqli_query($db, $training_sql);

if(mysqli_num_rows($training_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=trainingCourses';
    </script>";     
 }



$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);
 $userID = $user['id'];

    $todayDate = date("Y-m-d");

 


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
<?php
}
?>










<?php 
	  if(isset($_POST['searchLeave'])) {


  $searchLeave = $_POST['searchtextLeave'];
  if(empty($searchLeave)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=leaveApplication';
    </script>"; 
  }



   $leave_sql = "SELECT * FROM leave_application where `application_date` LIKE '%$searchLeave%' OR `personal_reason` LIKE '%$searchLeave%' OR `start_date` LIKE '%$searchLeave%' OR `end_date` LIKE '%$searchLeave%' OR `status` LIKE '%$searchLeave%' ";
 $leave_query = mysqli_query($db, $leave_sql);

if(mysqli_num_rows($leave_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=leaveApplication';
    </script>";     
 }

 

 $list = 0;
 ?>
  
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container leave-application">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextLeave" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchLeave" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<a class="btn btn-primary leave-btn" href="user.php?userpage=addLeaveApplication" data-aos="fade-down">New Leave Application</a>
				<div class="leave-applications" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">List</th>
						      <th scope="col">Application date</th>
						      <th scope="col">Leave type</th>
						      <th scope="col">Personal reason</th>
						      <th scope="col">Start date</th>
						      <th scope="col">End date</th>
						      <th scope="col">Status</th>
						      <th scope="col">Action</th>

						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($leave_query) > 0 ) {
						  	while ($leave = mysqli_fetch_assoc($leave_query)) {	
						  	$list = $list + 1;
						  							  	
						  	?>

						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><?php if(isset($leave['application_date'])) {  echo date("d/m/Y",strtotime($leave['application_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?=$leave['leave_type'];?></td>
						      <td align="center" class="cell-breakWord"><?=$leave['personal_reason'];?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($leave['start_date'])) {  echo date("d/m/Y",strtotime($leave['start_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($leave['end_date'])) {  echo date("d/m/Y",strtotime($leave['end_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><span <?php if($leave['status'] == "accepted") { ?> class="badge badge-success" <?php } else if($leave['status'] == "pending") { ?>  class="badge badge-warning" <?php } else { ?> class="badge badge-danger" <?php } ?>  ><?= $leave['status']; ?></span></td>

						 <?php
						 if($leave['status'] == "pending") {
						 ?>
                         <td align="center">
                        <a href = "user.php?userpage=editLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "user.php?userpage=deleteLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                        <?php
                    	}
                    	?>

						    </tr>

						    <?php
							}
							} else {
								?>
								<h6>No leave applications.</h6>
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














<?php 

	  if(isset($_POST['searchAnnouncement'])) {


  $searchAnnouncement = $_POST['searchtextAnnouncement'];
  if(empty($searchAnnouncement)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=announcement';
    </script>"; 
  }



   $announce_sql = "SELECT * FROM announcement where `title` LIKE '%$searchAnnouncement%' OR `content` LIKE '%$searchAnnouncement%' OR `date_created` LIKE '%$searchAnnouncement%' OR `announcer` LIKE '%$searchAnnouncement%' ";
 $announce_query = mysqli_query($db, $announce_sql);

if(mysqli_num_rows($announce_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=announcement';
    </script>";     
 }



 

 $list = 0;
 ?>



	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container announcement">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextAnnouncement" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchAnnouncement" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="announcements" data-aos="fade-down">
					 <?php 
                           while($announce = mysqli_fetch_assoc($announce_query)) {
                            $list = $list + 1;   

                            $content1 = "";
                            if (strlen($announce['content']) < 100) {
                              $content1 = $announce['content'];
                            } else {

                           $content1 = substr($announce['content'], 100);
                                }                            

                            ?>

					<div class="item">
						<h2> <?= $announce['title']; ?></h2>
						<p>by  <?= $announce['announcer']; ?> | <?php if(isset($announce['date_created'])) {  echo date("d/m/Y",strtotime($announce['date_created'])); } ?></p>
						<p class="content"><?= $content1; ?>							
							</p>
						<span><a href="user.php?userpage=announcement-detail&ID=<?=$announce['id'];?>">More>></a></span>
					</div>
					<?php
					}
					?>
												
					
				</div>
			</div>
		</div>
	</div>

	<?php
	}

		?>







		<?php



	  if(isset($_POST['searchAward'])) {

$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
$user_query = mysqli_query($db, $user_sql);
	$user1 = mysqli_fetch_assoc($user_query); 
	$userID = $user1['id'];


  $searchAward = $_POST['searchtextAward'];
  if(empty($searchAward)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=awards';
    </script>"; 
  }



   $award_sql = "SELECT * FROM employee_award where `award_title` LIKE '%$searchAward%' AND id_user = '$userID' OR `gift_item` LIKE '%$searchAward%' AND id_user = '$userID' OR `award_amount` LIKE '%$searchAward%' AND id_user = '$userID' OR `award_date` LIKE '%$searchAward%' AND id_user = '$userID' ";
 $award_query = mysqli_query($db, $award_sql);

if(mysqli_num_rows($award_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=awards';
    </script>";     
 }



 $list = 0;
 ?>
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container award">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextAward" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchAward" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="awards" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Award title</th>
						      <th scope="col">Gift item</th>
						      <th scope="col">Award amount(VND)</th>
						      <th scope="col">Awarded date</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($award_query) > 0) {
						  	while ($award = mysqli_fetch_assoc($award_query)) {
						  	 $list = $list + 1;
						  	?>
						    <tr>
						      <th align="center"><?=$list; ?></th>
						      <td align="center" class="cell-breakWord"><?=$award['award_title']; ?></td>
						      <td align="center" class="cell-breakWord"><?=$award['gift_item']; ?></td>
						      <td align="center" class="cell-breakWord"><?php $awardAmount = number_format($award['award_amount']); echo $awardAmount; ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($award['award_date'])) {  echo date("d/m/Y",strtotime($award['award_date'])); } ?></td>
						    </tr>
						    <?php
							}
							} else {
								?>
								<h6>No awards.</h6>
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









 <?php 

	  if(isset($_POST['searchPenalty'])) {

$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
$user_query = mysqli_query($db, $user_sql);
	$user1 = mysqli_fetch_assoc($user_query); 
	$userID = $user1['id'];


  $searchPenalty = $_POST['searchtextPenalty'];
  if(empty($searchPenalty)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=penalties';
    </script>"; 
  }



   $deduction_sql = "SELECT * FROM salary_deduction where `deduction_amount` LIKE '%$searchPenalty%' AND id_user = '$userID' OR `deduction_reason` LIKE '%$searchPenalty%' AND id_user = '$userID' OR `deduction_date` LIKE '%$searchPenalty%' AND id_user = '$userID' ";
 $deduction_query = mysqli_query($db, $deduction_sql);

if(mysqli_num_rows($deduction_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
        alert('no results');
    window.location.href='user.php?userpage=penalties';
    </script>";     
 }


 
 $list = 0;
 ?>
  
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container penalty">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
					<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextPenalty" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchPenalty" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="penalties" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Deduction amount(VND)</th>
						      <th scope="col">Deduction reason</th>
						      <th scope="col">Deduction date</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($deduction_query) > 0 ) {
						  	   while ( $deduction = mysqli_fetch_assoc($deduction_query)) {
						  	            $list = $list + 1;
						  	

						  	?>
						    <tr>
						      <th align="center"><?= $list; ?></th>
						      <td align="center" class="cell-breakWord"><?php $deductAmount = number_format($deduction['deduction_amount']); echo $deductAmount; ?></td>
						      <td align="center" class="cell-breakWord"><?= $deduction['deduction_reason']; ?></td>
						      <td align="center" class="cell-breakWord"> <?php if(isset($deduction['deduction_date'])) {  echo date("d/m/Y",strtotime($deduction['deduction_date'])); } ?></td>
						    </tr>
						    <?php
							}
							} else {
								?>

								<h6>No penalties.</h6>
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







 <?php 


	  if(isset($_POST['searchOrder'])) {

$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
$user_query = mysqli_query($db, $user_sql);
	$user1 = mysqli_fetch_assoc($user_query); 
	$userID = $user1['id'];


  $searchOrder = $_POST['searchtextOrder'];
  if(empty($searchOrder)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=userOrderHistory';
    </script>"; 
  }

	$book0_query = mysqli_query($db, "SELECT * FROM book WHERE `book_title` LIKE '%$searchOrder%' OR `author_name` LIKE '%$searchOrder%' ");
	$book0 = mysqli_fetch_assoc($book0_query);
	$bookID = $book0['id'];


   $order_sql = "SELECT * FROM `order` WHERE `id_book` = '$bookID' AND `id_user` = '$userID' OR `placeOrder_date` LIKE '%$searchOrder%' AND `id_user` = '$userID'  OR `type` LIKE '%$searchOrder%' AND id_user = '$userID' OR `expired_date` LIKE '%$searchOrder%' AND id_user = '$userID' OR `status` LIKE '%$searchOrder%' AND id_user = '$userID' ";
 $order_query = mysqli_query($db, $order_sql);

if(mysqli_num_rows($order_query) == 0 ) {
    echo "<script>
    alert('no results.');
    window.location.href='user.php?userpage=userOrderHistory';
    </script>";   
 }


 

$list = 0;
 ?>




	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container order">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
					<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextOrder" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchOrder" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="orders-history" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">List</th>
						      <th scope="col">Book Name</th>
						      <th scope="col">Image</th>
						      <th scope="col">Author</th>
						      <th scope="col">Prize(VND)</th>
						      <th scope="col">Type of Order</th>
						      <th scope="col">Order Date</th>
						      <th scope="col">Expired Date</th>
						      <th scope="col">Status</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php

						  	if(mysqli_num_rows($order_query) > 0 ) {

						  	while($order = mysqli_fetch_assoc($order_query)) {
						  		  $list = $list + 1;

                            $IDbook = $order['id_book'];
                                 
                            $book_sql = "SELECT * FROM book where id = '$IDbook'";
                            if($book_query = mysqli_query($db,$book_sql)) {
                            $book = mysqli_fetch_assoc($book_query);
                             }
                              $IDimage = $book['id_image'];
                                   $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }

						  	?>
						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><?= $book['book_title']; ?></td>
						      <td align="center" class="cell-breakWord"><img src="img/<?= $image['url'];?>" width="50" height="50" alt="book"></td>
						      <td align="center" class="cell-breakWord"><?= $book['author_name']; ?></td>
						      <td align="center" class="cell-breakWord"><?php $book1 = number_format($book['prize']); echo $book1; ?></td>
						      <td align="center" class="cell-breakWord"><?= $order['type']; ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($order['placeOrder_date'])) { echo date("d/m/Y",strtotime($order['placeOrder_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($order['expired_date'])) {  echo date("d/m/Y",strtotime($order['expired_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><span <?php if($order['status'] == "completed") { ?> class="badge badge-success" <?php } else { ?>  class="badge badge-danger" <?php } ?> ><?= $order['status']; ?></span></td>
						    </tr>
						    <?php
							}
							} else {

								?>
								<h6>No orders.</h6>
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
















<?php



 if(isset($_POST['searchBook'])) {

  $searchBook = $_POST['searchtextBook'];
  if(empty($searchBook)){
    echo "<script>
    alert('please input text');
    window.location.href='user.php?userpage=order';
    </script>"; 
  }

	$cate_query = mysqli_query($db, "SELECT * FROM category WHERE `category_name` LIKE '%$searchBook%' ");
	$cate = mysqli_fetch_assoc($cate_query);
	$cateID = $cate['id'];


   $book_sql = "SELECT * FROM `book` WHERE `book_title` LIKE '%$searchBook%' OR `id_category` = '$cateID' OR `author_name` LIKE '%$searchBook%' OR `date_publication` LIKE '%$searchBook%' OR `prize` LIKE '%$searchBook%' OR `status` LIKE '%$searchBook%' OR `max_expired_day` LIKE '%$searchBook%'   ";
 $book_query = mysqli_query($db, $book_sql);

if(mysqli_num_rows($book_query) == 0 ) {
    echo "<script>
    alert('no results.');
    window.location.href='user.php?userpage=order';
    </script>";   
 }




 
?>
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>

	<div class="container order">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextBook" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchBook" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		<div class="orders">
			<div class="row" >
				<div class="col-md-3">
					<div class="categories" data-aos="fade-down">
						<h6 class=""><a href="user.php?userpage=order">All Categories</a></h6>
						<ul>
							<?php

                            $category_sql = "SELECT * FROM category ORDER BY category_name ASC";
                          $category_query = mysqli_query($db,$category_sql);
                         while($category = mysqli_fetch_assoc($category_query)) {
                                                                                         
							?>
							<li><a href="user.php?userpage=orderCategory&ID=<?=$category['id'];?>"><?=$category['category_name'];?></a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			
		
				<div class="col-md-9">
					<div class="books" data-aos="fade-down">
						<div class="row">
 							 <?php 
 							 if(mysqli_num_rows($book_query) > 0) {
                          while($book = mysqli_fetch_assoc($book_query)) {

                            $IDimage = $book['id_image'];
                            $IDcate = $book['id_category'];
                              $category1_sql = "SELECT * FROM category where id = '$IDcate'";
                          $category1_query = mysqli_query($db,$category1_sql);
							$category1 = mysqli_fetch_assoc($category1_query);

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }

                            ?>



							<div class="col-lg-3">
								<div class="book-info">
									<a  href="user.php?userpage=order&IDbook=<?=$book['id'];?>">	<img src="img/<?=$image['url'];?>"   aria-expanded="false" aria-controls="#success #book_info"></a>
									<a href="user.php?userpage=order&IDbook=<?=$book['id'];?>"  ><h5><?=$book['book_title'];?></h5></a>
									<p  <?php if($book['status'] == "unavailable") { ?> style="color: red; font-size: 12px;"  <?php } else { ?> style="color: green; font-size: 12px;" <?php } ?> > <?=$book['status'];?></p>
									

									<?php
										if($book['status'] != "unavailable") {
									?>
									<a href="user.php?userpage=order&IDbook=<?=$book['id'];?>&action=borrow" class="btn btn-primary" style="color:white;" data-toggle="tooltip" title="Borrow">
										<i class="fas fa-book"></i>
									</a>
									<a href="user.php?userpage=order&IDbook=<?=$book['id'];?>&action=purchase" class="btn btn-success" style="color:white;" data-toggle="tooltip" title="Purchase">
										<i class="fas fa-shopping-cart"></i>
									</a>
									<?php
								}
									?>
								</div>	

							</div>




							<?php
							}
							} else {

								?>
								<h6>No books available.</h6>
								<?php
							}
							?>		
				
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>


<?php
if(isset($_GET['IDbook'])) {
  $IDbook = $_GET['IDbook'];



     $book_sql = "SELECT * FROM book WHERE id = '$IDbook'";
$book_query = mysqli_query($db,$book_sql);
 

      $book = mysqli_fetch_assoc($book_query);

                            $IDimage = $book['id_image'];
                            $IDcate = $book['id_category'];
                              $category1_sql = "SELECT * FROM category where id = '$IDcate'";
                          $category1_query = mysqli_query($db,$category1_sql);
              $category1 = mysqli_fetch_assoc($category1_query);

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }




?>



 <div class="modal fade" id="book_info"  role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Book Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="float-left">
          <img src="img/<?=$image['url'];?>" width="230" height="400" alt="book">
        </div>

        <div class="book-info" style="margin-left: 250px;">
          <div><h2>Title: <?=$book['book_title'];?></h2></div>
          <div style="margin-top: 20px;"><p>Category: <?= $category1['category_name']; ?></p></div>
          <div style="margin-top: 20px;"><p>Author: <?=$book['author_name'];?></p></div>
          <div style="margin-top: 20px;"><p>Publication date: <?php if(isset($book['date_publication'])) { echo date("d/m/Y",strtotime($book['date_publication'])); } ?></p></div>
          <div style="margin-top: 20px;"><p>Prize(VND): <?php $prize = number_format($book['prize']); echo $prize; ?></p></div>
                    <div style="margin-top: 20px;"><p>Max Expired Days: <?=$book['max_expired_day'];?></p></div>

          <div  <?php if($book['status'] == "unavailable") { ?> style="color: red; margin-top: 20px;"  <?php } else { ?> style="color: green; margin-top: 20px;" <?php } ?>><p>Status: <?=$book['status'];?></p></div>
        </div>
      </div>


      <div class="modal-footer">
      	<?php
      	if(isset($_GET['action']) && $_GET['action'] == "borrow") {
      	?>
	<a href="user.php?userpage=addOrder&IDbook=<?=$book['id'];?>&action=borrow" class="btn btn-primary" style="color:white;" data-toggle="tooltip" title="Borrow">
	<i class="fas fa-book"></i>
	</a>
	<?php

		} else if (isset($_GET['action']) && $_GET['action'] == "purchase") {
		?>

		<a href="user.php?userpage=addOrder&IDbook=<?=$book['id'];?>&action=purchase" class="btn btn-success" style="color:white;" data-toggle="tooltip" title="Purchase">
			<i class="fas fa-shopping-cart"></i>
		</a>
	<?php
			}
	?>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#book_info').modal('show');
    });
</script>


<?php
}
}
?>










