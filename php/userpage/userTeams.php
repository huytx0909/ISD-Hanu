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
 $userteamID = $user['id_team'];
 $userdepartmentID = $user['id_department'];

 $team_sql = "SELECT * FROM team where id != '$userteamID' AND id_department = '$userdepartmentID'";
  $team_query = mysqli_query($db, $team_sql);


 ?>


	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container team">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search&departmentID=<?=$userdepartmentID;?>" method="post" enctype="multipart/form-data">
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
						<h2><a href="user.php?userpage=userTeamsDetail&teamID=<?=$team['id'];?>" class="team-name"><?=$team['name']; ?></a></h2>
					</div>
					<?php
						} }
						else {
							?>
							<div class="item">
						<h6>No other teams.</h6>
					</div>

							<?php
						}
				?>
				</div>
			</div>
		</div>
	</div>