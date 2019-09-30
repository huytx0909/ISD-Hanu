<?php 

	$order_sql = "SELECT * FROM `order` ORDER BY placeOrder_date DESC";
	if($order_query = mysqli_query($db,$order_sql)) {
  $order = mysqli_fetch_assoc($order_query);

 }


 ?>
	
	<div class = "header">
		<h2>Order Book</h2>
	</div>

	<div class="container">
  <?php
  
  if (isset($_SESSION['message'])) {
    echo "<div class='error' id='error'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
  }
  ?>
    <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextOrder">
            <button class="btn btn-outline-success" type="submit" name="searchOrder">Search</button>
          </form>
    </div>

    <div class="clearfix"></div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>order ID</th>               
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

                            <td align="center" class="cell-breakWord"><?= $order['id']; ?></a></td>
                            <td align="center" class="cell-breakWord"><?= $user['username']; ?></td>
                            <td align="center" class="cell-breakWord"><?= $user['fullName']; ?></td>  
                            <td align="center" class="cell-breakWord"><?= $book['book_title']; ?></td>
                            <td align="center" class="cell-breakWord"><?= $book['author_name']; ?></td>
                            <td align="center" class="cell-breakWord"><?= $book['prize']; ?></td>
                            <td align="center" class="cell-breakWord"><?= $order['type']; ?></td>
                            <td align="center" class="cell-breakWord"><?php if(isset($order['placeOrder_date'])) { echo date("d-m-Y",strtotime($order['placeOrder_date'])); } ?></td>
                            <td align="center" class="cell-breakWord"><?php if(isset($order['expired_date'])) {  echo date("d-m-Y",strtotime($order['expired_date'])); } ?></td>
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
                        
                        <a href = "admin.php?adminpage=deleteBookOrder&ID=<?=$order['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
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

