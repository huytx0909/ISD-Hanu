<?php 
   if(isset($_POST['search'])) {
	$search=$_POST['searchtext'];
	if(empty($search)){
		header("Location:admin.php?adminpage=adminBook");
	}



	$search_sql = "SELECT * FROM Book WHERE `book_title` LIKE '%$search%' or `author_name` LIKE '%$search%' or `date_publication` LIKE '%$search%' or `prize` LIKE '%$search%' or `status` LIKE '%$search%'";
   $list = 0;
   if(!empty($search_sql)){
   
        if($search_query= mysqli_query($db,$search_sql)){
     $searchbook = mysqli_fetch_assoc($search_query);	
     }
} 
?>

  <div class = "header">
    <h3 align="center">Book table</h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBook" > Add new Book</a></button>

        <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminBookCategory" > Book category</a></button>
         
  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>book title</th>               
                        <th>author</th>
                        <th>image</th>                        
                        <th>publication date</th>
                        <th>prize</th>
                        <th>status</th>
                        <th>max expired day</th>
                        <th>category</th>


                        <th>Actions</th>
                
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   

                            $IDcategory = $searchbook['id_category'];
                            $IDimage = $searchbook['id_image'];

                            $category_sql = "SELECT * FROM category where id = '$IDcategory'";
                          if($category_query = mysqli_query($db,$category_sql)) {
                           $category = mysqli_fetch_assoc($category_query);
                                                                            }               

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }



                            ?>
                      

                      <td  align="center">
                           
                                <?= $list; ?>
                                                 
                        </td>
                      


                              <td class=""  align="center"><?= $searchbook['book_title']; ?></a>
                              </td>

                               <td class=""  align="center"><?= $searchbook['author_name']; ?>
                              </td>



                                

                                <td class=""  align="center"><image src="img/<?= $image['url'];?>" width="50" height="50">
                              </td>

                                <td class=""  align="center"><?php if(isset($searchbook['date_publication'])) { echo date("d-m-Y",strtotime($searchbook['date_publication'])); } ?>
                              </td>

                                 <td class=""  align="center"><?= $searchbook['status']; ?>
                              </td>                               

                                 <td class=""  align="center"><?= $searchbook['prize']; ?>
                              </td>   


                               <td class=""  align="center"><?= $searchbook['max_expired_day']; ?>
                              </td>

                               <td class=""  align="center"><?= $category['category_name']; ?>
                              </td>

                         <td  align="center">
                        <a href = "admin.php?adminpage=editBook&ID=<?=$searchbook['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        <a href = "admin.php?adminpage=deleteBook&ID=<?=$searchbook['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Delete</a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($searchbook = mysqli_fetch_assoc($search_query));
                   ?>

                  

                </tbody>

            </table>
        </div>
    </div>
</div>
<?php
}
?>




