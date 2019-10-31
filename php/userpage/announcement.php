<?php 
	
if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



	
  $announce_sql = "SELECT * FROM announcement ORDER BY date_created DESC";
  $announce_query = mysqli_query($db,$announce_sql);

 

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
					 		if(mysqli_num_rows($announce_query) > 0) {
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
					} else {
					?>
					<h6>No announcements!</h6>							
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>