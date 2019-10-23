<?php
if (isset($_POST['Submit'])) {
	$name = $_POST['username'];
	$deductReason = $_POST['deduction_reason'];
	$deductAmount = $_POST['deduction_amount'];
	$deductDate = $_POST['deduction_date'];

	$todayDate = date("Y-m-d");


	$user_sql = "SELECT * FROM user WHERE username = '$name'";
	$user_query = mysqli_query($db,$user_sql);
    
    
	if (empty($name) || empty($deductReason) || empty($deductAmount) || empty($deductDate)) {
			$_SESSION['error'] =  "All fields are required."; 
	}
	 else if(!is_numeric($deductAmount) || $deductAmount < 0) {
	       $_SESSION['error'] = "Deduction amount has to be numberic and greater than 0.";
		} else if($deductDate > $todayDate) {
	   $_SESSION['error'] = "The date must be earlier than today";

		}
	else if (mysqli_num_rows($user_query) == 1) {
		$user = mysqli_fetch_assoc($user_query); 
		$IDuser = $user['id'];

		$deduction0_sql = "SELECT * FROM salary_deduction WHERE id_user = '$IDuser' AND deduction_amount = '$deductAmount' AND deduction_reason = '$deductReason' AND deduction_date = '$deductDate' ";
		$deduction0_query = mysqli_query($db, $deduction0_sql);

		if(mysqli_num_rows($deduction0_query) > 0) {
			$_SESSION['error'] =  "This penalty existed in the database."; 

		}


			$deduct_sql = "INSERT INTO `salary_deduction`(id_user, deduction_amount, deduction_reason, deduction_date) VALUES('$IDuser', '$deductAmount', '$deductReason', '$deductDate')";

		 	$deduct_query = mysqli_query($db,$deduct_sql); 
			
			$_SESSION['success'] = "Success."; 

			$deductDate1 =  date("d/m/Y",strtotime($deductDate));
			$deductAmount1 = number_format($deductAmount);
	
			session_start();
			$_SESSION["infoEmailArr"] = array("recipient" => $user['email'],"subject" => "Penalty fee",
			"username"  => $user['username'],
			"fullname" => $user['fullName'],
			"Deduction amount(VND)" => $deductAmount1,
			"Reason" => $deductReason,
		     "Date" => $deductDate1);


				echo "<script>
    window.location.href='email/email.php';
    </script>";				
               
       
	} else {
		$_SESSION['error'] = "There is no such user.";
	}
}
?>

  <div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminEmployeeDeduction">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add a penalty</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
	<form method="POST" action="admin.php?adminpage=addEmployeeDeduction"  class="form beta-form-checkout">
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
			<label for="amount">Deduction Amount:</label>
			<input type="number" name="deduction_amount" class="form-control">
		</div>
					
					
		<div class="form-group">
			<label for="description">Deduction Reason:</label>
			<textarea class="form-control" rows="5" type="text" name="deduction_reason"></textarea>
		</div>

		<div class="form-group">
			<label for="description">Deduction Date:</label>
			<input type="date" name="deduction_date" class="form-control">
		</div>

		

	 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>
</div>
</div>