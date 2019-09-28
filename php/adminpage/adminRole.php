<?php 
  $role_sql = "SELECT * FROM role";
  if($role_query = mysqli_query($db,$role_sql)) {
  $role = mysqli_fetch_assoc($role_query);
 }
 $list = 0;
 ?>


  
  <div class = "header">
    <h3 align="center">Role table</h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addRole">Add new role</a></button>

           
         
  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextRole">
            <button class="btn btn-outline-success" type="submit" name="searchRole">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Role</th>
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
                      


                        <td class="" align="center"><a href="admin.php?adminpage=adminRoleUser&IDrole=<?=$role['id'];?>" style="color: black;"><strong><?= $role['name']; ?></strong>
                             </a></td>

                       <td class="" align="center"><?= $role['description']; ?>
                              </td>
                           
                         <td align="center">
                        <a href = "admin.php?adminpage=editRole&ID=<?=$role['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        <a href = "admin.php?adminpage=deleteRole&ID=<?=$role['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>Delete</a>
                        </td>
                  
                    </tr>
                  <?php } while($role = mysqli_fetch_assoc($role_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
         
        </div>
    </div>
</div>