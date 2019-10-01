<?php 
  if(isset($_GET['IDcategory'])) {
    $IDcategory = $_GET['IDcategory'];
	
  $book_sql = "SELECT * FROM book where id_category = '$IDcategory' ORDER BY book_title ASC";
  if($book_query = mysqli_query($db,$book_sql)) {
  $book = mysqli_fetch_assoc($book_query);

 }

  $category0_sql = "SELECT * FROM category where id = '$IDcategory'";
  if($category0_query = mysqli_query($db,$category0_sql)) {
  $category0 = mysqli_fetch_assoc($category0_query);
                                                                            }  

 $list = 0;
 ?>
  
  <div class = "header">
    <h2> <?= $category0['category_name']; ?> Book Table</h2>
  </div>

  <div class="container">

  <div class="float-left">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBook&ID=<?= $category0['id']; ?>" > Add new Book</a></button>

        <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminBookCategory" > Book category</a></button>
         
  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>book title</th>               
                        <th>author</th>
                        <th>image</th>                        
                        <th>publication date</th>
                        <th>prize($)</th>
                        <th>status</th>
                        <th>max expired days</th>
                        <th>category</th>


                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   

                            $IDimage = $book['id_image'];

                                    

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }

                         $category_sql = "SELECT * FROM category where id = '$IDcategory'";
                          if($category_query = mysqli_query($db,$category_sql)) {
                           $category = mysqli_fetch_assoc($category_query);
                                                                            }  
                            ?> 

                      <td align="center">
                           
                                <?= $list; ?>                     
                      </td>
                      


                              <td align="center" class="cell-breakWord"><?= $book['book_title']; ?></a>
                              </td>

                               <td align="center" class="cell-breakWord"><?= $book['author_name']; ?>
                              </td>



                                

                                <td align="center"><image src="img/<?= $image['url'];?>" width="50" height="50" alt="book">
                                </td>

                                <td align="center" class="cell-breakWord"><?php if(isset($book['date_publication'])) { echo date("d-m-Y",strtotime($book['date_publication'])); } ?>
                              </td>

                                <td align="center" class="cell-breakWord"><?= $book['prize']; ?>
                              </td>  

                                 <td align="center" class="cell-breakWord"><?= $book['status']; ?>
                              </td>                               
 

                               <td align="center" class="cell-breakWord"><?= $book['max_expired_day']; ?>
                              </td>

                               <td align="center" class="cell-breakWord"><?= $category['category_name']; ?>
                              </td>

                        <td align="center">
                        <a href = "admin.php?adminpage=editBook&ID=<?=$book['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        
                        <a href = "admin.php?adminpage=deleteBook&IDbook=<?=$book['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                  <?php 

                      } while($book = mysqli_fetch_assoc($book_query));
                   ?>
                 
                </tbody>

            </table>
        </div>
    </div>
</div>




<?php 
 }
?>