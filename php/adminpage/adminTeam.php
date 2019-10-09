<?php 
	
  $team_sql = "SELECT * FROM team ORDER BY name ASC";
  if($team_query = mysqli_query($db,$team_sql)) {
  $team = mysqli_fetch_assoc($team_query);

 }

 $list = 0;
 ?>
  
  <div class = "header">
    <h2>Team Table</h2>
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
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTeam" >Add new team</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTeam">
            <button class="btn btn-outline-success" type="submit" name="searchTeam">Search</button>
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
                        <th>Team name</th>               
                        <th>Description</th>
                        <th>Department</th>                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                      <?php 
                        do {
                          $list = $list + 1;   
                          $IDdepartment = $team['id_department'];
                          $department_sql = "SELECT * FROM department where id = '$IDdepartment'";
                          if($department_query = mysqli_query($db,$department_sql)) {
                           $department = mysqli_fetch_assoc($department_query);
                          }            
                      ?>
                    
                      <td align="center">
                        <?= $list; ?>                 
                      </td>

                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminTeamUser&IDteam=<?=$team['id'];?>"><strong><?= $team['name']; ?></strong></td>
                      <td align="center" class="cell-breakWord"><?= $team['description']; ?></td>
                      <td class="" align="center"><?= $department['name']; ?></td>                               
                      <td align="center">
                        <a href = "admin.php?adminpage=editTeam&ID=<?=$team['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTeam&ID=<?=$team['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                      </td>

                    </tr>
                  <?php 

                      } while($team = mysqli_fetch_assoc($team_query));
                   ?>

                </tbody>

            </table>
             
        </div>
    </div>
</div>
</div>