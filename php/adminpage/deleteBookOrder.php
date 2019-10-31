<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];


  	$order_sql  = "SELECT * FROM `order` WHERE id = '$delete_ID'";
  	$order_query = mysqli_query($db, $order_sql);
  	$order = mysqli_fetch_assoc($order_query);
  	$IDbook = $order['id_book'];

  	$book_sql = "UPDATE book set status = 'available' WHERE id = '$IDbook'";
  	$book_query = mysqli_query($db, $book_sql);



 $delete_sql = "DELETE FROM `order` WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	$_SESSION['success'] = "Success.";
 	echo "<script>
    window.location.href='admin.php?adminpage=adminBookOrder';
    </script>";
 }


}

?>