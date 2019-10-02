<?php 
  $department_sql = "SELECT * FROM department ORDER BY name ASC";
  if($department_query = mysqli_query($db,$department_sql)) {
  $department = mysqli_fetch_assoc($department_query);
 }
 $list = 0;
 ?>


  
  <div class = "header">
    <h2>Department Table</h2>
  </div>

  <div class="container">
  <?php
  
  if (isset($_SESSION['message'])) {
    echo "<div class='error' id='error'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
  }
  ?>
    <div class="float-left">
        <button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addDepartment">Add new department</a></button>        
  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextDepartment">
            <button class="btn btn-outline-success" type="submit" name="searchDepartment">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
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
                      
                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminDepartmentTeam&IDdepartment=<?=$department['id'];?>"><strong><?= $department['name']; ?></strong></a></td>
                      <td align="center" class="cell-breakWord"><?= $department['description']; ?></td>   
                      <td align="center">
                        <a href = "admin.php?adminpage=editDepartment&ID=<?=$department['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                        <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteDepartment&ID=<?=$department['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                        <i class="far fa-trash-alt" onclick="confirm('Are you sure you want to delete this');"></i></a>
                      </td>
                    </tr>
                  <?php } while($department = mysqli_fetch_assoc($department_query)); ?>

                </tbody>
           
            </table>
         
        </div>
    </div>
</div>