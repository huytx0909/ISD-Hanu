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
	if (empty($username) || empty($type)) {
		$_SESSION['error'] =  "All fields are required."; 
	}else if (mysqli_num_rows($result1) == 1) {
	
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


			$_SESSION['success'] = "Success."; 


			$book2_sql = "SELECT * from book where id = '$IDbook'";
			$book2_query = mysqli_query($db, $book2_sql);
			$book2 = mysqli_fetch_assoc($book2_query);

			$returnDate =  date("d-m-Y",strtotime($expiredDate));

			session_start();
			$_SESSION["infoEmailArr"] = array("recipient" => $user['email'],"subject" => "Book order",
			"Book name" => $book2['book_title'],
			"Author" => $book2['author_name'],	
 			"Type" => $type,
 			"Price" => $book2['prize'],
 		    "return date" => $returnDate);

 			echo "<script>
    window.location.href='email/email.php';
    </script>";

	
	
			} else {

				$_SESSION['error'] = "There is no such user";
			}

}
?>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminBookOrder">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Add Order</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
		<form method="POST" action="admin.php?adminpage=addBookOrder&ID=<?=$IDbook;?>" class="form beta-form-checkout">
			<div class="form-group">
				<?php 
				if (isset($_SESSION['error'])) {
				echo "<div class = 'error' id='msg'>".$_SESSION['error']."</div";
				unset($_SESSION['error']);
				} 
				?>
				<label for="name">User Name:</label>
				<input type="text" name="username" class="form-control">
			</div>

			<div class="form-group">
		   		<label for="type">Type of Order:</label>
		   		<select  class="form-control" id="type" name="type">
		   			<option></option>
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
</div>
</div>
<?php
}
?>