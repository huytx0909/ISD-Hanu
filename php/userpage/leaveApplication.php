<?php 
	
	
if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}



  $leave_sql = "SELECT * FROM leave_application ORDER BY application_date DESC";
  $leave_query = mysqli_query($db,$leave_sql);

 

 $list = 0;
 ?>
  
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container leave-application">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextLeave" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchLeave" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<a class="btn btn-primary leave-btn" href="user.php?userpage=addLeaveApplication" data-aos="fade-down">New Leave Application</a>
				<div class="leave-applications" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">List</th>
						      <th scope="col">Application date</th>
						      <th scope="col">Leave type</th>
						      <th scope="col">Personal reason</th>
						      <th scope="col">Start date</th>
						      <th scope="col">End date</th>
						      <th scope="col">Status</th>
						      <th scope="col">Action</th>

						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($leave_query) > 0 ) {
						  	while ($leave = mysqli_fetch_assoc($leave_query)) {	
						  	$list = $list + 1;
						  							  	
						  	?>

						    <tr>
						      <th align="center"><?=$list;?></th>
						      <td align="center" class="cell-breakWord"><?php if(isset($leave['application_date'])) {  echo date("d/m/Y",strtotime($leave['application_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?=$leave['leave_type'];?></td>
						      <td align="center" class="cell-breakWord"><?=$leave['personal_reason'];?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($leave['start_date'])) {  echo date("d/m/Y",strtotime($leave['start_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><?php if(isset($leave['end_date'])) {  echo date("d/m/Y",strtotime($leave['end_date'])); } ?></td>
						      <td align="center" class="cell-breakWord"><span <?php if($leave['status'] == "accepted") { ?> class="badge badge-success" <?php } else if($leave['status'] == "pending") { ?>  class="badge badge-warning" <?php } else { ?> class="badge badge-danger" <?php } ?>  ><?= $leave['status']; ?></span></td>

						 <?php
						 if($leave['status'] == "pending") {
						 ?>
                         <td align="center">
                        <a href = "user.php?userpage=editLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "user.php?userpage=deleteLeaveApplication&ID=<?=$leave['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                        <?php
                    	}
                    	?>

						    </tr>

						    <?php
							}
							} else {
								?>
								<h6>No leave applications.</h6>
								<?php
							}
							?>

						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

