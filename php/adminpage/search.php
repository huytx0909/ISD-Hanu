<?php 
   if(isset($_POST['search'])) {
  $search=$_POST['searchtext'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";       
    echo "<script>
    window.location.href='admin.php?adminpage=adminBook';
    </script>"; 
  }
  $search_sql = "SELECT * FROM Book WHERE `book_title` LIKE '%$search%' or `author_name` LIKE '%$search%' or `date_publication` LIKE '%$search%' or `prize` LIKE '%$search%' or `status` LIKE '%$search%'";
   
      if($search_query= mysqli_query($db,$search_sql)) {
     $searchbook = mysqli_fetch_assoc($search_query); 
        }
if(mysqli_num_rows($search_query) == 0) {
    $_SESSION['error'] = "No results.";       
    echo "<script>
    window.location.href='admin.php?adminpage=adminBook';
    </script>";     
 } 
    $list = 0;
?>

  <div class = "header">
    <h2>Book Table</h2>
  </div>
 
  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBook" > Add new Book</a></button>

        <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminBookCategory" > Book category</a></button>

        <button type="button" class="btn btn-warning"><a href = "admin.php?adminpage=adminBookOrder" > Book Order</a></button> 
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

     <div class="row">
        <div class="col-11 col-md-11 col-xl-12 table-responsive" >
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                       <th>List</th>                  
                        <th>Book Title</th>               
                        <th>Author</th>
                        <th>Image</th>                        
                        <th>Publication Date</th>
                        <th>Prize($)</th>
                        <th>Status</th>
                        <th>Max Expired Days</th>
                        <th>Category</th>
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
                      
                      <td align="center">
                          <?= $list; ?>                       
                      </td>
                      
                      <td align="center" class="cell-breakWord"><?= $searchbook['book_title']; ?></a></td>
                      <td align="center" class="cell-breakWord"><?= $searchbook['author_name']; ?></td>
                      <td align="center"><img src="img/<?= $image['url'];?>" width="50" height="50"></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($searchbook['date_publication'])) { echo date("d/m/Y",strtotime($searchbook['date_publication'])); } ?></td>
                      <td align="center" class="cell-breakWord"><?= $searchbook['status']; ?></td>                 
                      <td align="center" class="cell-breakWord"><?php $sbook = number_format($searchbook['prize']); echo $sbook; ?></td>   
                      <td align="center" class="cell-breakWord"><?= $searchbook['max_expired_day']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $category['category_name']; ?></td>

                      <td align="center">
                        <a href = "admin.php?adminpage=editBook&ID=<?=$book['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                        <i class="far fa-edit"></i></a>
                        
                        <a href = "admin.php?adminpage=deleteBook&ID=<?=$book['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                        <i class="far fa-trash-alt"></i></a>

                           <?php
                           if($searchbook['status'] == "available") {
                           ?>
                            <a href = "admin.php?adminpage=addBookOrder&ID=<?=$book['id'];?>" class="btn btn-success" data-toogle="tooltip" title="Order">
                            <i class="fas fa-shopping-cart" ></i></a>
                                 <?php
                               }
                                 ?>
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
</div>
<?php
}
?>



<?php 
   if(isset($_POST['searchCategory'])) {
  $search=$_POST['searchtextCategory'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
   echo "<script>
    window.location.href='admin.php?adminpage=adminBookCategory';
    </script>";   
  }
  $search_sql = "SELECT * FROM category WHERE `category_name` LIKE '%$search%'";
   $list = 0;
   if(!empty($search_sql)){   
        if($search_query= mysqli_query($db,$search_sql)){
     $searchCategory = mysqli_fetch_assoc($search_query); 
     }
}
 if(mysqli_num_rows($search_query) == 0) {
    $_SESSION['error'] = "No result.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminBookCategory';
    </script>";   
 } 
?>

 <div class = "header">
    <h2>Book Category Table</h2>
  </div>

  
 <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBookCategory" > Add new Category</a></button>
      </div>
       <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextCategory">
            <button class="btn btn-outline-success" type="submit" name="searchCategory">Search</button>
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-11 col-md-11 lco-xl-12 table-responsive" >
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                       <th>List</th>                  
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
                      
                        <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminBookinCate&IDcategory=<?=$searchCategory['id'];?>"><strong><?= $searchCategory['category_name']; ?></strong></a></td>
                           
                         <td align="center">
                        <a href = "admin.php?adminpage=editBookCategory&ID=<?=$searchCategory['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteBookCategory&ID=<?=$searchCategory['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                             <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php } while($searchCategory = mysqli_fetch_assoc($search_query)); ?>     

                </tbody>
           
            </table>
          </div>
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
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminDepartment';
    </script>";   
  }
  $department_sql = "SELECT * FROM department WHERE `name` LIKE '%$search%' or `description` LIKE '%$search%'";
     if(!empty($department_sql)){
  $department_query = mysqli_query($db,$department_sql);
  $department = mysqli_fetch_assoc($department_query);
 
  $list = 0;
}
if(mysqli_num_rows($department_query) == 0) {
$_SESSION['error'] = "No results.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminDepartment';
    </script>";   
 }
 ?>

  <div class = "header">
    <h2>Department Table</h2>
  </div>
  
  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addDepartment">Add new department</a></button>                   
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
                       <th>List</th>                  
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
                      
                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminDepartmentTeam&IDdepartment=<?=$department['id'];?>"><strong><?= $department['name']; ?></strong></a></td>

                       <td align="center" class="cell-breakWord"><?= $department['description']; ?></td>
                           
                        <td align="center">
                        <a href = "admin.php?adminpage=editDepartment&ID=<?=$department['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteDepartment&ID=<?=$department['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php } while($department = mysqli_fetch_assoc($department_query)); ?>
           </tbody>
            </table>
          </div>
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
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminTeam';
    </script>";   
  }
  
  $team_sql = "SELECT * FROM team WHERE `name` LIKE '%$search%' or `description` LIKE '%$search%'";
       if(!empty($team_sql)){
  $team_query = mysqli_query($db,$team_sql);
  $team = mysqli_fetch_assoc($team_query);
 
   $list = 0;
}
if(mysqli_num_rows($team_query) == 0) {
$_SESSION['error'] = "No results.";
   echo "<script>
    window.location.href='admin.php?adminpage=adminTeam';
    </script>";        
 }
 ?>


  
  <div class = "header">
    <h2>Team Table</h2>
  </div>

  
 <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTeam" >Add new team</a></button>
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
                      


                              <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminTeamUser&IDteam=<?=$team['id'];?>"><strong><?= $team['name']; ?></strong></a>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $team['description']; ?>
                              </td>

                            

                                 <td align="center" class="cell-breakWord"><?= $department['name']; ?>
                              </td>                               

                         <td align="center">
                        <a href = "admin.php?adminpage=editTeam&ID=<?=$team['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTeam&ID=<?=$team['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
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
</div>