<?php 
   if(isset($_POST['searchCategory'])) {
  $search=$_POST['searchtextCategory'];
  if(empty($search)){
    header("Location:admin.php?adminpage=adminBookCategory");
  }



  $search_sql = "SELECT * FROM category WHERE `category_name` LIKE '%$search%'";
   $list = 0;
   if(!empty($search_sql)){
   
        if($search_query= mysqli_query($db,$search_sql)){
     $searchCategory = mysqli_fetch_assoc($search_query); 
     }
} 
?>


 <div class = "header">
    <h3 align="center">Book category table</h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBookCategory" > Add new Category</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextCategory">
            <button class="btn btn-outline-success" type="submit" name="searchCategory">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Book Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php do {  $list = $list + 1;   ?>
                      

                      <td align="center">
                           
                                <?= $list; ?>
                                                 
                        </td>
                      


                        <td class="" align="center"><a href="admin.php?adminpage=adminBookinCate&IDcategory=<?=$searchCategory['id'];?>" style="color:black;"><?= $searchCategory['category_name']; ?>
                             </a></td>
                           
                         <td align="center">
                        <a href = "admin.php?adminpage=editBookCategory&ID=<?=$searchCategory['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        <a href = "admin.php?adminpage=deleteBookCategory&ID=<?=$searchCategory['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>Delete</a>
                        </td>
                  
                    </tr>
                  <?php } while($searchCategory = mysqli_fetch_assoc($search_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
        </div>
    </div>
</div>
<?php
}
?>



<?php 
   if(isset($_POST['searchDepartment'])) {
  $search=$_POST['searchtextDepartment'];
  if(empty($search)){
    header("Location:admin.php?adminpage=adminDepartment");
  }



  $department_sql = "SELECT * FROM department WHERE `name` LIKE '%$search%' or `description` LIKE '%$search%'";

     if(!empty($department_sql)){

  if($department_query = mysqli_query($db,$department_sql)) {
  $department = mysqli_fetch_assoc($department_query);
 }
  $list = 0;

}
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
                         <?php do {  $list = $list + 1;   ?>
                      

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

<?php
}
?>





<?php 

if(isset($_POST['searchTeam'])) {
  $search=$_POST['searchtextTeam'];
  if(empty($search)){
    header("Location:admin.php?adminpage=adminTeam");
  }
  
  $team_sql = "SELECT * FROM team WHERE `name` LIKE '%$search%' or `description` LIKE '%$search%'";

       if(!empty($team_sql)){

  if($team_query = mysqli_query($db,$team_sql)) {
  $team = mysqli_fetch_assoc($team_query);

 }
 $list = 0;

}
 ?>




  
  <div class = "header">
    <h3 align="center">Team table</h3>
  </div> <br>

  
  <div class="container" style="margin-top: 50px;">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTeam" >Add new team</a></button>

           <a href = "admin.php?adminpage=addTeam" >Add new team</a>
  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTeam">
            <button class="btn btn-outline-success" type="submit" name="searchTeam">Search</button>
          </form>
      </div>

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
                      

                                <td>
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td class="" align="center"><a href="admin.php?adminpage=adminTeamUser&IDteam=<?=$team['id'];?>" style="color: black;"><strong><?= $team['name']; ?></strong>
                             </td>

                               <td class="" align="center"><?= $team['description']; ?>
                              </td>

                            

                                 <td class="" align="center"><?= $department['name']; ?>
                              </td>                               

                         <td align="center">
                        <a href = "admin.php?adminpage=editTeam&ID=<?=$team['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        <a href = "admin.php?adminpage=deleteTeam&ID=<?=$team['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>Delete</a>
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










<?php
if(isset($_POST['searchUser'])) {
  $search=$_POST['searchtextUser'];
  if(empty($search)){
    header("Location:admin.php?adminpage=adminUser");
  }


function logConsole($msg) {
  echo "<script>console.log(" . json_encode($msg) . ")</script>";
}

//fetching data in descending order (lastest entry first)
 $user_sql ="SELECT * FROM user WHERE `id` LIKE '%$search%' or `username` LIKE '%$search%' or `fullName` LIKE '%$search%' or `email` LIKE '%$search%' or `phone` LIKE '%$search%' or `address` LIKE '%$search%' or `salary` LIKE '%$search%' or `level` LIKE '%$search%' ORDER BY id DESC";
if(!empty($user_sql)){

$result = mysqli_query($db, $user_sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Homepage</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style/index.css">
  <link rel="stylesheet" href="style/header.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  

  <div class = "header">
    <h3 align="center">User table</h3>
  </div> <br>
  <div class="container" style="margin-top: 50px;">
      <div class="float-left">
        <button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
      </div>

      <div class="float-right">

        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextUser">
            <button class="btn btn-outline-success" type="submit" name="searchUser">Search</button>
          </form>

      </div>

      <div class="clearfix"></div>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Salary</th>
            <th scope="col">Department</th>
            <th scope="col">Team</th>
            <th scope="col">Role</th>
            <th scope="col">Level</th>
            <th scope="col">Date Created</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php
while ($res = mysqli_fetch_array($result)) {
  // prepare query by id
  $departmentSql = "SELECT name FROM department WHERE id = " . $res['id_department'];
  $teamSql = "SELECT name FROM team WHERE id = " . $res['id_team'];
  $roleSql = "SELECT name FROM role WHERE id = " . $res['id_role'];

 if($departmentResult = mysqli_query($db, $departmentSql)){
  $departmentName = mysqli_fetch_array($departmentResult);
         $depart = $departmentName[0];        
                } else {
                  $depart = "none";
                }
  
  if($teamResult = mysqli_query($db, $teamSql)){
  $teamName = mysqli_fetch_array($teamResult);
    $team = $teamName[0];
  } else {
    $team = "none";
  }

  if( $roleResult = mysqli_query($db, $roleSql)){
  $roleName = mysqli_fetch_array($roleResult);
  $role = $roleName[0];
        } else {
          $role = "none";
        }

  echo "<tr>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['username'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['password'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['fullName'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['email'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['phone'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['address'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['salary'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $depart . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $team . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $role . "</td>";
    echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['level'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['date_created'] . "</td>";
  echo "<td align=\"center\"><button type=\"button\" class=\"btn btn-primary edit\"><a href=\"admin.php?adminpage=editUser&id=$res[id]\">Edit</a></button> | <button type=\"button\" class=\"btn btn-danger delete\"><a href=\"admin.php?adminpage=deleteUser&id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></button></td>";
}
?>
        </tbody>
      </table>
  </div>
</body>
</html>
<?php
}

?>





<?php 
   if(isset($_POST['searchRole'])) {
  $search=$_POST['searchtextRole'];
  if(empty($search)){
    header("Location:admin.php?adminpage=adminRole");
  }



  $role_sql = "SELECT * FROM role WHERE `name` LIKE '%$search%' or `description` LIKE '%$search%'";

     if(!empty($role_sql)){

  if($role_query = mysqli_query($db,$role_sql)) {
  $role = mysqli_fetch_assoc($role_query);
 }
  $list = 0;

}
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
                         <?php do {  $list = $list + 1;   ?>
                      

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

<?php
}
?>





<?php
if(isset($_POST['searchRoleUser'])) {
  if(isset($_GET['IDrole'])) {
    $IDrole = $_GET['IDrole'];
  $search=$_POST['searchtextRoleUser'];
  if(empty($search)){
    header("Location:admin.php?adminpage=adminRoleUser&IDrole=$IDrole");
  }


function logConsole($msg) {
  echo "<script>console.log(" . json_encode($msg) . ")</script>";
}

//fetching data in descending order (lastest entry first)
 $user_sql ="SELECT * FROM user WHERE id_role = $IDrole AND `id` LIKE '%$search%' or `username` LIKE '%$search%' or `email` LIKE '%$search%' or `phone` LIKE '%$search%' or `address` LIKE '%$search%' or `salary` LIKE '%$search%' ORDER BY id DESC";
if(!empty($user_sql)){

$result = mysqli_query($db, $user_sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Homepage</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style/index.css">
  <link rel="stylesheet" href="style/header.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  

  <div class = "header">
    <h3 align="center">User table</h3>
  </div> <br>
  <div class="container" style="margin-top: 50px;">
      <div class="float-left">
        <button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
      </div>

      <div class="float-right">

        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextUser">
            <button class="btn btn-outline-success" type="submit" name="searchUser">Search</button>
          </form>

      </div>

      <div class="clearfix"></div>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Salary</th>
            <th scope="col">Department</th>
            <th scope="col">Team</th>
            <th scope="col">Role</th>
            <th scope="col">Date Created</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php
while ($res = mysqli_fetch_array($result)) {
  // prepare query by id
  $departmentSql = "SELECT name FROM department WHERE id = " . $res['id_department'];
  $teamSql = "SELECT name FROM team WHERE id = " . $res['id_team'];
  $roleSql = "SELECT name FROM role WHERE id = " . $res['id_role'];

  // get result
  $departmentResult = mysqli_query($db, $departmentSql);
  $teamResult = mysqli_query($db, $teamSql);
  $roleResult = mysqli_query($db, $roleSql);

  //fetch to array
  $departmentName = mysqli_fetch_array($departmentResult);
  $teamName = mysqli_fetch_array($teamResult);
  $roleName = mysqli_fetch_array($roleResult);

  echo "<tr>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['username'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['password'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['email'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['phone'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['address'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['salary'] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $departmentName[0] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $teamName[0] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $roleName[0] . "</td>";
  echo "<td class=\"cell-breakWord\" align=\"center\">" . $res['date_created'] . "</td>";
  echo "<td align=\"center\"><button type=\"button\" class=\"btn btn-primary edit\"><a href=\"admin.php?adminpage=editUser&id=$res[id]\">Edit</a></button> | <button type=\"button\" class=\"btn btn-danger delete\"><a href=\"admin.php?adminpage=deleteUser&id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></button></td>";
}
?>
        </tbody>
      </table>
  </div>
</body>
</html>
<?php
}
}

?>


