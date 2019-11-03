<?php



if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



if(isset($_GET['teamID']))  {
 $teamID = $_GET['teamID'];
  $todayDate = date("Y-m-d");


 $team_sql = "SELECT * FROM team where id = '$teamID'";
 $team_query = mysqli_query($db, $team_sql);
 $team = mysqli_fetch_assoc($team_query);

  $user_sql = "SELECT * FROM user where id_team = '$teamID'";
 $user_query = mysqli_query($db, $user_sql);




 $task_sql = "SELECT * FROM task where id_team = '$teamID' ORDER BY deadline DESC";
	$task_query = mysqli_query($db, $task_sql);


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
		  	<a class="btn btn-secondary team-btn" href="user.php?userpage=userTeams" data-aos="fade-down">back</a>

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
						<span <?php if($task['deadline'] < $todayDate) { ?> style="color: red;"  <?php } ?> > Deadline: <?php if(isset($task['deadline'])) {  echo date("d/m/Y",strtotime($task['deadline'])); } ?></span>
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
?>