<?php 
  if(isset($_GET['IDdepartment'])) {
    $IDdepartment = $_GET['IDdepartment'];
	
  $team_sql = "SELECT * FROM team where id_department = '$IDdepartment'";
  $team_query = mysqli_query($db,$team_sql);

 


  $department0_sql = "SELECT * FROM department where id = '$IDdepartment'";
    if($department0_query = mysqli_query($db,$department0_sql)) {
    $department0 = mysqli_fetch_assoc($department0_query);
                }                                                                


 ?>
  
  <div class = "header">
    <h2>Teams of <?= $department0['name']; ?> Department </h2>
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
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTeam">Add new team</a></button>                  
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
                        <th>Team name</th>               
                        <th>Description</th>
                        <th>Department</th>                        
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>       
                    <tr>
                      <?php 
                        while($team = mysqli_fetch_assoc($team_query)) {
                          $department_sql = "SELECT * FROM department where id = '$IDdepartment'";
                        if($department_query = mysqli_query($db,$department_sql)) {
                          $department = mysqli_fetch_assoc($department_query);
                        }            
                      ?>
                      

                      

                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminTeamUser&IDteam=<?=$team['id'];?>"><strong><?= $team['name']; ?></strong></a></td>
                      <td align="center" class="cell-breakWord"><?= $team['description']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $department['name']; ?></td>                               
                      <td align="center">
                        <a href = "admin.php?adminpage=editTeam&ID=<?=$team['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                          <i class="far fa-edit"></i></a>
                        
                        <a href = "admin.php?adminpage=deleteTeam&IDteam=<?=$team['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
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
<?php

}
?>

