<?php 
$success = "";
if (isset($_POST['Submit'])) {
	
	$name = $_POST['name'];
      $category_pattern = '/^[a-zA-Z ]*$/';

    
	$sql1 = "SELECT * FROM category WHERE category_name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "Book category existed in database";
	} else {
		if (empty($name)) {
			$_SESSION['message'] =  "All fields are required."; 
       	}else if(!preg_match($category_pattern, $name) || strlen($name) > 100) {
       		$_SESSION['message'] = "Only alphabets and white space allowed";
        }else { 	
		 	$sql = "INSERT INTO category(category_name) VALUES('$name')";
			$result = mysqli_query($db, $sql);
			
			$success = "<div class='success' id='success'>
							Success.
				  		</div>"; 
               
			
		} 
	}
	
}
?>

<div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminBookCategory">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add Book Category</h2>
</div> 

<div class="container">
	<div class="main">
			<form method="POST" action="admin.php?adminpage=addBookCategory"  class="form beta-form-checkout">
				<div class="form-group">
					<?php 
					echo $success;
					if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
					} 
					?>
					<label for="name">Category Name: </label>
					<input type="text" name="name" class="form-control">
				</div>
		
				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
				<div class="clearfix"></div>
			</form>
	</div>
</div>