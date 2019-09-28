<?php 
  $department_sql = "SELECT * FROM department";
  if($department_query = mysqli_query($db,$department_sql)) {
  $department = mysqli_fetch_assoc($department_query);
 }
 $list = 0;
 ?>


  
  <div class = "header">
    <h3 align="center">Department table</h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addDepartment">Add new department</a></button>

           
         
  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextDepartment">
            <button class="btn btn-outline-success" type="submit" name="searchDepartment">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Department</th>
                        <th>Description</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php do { 
                          $list = $list + 1;   ?>
                      

                      <td align="center">
                           
                                <?= $list; ?>
                                                 
                        </td>
                      


                        <td class="" align="center"><a href="admin.php?adminpage=adminDepartmentTeam&IDdepartment=<?=$department['id'];?>" style="color: black;"><strong><?= $department['name']; ?></strong>
                             </a></td>

                       <td class="" align="center"><?= $department['description']; ?>
                              </td>
                           
                         <td align="center">
                        <a href = "admin.php?adminpage=editDepartment&ID=<?=$department['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        <a href = "admin.php?adminpage=deleteDepartment&ID=<?=$department['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>Delete</a>
                        </td>
                  
                    </tr>
                  <?php } while($department = mysqli_fetch_assoc($department_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
         
        </div>
    </div>
</div>