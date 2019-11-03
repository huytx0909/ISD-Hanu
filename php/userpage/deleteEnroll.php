<?php



  if(isset($_GET['ID'])){
$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);
 $userID = $user['id'];

  	$trainingID = $_GET['ID'];


 	$training0_sql = "SELECT * from training where id = '$trainingID'";
				$training0_query = mysqli_query($db,$training0_sql);
				$training0 = mysqli_fetch_assoc($training0_query);
				$numberTrainee = $training0['number_trainees'] - 1;

		     	 $training1_sql = "UPDATE training set number_trainees = '$numberTrainee' where id = '$trainingID'";
				$training1_query = mysqli_query($db,$training1_sql);

 $delete_sql = "DELETE FROM trainee WHERE id_training='$trainingID' AND id_user = '$userID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {
 	echo "<script>
    window.location.href='user.php?userpage=trainingCourses';
    </script>";
 }


}

?>