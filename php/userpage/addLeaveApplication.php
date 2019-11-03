<?php
if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);
 $userID = $user['id'];


if (isset($_POST['Submit'])) {
	$leaveType = $_POST['leave_type'];
	$personalReason = $_POST['personalReason'];
	$startDate = $_POST['start_date'];
	$endDate = $_POST['end_date'];
	$todayDate = date("Y-m-d");
	$status = "pending";

	
    

    
	
	 if($leaveType == "Personal" && empty($personalReason)) {
	echo "<script>
		alert('detail personal reason is required');
	    </script>"; 	
	}
	else{
		

		$leave0_sql = "SELECT * FROM leave_application WHERE id_user = '$userID' AND leave_type = '$leaveType' AND start_date = '$startDate' AND end_date = '$endDate' ";
		$leave0_query = mysqli_query($db, $leave0_sql);

		if(mysqli_num_rows($leave0_query) > 0) {
		echo "<script>
		alert('leave application existed');
	    </script>"; 	
		}

        else if($startDate < $endDate && $startDate > $todayDate) {

			$leave_sql = "INSERT INTO `leave_application`(id_user, leave_type, status, start_date, end_date, application_date, personal_reason) VALUES('$userID', '$leaveType','$status', '$startDate', '$endDate', '$todayDate', '$personalReason')";

		 	$leave_query = mysqli_query($db,$leave_sql); 
			
			echo "<script>
	alert('added successfully');
    window.location.href='user.php?userpage=LeaveApplication';
    </script>"; 	
               
        }else {
        	echo "<script>
		alert('Start date can't be later than end date and earlier than the date of today.');
	    </script>"; 	
		}
        	
	}
}
?>






	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container leave-application">
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="leave-applications" data-aos="fade-down">
					<div class="item">
						<h2>Add New Leave Application</h2>
						<form method="POST" action="user.php?userpage=addLeaveApplication"  class="form beta-form-checkout">
					
						<div class="form-group select">
				    		<label for="leave_type">Leave Reason:</label>
					   		<select class="form-control" name="leave_type" required="">
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
							<input type="date" name="start_date" class="form-control" required="">
						</div>

						<div class="form-group">
							<label for="date">End Date:</label>
							<input type="date" name="end_date" class="form-control" required="">
						</div>

						<button type="reset" class="btn btn-danger float-right leave_cancel_btn" name="cancel">Cancel</button>
						<button type="submit" class="btn btn-primary float-right leave_add_btn" name="Submit">Add</button>
			
		
			<div class="clearfix"></div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>