<?php
}
?>



<?php
if(isset($_POST['searchUser'])) {
  $search=$_POST['searchtextUser'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminUser';
    </script>";   
  }
//fetching data in descending order (lastest entry first)
 $user_sql ="SELECT * FROM user WHERE `id` LIKE '%$search%' or `username` LIKE '%$search%' or `fullName` LIKE '%$search%' or `email` LIKE '%$search%' or `phone` LIKE '%$search%' or `address` LIKE '%$search%' or `gender` LIKE '%$search%' or `DOB` LIKE '%$search%' or `gross_salary` LIKE '%$search%' or `net_salary` LIKE '%$search%' or `level` LIKE '%$search%' ORDER BY id DESC";
if(!empty($user_sql)){
$result = mysqli_query($db, $user_sql);
}
if(mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "No results.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminUser';
    </script>";    
 }
?>
<body>
  <div class = "header">
    <h2>User Table</h2>
  </div>
  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
          <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminRole" > User Role</a></button>

      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextUser">
            <button class="btn btn-outline-success" type="submit" name="searchUser">Search</button>
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
            <th>Username</th>
            <th>Full Name</th>
      
            <th>Department</th>
            <th>Team</th>
            <th>Role</th>
            <th>Level</th>
            <th>Date Created</th>
            <th>Actions</th>
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

    ?>
  <tr>
   <td class="cell-breakWord" align="center"><a href="admin.php?adminpage=adminUserProfile&ID=<?=$res['id'];?>"><strong><?=$res['username']; ?></strong></a></td>
    <td class="cell-breakWord" align="center"><?=$res['fullName']; ?></td>
   
    <td class="cell-breakWord" align="center"><?=$depart; ?></td>
    <td class="cell-breakWord" align="center"><?=$team; ?></td>
    <td class="cell-breakWord" align="center"><?=$role; ?></td>
    <td class="cell-breakWord" align="center"><?=$res['level']; ?></td>
    <td class="cell-breakWord" align="center"><?=date("d/m/Y",strtotime($res['date_created'])); ?></td>
    <td align="center">
      <button type="button" class="btn btn-primary edit"><a href="admin.php?adminpage=editUser&ID=<?=$res['id'];?>" data-toogle="tooltip" title="Edit"><i class="far fa-edit"></i></a></button>  
      <button type="button" class="btn btn-danger" data-toogle="tooltip" title="Delete"><a href="admin.php?adminpage=deleteUser&ID=<?=$res['id'];?>" onclick="return ConfirmDelete();"><i class="far fa-trash-alt"></i></a></button>
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




<?php 
   if(isset($_POST['searchRole'])) {
  $search=$_POST['searchtextRole'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminRole';
    </script>";   
  }
  $role_sql = "SELECT * FROM role WHERE `name` LIKE '%$search%' or `description` LIKE '%$search%'";
     if(!empty($role_sql)){
  if($role_query = mysqli_query($db,$role_sql)) {
  $role = mysqli_fetch_assoc($role_query);
 }
  $list = 0;
}
if(mysqli_num_rows($role_query) == 0) {
    $_SESSION['error'] = "No results.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminRole';
    </script>";   
 }
 ?>
  
  <div class = "header">
    <h2>Role table</h2>
  </div> 

  <div class="container-fluid">
  <div class="main">
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
                        <th>List</th>                  
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
                  <?php } while($role = mysqli_fetch_assoc($role_query)); ?>
                </tbody>
            </table>
        </div>
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
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminRoleUser&IDrole=$IDrole';
    </script>";   
  }
//fetching data in descending order (lastest entry first)
 $user_sql ="SELECT * FROM user WHERE id_role = $IDrole AND `id` LIKE '%$search%' or `username` LIKE '%$search%' or `email` LIKE '%$search%' or `phone` LIKE '%$search%' or `address` LIKE '%$search%' or `gross_salary` LIKE '%$search%' or `net_salary` LIKE '%$search%' or `gender` LIKE '%$search%' or `DOB` LIKE '%$search%'  ORDER BY id DESC";
