<?php
 $success = "";

if (isset($_POST['Submit'])) {

		//variables
	  $title = $_POST['title'];
	  $content = $_POST['content'];
	 
		$todayDate = date("Y-m-d");
		$announcer = $_SESSION['admin'];

	
    //query all announcements
    $sql1 = "SELECT * FROM announcement WHERE title = '$title' AND content = '$content'";
	$result1 = mysqli_query($db, $sql1); 
	//check fields empty or not
	if (empty($title) || empty($content)) {
			$_SESSION['error'] =  "All fields are required."; 
	}
		// check title and content are numeric or not
	 else if(is_numeric($title) || is_numeric($content)) {
					$_SESSION['error'] =  "title or content could not be numberic"; 

	} 
	// check if announcement exists in db
	else if (mysqli_num_rows($result1) >= 1) {
		$_SESSION['error'] = "announcement event existed in database.";
	}   
	  else {
	
		// insert announcement
		 $announce_sql = "INSERT INTO `announcement`(title, content, announcer, date_created) VALUES('$title', '$content', '$announcer', '$todayDate')";

		 $announce_query = mysqli_query($db, $announce_sql); 

		 // announce success
				$_SESSION['success'] = "Success.";   
				echo "<script>
    window.location.href='admin.php?adminpage=adminAnnouncement';
    </script>";     
       

	
			} 

}
?>

<div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminAnnouncement">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add Announcement</h2>
</div>
<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
	<form method="POST" action="admin.php?adminpage=addAnnouncement"  class="form beta-form-checkout">
			 <div class="form-group">
			<?php 
				if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
				} 
				?>
			<label for="name">Announcement title:</label>
			<input type="text" name="title" class="form-control">
		</div>


		<div class="form-group">
					<label for="description">Announcement Content:</label>
					<textarea class="form-control" rows="5" id="description" name="content"></textarea>
				</div>

			 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>
</div>
</div>
