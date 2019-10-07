<?php 
if (isset($_POST['Submit'])) {
	
	$name = $_POST['name'];
      $category_pattern = '/^[a-zA-Z ]*$/';

    
	$sql1 = "SELECT * FROM category WHERE category_name = '$name'";
	$result1 = mysqli_query($db, $sql1); 
	if (empty($name)) {
			$_SESSION['error'] =  "All fields are required."; 
       	}
	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] = "Book category existed in database.";
	} else {
		 if(!preg_match($category_pattern, $name) || strlen($name) > 100) {
       		$_SESSION['error'] = "Name must contain letters and spaces only.";
        }else { 	
		 	$sql = "INSERT INTO category(category_name) VALUES('$name')";
			$result = mysqli_query($db, $sql);
			
			$_SESSION['success'] = "Success."; 
			header("Location:admin.php?adminpage=adminBookCategory."); 	 
               
			
		} 
	}
	
}
?>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminBookCategory">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add Book Category</h2>
</div> 

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
			<form method="POST" action="admin.php?adminpage=addBookCategory"  class="form beta-form-checkout">
				<div class="form-group">
					<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
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
</div>
</div>
