	<?php
	//including the database connection file

	$nameErr=$passwordErr=$emailErr=$phoneErr=$addressErr=$salaryErr=$departmentErr=$teamErr= $roleErr =$success="";

	if(isset($_POST['Submit'])) {	
		$userName = mysqli_real_escape_string($mysqli, $_POST['user-name']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
		$address = mysqli_real_escape_string($mysqli, $_POST['address']);
		$salary = mysqli_real_escape_string($mysqli, $_POST['salary']);
		$department = mysqli_real_escape_string($mysqli, $_POST['department']);
		$team = mysqli_real_escape_string($mysqli, $_POST['team']);
		$role = mysqli_real_escape_string($mysqli, $_POST['role']);
			
		// checking empty fields
		if(empty($userName) || empty($password) || empty($email) || empty($phone) || empty($address) || empty($salary) || empty($department) || empty($team) || empty($role)) {
					
			if(empty($userName)) {
				$nameErr = "Name field is empty";
			}
			
			if(empty($password)) {
				$passwordErr = "Password field is empty";
			}
			
			if(empty($email)) {
				$emailErr = "Email field is empty";
			}

			if(empty($phone)) {
				$phoneErr = "Phone field is empty";
			}
			
			if(empty($address)) {
				$addressErr = "Address field is empty";
			}
			
			if(empty($salary)) {
				$salaryErr = "Salary field is empty";
			}

			if(empty($department)) {
				$departmentErr = "Department field is empty";
			}
			
			if(empty($team)) {
				$teamErr = "Team field is empty";
			}
			
			if(empty($role)) {
				$roleErr = "Role field is empty";
			}
			
		} else { 
			// if all the fields are filled (not empty) 

			//insert data to database	
			echo $userName, $password, $email, $phone, $address, $salary, $department, $team, $role;
			$insertResult = mysqli_query($db, "INSERT INTO user(`name`, password, email, phone, address, salary, department, team, role) VALUES('$userName','$password','$email','$phone','$address','$salary','$department','$team','$role')");
			
			//display success message
			$success = "Data added successfully.";
		}
	}

			$roleResult = mysqli_query($db, "SELECT * FROM role ORDER BY id DESC"); // using mysqli_query instead
			$departmentResult = mysqli_query($db, "SELECT * FROM department ORDER BY id DESC"); // using mysqli_query instead
			$teamResult = mysqli_query($db, "SELECT * FROM team ORDER BY id DESC"); // using mysqli_query instead
	?>
	

		<div class="container">

			<div class="main">
				<h2 style="text-align: center;">Add new data</h2>
				<form action="admin.php?adminpage=addUser" method="post" name="form1" class="form">
					<span class="success"><?php echo $success; ?></span>
				  <div class="form-group">
				    <label for="name">User Name:</label><br>
				    <span class="error"><?php echo $nameErr; ?></span>
				    <input type="text" class="form-control" name="user-name" placeholder="Enter user name">
				  </div>

				  <div class="form-group">
				    <label for="password">Password:</label><br>
				    <span class="error"><?php echo $passwordErr; ?></span>
				    <input type="password" class="form-control" name="password" placeholder="Enter password">
				  </div>

				  <div class="form-group">
				    <label for="email">Email:</label><br>
				    <span class="error"><?php echo $emailErr; ?></span>
				    <input type="text" class="form-control" name="email" placeholder="Enter email">
				  </div>

				   <div class="form-group">
				    <label for="phone">Phone:</label><br>
				    <span class="error"><?php echo $phoneErr; ?></span>
				    <input type="text" class="form-control" name="phone" placeholder="Enter phone">
				  </div>

				  <div class="form-group">
				    <label for="address">Address:</label><br>
				    <span class="error"><?php echo $addressErr; ?></span>
				    <input type="text" class="form-control" name="address" placeholder="Enter address">
				  </div>
				
				  <div class="form-group">
				    <label for="salary">Salary:</label><br>
				    <span class="error"><?php echo $salaryErr; ?></span>
				    <input type="text" class="form-control" name="salary" placeholder="Enter salary">
				  </div>
				<div class="select-group">
				  <div class="form-group select">
				  		<label for="department">Department:</label><br>
				  		<span class="error"><?php echo $departmentErr; ?></span>
				  		<br>
				  		
				    	<select class="custom-select" name="department">
				    		<option></option>
					   		<?php
					   		while($res = mysqli_fetch_array($departmentResult)) { ?> 
					      	<option  value=<?php echo "<td>".$res['name']."</td>"?>>

					      	 <?php echo "<td>".$res['name']."</td>"?>    		
					      	</option>									
							<?php
						 }
						?>
						</select>
				  </div>

				  <div class="form-group select">
				  		<label for="team">Team:</label><br>
				  		<span class="error"><?php echo $teamErr; ?></span>
				  		<br>
				  		
				    	<select class="custom-select" name="team">
				    		<option></option>
					   		<?php
					   		while($res = mysqli_fetch_array($teamResult)) { ?> 
					      	<option value=<?php "<td>".$res['name']."</td>"?>>

					      	 <?php echo "<td>".$res['name']."</td>"?>    		
					      	</option>									
							<?php
						 }
						?>
						</select>
				  </div>

				    <div class="form-group select">
				    	<label for="role">Role:</label><br>
				    	<span class="error"><?php echo $roleErr; ?></span>
				    	<br>
				    	
					   <select class="custom-select" name="role">
					   		<option></option>
					   		<?php
					   		while($res = mysqli_fetch_array($roleResult)) { ?> 
					      	<option value=<?php echo "<td>".$res['name']."</td>"?>>

					      	 <?php echo "<td>".$res['name']."</td>"?>    		
					      	</option>									
							<?php
						 }
						?>
						</select>
						
					</div>
				</div>

				   	<button type="reset" class="btn btn-danger float-right" name="cancel" >Cancel</button>
				  	<button type="submit" class="btn btn-primary float-right" name="Submit">Add</button>

				  <div class="clearfix"></div>
				</form>
			</div>
		</div>
	
