<?php 
	
  $task_sql = "SELECT * FROM task ORDER BY deadline DESC";
  $task_query = mysqli_query($db,$task_sql);

 
  $todayDate = date("Y-m-d");

 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Task Management</h2>
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
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTask" >Add new task</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTask">
            <button class="btn btn-outline-success" type="submit" name="searchTask">Search</button>
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
                       <th>List</th>                  
                        <th>Task Name</th>                   
                        <th>Team</th>                   
                        <th>Description</th>
                        <th>Deadline</th>
                       <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          while($task = mysqli_fetch_assoc($task_query)) {
                            $list = $list + 1;
                            $IDteam = $task['id_team']; 
                            $team_sql = "SELECT * FROM team where id = '$IDteam'";
                            $team_query = mysqli_query($db, $team_sql);
                            $team = mysqli_fetch_assoc($team_query);


                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $task['task_name']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $team['name']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $task['description']; ?>
                              </td>

                              <td align="center" class="cell-breakWord" <?php if($task['deadline'] < $todayDate) { ?> style="color: red;"  <?php } ?> > <?php if(isset($task['deadline'])) {  echo date("d/m/Y",strtotime($task['deadline'])); } ?>
                              </td>

                    
                              <td align="center" class="cell-breakWord"><span <?php if($task['status'] == "completed") { ?> class="badge badge-success" <?php } else if($task['status'] == "incompleted") { ?>  class="badge badge-danger" <?php } ?>  ><?= $task['status']; ?></span></td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editTask&ID=<?=$task['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTask&ID=<?=$task['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
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