if(!empty($user_sql)){
$user_query = mysqli_query($db, $user_sql); 
$user = mysqli_fetch_assoc($user_query);   
 } 
  
  if(mysqli_num_rows($user_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminRoleUser&IDrole=$IDrole';
    </script>";
  }
  $role1_sql = "SELECT * FROM role where id = '$IDrole'";
  if($role1_query = mysqli_query($db,$role1_sql)) {
  $role1 = mysqli_fetch_assoc($role1_query);
 }
?>

<div class = "header">
    <h2>Users have <?= $role1['name']; ?> Role</h2>
  </div>

  
   <div class="container-fluid"> 
  <div class="main">
    
     <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add User</button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search&IDrole=<?=$IDrole;?>" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextRoleUser">
            <button class="btn btn-outline-success" type="submit" name="searchRoleUser">Search</button>
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
                <th>Username</th>
                 <th>Fullname</th>                          
                <th>Email</th>
                <th>Phone</th>                        
                <th>Gross Salary</th>
                <th>Address</th>
                <th>Department</th>
                <th>Team</th>
               
                <th>Date Created</th>
                <th>Actions</th>
              </tr>
          </thead>
          <tbody>    
              <tr>
                <?php 
                $list = 0;
                  do {
                    $list = $list + 1;  
                    $IDdepartment = $user['id_department'];
                    $IDteam = $user['id_team'];
                    $IDrole = $user['id_role']; 
                    $departmentSql = "SELECT * FROM department WHERE id = '$IDdepartment'";
                    $teamSql = "SELECT * FROM team WHERE id = '$IDteam' ";
                    $roleSql = "SELECT * FROM role WHERE id = '$IDrole' ";
                    // get result
                  
                    if($departmentResult = mysqli_query($db, $departmentSql)){
                        $departmentName = mysqli_fetch_assoc($departmentResult);
                    }
                           if($teamResult = mysqli_query($db, $teamSql)) {
                             $teamName = mysqli_fetch_assoc($teamResult);
                           }
                           if($roleResult = mysqli_query($db, $roleSql)){
                            $roleName = mysqli_fetch_assoc($roleResult);
                           }
                              //fetch to array
                            ?>     

                <td align="center">
                  <?= $list; ?>                         
                </td>

                <td align="center" class="cell-breakWord"><?= $user['username']; ?></td>
                 <td align="center" class="cell-breakWord"><?= $user['fullName']; ?></td>
                <td align="center" class="cell-breakWord"><?= $user['email']; ?></td>
                <td align="center" class="cell-breakWord"><?= $user['phone']; ?></td>
                <td align="center" class="cell-breakWord"><?php $gross1 = number_format($user['gross_salary']); echo $gross1; ?></td>
                <td align="center" class="cell-breakWord"><?= $user['address']; ?></td>
                <td align="center" class="cell-breakWord"><?= $departmentName['name']; ?></td>
                <td align="center" class="cell-breakWord"><?= $teamName['name']; ?></td>   
              
                <td align="center" class="cell-breakWord"><?php if(isset($user['date_created'])) { echo date("d/m/Y",strtotime($user['date_created'])); } ?></td>

                <td align="center">
                    <a href = "admin.php?adminpage=deleteRoleUser&IDrole=<?=$user['id_role'];?>&ID=<?=$user['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                    <i class="far fa-trash-alt"></i></a>
                </td>
                  
              </tr>
              <?php 
                } while($user = mysqli_fetch_assoc($user_query));
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

<?php  
    if(isset($_GET['IDrole'])) {
      $IDrole1 = $_GET['IDrole'];
    if(isset($_POST['add'])) {
      if(isset($_POST['userRole'])) {
       $userRole = $_POST['userRole'];
       $userR = "";
      foreach($userRole as $userR) 
 {
       $userUpdate = "UPDATE user set id_role = '$IDrole1' where username = '$userR' ";
       $userUpdate_query = mysqli_query($db, $userUpdate);       
  }  
       $_SESSION['success'] = "Success."; 
       echo "<script>
    window.location.href='admin.php?adminpage=adminRoleUser&IDrole=$IDrole';
    </script>"; 
         }  
          }
    $user_sql = "SELECT * FROM user where id_role != '$IDrole1' OR id_role IS NULL";
    $user_query = mysqli_query($db,$user_sql);
    $user = mysqli_fetch_assoc($user_query);
  ?>
    
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="admin.php?adminpage=search&IDrole=<?=$IDrole1;?>" class="beta-form-checkout">

        <div class="modal-header">
         <div class="float-left">
          <h4 class="modal-title">List of users </h4></div>
        </div>
        <div class="modal-body">
          <?php
              if(mysqli_num_rows($user_query) > 0) {
             do { 
          ?>
                
          <div class="checkbox">
            <label><input type="checkbox" name="userRole[]" value="<?= $user['username']; ?>"> <?= $user['username']; ?> </label>
            </div>

            <?php
             } while($user = mysqli_fetch_assoc($user_query));
             } else {
              echo "There are no users in other roles!";
             }
            ?>

        </div>
        <div class="modal-footer">
          <input type="submit" name="add" value="submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </form>
      </div>
    </div>
  </div>

<?php
}
}
?>





