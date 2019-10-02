<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

 if(isset($_GET['ID'])) { 
   $IDbook = $_GET['ID'];

if (isset($_POST['Submit'])) {
	  $IDbook = $_GET['ID'];
	  $username = $_POST['username'];
	  $type = $_POST['type'];

		$orderDate = date("Y/m/d");
		$expiredDate = "";


	$book_sql = "SELECT * FROM book WHERE id = '$IDbook'";
	$book_query = mysqli_query($db,$book_sql);
	$book = mysqli_fetch_assoc($book_query);
	$expiredDays = $book['max_expired_day'];
    $expiredDate = date('Y/m/d', strtotime("+". $expiredDays . " days"));
    
	$sql1 = "SELECT * FROM user WHERE username = '$username'";
	$result1 = mysqli_query($db, $sql1);

	if (mysqli_num_rows($result1) == 1) {
	
			$user = mysqli_fetch_assoc($result1); 
			$IDuser = $user['id'];

         if($type == "borrow") {
         	$status = "incompleted";

		 	$sql = "INSERT INTO `order`(id_user, id_book, placeOrder_date, type, expired_date, status) VALUES('$IDuser', '$IDbook','$orderDate', '$type', '$expiredDate', '$status')";

		     } else {

		     	$status = "completed";

		     	 $sql = "INSERT INTO `order`(id_user, id_book, placeOrder_date, type, status) VALUES('$IDuser', '$IDbook','$orderDate', '$type', '$status')";

		     }
			$result = mysqli_query($db, $sql);

			$book1_sql = "UPDATE book SET status = 'unavailable' WHERE id = '$IDbook' ";
			$book1_query = mysqli_query($db, $book1_sql);


		echo "<script>
    		alert('added order successfully');
   			window.location.href='admin.php?adminpage=adminBookOrder';
    			</script>";               
	
			} else {

				$_SESSION['message'] = "there is no such user";
			}

}
?>

<div class = "header">
	<h2>Add Order</h2>
</div>

<div class="container">
	<div class="main">
		<?php 
			if (isset($_SESSION['message'])) {
				echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
				unset($_SESSION['message']);
			} 
		?>

		<form method="POST" action="admin.php?adminpage=addBookOrder&ID=<?=$IDbook;?>" class="form beta-form-checkout">
			<div class="form-group">
				<label for="name">User Name:</label>
				<input type="text" name="username" class="form-control" required>
			</div>

			<div class="form-group">
		   		<label for="type">Type of Order:</label>
		   		<select  class="form-control" id="type" name="type" required>
		    		<option value="borrow">Borrow</option>
		     		<option value="purchase">Purchase</option>
		   		</select>
		 	</div>

				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
					
			<div class="clearfix"></div>
			</form>
	</div>
</div>

<?php
}
?>