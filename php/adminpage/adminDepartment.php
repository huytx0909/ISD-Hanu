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
        <button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addDepartment">Add new department</a></button> 
      </div>       
    <div class="col-6 col-xl-4">
      <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextDepartment">
            <button class="btn btn-outline-success" type="submit" name="searchDepartment">Search</button>
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
                        <i class="far fa-trash-alt" onclick="return ConfirmDelete();"></i></a>
                      </td>
                    </tr>
                  <?php } while($department = mysqli_fetch_assoc($department_query)); ?>

                </tbody>
           
            </table>
         
        </div>
    </div>
</div>
</div>