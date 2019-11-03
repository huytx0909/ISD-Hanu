 <?php 


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



 
$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
$user_query = mysqli_query($db, $user_sql);
	$user1 = mysqli_fetch_assoc($user_query); 
	$userID = $user1['id'];

	$order_sql = "SELECT * FROM `order` WHERE id_user = '$userID' ORDER BY placeOrder_date DESC";
  $order_query = mysqli_query($db,$order_sql);

 

$list = 0;
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
              			<input type="search" placeholder="Search..." name="searchtextOrder" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchOrder" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="orders-history" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">List</th>
						      <th scope="col">Book Name</th>
						      <th scope="col">Image</th>
						      <th scope="col">Author</th>
						      <th scope="col">Prize(VND)</th>
						      <th scope="col">Type of Order</th>
						      <th scope="col">Order Date</th>
						      <th scope="col">Expired Date</th>
						      <th scope="col">Status</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php

						  	if(mysqli_num_rows($order_query) > 0 ) {

						  	while($order = mysqli_fetch_assoc($order_query)) {
						  		  $list = $list + 1;

                            $IDbook = $order['id_book'];
                                 
                            $book_sql = "SELECT * FROM book where id = '$IDbook'";
                            if($book_query = mysqli_query($db,$book_sql)) {
                            $book = mysqli_fetch_assoc($book_query);
                             }
                              $IDimage = $book['id_image'];
                                   $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }

						  	?>
						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><?= $book['book_title']; ?></td>
						      <td align="center" class="cell-breakWord"><img src="img/<?= $image['url'];?>" width="50" height="50" alt="book"></td>
						      <td align="center" class="cell-breakWord"><?= $book['author_name']; ?></td>
						      <td align="center" class="cell-breakWord"><?php $book1 = number_format($book['prize']); echo $book1; ?></td>
						      <td align="center" class="cell-breakWord"><?= $order['type']; ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($order['placeOrder_date'])) { echo date("d/m/Y",strtotime($order['placeOrder_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($order['expired_date'])) {  echo date("d/m/Y",strtotime($order['expired_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><span <?php if($order['status'] == "completed") { ?> class="badge badge-success" <?php } else { ?>  class="badge badge-danger" <?php } ?> ><?= $order['status']; ?></span></td>
						    </tr>
						    <?php
							}
							} else {

								?>
								<h6>No orders.</h6>
								<?php
							}
							?>

						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

