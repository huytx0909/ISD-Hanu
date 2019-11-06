<?php
 
  $user_sql = "SELECT * FROM user ORDER BY username ASC";
  $user_query = mysqli_query($db,$user_sql);

   





if(isset($_POST['update'])) {


        if(isset($_POST['socialInsurance']) && isset($_POST['healthInsurance']) && isset($_POST['providentFund'])) {

        $_SESSION['socialInsurance'] = $_POST['socialInsurance'];
         $_SESSION['healthInsurance'] = $_POST['healthInsurance'];
         $_SESSION['providentFund'] = $_POST['providentFund'];
       $_SESSION['success'] = "Updated Successfully."; 
     

            } 


           }




 ?>
  
  <div class = "header">
    <h2>Employee Salary </h2>
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
          <form method="post" action="exportSalary.php" style="margin-bottom: 5px;">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoModal">Update Deduction</button>

      </div>

      <div class="col-6 col-xl-4">
       <div class="float-right">
          <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextSalary">
              <button class="btn btn-outline-success" type="submit" name="searchSalary">Search</button>
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
                        <th>Gross Salary(VND)</th>
                        <th>Social Insurance(<?php if(isset($_SESSION['socialInsurance'])) { echo $_SESSION['socialInsurance']; } else {echo 8;} ?>%)</th>
                       <th>Provident Fund(<?php if(isset($_SESSION['providentFund'])) { echo $_SESSION['providentFund']; } else {echo 5;} ?>%)</th>
                       <th>Health Insurance(VND)</th>
                       <th>Total Penalties(VND)</th> 
                      <th>Net Salary(VND)</th>

                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          while($user = mysqli_fetch_assoc($user_query)) {

                  
                            ?>
                               
                      


                              <td align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>
                           


                              <td align="center" class="cell-breakWord"><?php $grossSalary = number_format($user['gross_salary']); echo $grossSalary; ?>
                              </td>

                              <?php
                                if(isset($_SESSION['socialInsurance']) && isset($_SESSION['healthInsurance']) && isset($_SESSION['providentFund'])) {


                                       $IDuser = $user['id'];
                                  $penalty0_sql = "SELECT * FROM salary_deduction WHERE id_user = '$IDuser'";
                                  $penalty0_query = mysqli_query($db, $penalty0_sql);
                                  $totalPenalty = 0;
                                  while($penalty0 = mysqli_fetch_assoc($penalty0_query)){
                                    $totalPenalty = $totalPenalty + $penalty0['deduction_amount'];
                                  }
                                   $netSalary0 = $user['gross_salary'] - $totalPenalty;



                               $socialInsurance = $user['gross_salary'] / 100 *  $_SESSION['socialInsurance'];
                               $provi = $user['gross_salary'] / 100 *  $_SESSION['providentFund'];
                               $healthInsurance = $_SESSION['healthInsurance'];
                               $netSalary = $netSalary0 - $socialInsurance -  $provi - $healthInsurance;
                               $IDuser = $user['id'];
                               $user1_sql = "UPDATE user SET net_salary = '$netSalary' WHERE id = '$IDuser'";
                               $user1_query = mysqli_query($db, $user1_sql);
                                    } else {

                                       $IDuser = $user['id'];
                                  $penalty0_sql = "SELECT * FROM salary_deduction WHERE id_user = '$IDuser'";
                                  $penalty0_query = mysqli_query($db, $penalty0_sql);
                                  $totalPenalty = 0;
                                  while($penalty0 = mysqli_fetch_assoc($penalty0_query)){
                                    $totalPenalty = $totalPenalty + $penalty0['deduction_amount'];
                                  }
                                   $netSalary0 = $user['gross_salary'] - $totalPenalty;

                                       $socialInsurance = $user['gross_salary'] / 100 *  8;
                               $provi = $user['gross_salary'] / 100 *  5;
                               $healthInsurance = 0;
                               $netSalary = $netSalary0 - $socialInsurance -  $provi - $healthInsurance;
                               $IDuser = $user['id'];
                               $user1_sql = "UPDATE user SET net_salary = '$netSalary' WHERE id = '$IDuser'";
                               $user1_query = mysqli_query($db, $user1_sql);


                                    }

                              ?>

                               <td align="center" class="cell-breakWord"><?php $socialInsurance1 = number_format($socialInsurance); echo $socialInsurance1; ?>
                              </td>
                           
                            <td align="center" class="cell-breakWord"><?php $provi1 = number_format($provi); echo $provi1; ?>
                              </td>
                           
                            <td align="center" class="cell-breakWord"><?php $health = number_format($healthInsurance); echo $health; ?>
                              </td>


                          


                              <td align="center" class="cell-breakWord"><?php $totalPenalty1 = number_format($totalPenalty); echo $totalPenalty1; ?>
                              </td>
                           


                              <td align="center" class="cell-breakWord"><?php $netSalary2 = number_format($netSalary); echo $netSalary2; ?>
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



    


 <!-- Modal -->
  <div class="modal fade" id="demoModal" role="dialog">


    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="admin.php?adminpage=adminEmployeeSalary" class="beta-form-checkout">

        <div class="modal-header">
         <div class="float-left">
          <h4 class="modal-title"> Update Deduction </h4></div>
        </div>
        <div class="modal-body">

          <div class="form-group">
        <label for="name">Social Insurance(%): </label>
        <input type="number" min="0" max="100"  name="socialInsurance" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="name">Provident Fund(%): </label>
        <input type="number" min = "0" max="100"  name="providentFund" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="name">Health Insurance(VND): </label>
        <input type="number" min = "0"  name="healthInsurance" class="form-control" required>
      </div>
         

        </div>
        <div class="modal-footer">
          <input type="submit" name="update" value="submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </form>
      </div>
      
    </div>
  </div>

  
