<?php 
  if(isset($_GET['ID'])) {

       $book_ID = $_GET['ID']; 
   	

if (isset($_POST['update'])) {

	$title = $_POST['title'];
	$authorName = $_POST['authorName'];
	$datePublication = $_POST['datePublication'];
	$prize = $_POST['prize'];
	$status = $_POST['status'];
	$max_expired_day = $_POST['max_expired_day'];
    $category = $_POST['category'];
	$image = $_POST['image'];

	if (empty($title) || empty($authorName) || empty($datePublication) || empty($prize)
			|| empty($status) || empty($max_expired_day) || empty($category)) {
			$_SESSION['error'] =  "All fields are required."; 
		}

   else if(!is_numeric($prize) || $prize < 0) {
       $_SESSION['error'] = "Prize has to be numberic and greater than 0.";
	}
      else {



 $category_sql = "SELECT * from category where category_name = '$category'";
    $category_query = mysqli_query($db, $category_sql);
    if($category_q = mysqli_fetch_assoc($category_query)){
    $IDcategory = $category_q['id'];
      }
     
   
    if(!empty($image)) {


    $image0_sql= "SELECT * from image where url = '$image'";
    $image0_query = mysqli_query($db, $image0_sql);
    $countRow = mysqli_num_rows($image0_query);
   
    if($countRow == 0) {

    $image_sql = "INSERT INTO image(url) VALUES ('$image')";
    $image_query = mysqli_query($db, $image_sql);
      }
    
   
    $image1_sql = "SELECT * from image where url = '$image'";
    $image1_query = mysqli_query($db, $image1_sql);
    if($image1 = mysqli_fetch_assoc($image1_query)) {
    $IDimage = $image1['id'];
     }

      $sql = "UPDATE book set book_title = '$title', author_name = '$authorName', date_publication = '$datePublication', prize = '$prize', max_expired_day = '$max_expired_day', id_category = '$IDcategory', status = '$status', id_image = '$IDimage' WHERE id = '$book_ID'";
			$result = mysqli_query($db, $sql);
			
			$_SESSION['success'] = "Success."; 
			echo "<script>
    window.location.href='admin.php?adminpage=adminBook';
    </script>"; 	   
               
          }  else {


            $sql = "UPDATE book set book_title = '$title', author_name = '$authorName', date_publication = '$datePublication', prize = '$prize', max_expired_day = '$max_expired_day', id_category = '$IDcategory', status = '$status' WHERE id = '$book_ID'";
			$result = mysqli_query($db, $sql);
			
			$_SESSION['success'] = "Success."; 
			echo "<script>
    window.location.href='admin.php?adminpage=adminBook';
    </script>"; 	           
           }

	}
	
       }


 $book_sql = "SELECT * from book where id = '$book_ID'";
 if($book_query = mysqli_query($db,$book_sql)) {
  $book = mysqli_fetch_assoc($book_query);
 }

  

 $category1_sql = "SELECT * from category";
 if($category1_query = mysqli_query($db,$category1_sql)) {
  $category1 = mysqli_fetch_assoc($category1_query);
 }



 $categoryID = $book['id_category'];
$category2_sql = "SELECT * from category where id = '$categoryID'";
 if($category2_query = mysqli_query($db,$category2_sql)) {
  $category2 = mysqli_fetch_assoc($category2_query);
 }

?>






<div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminBook">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
	<h2>Edit Book</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
		<form method="POST" action="admin.php?adminpage=editBook&ID=<?= $book['id'];?>" class="form beta-form-checkout">
			<div class="form-group">
				<?php 
					if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
					} 
					?>
				<label for="title">Book title:</label>
				<input type="text" name="title" class="form-control" value="<?= $book['book_title']; ?>">
			</div>

	        <div class="form-group">
				<label for="name">Author's name: </label>
				<input type="text"  name="authorName" class="form-control"  value="<?= $book['author_name']; ?>">
			</div>
	        
			<div class="form-group">
				<label for="date">Date of publication:</label>
				<input type="date" name="datePublication" class="form-control" value="<?= $book['date_publication']; ?>">
			</div>

			<div class="form-group">
				<label for="prize">Prize (VND):</label>
				<input type="number" name="prize" class="form-control" value="<?= $book['prize']; ?>">	
			</div>
	  
			<div class="form-group">
				<label for="expired">Max Expired Day:</label>
				<input type="number" min="1" max = "30" name="max_expired_day" value="<?= $book['max_expired_day']; ?>" class="form-control">
			</div>

	        <div class="form-group">
	        	<label for="category">Category</label>
	    		<select  class="form-control" id="category" name="category">
			      	<?php
			        	do {
			      	?>
			      	<option value="<?= $category1['category_name'] ?>"  <?php if($category2['category_name'] == $category1['category_name']) { ?> selected="selected"  <?php } ?>    ><?= $category1['category_name'] ?></option>
			      	<?php
			        	} while($category1 = mysqli_fetch_assoc($category1_query));
			      	?>
	    		</select>
	  		</div>

	   		<div class="form-group">
	     		<label for="status">Status</label>
	    		<select class="form-control" id="status" name="status">
	    			<option></option>
			    	<option value="available" <?php if($book['status'] == "available") { ?> selected="selected"  <?php } ?> >available</option>
			      	<option value="unavailable" <?php if($book['status'] == "unavailable") { ?> selected="selected"  <?php } ?> >unavailable</option>
	    		</select>
	 		</div>

	  		<div class="form-group">
	    		<label for="image">Image</label>
	    		<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
	  		</div>

				<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				<button type="submit" class="btn btn-primary float-right" name="update">Update</button>
			
		
			<div class="clearfix"></div>
		</form>
	</div>
</div>
</div>
</div>
<?php
}

?>

