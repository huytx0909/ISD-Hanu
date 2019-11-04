 <?php


if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



$user = $_SESSION['user'];
$user_sql = "SELECT * from user WHERE username = '$user'";
$result = mysqli_query($db, $user_sql);
	$res = mysqli_fetch_assoc($result);
	$userID = $res['id'];
	$userName = $res['username'];
	$fullName = $res['fullName'];
	$email = $res['email'];
	$phone = $res['phone'];
	$address = $res['address'];
	$level = $res['level'];
	$dob = $res['DOB'];
	$gender = $res['gender'];




	$IDimage = $res['id_image'];
					
	 $image_sql = "SELECT * FROM image where id = '$IDimage'";
      if($image_query = mysqli_query($db,$image_sql)) {
         $image = mysqli_fetch_assoc($image_query);
                                                          }





if (isset($_POST['update'])) {
	$userName = mysqli_real_escape_string($db, $_POST['username']);
	$fullName = mysqli_real_escape_string($db, $_POST['fullName']);

	$oldPassword = mysqli_real_escape_string($db, $_POST['old_password']);


	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	
	$dob = mysqli_real_escape_string($db, $_POST['DOB']);
	$gender = mysqli_real_escape_string($db, $_POST['gender']);
	$image = mysqli_real_escape_string($db, $_POST['image']);

	// echo $password, $email, $phone, $address, $salary, $departmentName, $teamName, $roleName;

	// checking empty fields
	   $sql1 = "SELECT * FROM user WHERE username = '$userName' and id != '$userID'";
		$result1 = mysqli_query($db, $sql1); 

		$oldPassword1 = md5($oldPassword);
		 $sql2 = "SELECT * FROM user WHERE id = '$userID' and password = '$oldPassword1'";
		$result2 = mysqli_query($db, $sql2); 
	
	if(mysqli_num_rows($result2) == 0) {
		echo "<script>
    	  alert('your password is incorect');
    	</script>";
	}

	 else if (mysqli_num_rows($result1) >= 1) {
	echo "<script>
      alert('username existed in database');
    </script>"; 	} else { 
	 	if(ctype_alpha(str_replace(' ', '', $fullName)) === false) {
	echo "<script>
    	  alert('full name could not contain numbers');
    	</script>";
    		} 

		 else {
	

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

     	$updateUser_sql = "UPDATE user SET username = '$userName', fullName = '$fullName', email = '$email', phone = '$phone', address = '$address', gender = '$gender', DOB = '$dob', id_image = '$IDimage' WHERE id = '$userID' ";
		$update_query = mysqli_query($db, $updateUser_sql);

			echo "<script>
			 alert('Update successfully');
    window.location.href='user.php?userpage=profile';
    </script>"; 
		
               
          }  else {


           	$updateUser_sql = "UPDATE user SET username = '$userName', fullName = '$fullName', email = '$email', phone = '$phone', address = '$address', gender = '$gender', DOB = '$dob' WHERE id = '$userID' ";
		$update_query = mysqli_query($db, $updateUser_sql);

	echo "<script>
			 alert('Update successfully');
    window.location.href='user.php?userpage=profile';
    </script>";        
           }




	 
	}
}
}





?>







	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container profile">
			<form method="POST" action="user.php?userpage=editUserProfile" class="form">

		<div class="row">

			<div class="col-md-3">	
				<div class="user-pic" data-aos="fade-down">
					<img src="img/<?=$image['url'];?>"  width="234" height = "200" alt="pic">
					<input type="file" class="form-control-file file" id="exampleFormControlFile1" name="image">

				</div>
			</div>
			
			<div class="col-md-5">
				<div class="info" data-aos="fade-down">
					<div>
						<label for="name">Full Name:</label>
						<input type="text" name="fullName" class="form-control" value="<?= $fullName; ?>" required="">
					</div>
					<div class="item1">
						<label for="gender">Gender:</label>
						<select  class="form-control" id="gender" name="gender" value="<?= $gender; ?>" required>
							<option value="male">Male</option>
							<option value="female">Female</option>
			      		</select>
					</div>
					<div class="item1">
						<label for="date">Date of Birth:</label>
						<input type="date" name="DOB" class="form-control" value="<?= $dob; ?>" required>
					</div>
					<div class="item1">
						<label for="address">Address:</label>
						<input type="text" name="address" class="form-control" value="<?= $address; ?>" required>
					</div>
					<div class="item1">
						<label for="phone">Phone Number:</label>
						<input type="text" name="phone" class="form-control" value="<?= $phone; ?>" required>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="info" data-aos="fade-down">
					<div>
						<label for="name">Username:</label>
						<input type="text" name="username" class="form-control" value="<?= $userName; ?>" required>
					</div>
					<div class="item1">
						<label for="password">Your Password:</label>
						<input type="password" name="old_password" minlength="8" class="form-control" required>
					</div>
					
					<div class="item1">
						<label for="email">Email:</label>
						<input type="text" name="email" class="form-control" value="<?= $email; ?>" required>
					</div>


					<div class="item1">
						<a href="user.php?userpage=profile" style="margin-top: 10px;" class="btn btn-danger float-right" name="cancel" >Cancel</a>
						<button type="submit" class="btn btn-primary float-right" name="update">Update</button>


					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
				</form>

	</div>