<?php


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}




	if(isset($_GET['ID'])) {
	$cateID = $_GET['ID'];
	
		 $book_sql = "SELECT * FROM book WHERE id_category = '$cateID' ORDER BY book_title ASC";
$book_query = mysqli_query($db,$book_sql);
 
?>
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>

	<div class="container order">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextBook" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchBook" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		<div class="orders">
			<div class="row" >
				<div class="col-md-3">
					<div class="categories" data-aos="fade-down">
						<h6 class=""><a href="user.php?userpage=order">All Categories</a></h6>
						<ul>
							<?php

                            $category_sql = "SELECT * FROM category ORDER BY category_name ASC";
                          $category_query = mysqli_query($db,$category_sql);
                         while($category = mysqli_fetch_assoc($category_query)) {
                                                                                         
							?>
							<li><a href="user.php?userpage=orderCategory&ID=<?=$category['id'];?>"><?=$category['category_name'];?></a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			
		
				<div class="col-md-9">
					<div class="books" data-aos="fade-down">
						<div class="row">
 							 <?php 
 							 if(mysqli_num_rows($book_query) > 0) {
                          while($book = mysqli_fetch_assoc($book_query)) {

                            $IDimage = $book['id_image'];
                            $IDcate = $book['id_category'];
                              $category1_sql = "SELECT * FROM category where id = '$IDcate'";
                          $category1_query = mysqli_query($db,$category1_sql);
							$category1 = mysqli_fetch_assoc($category1_query);

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }

                            ?>



							<div class="col-lg-3">
								<div class="book-info">
									<img src="img/<?=$image['url'];?>"  href="user.php?userpage=orderCategory&ID=<?=$cateID;?>&IDbook=<?=$book['id'];?>"   aria-expanded="false" aria-controls="#success #book_info">
									<a href="user.php?userpage=orderCategory&ID=<?=$cateID;?>&IDbook=<?=$book['id'];?>"  ><h5><?=$book['book_title'];?></h5></a>
									<p  <?php if($book['status'] == "unavailable") { ?> style="color: red; font-size: 12px;"  <?php } else { ?> style="color: green; font-size: 12px;" <?php } ?> > <?=$book['status'];?></p>
									

									<?php
										if($book['status'] != "unavailable") {
									?>
									<a href="user.php?userpage=orderCategory&ID=<?=$cateID;?>&IDbook=<?=$book['id'];?>&action=borrow" class="btn btn-primary" style="color:white;" data-toggle="tooltip" title="Borrow">
										<i class="fas fa-book"></i>
									</a>
									<a href="user.php?userpage=orderCategory&ID=<?=$cateID;?>&IDbook=<?=$book['id'];?>&action=purchase" class="btn btn-success" style="color:white;" data-toggle="tooltip" title="Purchase">
										<i class="fas fa-shopping-cart"></i>
									</a>
									<?php
								}
									?>
								</div>	

							</div>




							<?php
							}
							} else {

								?>
								<h6>No books available.</h6>
								<?php
							}
							?>		
				
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>






<?php
if(isset($_GET['IDbook'])) {
  $IDbook = $_GET['IDbook'];



     $book_sql = "SELECT * FROM book WHERE id = '$IDbook'";
$book_query = mysqli_query($db,$book_sql);
 

      $book = mysqli_fetch_assoc($book_query);

                            $IDimage = $book['id_image'];
                            $IDcate = $book['id_category'];
                              $category1_sql = "SELECT * FROM category where id = '$IDcate'";
                          $category1_query = mysqli_query($db,$category1_sql);
              $category1 = mysqli_fetch_assoc($category1_query);

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }




?>



 <div class="modal fade" id="book_info"  role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Book Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="float-left">
          <img src="img/<?=$image['url'];?>" width="230" height="400" alt="book">
        </div>

        <div class="book-info" style="margin-left: 250px;">
          <div><h2>Title: <?=$book['book_title'];?></h2></div>
          <div style="margin-top: 20px;"><p>Category: <?= $category1['category_name']; ?></p></div>
          <div style="margin-top: 20px;"><p>Author: <?=$book['author_name'];?></p></div>
          <div style="margin-top: 20px;"><p>Publication date: <?php if(isset($book['date_publication'])) { echo date("d/m/Y",strtotime($book['date_publication'])); } ?></p></div>
          <div style="margin-top: 20px;"><p>Prize(VND): <?php $prize = number_format($book['prize']); echo $prize; ?></p></div>
                    <div style="margin-top: 20px;"><p>Max Expired Days: <?=$book['max_expired_day'];?></p></div>

          <div  <?php if($book['status'] == "unavailable") { ?> style="color: red; margin-top: 20px;"  <?php } else { ?> style="color: green; margin-top: 20px;" <?php } ?>><p>Status: <?=$book['status'];?></p></div>
        </div>
      </div>


      <div class="modal-footer">
      	<?php
      	if(isset($_GET['action']) && $_GET['action'] == "borrow") {
      	?>
	<a href="user.php?userpage=addOrder&IDbook=<?=$book['id'];?>&action=borrow" class="btn btn-primary" style="color:white;" data-toggle="tooltip" title="Borrow">
	<i class="fas fa-book"></i>
	</a>
	<?php

		} else if (isset($_GET['action']) && $_GET['action'] == "purchase") {
		?>

		<a href="user.php?userpage=addOrder&IDbook=<?=$book['id'];?>&action=purchase" class="btn btn-success" style="color:white;" data-toggle="tooltip" title="Purchase">
			<i class="fas fa-shopping-cart"></i>
		</a>
	<?php
			}
	?>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#book_info').modal('show');
    });
</script>


<?php
}

}
?>

