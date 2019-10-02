<?php
$success = "";

if(isset($_GET['ID'])) {
   $IDaward = $_GET['ID'];
if (isset($_POST['Submit'])) {
	$name = $_POST['username'];
	$awardTitle = $_POST['title'];
	$giftItem = $_POST['gift_item'];
	$awardAmount = $_POST['award_amount'];
	$awardDate = $_POST['award_date'];


	$user_sql = "SELECT * FROM user WHERE username = '$name'";
	$user_query = mysqli_query($db,$user_sql);
    
    
	if (empty($name) || empty($awardTitle) || empty($giftItem) || empty($awardAmount) || empty($awardDate)) {
			$_SESSION['message'] =  "All fields are required."; 
	}
	 else if(!is_numeric($awardAmount) || $awardAmount < 0) {
	       $_SESSION['message'] = "Award amount has to be numberic and greater than 0";
		}
	else if (mysqli_num_rows($user_query) == 1) {
		$user = mysqli_fetch_assoc($user_query); 
		$IDuser = $user['id'];

		$award0_sql = "SELECT * FROM employee_award WHERE id_user = '$IDuser' AND award_title = '$awardTitle' AND gift_item = '$giftItem' AND award_amount = '$awardAmount' AND award_date = '$awardDate' and id != '$IDaward' ";
		$award0_query = mysqli_query($db, $award0_sql);

		if(mysqli_num_rows($award0_query) > 0) {
			$_SESSION['message'] =  "this award existed in the database"; 

		}


			$award_sql = "UPDATE employee_award SET id_user = '$IDuser', award_title = '$awardTitle', gift_item = '$giftItem', award_amount = '$awardAmount', award_date = '$awardDate' WHERE id ='$IDaward'";

		 	$award_query = mysqli_query($db,$award_sql); 
			
			$success = "<div class='success' id='success'>
							Success.
				  		</div>"; 
               
       
	} else {
		$_SESSION['message'] = "There is no such user";
	}
}


$award1_sql = "SELECT * FROM employee_award WHERE id = '$IDaward'";
    $award1_query = mysqli_query($db, $award1_sql);
    $award1 = mysqli_fetch_assoc($award1_query);
    $IDuser0 = $award1['id_user'];

    $user0_sql = "SELECT * FROM user WHERE id = '$IDuser0'";
     $user0_query = mysqli_query($db, $user0_sql);
    $user0 = mysqli_fetch_assoc($user0_query);
?>

  <div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminEmployeeAward">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Edit award to a employee</h2>
</div>

<div class="container">
	<div class="main">
	<form method="POST" action="admin.php?adminpage=editEmployeeAward&ID=<?=$IDaward;?>"  class="form beta-form-checkout">
		<div class="form-group">
			<?php 
				echo $success;
				if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
				} 
				?>
			<label for="name">username:</label>
			<input type="text" name="username" class="form-control" value="<?=$user0['username'];?>">
		</div>

		<div class="form-group">		
			<label for="award">Award title:</label>
			<input type="text" name="title" class="form-control" value="<?=$award1['award_title'];?>">
		</div>

		<div class="form-group">		
			<label for="gift">Gift item:</label>
			<input type="text" name="gift_item" class="form-control" value="<?=$award1['gift_item'];?>">
		</div>

		<div class="form-group">		
			<label for="amount">Award amount:</label>
			<input type="text" name="award_amount" class="form-control" value="<?=$award1['award_amount'];?>">
		</div>
					
					
		<div class="form-group">
			<label for="date">Awarded date:</label>
			<input type="date" name="award_date" class="form-control" value="<?=$award1['award_date'];?>">
		</div>

		

	 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Update</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>

<?php
}
?>