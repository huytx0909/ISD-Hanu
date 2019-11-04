<?php  
//export.php  
      require_once 'dbase/dbase.php';

$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM user ORDER BY id_department ASC";
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
                         <th>Email</th>
                         <th>Phone Number</th>                         
                          <th>Gross Salary(VND)</th>  
                           <th>Net Salary(VND)</th>  
                           <th>Role</th>  
                           <th>Department</th>  


       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
  	$IDdepartment = $row['id_department'];
  	$IDrole = $row['id_role'];

  	$dob = date("d/m/Y",strtotime($row['DOB']));

  	$department_query = mysqli_query($db, "SELECT * FROM department where id = '$IDdepartment'");
  	$depart = mysqli_fetch_assoc($department_query);
  	$departName = $depart['name'];

  		$role_query = mysqli_query($db, "SELECT * FROM role where id = '$IDrole'");
  	$role = mysqli_fetch_assoc($role_query);
  	$roleName = $role['name'];


   $output .= '
    <tr>  
                         <td>'.$row["username"].'</td>  
                         <td>'.$row["fullName"].'</td>  
                         <td>'.$row["gender"].'</td>
             		   <td>'.$dob.'</td>  
  
      					 <td>'.$row["address"].'</td>
       					 <td>'.$row["email"].'</td>  
      					 <td>'.$row["phone"].'</td>  
  
      					 <td>'.$row["gross_salary"].'</td>
             			 <td>'.$row["net_salary"].'</td>
                    	 <td>'.$roleName.'</td>
                    	 <td>'.$departName.'</td>


                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=employee.xls');
  echo $output;
 }
}
?>