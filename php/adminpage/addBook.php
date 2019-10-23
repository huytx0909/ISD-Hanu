<?php 
if (isset($_POST['Submit'])) {
	
	$title = $_POST['title'];
	$authorName = $_POST['authorName'];
	$datePublication = $_POST['datePublication'];
	$prize = $_POST['prize'];
	$status = $_POST['status'];
	$max_expired_day = $_POST['max_expired_day'];
    $category = $_POST['category'];
	$image = $_POST['image'];

	$sql1 = "SELECT * FROM book WHERE book_title = '$title' AND author_name = '$authorName' AND date_publication = '$datePublication' ";
	$result1 = mysqli_query($db, $sql1);

	if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] = "Book existed in database.";
	} else {
		if (empty($title) || empty($authorName) || empty($datePublication) || empty($prize)
			|| empty($status) || empty($max_expired_day) || empty($category)) {
			$_SESSION['error'] =  "All fields are required."; 
		}else if(!is_numeric($prize) || $prize < 0) {
	       $_SESSION['error'] = "Prize has to be numberic and greater than 0.";
		}else {
	    $category_sql = "SELECT * from category where category_name = '$category'";
	    $category_query = mysqli_query($db, $category_sql);
	    if($category_q = mysqli_fetch_assoc($category_query)){
	    $IDcategory = $category_q['id'];
	      }

	    $image_sql = "INSERT INTO image(url) VALUES ('$image')";
	    $image_query = mysqli_query($db, $image_sql);
	   
	    $image1_sql = "SELECT * from image where url = '$image'";
	    $image1_query = mysqli_query($db, $image1_sql);
	    if($image1 = mysqli_fetch_assoc($image1_query)) {
	    $IDimage = $image1['id'];
     }

 	$sql = "INSERT INTO book(book_title, author_name, date_publication, prize, status, max_expired_day, id_category, id_image) VALUES('$title', '$authorName', '$datePublication', '$prize', '$status', '$max_expired_day','$IDcategory' ,'$IDimage')";
			$result = mysqli_query($db, $sql);
	$_SESSION['success'] = "Success.";
	echo "<script>
    window.location.href='admin.php?adminpage=adminBook';
    </script>";            
	}
}
}
?>


<?php

	$category1_sql = "SELECT * from category";
 if($category1_query = mysqli_query($db,$category1_sql)) {
  $category1 = mysqli_fetch_assoc($category1_query);
 } 

	?>

<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminBook">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add Book</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
		<form method="POST" action="admin.php?adminpage=addBook" class="form beta-form-checkout">
			<div class="form-group">
				<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='error'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
				?>
				<label for="title">Book Title:</label>
				<input type="text" name="title" class="form-control">
			</div>

	        <div class="form-group">
				<label for="name">Author's Name: </label>
				<input type="text"  name="authorName" class="form-control">
			</div>
	        
			<div class="form-group">
				<label for="date">Date of Publication:</label>
				<input type="date" name="datePublication" class="form-control">
			</div>

			<div class="form-group">
				<label for="prize">Prize (VND):</label>
				<input type="number" name="prize" class="form-control">
			</div>
	  
			<div class="form-group">
				<label for="expired">Max Expired Day:</label>
				<input type="number" min="1" max = "30" name="max_expired_day" class="form-control">
			</div>
	        		

	        <div class="form-group">
			    <label for="category">Category</label>
			    <select  class="form-control" id="category" name="category">
			    	<option></option>
		     		<?php
		           		do {
		      		?>
		      		<option value="<?= $category1['category_name']; ?>" <?php if(isset($_GET['ID'])) { if($_GET['ID'] == $category1['id']) { ?> selected <?php }  } ?> ><?= $category1['category_name'] ?></option>
		      		<?php
		        		} while($category1 = mysqli_fetch_assoc($category1_query));
		      		?>
	    		</select>
	  		</div>

	   		<div class="form-group">
			    <label for="status">Status</label>
			    <select  class="form-control" id="status" name="status">
			    	<option></option>
			    	<option value="available">available</option>
			    	<option value="unavailable">unavailable</option>
	    		</select>
	  		</div>

	  		<div class="form-group">
	    		<label for="image">Image</label>
	    		<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
	  		</div>	
			
				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
		</form>
	</div>
</div>
</div>
</div>
