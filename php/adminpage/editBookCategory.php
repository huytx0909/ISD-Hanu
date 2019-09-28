<?php 
if (isset($_POST['update'])) {
if(isset($_GET['ID'])) {
$category_ID = "";
 $category_ID = $_GET['ID']; 
	
	$name = $_POST['name'];
  
    $category_pattern = '/^[a-zA-Z ]*$/';
   
	$sql1 = "SELECT * FROM category WHERE category_name = '$name' and id != '$category_ID'";
	$result1 = mysqli_query($db, $sql1); 
	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['message'] = "category existed in database";
	} else {
		
       if(!preg_match($category_pattern, $name)) {
       $_SESSION['message'] = "Only alphabets and white space allowed";
                  }
            else { 	
		 $sql = " UPDATE category SET  category_name = '$name' WHERE id ='$category_ID'";
			$result = mysqli_query($db, $sql);
			
			
			header("location: admin.php?adminpage=adminBookCategory"); //redirect to home after registering successfully
               
			
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
    <h2>Add Book Category</h2>
</div> 

<div class="container">
	<div class="main">
		<?php 
			if (isset($_SESSION['message'])) {
				echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
				unset($_SESSION['message']);
			} 
		?>

		<form method="POST" action="admin.php?adminpage=editBookCategory&ID=<?= $category_ID; ?>"  class="form beta-form-checkout">
			<div class="form-group">
				<label for="name">Category Name: </label>
				<input type="text" name="name" class="form-control" value="<?=$category['category_name'];?>" required>
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