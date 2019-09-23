<?php 
  if(isset($_GET['IDdepartment'])) {
    $IDdepartment = $_GET['IDdepartment'];
	
  $team_sql = "SELECT * FROM team where id_department = '$IDdepartment'";
  if($team_query = mysqli_query($db,$team_sql)) {
  $team = mysqli_fetch_assoc($team_query);

 }


  $department0_sql = "SELECT * FROM department where id = '$IDdepartment'";
    if($department0_query = mysqli_query($db,$department0_sql)) {
    $department0 = mysqli_fetch_assoc($department0_query);
                }                                                                


 $list = 0;
 ?>

 



  
  <div class = "header">
    <h3 align="center">Teams of <?= $department0['name']; ?> Department </h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">

 <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTeam">Add new team</a></button>
                   
  </div>

 <div class="float-right">
 <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTeam">
      <button class="btn btn-outline-success" type="submit" name="searchTeam">Search</button>
    </form> </div>

      <div class="clearfix"></div>


    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Team name</th>               
                        <th>Description</th>
                        <th>Department</th>                        
                        

                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   


                            $department_sql = "SELECT * FROM department where id = '$IDdepartment'";
                          if($department_query = mysqli_query($db,$department_sql)) {
                           $department = mysqli_fetch_assoc($department_query);
                                                                            }            


                            ?>
                      

                                <td>
                           
                                <h5><?= $list; ?></h5>
                                                 
                                </td>
                      


                              <td class="" align="center"><a href="admin.php?adminpage=adminTeamUser&IDteam=<?=$team['id'];?>" style="color: black;"><strong><?= $team['name']; ?></strong>
                             </a>
                             </td>

                               <td class="" align="center"><?= $team['description']; ?>
                              </td>

                            

                                 <td class="" align="left"><?= $department['name']; ?>
                              </td>                               

                         <td align="center">
                        <a href = "admin.php?adminpage=editTeam&ID=<?=$team['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        
                        <a href = "admin.php?adminpage=deleteTeam&IDteam=<?=$team['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
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

<?php

}
?>

