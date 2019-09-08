
<?php
//including the database connection file

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM user ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($db, "SELECT * FROM user ORDER BY id DESC"); // using mysqli_query instead
?>


	<div class = "header">
		<h3 align="center">User table</h3>
	</div> <br>
	<div class="container" style="margin-top: 50px;">
			<div class="float-left">
				<button type="button" class="btn btn-primary"><a href="admin.php?adminpage=addUser">Add New User</a></button>
			</div>

			<div class="float-right">
				<form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
			      <button class="btn btn-outline-success" type="submit" name="search">Search</button>
			    </form>
			</div>

			<div class="clearfix"></div>
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Username</th>
			      <th scope="col">Password</th>
			      <th scope="col">Email</th>
			      <th scope="col">Phone</th>
			      <th scope="col">Address</th>
			      <th scope="col">Salary</th>
			      <th scope="col">Department</th>
			      <th scope="col">Team</th>
			      <th scope="col">Role</th>
			      <th scope="col">Date Created</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			    	<?php 
						//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
						while($res = mysqli_fetch_array($result)) { 		
							echo "<tr>";
							echo "<td class=\"cell-breakWord\">".$res['username']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['password']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['email']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['phone']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['address']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['salary']."</td>";	
							echo "<td class=\"cell-breakWord\">".$res['department']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['team']."</td>";
							echo "<td class=\"cell-breakWord\">".$res['role']."</td>";		
							echo "<td><button type=\"button\" class=\"btn btn-primary edit\"><a href=\"admin.php?adminpage=editUser&id=$res[id]\">Edit</a></button> | <button type=\"button\" class=\"btn btn-danger delete\"><a href=\"admin.php?adminpage=deleteUser&id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></button></td>";		
						}
						?>
			  </tbody>
			</table>
	</div>
