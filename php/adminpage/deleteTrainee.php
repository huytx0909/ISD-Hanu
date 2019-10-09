<?php
  if(isset($_GET['ID'])){
  	$delete_ID = "";
  	$delete_ID = $_GET['ID'];

$training_sql = "SELECT * from trainee where id ='$delete_ID'";
 	$training_query = mysqli_query($db, $training_sql);
 	$training = mysqli_fetch_assoc($training_query);
 	$IDtraining = $training['id_training'];

 	$training0_sql = "SELECT * from training where id = '$IDtraining'";
				$training0_query = mysqli_query($db,$training0_sql);
				$training0 = mysqli_fetch_assoc($training0_query);
				$numberTrainee = $training0['number_trainees'] - 1;

		     	 $training1_sql = "UPDATE training set number_trainees = '$numberTrainee' where id = '$IDtraining'";
				$training1_query = mysqli_query($db,$training1_sql);

 $delete_sql = "DELETE FROM trainee WHERE id='$delete_ID'";
 if($delete_query = mysqli_query($db, $delete_sql)) {

 	echo "<script>
    window.location.href='admin.php?adminpage=adminTrainee&IDtraining=$IDtraining"';
    </script>";
 }


}

?>