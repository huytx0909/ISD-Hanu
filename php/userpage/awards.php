<?php

if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
$user_query = mysqli_query($db, $user_sql);
	$user1 = mysqli_fetch_assoc($user_query); 
	$userID = $user1['id'];
  $award_sql = "SELECT * FROM employee_award WHERE id_user = '$userID' ORDER BY award_date DESC";
  $award_query = mysqli_query($db,$award_sql);

 

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

