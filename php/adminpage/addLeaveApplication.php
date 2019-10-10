<?php
if (isset($_POST['Submit'])) {
	$name = $_POST['username'];
	$leaveType = $_POST['leave_type'];
	$personalReason = $_POST['personalReason'];
	$status = $_POST['status'];
	$startDate = $_POST['start_date'];
	$endDate = $_POST['end_date'];
	$todayDate = date("Y-m-d");


	$user_sql = "SELECT * FROM user WHERE username = '$name'";
	$user_query = mysqli_query($db,$user_sql);
    

    
	if (empty($name) || empty($startDate) || empty($endDate) || empty($status) || empty($leaveType)) {
			$_SESSION['error'] =  "All fields are required."; 
	}
	 else if($leaveType == "Personal" && empty($personalReason)) {
			$_SESSION['error'] =  "Specific personal reason is required."; 

	}
	else if (mysqli_num_rows($user_query) == 1) {
		$user = mysqli_fetch_assoc($user_query); 
		$IDuser = $user['id'];

		$leave0_sql = "SELECT * FROM leave_application WHERE id_user = '$IDuser' AND leave_type = '$leaveType' AND start_date = '$startDate' AND end_date = '$endDate' ";
		$leave0_query = mysqli_query($db, $leave0_sql);

		if(mysqli_num_rows($leave0_query) > 0) {
			$_SESSION['error'] =  "Leave Application existed in the database."; 

		}

        else if($startDate < $endDate && $startDate > $todayDate) {

			$leave_sql = "INSERT INTO `leave_application`(id_user, leave_type, status, start_date, end_date, application_date, personal_reason) VALUES('$IDuser', '$leaveType','$status', '$startDate', '$endDate', '$todayDate', '$personalReason')";

		 	$leave_query = mysqli_query($db,$leave_sql); 
			
			$_SESSION['success'] = "Success."; 
			echo "<script>
    window.location.href='admin.php?adminpage=adminLeaveApplication';
    </script>"; 	
               
        }else {
            $_SESSION['error'] = "Start date can't be later than end date and earlier than the date of today.";
        }	
	} else {
		$_SESSION['error'] = "There is no such user.";
	}
}
?>

  <div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminLeaveApplication">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Add leave application</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
	<form method="POST" action="admin.php?adminpage=addLeaveApplication"  class="form beta-form-checkout">
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
					
					<div class="form-group select">
				    	<label for="leave_type">Leave Reason:</label>
					   	<select class="form-control" name="leave_type">
					   		<option></option>
					   		<option value="Vacation">Vacation</option>
					   		<option value="Personal">Personal</option>
					      	<option value="Sick Leave">Sick Leave</option>
						</select>

					</div>

					<div class="form-group">
					<label for="personalReason">For Detail Personal Reason:</label>
					<textarea class="form-control" rows="5" id="reason" name="personalReason"></textarea>
				</div>
		

		<div class="form-group">
			<label for="date">Start Date:</label>
			<input type="date" name="start_date" class="form-control">
		</div>

		<div class="form-group">
			<label for="date">End Date:</label>
			<input type="date" name="end_date" class="form-control">
		</div>

		<div class="form-group select">
				    	<label for="leave_type">Status:</label>
					   	<select class="form-control" name="status">
					   		<option></option>
					   		<option value="accepted">Accepted</option>
					   		<option value="pending">Pending</option>
					      	<option value="rejected">Rejected</option>
						</select>

					</div>

	 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
	</form>
</div>
</div>
</div>
</div>
