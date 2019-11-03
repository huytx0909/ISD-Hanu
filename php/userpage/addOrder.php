<?php






if(isset($_GET['IDbook'])) {
$IDbook = $_GET['IDbook'];
$book_sql = "SELECT * FROM book where id = '$IDbook'";
$book_query = mysqli_query($db, $book_sql);
$book = mysqli_fetch_assoc($book_query);
$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);
 $userID = $user['id'];

if(isset($_GET['action']) && $_GET['action'] == "borrow") {
	
		$orderDate = date("Y/m/d");
		$type = "borrow";
	$expiredDays = $book['max_expired_day'];

    $expiredDate = date('Y/m/d', strtotime("+". $expiredDays . " days"));
$status = "incompleted";

	$sql = "INSERT INTO `order`(id_user, id_book, placeOrder_date, type, expired_date, status) VALUES('$userID', '$IDbook','$orderDate', '$type', '$expiredDate', '$status')";

			$result = mysqli_query($db, $sql);

			$book1_sql = "UPDATE book SET status = 'unavailable' WHERE id = '$IDbook' ";
			$book1_query = mysqli_query($db, $book1_sql);

			echo "<script>
			alert('borrowed successfully');
    history.go(-1);

    </script>";
} else if(isset($_GET['action']) && $_GET['action'] == "purchase") {


		$orderDate = date("Y/m/d");
$type = "purchase";
$status = "completed";


 $sql = "INSERT INTO `order`(id_user, id_book, placeOrder_date, type, status) VALUES('$userID', '$IDbook','$orderDate', '$type', '$status')";

 			$result = mysqli_query($db, $sql);
 			$book1_sql = "UPDATE book SET status = 'unavailable' WHERE id = '$IDbook' ";
			$book1_query = mysqli_query($db, $book1_sql);
echo "<script>
			alert('purchase successfully');

    history.go(-1);
 
    </script>";

}
}
?>