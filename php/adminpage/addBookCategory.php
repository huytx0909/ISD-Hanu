 <?php 
if (isset($_POST['register_button'])) {
	
	$name = $_POST['name'];
      $category_pattern = '/^[a-zA-Z ]*$/';

    
	$sql1 = "SELECT * FROM category WHERE category_name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "subject existed in database";
	} else {
		
       if(!preg_match($category_pattern, $name) || strlen($name) > 100) {
       $_SESSION['message'] = "Only alphabets and white space allowed";
                  }
            else { 	
		 $sql = "INSERT INTO category(category_name) VALUES('$name')";
			$result = mysqli_query($db, $sql);
			
			
			header("location: admin.php?adminpage=adminBookCategory"); //redirect to home after registering successfully
               
			
		} 
	}
	
}
?>






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Add Category </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=addBookCategory"  class="beta-form-checkout">
		<table>
			 <div class="form-group">
			<tr>
				<td>Category name: </td>
				<td><input type="text" name="name" class="form-control" required></td>
			</tr>
		</div>

			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="add" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>