<?php 
  $department_sql = "SELECT * FROM department";
  if($department_query = mysqli_query($db,$department_sql)) {
  $department = mysqli_fetch_assoc($department_query);
 }
 $list = 0;
 ?>

  <div style="margin-left: 200px; padding: 20px;">
 <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextDepartment">
      <button class="btn btn-outline-success" type="submit" name="searchDepartment">Search</button>
    </form> </div>


  
  <div class = "header">
    <h3 align="center">Department table</h3>
  </div> <br>

  
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead>
                    <tr>
                       <th>list</th>                  
                        <th>Department</th>
                        <th>Description</th>

                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php do {  $list = $list + 1;   ?>
                      

                      <td>
                           
                                <h5><?= $list; ?></h5>
                                                 
                        </td>
                      


                        <td class=""><strong><a href="admin.php?adminpage=adminDepartmentTeam&IDdepartment=<?=$department['id'];?>" style="text-decoration-color: none;"><?= $department['name']; ?>
                             </a> </strong></td>

                       <td class=""><?= $department['description']; ?>
                              </td>
                           
                         <td>
                        <a href = "admin.php?adminpage=editDepartment&ID=<?=$department['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        </td>
                        <td>
                        <a href = "admin.php?adminpage=deleteDepartment&ID=<?=$department['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
                        </td>
                  
                    </tr>
                  <?php } while($department = mysqli_fetch_assoc($department_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
             <a href = "admin.php?adminpage=addDepartment" class="btn btn-success">
                            <span class="glyphicon glyphicon-remove"></span> add new department</a>
        </div>
    </div>
</div>