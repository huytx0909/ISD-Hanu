<?php
  if(isset($_GET['ID'])){
  	$order_ID = "";
  	$order_ID = $_GET['ID'];

 $order_sql = "UPDATE `order` SET status = 'completed' WHERE id = '$order_ID'";
 $order_query = mysqli_query($db, $order_sql);

 $orderID_sql = "SELECT * FROM `order` where id = '$order_ID'";
 $orderID_query = mysqli_query($db,$orderID_sql);
 $orderID = mysqli_fetch_assoc($orderID_query);
 $bookID = $orderID['id_book'];


$book_sql = "UPDATE `book` SET status = 'available' WHERE id = '$bookID'";
 $book_query = mysqli_query($db, $book_sql); 

 	echo "<script>
    window.location.href='admin.php?adminpage=adminBookOrder';
    </script>"; 	
 


}

?>