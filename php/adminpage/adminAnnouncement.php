<?php 
	
  $announce_sql = "SELECT * FROM announcement ORDER BY date_created DESC";
  if($announce_query = mysqli_query($db,$announce_sql)) {
  $announce = mysqli_fetch_assoc($announce_query);

 }

 $list = 0;
 ?>

  
  <div class = "header">
    <h2>Announcement table</h2>
  </div> 

  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-sm-11 col-xl-12">
      <?php 
        if (isset($_SESSION['success'])) {
        echo "<div class='success' id='msg'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
        } 
      ?>
      <?php 
        if (isset($_SESSION['error'])) {
        echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
        } 
      ?>
      </div>
    </div>  
    <div class="row">
      <div class="col-6 col-xl-8">  
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addAnnouncement" >Add new announcement</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextAnnouncement">
            <button class="btn btn-outline-success" type="submit" name="searchAnnouncement">Search</button>
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
          
        <div class="row">
          <div class="col-11 col-md-11 col-xl-12 table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th>list</th>                  
                      <th>title</th>               
                      <th>Posted by</th>
                      <th>Announcement Content</th>  
                      <th>Post date</th>                        
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody>       
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   

                            $content1 = "";
                            if (strlen($announce['content']) < 100) {
                              $content1 = $announce['content'];
                            } else {

                           $content1 = substr($announce['content'], 100);
                                }                            

                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminAnnouncementContent&&ID=<?=$announce['id'];?>"><strong> <?= $announce['title']; ?></strong></a>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $announce['announcer']; ?>
                              </td>

                             <td align="center" class="cell-breakWord"><?= $content1; ?><a href="admin.php?adminpage=adminAnnouncementContent&&ID=<?=$announce['id'];?>">Read more...</a>
                              </td>

                                 
                               <td align="center" class="cell-breakWord"> <?php if(isset($announce['date_created'])) {  echo date("d/m/Y",strtotime($announce['date_created'])); } ?>
                              </td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editAnnouncement&ID=<?=$announce['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                           <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteAnnouncement&ID=<?=$announce['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                           <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($announce = mysqli_fetch_assoc($announce_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
             
        </div>
    </div>
</div>

</div>