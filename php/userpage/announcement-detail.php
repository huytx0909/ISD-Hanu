<?php 


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}


	if(isset($_GET['ID'])) {
  $IDann = $_GET['ID'];
  $announce_sql = "SELECT * FROM announcement WHERE id = '$IDann'";
  if($announce_query = mysqli_query($db,$announce_sql)) {
  $announce = mysqli_fetch_assoc($announce_query);

 }

 ?>
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container announcement">
				  	<a class="btn btn-secondary team-btn" href="user.php?userpage=announcement" data-aos="fade-down">back</a>

		
		<div class="row">
			<div class="col-lg-12">	
				<div class="announcements" data-aos="fade-down">
					<div class="detail-item">
						<h2><?= $announce['title']; ?></h2>
						<p>Posted by <?=$announce['announcer'];?> |  <?php $date = date("d/m/Y",strtotime($announce['date_created'])); echo $date; ?></p>
						<p class="detail-content"><?= $announce['content']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>