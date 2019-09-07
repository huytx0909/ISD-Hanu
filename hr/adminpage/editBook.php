<?php 
  if(isset($_GET['ID'])) {

       $book_ID = $_GET['ID']; 
   	

if (isset($_POST['submit'])) {



	$title = $_POST['title'];
	$authorName = $_POST['authorName'];
	$datePublication = $_POST['datePublication'];
	$prize = $_POST['prize'];
	$status = $_POST['status'];
	$max_expired_day = $_POST['max_expired_day'];
    $category = $_POST['category'];
	$image = $_POST['image'];





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

 $sql = "UPDATE book set book_title = '$title', author_name = '$authorName', date_publication = '$datePublication', prize = '$prize', max_expired_day = '$max_expired_day', id_category = '$IDcategory', id_image = '$IDimage', status = '$status' WHERE id = '$book_ID'";
			$result = mysqli_query($db, $sql);
			
			
			header("location: admin.php?adminpage=adminBook"); //redirect to home after registering successfully
               

               

          }  else {


            $sql = "UPDATE book set book_title = '$title', author_name = '$authorName', date_publication = '$datePublication', prize = '$prize', max_expired_day = '$max_expired_day', id_category = '$IDcategory', status = '$status' WHERE id = '$book_ID'";
			$result = mysqli_query($db, $sql);
			
			
			header("location: admin.php?adminpage=adminBook"); //redirect to home after registering successfully
               


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


?>






   <div class="row">
   	<div class="col-md-4"></div>
   	<div class="col-md-4">

	<div class="header" align="center"> 
		<h1> Edit Book </h1>
 <?php 
	if (isset($_SESSION['message'])) {
		echo "<div id = 'error_msg'>".$_SESSION['message']."</div";
		unset($_SESSION['message']);
	} 

	?>
	
	</div>


	<form method="POST" action="admin.php?adminpage=editBook&ID=<?= $book['id'];?>" class="beta-form-checkout">
			 <div class="form-group" style="padding: 3px;">
			<tr>
				<td><strong>Book title: </strong></td>
				<td><input type="text" name="title" class="form-control" value="<?= $book['book_title']; ?>" ></td>
			</tr>
		</div>

        <div class="form-group" style="padding: 3px;">
			<tr>
				<td><strong>author's name: </strong></td>
				<td>
			<input type="text"  name="authorName" class="form-control"  value="<?= $book['author_name']; ?>" >

			</td>
			</tr>
		</div>
        


		<div class="form-group" style="padding: 3px;">
		 <div class='input-group date' id='datetimepicker1'>
			<tr>
				<td><strong>date of publication: </strong></td>
				<td><input type="date" name="datePublication" class="form-control"  value="<?= $book['date_publication']; ?>" >
				 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span></td>
			</tr>
		</div>
		</div>



		 <div class="form-group" style="padding: 3px;">
			<tr>
				<td><strong>prize (USD): </strong></td>
				<td><input type="number" min="0" name="prize" class="form-control"  value="<?= $book['prize']; ?>"></td>
			</tr>
		</div>
  

		 <div class="form-group" style="padding: 3px;">
			<tr>
				<td><strong>max expired day:</strong> </td>
				<td><input type="number" min="1" max = "30" name="max_expired_day"  value="<?= $book['max_expired_day']; ?>" class="form-control"></td>
			</tr>
		</div>
        		<div class="form-group">
    <label for="category"><strong>category</strong></label>
    <select  class="form-control" id="category" name="category" required>
      <?php
           do {
      ?>
      <option value="<?= $category1['category_name'] ?>"><?= $category1['category_name'] ?></option>
      <?php
        } while($category1 = mysqli_fetch_assoc($category1_query));
      ?>
    </select>
  </div>


   		<div class="form-group">
    <label for="status"><strong>status</strong></label>
    <select  class="form-control" id="status" name="status"  required>
      <option value="available" <?php if($book['status'] == "available") { ?> selected="selected"  <?php } ?> >available</option>
      <option value="unavailable" <?php if($book['status'] == "unavailable") { ?> selected="selected"  <?php } ?> >unavailable</option>
    </select>
  </div>


		


  <div class="form-group">
    <label for="image"><strong>Image</strong></label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
  </div>

			 		
			<tr>
				<td></td>
				<td><button type="submit" name="submit" class="btn btn-primary">submit</button></td>
			</tr>
	</form>
</div>
</div>

<?php
}

?>
