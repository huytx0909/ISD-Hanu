<?php
 if(isset($_GET['ID'])) { 
   $IDbook = $_GET['ID'];

if (isset($_POST['register_button'])) {
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
		 $sql = "INSERT INTO `order`(id_user, id_book, placeOrder_date, type, expired_date) VALUES('$IDuser', '$IDbook','$orderDate', '$type', '$expiredDate')";

		     } else {

		     	 $sql = "INSERT INTO `order`(id_user, id_book, placeOrder_date, type) VALUES('$IDuser', '$IDbook','$orderDate', '$type')";

		     }
			$result = mysqli_query($db, $sql);

			$book1_sql = "UPDATE book SET status = 'unavailable' WHERE id = '$IDbook' ";
			$book1_query = mysqli_query($db, $book1_sql);


			header("location: admin.php?adminpage=adminBook"); //redirect to home after registering successfully
               
	
			}

}
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Add Order </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=addBookOrder&ID=<?=$IDbook;?>"  class="beta-form-checkout">
		<table>
			 <div class="form-group" align="center">
			<tr>
				<td><strong>Username: </strong></td>
				<td><input type="text" name="username" class="form-control" required></td>
			</tr>
		</div>


			<div class="form-group" align="center">
   			 <td><strong>Type of order: </strong></td>
   			<td> <select  class="form-control" id="type" name="type" required>
    		  <option value="borrow">Borrow</option>
     		 <option value="purchase">Purchase</option>
   			 </select>
   			</td>
 			 </div>

			
			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="submit" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>

<?php
}
?>