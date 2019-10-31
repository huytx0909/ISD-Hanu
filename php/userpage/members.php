<?php


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



if(isset($_GET['teamID'])) {
$teamID = $_GET['teamID'];

$team_query = mysqli_query($db, "SELECT * FROM team where id = '$teamID'");
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
?>