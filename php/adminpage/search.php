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


 <div style="margin-left: 200px;">
 <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
      <button class="btn btn-outline-success" type="submit" name="search">Search</button>
    </form> </div>



  
  <div class = "header">
    <h3 align="center">Book table</h3>
  </div> <br>

  
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead>
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


                        <th> </th>
                        <th> </th>
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
                      

                      <td>
                           
                                <h5><?= $list; ?></h5>
                                                 
                        </td>
                      


                              <td class=""><strong><?= $searchbook['book_title']; ?></a>
                              </strong></td>

                               <td class=""><strong><?= $searchbook['author_name']; ?>
                              </strong></td>



                                

                                <td class=""><image src="image/<?= $image['url'];?>" width="50" height="50">
                              </td>

                                <td class=""><strong><?php if(isset($searchbook['date_publication'])) { echo date("d-m-Y",strtotime($searchbook['date_publication'])); } ?>
                              </strong></td>

                                 <td class=""><strong><?= $searchbook['status']; ?>
                              </strong></td>                               

                                 <td class=""><strong><?= $searchbook['prize']; ?>
                              </strong></td>   


                               <td class=""><strong><?= $searchbook['max_expired_day']; ?>
                              </strong></td>

                               <td class=""><strong><?= $category['category_name']; ?>
                              </strong></td>

                         <td>
                        <a href = "admin.php?adminpage=editBook&ID=<?=$searchbook['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        </td>
                        <td>
                        <a href = "admin.php?adminpage=deleteBook&ID=<?=$searchbook['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($searchbook = mysqli_fetch_assoc($search_query));
                   ?>

                  

                </tbody>

            </table>
             <a href = "admin.php?adminpage=addBook" class="btn btn-success">
                            <span class="glyphicon glyphicon-remove"></span> add new course</a>
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


 <div align ="right">
 <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextCategory">
      <button class="btn btn-outline-success" type="submit" name="searchCategory">Search</button>
    </form> </div>



  
 <div class = "header">
    <h3 align="center">Book category table</h3>
  </div> <br>

  
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead>
                    <tr>
                       <th>list</th>                  
                        <th>Book Category</th>
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
                      


                        <td class=""><strong><a href="admin.php?adminpage=adminBookinCate&IDcategory=<?=$searchCategory['id'];?>" style="text-decoration-color: none;"><?= $searchCategory['category_name']; ?>
                             </a> </strong></td>
                           
                         <td>
                        <a href = "admin.php?adminpage=editBookCategory&ID=<?=$searchCategory['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        </td>
                        <td>
                        <a href = "admin.php?adminpage=deleteBookCategory&ID=<?=$searchCategory['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
                        </td>
                  
                    </tr>
                  <?php } while($searchCategory = mysqli_fetch_assoc($search_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
             <a href = "admin.php?adminpage=addBookCategory" class="btn btn-success">
                            <span class="glyphicon glyphicon-remove"></span> add new category</a>
        </div>
    </div>
</div>
<?php
}
?>