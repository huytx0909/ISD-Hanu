<?php  
//export.php  
      require_once 'dbase/dbase.php';

$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM salary_deduction ORDER BY deduction_date DESC";
 $result = mysqli_query($db, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Username</th>  
                         <th>Fullname</th>  
                         <th>Gender</th>  
                         <th>Date Birth</th>  
                         <th>Address</th>
                    	 <th>Department</th>  
                    	 <th>Role</th>  
                          <th>Deduction Amount(VND)</th>  
                           <th>Deduction Reason</th>  
                           <th>Deduction Date</th>  


       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {

  	$IDuser = $row['id_user'];

	$user_query = mysqli_query($db, "SELECT * FROM user where id = '$IDuser'");
  	$user = mysqli_fetch_assoc($user_query);

  	$IDdepartment = $user['id_department'];
  	$IDrole = $user['id_role'];

  	$dob = date("d/m/Y",strtotime($user['DOB']));
  	$deductDate = date("d/m/Y",strtotime($row['deduction_date']));


  	$department_query = mysqli_query($db, "SELECT * FROM department where id = '$IDdepartment'");
  	$depart = mysqli_fetch_assoc($department_query);
  	$departName = $depart['name'];

  		$role_query = mysqli_query($db, "SELECT * FROM role where id = '$IDrole'");
  	$role = mysqli_fetch_assoc($role_query);
  	$roleName = $role['name'];


   $output .= '
    <tr>  
                         <td>'.$user["username"].'</td>  
                         <td>'.$user["fullName"].'</td>  
                         <td>'.$user["gender"].'</td>
             		 	  <td>'.$dob.'</td>  
      					 <td>'.$user["address"].'</td>  
                    	 <td>'.$departName.'</td>
                    	 <td>'.$roleName.'</td>
                    	 <td>'.$row["deduction_amount"].'</td>
                    	 <td>'.$row["deduction_reason"].'</td>
                    	 <td>'.$deductDate.'</td>


                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=salarydeduction.xls');
  echo $output;
 }
}
?>