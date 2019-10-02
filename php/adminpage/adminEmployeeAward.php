<?php 
	
  $award_sql = "SELECT * FROM employee_award ORDER BY award_date DESC";
  if($award_query = mysqli_query($db,$award_sql)) {
  $award = mysqli_fetch_assoc($award_query);

 }

 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Employee Award </h2>
  </div> 

  
  <div class="container">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addEmployeeAward" >Add new award to employee!</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextAward">
            <button class="btn btn-outline-success" type="submit" name="searchAward">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>List</th>                  
                        <th>Username</th>
                        <th>Fullname</th>                   
                        <th>Award title</th>
                        <th>Gift item</th>
                       <th>Award amount(VND)</th>  
                       <th>Awarded date</th>
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;
                            $IDuser = $award['id_user']; 
                            $user_sql = "SELECT * FROM user where id = '$IDuser'";
                            $user_query = mysqli_query($db, $user_sql);
                            $user = mysqli_fetch_assoc($user_query);


                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td class="" align="center" class="cell-breakWord"><?= $user['username']; ?>
                             </td>

                               <td class="" align="center" class="cell-breakWord"><?= $user['fullName']; ?>
                              </td>

                             

                              <td class="" align="center" class="cell-breakWord"><?= $award['award_title']; ?>
                              </td>

                              <td class="" align="center" class="cell-breakWord"><?= $award['gift_item']; ?>
                              </td>

                              <td class="" align="center" class="cell-breakWord"><?= $award['award_amount']; ?>
                              </td>
                           
                                  
                               <td class="" align="center" class="cell-breakWord"> <?php if(isset($award['award_date'])) {  echo date("d-m-Y",strtotime($award['award_date'])); } ?>
                              </td>

                                                           

                         <td align="center">
                        <a href = "admin.php?adminpage=editEmployeeAward&ID=<?=$award['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteEmployeeAward&ID=<?=$award['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($award = mysqli_fetch_assoc($award_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
             
        </div>
    </div>
</div>
