<?php 
if (isset($_POST['update'])) {
if(isset($_GET['ID'])) {
$category_ID = "";
 $category_ID = $_GET['ID']; 
	
	$name = $_POST['name'];
  
    $category_pattern = '/^[a-zA-Z ]*$/';
   
	$sql1 = "SELECT * FROM category WHERE category_name = '$name' and id != '$category_ID'";
	$result1 = mysqli_query($db, $sql1); 
	if (empty($name)) {
			$_SESSION['error'] =  "All fields are required."; 
       	}
	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] = "Category existed in database.";
	} else {
		
       if(!preg_match($category_pattern, $name)) {
       		$_SESSION['error'] = "Only alphabets and white space allowed";
        }else { 	
		 	$sql = " UPDATE category SET  category_name = '$name' WHERE id ='$category_ID'";
			$result = mysqli_query($db, $sql);
			
			
			$_SESSION['success'] = "Success."; 
			header("Location:admin.php?adminpage=adminBookCategory");
			
		} 
	}
  }	
}
if(isset($_GET['ID'])) {
 $category_ID = "";
 $category_ID = $_GET['ID'];
 $category_sql = "SELECT * from category where id = '$category_ID'";
 if($category_query = mysqli_query($db,$category_sql)) {
  $category = mysqli_fetch_assoc($category_query);
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

<div class="container">
	<div class="main">
		<form method="POST" action="admin.php?adminpage=editBookCategory&ID=<?= $category_ID; ?>"  class="form beta-form-checkout">
			<div class="form-group">
				<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
				<label for="name">Category Name: </label>
				<input type="text" name="name" class="form-control" value="<?=$category['category_name'];?>">
			</div>

			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="update">Update</button>
			
		
			<div class="clearfix"></div>
		</form>
	</div>
</div>

<?php
}
?>