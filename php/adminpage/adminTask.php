<?php 
	
  $task_sql = "SELECT * FROM task ORDER BY deadline DESC";
  if($task_query = mysqli_query($db,$task_sql)) {
  $task = mysqli_fetch_assoc($task_query);

 }
  $todayDate = date("Y-m-d");

 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Task Management</h2>
  </div> 

  
  <div class="container">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTask" >Add new task!</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTask">
            <button class="btn btn-outline-success" type="submit" name="searchTask">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Task name</th>                   
                        <th>Team</th>                   
                        <th>Description</th>
                        <th>deadline</th>
                       <th>status</th>
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;
                            $IDteam = $task['id_team']; 
                            $team_sql = "SELECT * FROM team where id = '$IDteam'";
                            $team_query = mysqli_query($db, $team_sql);
                            $team = mysqli_fetch_assoc($team_query);


                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td class="" align="center" class="cell-breakWord"><?= $task['task_name']; ?>
                             </td>

                               <td class="" align="center" class="cell-breakWord"><?= $team['name']; ?>
                              </td>

                              <td class="" align="center" class="cell-breakWord"><?= $task['description']; ?>
                              </td>

                              <td class="" align="center" class="cell-breakWord" <?php if($task['deadline'] < $todayDate) { ?> style="color: red;"  <?php } ?> > <?php if(isset($task['deadline'])) {  echo date("d-m-Y",strtotime($task['deadline'])); } ?>
                              </td>

                    
                              <td align="center" class="cell-breakWord"><span <?php if($task['status'] == "completed") { ?> class="badge badge-success" <?php } else if($task['status'] == "incompleted") { ?>  class="badge badge-danger" <?php } ?>  ><?= $task['status']; ?></span></td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editTask&ID=<?=$task['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTask&ID=<?=$task['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($task = mysqli_fetch_assoc($task_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
             
        </div>
    </div>
</div>

