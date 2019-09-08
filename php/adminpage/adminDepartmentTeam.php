<?php 
  if(isset($_GET['IDdepartment'])) {
    $IDdepartment = $_GET['IDdepartment'];
	
  $team_sql = "SELECT * FROM team where id_department = '$IDdepartment'";
  if($team_query = mysqli_query($db,$team_sql)) {
  $team = mysqli_fetch_assoc($team_query);

 }

 $list = 0;
 ?>

 <div style="margin-left: 200px;">
 <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTeam">
      <button class="btn btn-outline-success" type="submit" name="searchTeam">Search</button>
    </form> </div>



  
  <div class = "header">
    <h3 align="center">Team table</h3>
  </div> <br>

  
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead>
                    <tr>
                       <th>list</th>                  
                        <th>Team name</th>               
                        <th>Description</th>
                        <th>Department</th>                        
                        

                        <th> </th>
                        <th> </th>
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
                      


                              <td class="" align="center"><?= $team['name']; ?></a>
                             </td>

                               <td class="" align="center"><?= $team['description']; ?>
                              </td>

                            

                                 <td class="" align="left"><?= $department['name']; ?>
                              </td>                               

                         <td>
                        <a href = "admin.php?adminpage=editTeam&ID=<?=$team['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        </td>
                        <td>
                        <a href = "admin.php?adminpage=deleteTeam&ID=<?=$team['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($team = mysqli_fetch_assoc($team_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
             <a href = "admin.php?adminpage=addTeam" class="btn btn-success">
                            <span class="glyphicon glyphicon-remove"></span> add new team</a>
        </div>
    </div>
</div>


<?php 
 }
?>