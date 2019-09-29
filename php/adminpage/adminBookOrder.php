<?php 

	$order_sql = "SELECT * FROM `order` ORDER BY placeOrder_date DESC";
	if($order_query = mysqli_query($db,$order_sql)) {
  $order = mysqli_fetch_assoc($order_query);

 }




 ?>
	
	<div class = "header">
		<h3 align="center">Order Book</h3>
	</div> <br>

	
	<div class="container" style="margin-top: 50px;">

  

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextOrder">
            <button class="btn btn-outline-success" type="submit" name="searchOrder">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
      
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
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
                      

                    	
                      


                              <td class="" align="center"><?= $order['id']; ?></a>
                              </td>

                               <td class="" align="center"><?= $user['username']; ?>
                              </td>

                              

                                <td class="" align="center"><?= $user['fullName']; ?>
                              </td>  

                                 <td class="" align="center"><?= $book['book_title']; ?>
                              </td>                               
 

                               <td class="" align="center"><?= $book['author_name']; ?>
                              </td>

                               <td class="" align="center"><?= $book['prize']; ?>
                              </td>

                               

                                <td class="" align="center"><?= $order['type']; ?>
                              </td>

                               <td class="" align="center"><?php if(isset($order['placeOrder_date'])) { echo date("d-m-Y",strtotime($order['placeOrder_date'])); } ?>
                              </td>

                                 <td class="" align="center"><?php if(isset($order['expired_date'])) {  echo date("d-m-Y",strtotime($order['expired_date'])); } ?>
                              </td>

                               <td class="" align="center"><span <?php if($order['status'] == "completed") { ?> class="badge badge-success" <?php } else { ?>  class="badge badge-danger" <?php } ?> ><?= $order['status']; ?>
                              </span></td>

                         <td align="center">

                          <?php
                           if($order['status'] == "incompleted") {

                          ?>
                            <a href = "admin.php?adminpage=editBookOrder&ID=<?=$order['id'];?>" class="btn btn-success">
                            <span class="glyphicon glyphicon-remove"></span> Returned</a>
                            <?php
                              }
                              ?>
                        
                        <a href = "admin.php?adminpage=deleteBookOrder&ID=<?=$order['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Delete</a>
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

