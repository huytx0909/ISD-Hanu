<?php
if (isset($_POST['Submit'])) {
	$name = $_POST['username'];
	$awardTitle = $_POST['title'];
	$giftItem = $_POST['gift_item'];
	$awardAmount = $_POST['award_amount'];
	$awardDate = $_POST['award_date'];


	$user_sql = "SELECT * FROM user WHERE username = '$name'";
	$user_query = mysqli_query($db,$user_sql);
    
    
	if (empty($name) || empty($awardTitle) || empty($giftItem) || empty($awardAmount) || empty($awardDate)) {
			$_SESSION['error'] =  "All fields are required."; 
	}
	 else if(!is_numeric($awardAmount) || $awardAmount < 0) {
	       $_SESSION['error'] = "Award amount has to be numberic and greater than 0.";
		}
	else if (mysqli_num_rows($user_query) == 1) {
		$user = mysqli_fetch_assoc($user_query); 
		$IDuser = $user['id'];

		$award0_sql = "SELECT * FROM employee_award WHERE id_user = '$IDuser' AND award_title = '$awardTitle' AND gift_item = '$giftItem' AND award_amount = '$awardAmount' AND award_date = '$awardDate' ";
		$award0_query = mysqli_query($db, $award0_sql);

		if(mysqli_num_rows($award0_query) > 0) {
			$_SESSION['error'] =  "This award existed in the database."; 

		}


			$award_sql = "INSERT INTO `employee_award`(id_user, award_title, gift_item, award_amount, award_date) VALUES('$IDuser', '$awardTitle', '$giftItem', '$awardAmount', '$awardDate')";

		 	$award_query = mysqli_query($db,$award_sql); 
			
			$_SESSION['success'] = "Success."; 
			header("Location:admin.php?adminpage=adminEmployeeAward"); 	
               
       
	} else {
		$_SESSION['error'] = "There is no such user.";
	}
}
?>

  <div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminEmployeeAward">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add award to a employee</h2>
</div>

<div class="container">
	<div class="main">
	<form method="POST" action="admin.php?adminpage=addEmployeeAward"  class="form beta-form-checkout">
		<div class="form-group">
			<?php 
				if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
				} 
				?>
			<label for="name">Username:</label>
			<input type="text" name="username" class="form-control">
		</div>

		<div class="form-group">		
			<label for="award">Award Title:</label>
			<input type="text" name="title" class="form-control">
		</div>

		<div class="form-group">		
			<label for="gift">Gift Item:</label>
			<input type="text" name="gift_item" class="form-control">
		</div>

		<div class="form-group">		
			<label for="amount">Award Amount:</label>
			<input type="text" name="award_amount" class="form-control">
		</div>
					
					
		<div class="form-group">
			<label for="date">Awarded Date:</label>
			<input type="date" name="award_date" class="form-control">
		</div>

		

	 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>

