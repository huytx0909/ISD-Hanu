<?php 
	$category_sql = "SELECT * FROM category";
	if($category_query = mysqli_query($db,$category_sql)) {
  $category = mysqli_fetch_assoc($category_query);
 }
 $list = 0;
 ?>

  <div style="margin-left: 200px; padding: 20px;">
 <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextCategory">
      <button class="btn btn-outline-success" type="submit" name="searchCategory">Search</button>
    </form> </div>


	
	<div class = "header">
		<h3 align="center">Book category table</h3>
	</div> <br>

	
	<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead>
                    <tr>
                       <th>list</th>                  
                        <th>Book Category</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php do {  $list = $list + 1;   ?>
                      

                    	<td>
                           
                                <h5><?= $list; ?></h5>
                                                 
                        </td>
                      


                        <td class=""><strong><a href="admin.php?adminpage=adminBookinCate&IDcategory=<?=$category['id'];?>" style="text-decoration-color: none;"><?= $category['category_name']; ?>
                             </a> </strong></td>
                           
                         <td>
                        <a href = "admin.php?adminpage=editBookCategory&ID=<?=$category['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        </td>
                        <td>
                        <a href = "admin.php?adminpage=deleteBookCategory&ID=<?=$category['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove</a>
                        </td>
                  
                    </tr>
                  <?php } while($category = mysqli_fetch_assoc($category_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
             <a href = "admin.php?adminpage=addBookCategory" class="btn btn-success">
                            <span class="glyphicon glyphicon-remove"></span> add new category</a>
        </div>
    </div>
</div>