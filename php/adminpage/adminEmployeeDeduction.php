<?php 
	
  $deduction_sql = "SELECT * FROM salary_deduction ORDER BY deduction_date DESC";
  $deduction_query = mysqli_query($db,$deduction_sql);

 
 ?>
  
  <div class = "header">
    <h2>Salary Deduction </h2>
  </div> 

  <div class="container-fluid">
 <div class="main">
    <div class="row">
      <div class="col-sm-11 col-xl-12">
      <?php 
        if (isset($_SESSION['success'])) {
        echo "<div class='success' id='msg'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
        } 
      ?>
      <?php 
        if (isset($_SESSION['error'])) {
        echo "<div class='error' id='msg'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
        } 
      ?>
      </div>
    </div>  
    <div class="row">
      <div class="col-6 col-xl-8">
         <form method="post" action="exportDeduction.php" style="margin-bottom: 5px;">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>   
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addEmployeeDeduction" >Add new penalty to employee</a></button>
      </div>
      <div class="col-6 col-xl-4">
       <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextDeduction">
              <button class="btn btn-outline-success" type="submit" name="searchDeduction">Search</button>
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="row">
      <div class="col-11 col-md-11 col-xl-12 table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                         <th>Fullname</th>
                        <th>Date of Birth</th>
                        <th>Deduction Amount(VND)</th>                   
                        <th>Deduction Reason</th>
                       	<th>Deduction Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          while($deduction = mysqli_fetch_assoc($deduction_query)) {
                            $IDuser = $deduction['id_user']; 
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


                            ?>
                               
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>

                             

                              <td align="center" class="cell-breakWord"> <?php if(isset($user['DOB'])) {  echo date("d/m/Y",strtotime($user['DOB'])); } ?>
                              </td>


                              <td align="center" class="cell-breakWord"><?php $deductAmount = number_format($deduction['deduction_amount']); echo $deductAmount; ?>
                              </td>

                               <td align="center" class="cell-breakWord"><?= $deduction['deduction_reason']; ?>
                              </td>
                           
                                  
                               <td align="center" class="cell-breakWord"> <?php if(isset($deduction['deduction_date'])) {  echo date("d/m/Y",strtotime($deduction['deduction_date'])); } ?>
                              </td>
                                       

                         <td align="center">
                        <a href = "admin.php?adminpage=editEmployeeDeduction&ID=<?=$deduction['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteEmployeeDeduction&ID=<?=$deduction['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete" onclick="return ConfirmDelete();">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } 
                   ?>
                 

                </tbody>

            </table>
             
        </div>
    </div>
  </div>
</div>