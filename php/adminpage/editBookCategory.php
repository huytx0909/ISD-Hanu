<?php 
if (isset($_POST['register_button'])) {
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






  <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Edit Book Category </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 
	?>
	</div>


	<form method="POST" action="admin.php?adminpage=editBookCategory&ID=<?= $category_ID; ?>"  class="beta-form-checkout">
		<table>
			 <div class="form-group">
			<tr>
				<td>Category name: </td>
				<td><input type="text" name="name" class="form-control" value="<?=$category['category_name'];?>" required></td>
			</tr>
		</div>

			 		
			<tr>
				<td></td>
				<td><input type="submit" name="register_button" value="edit" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>
</div>
</div>

<?php
}
?>