<?php 
if(isset($_POST['searchOrder'])) {
  $search=$_POST['searchtextOrder'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminBookOrder';
    </script>";
  }
  $order_sql = "SELECT * FROM `order` WHERE `id` LIKE '%$search%' OR `placeOrder_date` LIKE '%$search%' OR `expired_date` LIKE '%$search%' OR status LIKE '%$search%' OR `type` LIKE '%$search%'  ORDER BY placeOrder_date DESC";
  if($order_query = mysqli_query($db,$order_sql)) {
  $order = mysqli_fetch_assoc($order_query);
 }
 if(mysqli_num_rows($order_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminBookOrder';
    </script>"; 
 }

 $list = 0;
 ?>
  
  <div class = "header">
    <h2>Order Book</h2>
  </div>

  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-sm-11 col-md-12 col-xl-12"> 
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextOrder">
            <button class="btn btn-outline-success" type="submit" name="searchOrder">Search</button>
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
                        <th>List</th>               
                        <th>Username</th>
                        <th>Full Name</th>                        
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Prize</th>
                        <th>type of order</th>
                        <th>order date</th>
                        <th>expired date</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                         <?php 
                          do {

                            $list = $list + 1;

                            $IDuser = $order['id_user'];
                            $IDbook = $order['id_book'];
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                          if($user_query = mysqli_query($db,$user_sql)) {
                           $user = mysqli_fetch_assoc($user_query);
                                                                            }               
                            $book_sql = "SELECT * FROM book where id = '$IDbook'";
                            if($book_query = mysqli_query($db,$book_sql)) {
                            $book = mysqli_fetch_assoc($book_query);
                             }
                            ?>

                            <td align="center" class="cell-breakWord"><?= $list; ?></a></td>
                            <td align="center" class="cell-breakWord"><?= $user['username']; ?></td>
                            <td align="center" class="cell-breakWord"><?= $user['fullName']; ?></td>  
                            <td align="center" class="cell-breakWord"><?= $book['book_title']; ?></td>
                            <td align="center" class="cell-breakWord"><?= $book['author_name']; ?></td>
                            <td align="center" class="cell-breakWord"><?php $sbook1 = number_format($book['prize']); echo $sbook1; ?></td>
                            <td align="center" class="cell-breakWord"><?= $order['type']; ?></td>
                            <td align="center" class="cell-breakWord"><?php if(isset($order['placeOrder_date'])) { echo date("d/m/Y",strtotime($order['placeOrder_date'])); } ?></td>
                            <td align="center" class="cell-breakWord"><?php if(isset($order['expired_date'])) {  echo date("d/m/Y",strtotime($order['expired_date'])); } ?></td>
                            <td align="center" class="cell-breakWord"><span <?php if($order['status'] == "completed") { ?> class="badge badge-success" <?php } else { ?>  class="badge badge-danger" <?php } ?> ><?= $order['status']; ?></span></td>

                         <td align="center">
                          <?php
                           if($order['status'] == "incompleted") {
                          ?>
                            <a href = "admin.php?adminpage=editBookOrder&ID=<?=$order['id'];?>" class="btn btn-success" data-toogle="tooltip" title="Return">
                            <i class="fas fa-undo-alt"></i></a>
                            <?php
                              }
                              ?>
                        
                        <a href = "admin.php?adminpage=deleteBookOrder&ID=<?=$order['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                  <?php 
                      } while($order = mysqli_fetch_assoc($order_query));
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




<?php 
if(isset($_POST['searchTraining'])) {
  $search=$_POST['searchtextTraining'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminTraining';
    </script>"; 
  }
  
  $training_sql = "SELECT * FROM training WHERE `id` LIKE '%$search%' OR `training_name` LIKE '%$search%' OR `start_date` LIKE '%$search%' OR end_date LIKE '%$search%' OR description LIKE '%$search%' OR `max_trainees` LIKE '%$search%' OR `number_trainees` LIKE '%$search%'";
  if($training_query = mysqli_query($db,$training_sql)) {
  $training = mysqli_fetch_assoc($training_query);
 }
 if(mysqli_num_rows($training_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminTraining';
    </script>"; 
   }
 $list = 0;
    $todayDate = date("Y-m-d");
 
 ?>

  
  <div class = "header">
    <h2>Training course</h2>
  </div>
  
  <div class="container-fluid">
 <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addTraining">Add new training course</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTraining">
            <button class="btn btn-outline-success" type="submit" name="searchTraining">Search</button>
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
                      <th>List</th>                  
                      <th>Training Course Name</th> 
                      <th>Trainer</th>                                                                              
                      <th>Description</th>
                      <th>Max Number of Trainees</th> 
                      <th>Number of Trainees</th> 
                      <th>Start Date</th>
                      <th>End Date</th>                        
                        
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                      <?php 
                          do {
                            $list = $list + 1;   
                            $IDtrainer = $training['id_trainer'];
                            $trainer_sql = "SELECT * FROM user where id = '$IDtrainer'";
                          if($trainer_query = mysqli_query($db,$trainer_sql)) {
                           $trainer = mysqli_fetch_assoc($trainer_query);
                      }?>
                    
                      <td align="center"> 
                        <?= $list; ?>                  
                      </td>
                      <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminTrainee&IDtraining=<?=$training['id'];?>"><strong><?= $training['training_name']; ?></strong></a></td>
                      <td align="center" class="cell-breakWord"><?= $trainer['username']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $training['description']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $training['max_trainees']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $training['number_trainees']; ?></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($training['start_date'])) {  echo date("d/m/Y",strtotime($training['start_date'])); } ?></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($training['end_date'])) {  echo date("d/m/Y",strtotime($training['end_date'])); } ?></td>                                                               
                      <td align="center">
                          <?php
                          if($training['number_trainees']<$training['max_trainees'] && $todayDate < $training['start_date'] ) {
                          ?>
                          <a href = "admin.php?adminpage=addTrainee&IDtraining=<?=$training['id'];?>" class="btn btn-success" data-toogle="tooltip" title="Enroll">
                            <i class="fas fa-user-plus"></i></a>

                        <?php
                          }
                          ?>
                        <a href = "admin.php?adminpage=editTraining&ID=<?=$training['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                          <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTraining&ID=<?=$training['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                          <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 
                      } while($training = mysqli_fetch_assoc($training_query));
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




<?php 
if(isset($_POST['searchHoliday'])) {
  $search=$_POST['searchtextHoliday'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminHoliday';
    </script>"; 
  }
  
  $holiday_sql = "SELECT * FROM holiday WHERE `id` LIKE '%$search%' OR `event_name` LIKE '%$search%' OR `start_date` LIKE '%$search%' OR end_date LIKE '%$search%' OR description LIKE '%$search%'";
  if($holiday_query = mysqli_query($db,$holiday_sql)) {
  $holiday = mysqli_fetch_assoc($holiday_query);
 }
 if(mysqli_num_rows($holiday_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminHoliday';
    </script>";  
   }
 $list = 0;
 ?>

  
  <div class = "header">
    <h2>Holiday table</h2>
  </div> 

  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addHoliday" >Add new holiday event</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextHoliday">
            <button class="btn btn-outline-success" type="submit" name="searchHoliday">Search</button>
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
                       <th>List</th>                  
                        <th>Event name </th> 
                        <th>Description</th>
                        <th>Start Date</th>
                       <th>End Date</th>                        
                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                         <?php 
                          do {
                            $list = $list + 1;   
                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $holiday['event_name']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $holiday['description']; ?>
                              </td>

                            

                                 <td align="center" class="cell-breakWord"> <?php if(isset($holiday['start_date'])) {  echo date("d/m/Y",strtotime($holiday['start_date'])); } ?>
                              </td>    
                               <td align="center" class="cell-breakWord"> <?php if(isset($holiday['end_date'])) {  echo date("d/m/Y",strtotime($holiday['end_date'])); } ?>
                              </td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editHoliday&ID=<?=$holiday['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                           <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteHoliday&ID=<?=$holiday['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                           <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 
                      } while($holiday = mysqli_fetch_assoc($holiday_query));
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







<?php 
if(isset($_POST['searchLeave'])) {
  $search=$_POST['searchtextLeave'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminLeaveApplication';
    </script>"; 
  }
  $user_sql = "SELECT * FROM user where `username` LIKE '%$search%' OR `fullName` LIKE '%$search%'";
  $user_query = mysqli_query($db, $user_sql);
  $user = mysqli_fetch_assoc($user_query);
  $IDuser = $user['id'];
  
  $leave_sql = "SELECT * FROM leave_application where id_user = '$IDuser' OR `application_date` LIKE '%$search%' OR `leave_type` LIKE '%$search%' OR personal_reason LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%' OR status LIKE '%$search%' ORDER BY application_date ASC";
  if($leave_query = mysqli_query($db,$leave_sql)) {
  $leave = mysqli_fetch_assoc($leave_query);
 }
 if(mysqli_num_rows($leave_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminLeaveApplication';
    </script>";   
   }
 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Leave Application</h2>
  </div> 

  
 <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addLeaveApplication" >Add new application leave</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextLeave">
            <button class="btn btn-outline-success" type="submit" name="searchLeave">Search</button>
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
                        <th>Username</th>
                        <th>Fullname</th>                   
                        <th>Application date</th>
                        <th>Leave type</th>
                       <th>Personal reason</th>
                        <th>Start date</th>  
                       <th>End date</th>
                       <th>Status</th>                        
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                 <tr>
                         <?php 
                          do {
                            $list = $list + 1;
                            $IDuser = $leave['id_user']; 
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"> <?php if(isset($leave['application_date'])) {  echo date("d-m-Y",strtotime($leave['application_date'])); } ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $leave['leave_type']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $leave['personal_reason']; ?>
                              </td>

                            
                                 <td align="center" class="cell-breakWord"> <?php if(isset($leave['start_date'])) {  echo date("d/m/Y",strtotime($leave['start_date'])); } ?>
                              </td>    
                               <td align="center" class="cell-breakWord"> <?php if(isset($leave['end_date'])) {  echo date("d/m/Y",strtotime($leave['end_date'])); } ?>
                              </td>

                              <td align="center" class="cell-breakWord"><span <?php if($leave['status'] == "accepted") { ?> class="badge badge-success" <?php } else if($leave['status'] == "pending") { ?>  class="badge badge-warning" <?php } else { ?> class="badge badge-danger" <?php } ?>  ><?= $leave['status']; ?></span></td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 
                      } while($leave = mysqli_fetch_assoc($leave_query));
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













<?php 
if(isset($_POST['searchTask'])) {
  $search=$_POST['searchtextTask'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminTask';
    </script>"; 
  }
  $team_sql = "SELECT * FROM team where `name` LIKE '%$search%'";
  $team_query = mysqli_query($db, $team_sql);
  $team = mysqli_fetch_assoc($team_query);
  $IDteam = $team['id'];
  
  $task_sql = "SELECT * FROM task where id_team = '$IDteam' OR `task_name` LIKE '%$search%' OR `description` LIKE '%$search%' OR `deadline` LIKE '%$search%' OR `status` LIKE '%$search%' ORDER BY deadline DESC";
  if($task_query = mysqli_query($db,$task_sql)) {
  $task = mysqli_fetch_assoc($task_query);
 }
if(mysqli_num_rows($task_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminTask';
    </script>";  
   }
  $todayDate = date("Y-m-d");
 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Task Management</h2>
  </div> 

  
  <div class="container-fluid">
  <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addTask" >Add new task</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextTask">
            <button class="btn btn-outline-success" type="submit" name="searchTask">Search</button>
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
                        <th>Task name</th>                   
                        <th>Team</th>                   
                        <th>Description</th>
                        <th>deadline</th>
                       <th>status</th>
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                         <?php 
                          do {
                            $list = $list + 1;
                            $IDteam = $task['id_team']; 
                            $team_sql = "SELECT * FROM team where id = '$IDteam'";
                            $team_query = mysqli_query($db, $team_sql);
                            $team = mysqli_fetch_assoc($team_query);


                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $task['task_name']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $team['name']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $task['description']; ?>
                              </td>

                              <td align="center" class="cell-breakWord" <?php if($task['deadline'] < $todayDate) { ?> style="color: red;"  <?php } ?> > <?php if(isset($task['deadline'])) {  echo date("d/m/Y",strtotime($task['deadline'])); } ?>
                              </td>

                    
                              <td align="center" class="cell-breakWord"><span <?php if($task['status'] == "completed") { ?> class="badge badge-success" <?php } else if($task['status'] == "incompleted") { ?>  class="badge badge-danger" <?php } ?>  ><?= $task['status']; ?></span></td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editTask&ID=<?=$task['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteTask&ID=<?=$task['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 
                      } while($task = mysqli_fetch_assoc($task_query));
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











<?php 
if(isset($_POST['searchAward'])) {
  $search=$_POST['searchtextAward'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeAward';
    </script>"; 
  }
$user_sql = "SELECT * FROM user where `username` LIKE '%$search%' OR `fullName` LIKE '%$search%'";
  $user_query = mysqli_query($db, $user_sql);
  $user = mysqli_fetch_assoc($user_query);
  $IDuser = $user['id'];
  
  $award_sql = "SELECT * FROM employee_award WHERE id_user = '$IDuser' OR `award_title` LIKE '%$search%' OR `gift_item` LIKE '%$search%' OR `award_amount` LIKE '%$search%' OR `award_date` LIKE '%$search%'  ORDER BY award_date DESC";
  if($award_query = mysqli_query($db,$award_sql)) {
  $award = mysqli_fetch_assoc($award_query);
 }
 if(mysqli_num_rows($award_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeAward';
    </script>";  
   }
 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Employee Award </h2>
  </div> 

  
  <div class="container-fluid">
 <div class="main">
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addEmployeeAward" >Add new award to employee</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextAward">
            <button class="btn btn-outline-success" type="submit" name="searchAward">Search</button>
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
                       <th>List</th>                  
                        <th>Username</th>
                        <th>Fullname</th>                   
                        <th>Award title</th>
                        <th>Gift item</th>
                       <th>Award amount(VND)</th>  
                       <th>Awarded date</th>
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                         <?php 
                          do {
                            $list = $list + 1;
                            $IDuser = $award['id_user']; 
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


                            ?>
                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>

                             

                              <td align="center" class="cell-breakWord"><?= $award['award_title']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $award['gift_item']; ?>
                              </td>

                              <td align="center" class="cell-breakWord"><?= $award['award_amount']; ?>
                              </td>
                           
                                  
                               <td align="center" class="cell-breakWord"> <?php if(isset($award['award_date'])) {  echo date("d/m/Y",strtotime($award['award_date'])); } ?>
                              </td>
                                       

                         <td align="center">
                        <a href = "admin.php?adminpage=editEmployeeAward&ID=<?=$award['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteEmployeeAward&ID=<?=$award['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 
                      } while($award = mysqli_fetch_assoc($award_query));
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












<?php
 if(isset($_POST['searchSalary'])) {
  $search=$_POST['searchtextSalary'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeSalary';
    </script>";   
  }
//fetching data in descending order (lastest entry first)
 $user_sql ="SELECT * FROM user WHERE `id` LIKE '%$search%' or `username` LIKE '%$search%' or `fullName` LIKE '%$search%' or `email` LIKE '%$search%' or `phone` LIKE '%$search%' or `address` LIKE '%$search%' or `gender` LIKE '%$search%' or `DOB` LIKE '%$search%' or `gross_salary` LIKE '%$search%' or `net_salary` LIKE '%$search%' or `level` LIKE '%$search%' ORDER BY username ASC";
if(!empty($user_sql)){
$user_query = mysqli_query($db, $user_sql);
$user = mysqli_fetch_assoc($user_query);
} else if(mysqli_num_rows($user_query) == 0) {
    $_SESSION['error'] = "No results.";
    echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeSalary';
    </script>";    
 }

 $list = 0;



if(isset($_POST['update'])) {


        if(isset($_POST['socialInsurance']) && isset($_POST['healthInsurance']) && isset($_POST['providentFund'])) {

        $_SESSION['socialInsurance'] = $_POST['socialInsurance'];
         $_SESSION['healthInsurance'] = $_POST['healthInsurance'];
         $_SESSION['providentFund'] = $_POST['providentFund'];
       $_SESSION['success'] = "Success."; 
       echo "<script>
       alert('update successfully');
    window.location.href='admin.php?adminpage=adminEmployeeSalary';
    </script>"; 

            } 


           }




 ?>
  
  <div class = "header">
    <h2>Employee Salary </h2>
  </div> 

  <div class="container-fluid">
 <div class="main">
    
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoModal">Update Deduction</button>
            

      </div>
      <div class="col-6 col-xl-4">
       <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextSalary">
              <button class="btn btn-outline-success" type="submit" name="searchSalary">Search</button>
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
                       <th>List</th>                  
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Date of Birth</th>                   
                        <th>Gross Salary(VND)</th>
                        <th>Social Insurance(<?php if(isset($_SESSION['socialInsurance'])) { echo $_SESSION['socialInsurance']; } else {echo 8;} ?>%)</th>
                       <th>Provident Fund(<?php if(isset($_SESSION['providentFund'])) { echo $_SESSION['providentFund']; } else {echo 5;} ?>%)</th>
                       <th>Health Insurance(VND)</th>
                       <th>Total Penalties(VND)</th> 
                      <th>Net Salary(VND)</th>

                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {

                  
                              $list = $list + 1;
                            ?>
                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>
                           
                              <td class="cell-breakWord" align="center"><?=date("d/m/Y",strtotime($user['DOB'])); ?></td>


                              <td align="center" class="cell-breakWord"><?php $grossSalary = number_format($user['gross_salary']); echo $grossSalary; ?>
                              </td>

                              <?php
                                if(isset($_SESSION['socialInsurance']) && isset($_SESSION['healthInsurance']) && isset($_SESSION['providentFund'])) {


                                       $IDuser = $user['id'];
                                  $penalty0_sql = "SELECT * FROM salary_deduction WHERE id_user = '$IDuser'";
                                  $penalty0_query = mysqli_query($db, $penalty0_sql);
                                  $totalPenalty = 0;
                                  while($penalty0 = mysqli_fetch_assoc($penalty0_query)){
                                    $totalPenalty = $totalPenalty + $penalty0['deduction_amount'];
                                  }
                                   $netSalary0 = $user['gross_salary'] - $totalPenalty;



                               $socialInsurance = $user['gross_salary'] / 100 *  $_SESSION['socialInsurance'];
                               $provi = $user['gross_salary'] / 100 *  $_SESSION['providentFund'];
                               $healthInsurance = $_SESSION['healthInsurance'];
                               $netSalary = $netSalary0 - $socialInsurance -  $provi - $healthInsurance;
                               $IDuser = $user['id'];
                               $user1_sql = "UPDATE user SET net_salary = '$netSalary' WHERE id = '$IDuser'";
                               $user1_query = mysqli_query($db, $user1_sql);
                                    } else {

                                       $IDuser = $user['id'];
                                  $penalty0_sql = "SELECT * FROM salary_deduction WHERE id_user = '$IDuser'";
                                  $penalty0_query = mysqli_query($db, $penalty0_sql);
                                  $totalPenalty = 0;
                                  while($penalty0 = mysqli_fetch_assoc($penalty0_query)){
                                    $totalPenalty = $totalPenalty + $penalty0['deduction_amount'];
                                  }
                                   $netSalary0 = $user['gross_salary'] - $totalPenalty;

                                       $socialInsurance = $user['gross_salary'] / 100 *  8;
                               $provi = $user['gross_salary'] / 100 *  5;
                               $healthInsurance = 0;
                               $netSalary = $netSalary0 - $socialInsurance -  $provi - $healthInsurance;
                               $IDuser = $user['id'];
                               $user1_sql = "UPDATE user SET net_salary = '$netSalary' WHERE id = '$IDuser'";
                               $user1_query = mysqli_query($db, $user1_sql);

                                    }

                              ?>

                               <td align="center" class="cell-breakWord"><?php $socialInsurance1 = number_format($socialInsurance); echo $socialInsurance1; ?>
                              </td>
                           
                            <td align="center" class="cell-breakWord"><?php $provi1 = number_format($provi); echo $provi1; ?>
                              </td>
                           
                            <td align="center" class="cell-breakWord"><?php $health = number_format($healthInsurance); echo $health; ?>
                              </td>


                          


                              <td align="center" class="cell-breakWord"><?php $totalPenalty1 = number_format($totalPenalty); echo $totalPenalty1; ?>
                              </td>
                           


                              <td align="center" class="cell-breakWord"><?php $netSalary2 = number_format($netSalary); echo $netSalary2; ?>
                              </td>

                             
                                  
                             
                                       
                  
                    </tr>
                  <?php 

                      } while($user = mysqli_fetch_assoc($user_query));
                   ?>
                 

                </tbody>

            </table>
             
        </div>
    </div>
  </div>
</div>



    


 <!-- Modal -->
  <div class="modal fade" id="demoModal" role="dialog">


    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="admin.php?adminpage=adminEmployeeSalary" class="beta-form-checkout">

        <div class="modal-header">
         <div class="float-left">
          <h4 class="modal-title"> Update Deduction </h4></div>
        </div>
        <div class="modal-body">

          <div class="form-group">
        <label for="name">Social Insurance(%): </label>
        <input type="number" min="0" max="100"  name="socialInsurance" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="name">Provident Fund(%): </label>
        <input type="number" min = "0" max="100"  name="providentFund" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="name">Health Insurance(VND): </label>
        <input type="number" min = "0"  name="healthInsurance" class="form-control" required>
      </div>
         

        </div>
        <div class="modal-footer">
          <input type="submit" name="update" value="submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </form>
      </div>
      
    </div>
  </div>
<?php
}
?>
  




  <?php 
 if(isset($_POST['searchDeduction'])) {
  $search=$_POST['searchtextDeduction'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeDeduction';
    </script>"; 
  }
$user_sql = "SELECT * FROM user where `username` LIKE '%$search%' OR `fullName` LIKE '%$search%' OR `DOB` LIKE '%$search%'";
  $user_query = mysqli_query($db, $user_sql);
  $user = mysqli_fetch_assoc($user_query);
  $IDuser = $user['id'];
  
  $deduction_sql = "SELECT * FROM salary_deduction WHERE id_user = '$IDuser' OR `deduction_amount` LIKE '%$search%' OR `deduction_reason` LIKE '%$search%' OR `deduction_date` LIKE '%$search%' ORDER BY deduction_date DESC";
  if($deduction_query = mysqli_query($db,$deduction_sql)) {
  $deduction = mysqli_fetch_assoc($deduction_query);
 }
 if(mysqli_num_rows($deduction_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminEmployeeDeduction';
    </script>";  
   }

 $list = 0;
 ?>
  
  <div class = "header">
    <h2>Salary Deduction </h2>
  </div> 

  <div class="container-fluid">
 <div class="main">
  
    <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addEmployeeDeduction" >Add new penalty to employee</a></button>
      </div>
      <div class="col-6 col-xl-4">
       <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextDeduction">
              <button class="btn btn-outline-success" type="submit" name="searchDeduction">Search</button>
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
                       <th>List</th>                  
                        <th>Username</th>
                         <th>Fullname</th>
                        <th>Date of Birth</th>
                        <th>Deduction Amount(VND)</th>                   
                        <th>Deduction Reason</th>
                        <th>Deduction Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;
                            $IDuser = $deduction['id_user']; 
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


                            ?>
                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>

                             

                              <td align="center" class="cell-breakWord"> <?php if(isset($user['DOB'])) {  echo date("d/m/Y",strtotime($user['DOB'])); } ?>
                              </td>


                              <td align="center" class="cell-breakWord"><?php $deductAmount = number_format($deduction['deduction_amount']); echo $deductAmount; ?>
                              </td>

                               <td align="center" class="cell-breakWord"><?= $deduction['deduction_reason']; ?>
                              </td>
                           
                                  
                               <td align="center" class="cell-breakWord"> <?php if(isset($deduction['deduction_date'])) {  echo date("d/m/Y",strtotime($deduction['deduction_date'])); } ?>
                              </td>
                                       

                         <td align="center">
                        <a href = "admin.php?adminpage=editEmployeeDeduction&ID=<?=$deduction['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteEmployeeDeduction&ID=<?=$deduction['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($deduction = mysqli_fetch_assoc($deduction_query));
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









<?php 
if(isset($_POST['searchAnnouncement'])) {
  $search=$_POST['searchtextAnnouncement'];
  if(empty($search)){
    $_SESSION['error'] = "Please enter search keyword.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminAnnouncement';
    </script>"; 
  }
  
  $announce_sql = "SELECT * FROM announcement WHERE  `title` LIKE '%$search%' OR `content` LIKE '%$search%' OR date_created LIKE '%$search%' OR `announcer` LIKE '%$search%'";
  if($announce_query = mysqli_query($db,$announce_sql)) {
  $announce = mysqli_fetch_assoc($announce_query);
 }
 if(mysqli_num_rows($announce_query) == 0) {
    $_SESSION['error'] = "No results.";
     echo "<script>
    window.location.href='admin.php?adminpage=adminAnnouncement';
    </script>";  
   }
  

 $list = 0;
 ?>

  
  <div class = "header">
    <h2>Announcement table</h2>
  </div> 

  <div class="container-fluid">
  <div class="main">
   
    <div class="row">
      <div class="col-6 col-xl-8">  
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addAnnouncement" >Add new announcement</a></button>
      </div>
      <div class="col-6 col-xl-4">
        <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextAnnouncement">
            <button class="btn btn-outline-success" type="submit" name="searchAnnouncement">Search</button>
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
                      <th>title</th>               
                      <th>Posted by</th>
                      <th>Announcement Content</th>  
                      <th>Post date</th>                        
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody>       
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   

                            $content1 = "";
                            if (strlen($announce['content']) < 100) {
                              $content1 = $announce['content'];
                            } else {

                           $content1 = substr($announce['content'], 100);
                                }                            

                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminAnnouncementContent"><strong> <?= $announce['title']; ?></strong></a>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $announce['announcer']; ?>
                              </td>

                             <td align="center" class="cell-breakWord"><?= $content1; ?><a href="admin.php?adminpage=adminAnnouncementContent">Read more...</a>
                              </td>

                                 
                               <td align="center" class="cell-breakWord"> <?php if(isset($announce['date_created'])) {  echo date("d/m/Y",strtotime($announce['date_created'])); } ?>
                              </td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editAnnouncement&ID=<?=$announce['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                           <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteAnnouncement&ID=<?=$announce['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                           <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($announce = mysqli_fetch_assoc($announce_query));
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