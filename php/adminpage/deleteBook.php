<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];
 $delete_sql = "DELETE FROM book WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	echo "<script>
    window.location.href='admin.php?adminpage=adminBook';
    </script>";
 }


}

 else if(isset($_GET['IDbook'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['IDbook'];
 $delete_sql = "DELETE FROM book WHERE id='$delete_ID'";


 $book_sql = "SELECT * FROM book where id='$delete_ID'";
 if($book_query = mysqli_query($db, $book_sql)){
 	$book = mysqli_fetch_assoc($book_query);
 }
 $IDcategory = $book['id_category'];

 if($delete_query = mysqli_query($db, $delete_sql)) {
 	echo "<script>
    window.location.href='admin.php?adminpage=adminBookinCate&IDcategory=$IDcategory';
    </script>";
 }


}

?>