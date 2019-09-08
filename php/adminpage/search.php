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

        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=adminBookCategory" > Book category</a></button>
         
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



                                

                                <td class=""  align="center"><image src="image/<?= $image['url'];?>" width="50" height="50">
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