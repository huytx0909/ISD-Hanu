<?php 

	$book_sql = "SELECT * FROM book ORDER BY book_title ASC";
	if($book_query = mysqli_query($db,$book_sql)) {
  $book = mysqli_fetch_assoc($book_query);

 }

 $list = 0;
 ?>
	
	<div class = "header">
		<h2>Book Table</h2>
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
  if (isset($_SESSION['error'])) {
    echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
    unset($_SESSION['error']);
  }
  ?>
    </div>
</div>
  <div class="row">
      <div class="col-6 col-xl-8">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBook" > Add New Book</a></button>

        <button type="button" class="btn btn-info"><a href = "admin.php?adminpage=adminBookCategory" > Book Category</a></button>
    
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
                        <th>Prize(VND)</th>
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
                          <?= $list; ?>                         
                      </td>
                      
                      <td align="center" class="cell-breakWord"><?= $book['book_title']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $book['author_name']; ?> </td>
                      <td align="center"><img src="img/<?= $image['url'];?>" width="50" height="50" alt="book"></td>
                      <td align="center" class="cell-breakWord"><?php if(isset($book['date_publication'])) { echo date("d/m/Y",strtotime($book['date_publication'])); } ?></td>
                      <td align="center" class="cell-breakWord"><?php $prize = number_format($book['prize']); echo $prize; ?></td>  
                      <td align="center" <?php if($book['status'] == "unavailable") { ?> style="color: red;"  <?php } ?> > <?= $book['status']; ?> </td>             
                      <td align="center" class="cell-breakWord"><?= $book['max_expired_day']; ?></td>
                      <td align="center" class="cell-breakWord"><?= $category['category_name']; ?></td>

                      <td align="center">
                        <a href = "admin.php?adminpage=editBook&ID=<?=$book['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                        <i class="far fa-edit"></i></a>                        
                        <a href = "admin.php?adminpage=deleteBook&ID=<?=$book['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                        <i class="far fa-trash-alt"></i></a>

                           <?php
                           if($book['status'] == "available") {
                           ?>
                            <a href = "admin.php?adminpage=addBookOrder&ID=<?=$book['id'];?>" class="btn btn-success" data-toogle="tooltip" title="Order">
                            <i class="fas fa-shopping-cart"></i></a>
                                 <?php
                               }
                                 ?>
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

</div>