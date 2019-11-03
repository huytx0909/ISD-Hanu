 <?php 
	

if(!isset($_SESSION['user'])) {
echo "<script>
	alert('please sign in');
    window.location.href='userLogin.php';
    </script>"; 	
}


	
  $deduction_sql = "SELECT * FROM salary_deduction ORDER BY deduction_date DESC";
  $deduction_query = mysqli_query($db,$deduction_sql);

 
 $list = 0;
 ?>
  
	<div class="cover" data-aos="fade-down">
		<img src="img/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="image">
	</div>
		

	<div class="container penalty">
		<div class="row" data-aos="fade-down">
			<div class="col-lg-12">
				<form  class="form-inline" action="user.php?userpage=search" method="post" enctype="multipart/form-data">
		            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 search-announcement">
            		<div class="input-group">
              			<input type="search" placeholder="Search..." name="searchtextPenalty" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              		<div class="input-group-append">
                		<button id="button-addon1" type="submit" name="searchPenalty" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
              		</div>
           			</div>
           		</div>
		        </form>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">	
				<div class="penalties" data-aos="fade-down">
					<div class="item table-responsive">
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Deduction amount(VND)</th>
						      <th scope="col">Deduction reason</th>
						      <th scope="col">Deduction date</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  	if(mysqli_num_rows($deduction_query) > 0 ) {
						  	   while ( $deduction = mysqli_fetch_assoc($deduction_query)) {
						  	            $list = $list + 1;
						  	

						  	?>
						    <tr>
						      <th align="center"><?= $list; ?></th>
						      <td align="center" class="cell-breakWord"><?php $deductAmount = number_format($deduction['deduction_amount']); echo $deductAmount; ?></td>
						      <td align="center" class="cell-breakWord"><?= $deduction['deduction_reason']; ?></td>
						      <td align="center" class="cell-breakWord"> <?php if(isset($deduction['deduction_date'])) {  echo date("d/m/Y",strtotime($deduction['deduction_date'])); } ?></td>
						    </tr>
						    <?php
							}
							} else {
								?>

								<h6>No penalties.</h6>
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

