<?php 
	
  $leave_sql = "SELECT * FROM leave_application ORDER BY application_date DESC";
  $leave_query = mysqli_query($db,$leave_sql);

  ?>
  
  <div class = "header">
    <h2>Leave Application</h2>
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
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addLeaveApplication" >Add new leave application </a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
         <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextLeave">
            <button class="btn btn-outline-success" type="submit" name="searchLeave">Search</button>
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
                        <th>Username</th>
                        <th>Fullname</th>                   
                        <th>Application date</th>
                        <th>Leave type</th>
                       <th>Personal reason</th>
                        <th>Start date</th>  
                       <th>End date</th>
                       <th>Status</th>                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          while($leave = mysqli_fetch_assoc($leave_query)) {
                            $IDuser = $leave['id_user']; 
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


                            ?>
                      

                              
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"> <?php if(isset($leave['application_date'])) {  echo date("d/m/Y",strtotime($leave['application_date'])); } ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $leave['leave_type']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $leave['personal_reason']; ?>
                              </td>

                            
                                 <td align="center" class="cell-breakWord"> <?php if(isset($leave['start_date'])) {  echo date("d/m/Y",strtotime($leave['start_date'])); } ?>
                              </td>    
                               <td align="center" class="cell-breakWord"> <?php if(isset($leave['end_date'])) {  echo date("d/m/Y",strtotime($leave['end_date'])); } ?>
                              </td>

                              <td align="center" class="cell-breakWord"><span <?php if($leave['status'] == "accepted") { ?> class="badge badge-success" <?php } else if($leave['status'] == "pending") { ?>  class="badge badge-warning" <?php } else { ?> class="badge badge-danger" <?php } ?>  ><?= $leave['status']; ?></span></td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
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