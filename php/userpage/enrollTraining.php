<?php
if(isset($_GET['IDtraining'])) {
$trainingID = $_GET['IDtraining'];
$username = $_SESSION['user'];
 $user_sql = "SELECT * FROM user where username = '$username'";
 $user_query = mysqli_query($db, $user_sql);
 $user = mysqli_fetch_assoc($user_query);
 $userID = $user['id'];

 $training_query = mysqli_query($db,"SELECT * FROM training where id = '$trainingID'");
 $training = mysqli_fetch_assoc($training_query);
 $numberTrainee = $training['number_trainees'];

 $enrol_query = mysqli_query($db,"INSERT INTO trainee(id_user, id_training) VALUES('$userID','$trainingID')");
 
 $numberTrainee = $numberTrainee + 1;

 $training1_query = mysqli_query($db," UPDATE  training SET number_trainees = '$numberTrainee' where id = '$trainingID'");


 echo "<script>
        alert('enroll successfully');
    window.location.href='user.php?userpage=trainee&IDtraining=$trainingID';
    </script>";   
}


?>




