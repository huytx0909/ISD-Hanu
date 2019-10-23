<?php 
	if(isset($_GET['ID'])) {
  $IDann = $_GET['ID'];
  $announce_sql = "SELECT * FROM announcement WHERE id = '$IDann'";
  if($announce_query = mysqli_query($db,$announce_sql)) {
  $announce = mysqli_fetch_assoc($announce_query);

 }

 ?>

  
  <div class = "header" style="margin-left: 300px; margin-right: 150px;">
    <h2><?= $announce['title']; ?></h2>
    <h6 style="margin-left: 500px;">Posted by:<a href="admin.php?adminpage=adminProfile"> <?=$announce['announcer'];?></a> -  <?php $date = date("d/m/Y",strtotime($announce['date_created'])); echo $date; ?></h6>
 <button type="submit" class="btn btn-primary float-left" name="Submit">
    <a href="admin.php?adminpage=adminAnnouncement">
      <i class="fas fa-chevron-left"></i>
      Back
    </a>
  </button>
  </div> 

  <div class="container-fluid">
  <div class="main" style="margin-left: 300px; margin-right: 150px;">
   
    <div class="clearfix"></div>
        <div class="row">
          <div class="col-11 col-md-11 col-xl-12 table-responsive">
          <p><?= $announce['content']; ?></p>
             
        </div>
      
    </div>
</div>

</div>

<?php
}
?>