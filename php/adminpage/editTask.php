<?php
$success = "";
if(isset($_GET['ID'])) {
	$IDtask = $_GET['ID'];

if (isset($_POST['Submit'])) {
	$name = $_POST['task_name'];
	$team_name = $_POST['team'];
	$description = $_POST['description'];
	$deadline = $_POST['deadline'];
	$status = $_POST['status'];

	$todayDate = date("Y-m-d");


	
    
    
	if (empty($name) || empty($team_name) || empty($description) || empty($deadline) || empty($status)) {
			$_SESSION['message'] =  "All fields are required."; 
	}
	
	else {
		$team_sql = "SELECT * FROM team WHERE name = '$team_name'";
	$team_query = mysqli_query($db,$team_sql);
		$team = mysqli_fetch_assoc($team_query); 
		$IDteam = $team['id'];

        if($deadline > $todayDate) {

			$task_sql = "UPDATE task SET id_team = '$IDteam', task_name = '$name', description ='$description', deadline = '$deadline', status = '$status' WHERE id = '$IDtask'";

		 	$task_query = mysqli_query($db,$task_sql); 
			
			$success = "<div class='success' id='success'>
							Success.
				  		</div>"; 
               
        }else {
            $_SESSION['message'] = "deadline could not be earlier than today!";
        }	
	} 
}

$team_sql = "SELECT * from team ORDER BY name ASC";
$team_query = mysqli_query($db, $team_sql);
$team = mysqli_fetch_assoc($team_query);


$task1_sql = "SELECT * from task where id = '$IDtask'";
$task1_query = mysqli_query($db, $task1_sql);
$task1 = mysqli_fetch_assoc($task1_query);
?>

  <div class = "header">
	<button type="submit" class="btn btn-primary float-left" name="Submit">
		<a href="admin.php?adminpage=adminTask">
			<i class="fas fa-chevron-left"></i>
			Back
		</a>
	</button>
    <h2>Edit Task</h2>
</div>

<div class="container">
	<div class="main">
	<form method="POST" action="admin.php?adminpage=editTask&ID=<?=$IDtask;?>"  class="form beta-form-checkout">
		<div class="form-group">
			<?php 
				echo $success;
				if (isset($_SESSION['message'])) {
					echo "<div class='error'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
				} 
				?>
			<label for="name">Task name:</label>
			<input type="text" name="task_name" class="form-control" value="<?=$task1['task_name'];?>">
		</div>

		<div class="form-group select">
				    	<label for="team">Team:</label>
					   	<select class="form-control" name="team" required>
					   		<?php 
					   			do { ?>
					   		<option value="<?=$team['name'];?>" <?php if($task1['id_team'] == $team['id']) { ?> selected <?php } ?>  ><?=$team['name'];?></option>
					   	<?php	} while ($team = mysqli_fetch_assoc($team_query)); 
					   		 ?>
						</select>

					</div>
					
					

					<div class="form-group">
					<label for="description">Description:</label>
					<textarea class="form-control" rows="5" id="reason" name="description"><?=$task1['description'];?></textarea>
				</div>
		

		<div class="form-group">
			<label for="date">Deadline:</label>
			<input type="date" name="deadline" class="form-control" value="<?=$task1['deadline'];?>">
		</div>

		

		<div class="form-group select">
				    	<label for="status">Status:</label>
					   	<select class="form-control" name="status">
					   		<option value="completed" <?php if($task1['status'] == "completed") { ?> selected <?php } ?> >completed</option>
					      	<option value="incompleted" <?php if($task1['status'] == "incompleted") { ?> selected <?php } ?>>incompleted</option>
						</select>

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

