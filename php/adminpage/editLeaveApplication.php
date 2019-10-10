<?php
 $success = "";
if(isset($_GET['ID'])) {
 $IDleave = $_GET['ID'];	
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
    
    
	if (empty($name) || empty($startDate) || empty($endDate) || empty($leaveType) || empty($status)) {
			$_SESSION['error'] =  "All fields are required."; 
	} else if($leaveType == "Personal" && empty($personalReason)) {
			$_SESSION['error'] =  "Specific personal reason is required."; 

	} else if (mysqli_num_rows($user_query) == 1) {
		$user = mysqli_fetch_assoc($user_query); 
		$IDuser = $user['id'];

		$leave0_sql = "SELECT * FROM leave_application WHERE id_user = '$IDuser' AND leave_type = '$leaveType' AND start_date = '$startDate' AND end_date = '$endDate' and id != $'IDleave' ";

		$leave0_query = mysqli_query($db, $leave0_sql);

		if(mysqli_num_rows($leave0_query) > 0) {
			$_SESSION['error'] =  "Leave Application existed in the database."; 

		}

       else if($startDate < $endDate && $startDate > $todayDate) {

			$leave_sql = "UPDATE leave_application SET id_user = '$IDuser', leave_type = '$leaveType', personal_reason = '$personalReason', status = '$status', start_date = '$startDate', end_date = '$endDate' WHERE id = '$IDleave'";

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

    $leave1_sql = "SELECT * FROM leave_application where id = '$IDleave'";
    $leave1_query = mysqli_query($db, $leave1_sql);
    $leave1 = mysqli_fetch_assoc($leave1_query);
    $IDuser1 = $leave1['id_user'];
    $user1_sql = "SELECT * FROM user where id = '$IDuser1'";
    $user1_query = mysqli_query($db, $user1_sql);
    $user1 = mysqli_fetch_assoc($user1_query);


?>

  <div class = "header">
	<button type="submit" class="btn btn-dark float-left" name="Submit">
		<a href="admin.php?adminpage=adminLeaveApplication">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Edit leave application</h2>
</div>

<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-2 col-sm-4 col-md-8 col-xl-12">
	<form method="POST" action="admin.php?adminpage=editLeaveApplication&ID=<?= $leave1['id']; ?>"  class="form beta-form-checkout">
		<div class="form-group">
			<?php 
				echo $success;
				if (isset($_SESSION['error'])) {
					echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
					unset($_SESSION['error']);
				} 
				?>
			<label for="name">username:</label>
			<input type="text" name="username" class="form-control" value="<?= $user1['username']; ?>">
		</div>
					
					<div class="form-group select">
				    	<label for="leave_type">Leave reason:</label>
					   	<select class="form-control" name="leave_type">
					   		<option></option>
					   		<option value="Vacation" <?php if($leave1['leave_type'] == "Vacation") { ?> selected="selected"  <?php } ?>>Vacation</option>
					   		<option value="Personal" <?php if($leave1['leave_type'] == "Personal") { ?> selected="selected"  <?php } ?>>Personal</option>
					      	<option value="Sick Leave" <?php if($leave1['leave_type'] == "Sick Leave") { ?> selected="selected"  <?php } ?>>Sick Leave</option>
						</select>

					</div>

					<div class="form-group">
					<label for="description">For detail personal reason:</label>
					<textarea class="form-control" rows="5" id="reason" name="personalReason"><?= $leave1['personal_reason']; ?></textarea>
				</div>
		

		<div class="form-group">
			<label for="date">Start Date:</label>
			<input type="date" name="start_date" class="form-control" value="<?= $leave1['start_date']; ?>">
		</div>

		<div class="form-group">
			<label for="date">End Date:</label>
			<input type="date" name="end_date" class="form-control" value="<?= $leave1['end_date']; ?>">
		</div>

		<div class="form-group select">
				    	<label for="leave_type">Status:</label>
					   	<select class="form-control" name="status">
					   		<option></option>
					   		<option value="accepted" <?php if($leave1['status'] == "accepted") { ?> selected="selected"  <?php } ?>>accepted</option>
					   		<option value="pending" <?php if($leave1['status'] == "pending") { ?> selected="selected"  <?php } ?>>pending</option>
					      	<option value="rejected" <?php if($leave1['status'] == "rejected") { ?> selected="selected"  <?php } ?>>rejected</option>
						</select>

					</div>

	 		
			<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
			<button type="submit" class="btn btn-primary float-right" name="Submit">Update</button>
			
		
			<div class="clearfix"></div>
		</table>
	</form>
</div>
</div>
</div>
</div>
<?php
}
?>