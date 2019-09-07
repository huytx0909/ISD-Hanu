<?php 
	$subject_sql = "SELECT * FROM subject ORDER BY name ASC";
	if($subject_query = mysqli_query($db,$subject_sql)) {
  $subject = mysqli_fetch_assoc($subject_query);
 }
 $list = 0;
 ?>

  <div align ="right">
 <form  class="form-inline" action="index.php?page=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtext">
      <button class="btn btn-outline-success" type="submit" name="search">Search</button>
    </form> </div>


	
	<div class = "header">
		<h3 align="center">subject table</h3>
	</div> <br>

	
	<div class="container">
    <div class="row">
      <div class="col-md-3"></div>
        <div class="col-md-6">
            <table class="table">
             
                <thead>
                    <tr>
                       <th>list</th>                  
                        <th>subject</th>
                       
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php do {  $list = $list + 1;   ?>
                      

                    	<td>
                           
                                <h5><?= $list; ?></h5>
                                                 
                        </td>
                      


                        <td class=""><strong><a href="index.php?page=course&IDsubject=<?=$subject['id'];?>" style="text-decoration-color: none;"><?= $subject['name']; ?>
                             </a> </strong></td>

                         
                  
                    </tr>
                  <?php } while($subject = mysqli_fetch_assoc($subject_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
            
        </div>
    </div>
</div>

