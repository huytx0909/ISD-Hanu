<?php 

	$book_sql = "SELECT * FROM book";
	if($book_query = mysqli_query($db,$book_sql)) {
  $book = mysqli_fetch_assoc($book_query);

 }




 $list = 0;
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

                            $IDcategory = $book['id_category'];
                            $IDimage = $book['id_image'];

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
                           
                                <h5><?= $list; ?></h5>
                                                 
                        </td>
                      


                              <td class="" align="center"><strong><?= $book['book_title']; ?></a>
                              </strong></td>

                               <td class="" align="center"><strong><?= $book['author_name']; ?>
                              </strong></td>



                                

                                <td class="" align="center"><image src="image/<?= $image['url'];?>" width="50" height="50" alt="book">
                                </td>

                                <td class="" align="center"><strong><?php if(isset($book['date_publication'])) { echo date("d-m-Y",strtotime($book['date_publication'])); } ?>
                              </strong></td>

                                 <td class="" align="center"><strong><?= $book['status']; ?>
                              </strong></td>                               

                                 <td class="" align="center"><strong><?= $book['prize']; ?>
                              </strong></td>   


                               <td class="" align="center"><strong><?= $book['max_expired_day']; ?>
                              </strong></td>

                               <td class="" align="center"><strong><?= $category['category_name']; ?>
                              </strong></td>

                         <td align="center">
                        <a href = "admin.php?adminpage=editBook&ID=<?=$book['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        
                        <a href = "admin.php?adminpage=deleteBook&ID=<?=$book['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Delete</a>
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

