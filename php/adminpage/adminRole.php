<?php 
  $role_sql = "SELECT * FROM role";
  $role_query = mysqli_query($db,$role_sql);
 
 ?>


  
  <div class = "header">
    <h2>Role table</h2>
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
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addRole">Add new role</a></button>     
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextRole">
              <button class="btn btn-outline-success" type="submit" name="searchRole">Search</button>
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
                        <th>Role</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                         <?php 
                         while($role = mysqli_fetch_assoc($role_query)) {
                           ?>
                      

                     
                      


                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminRoleUser&IDrole=<?=$role['id'];?>"><strong><?= $role['name']; ?></strong>
                             </a></td>

                       <td align="center" class="cell-breakWord"><?= $role['description']; ?></td>
                           
                        <td align="center">
                          <a href = "admin.php?adminpage=editRole&ID=<?=$role['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                              <i class="far fa-edit"></i></a>
                          <a href = "admin.php?adminpage=deleteRole&ID=<?=$role['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                              <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>