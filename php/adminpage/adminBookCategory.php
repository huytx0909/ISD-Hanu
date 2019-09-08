<?php 
	$category_sql = "SELECT * FROM category";
	if($category_query = mysqli_query($db,$category_sql)) {
  $category = mysqli_fetch_assoc($category_query);
 }
 $list = 0;
 ?>

	
	<div class = "header">
		<h3 align="center">Book category table</h3>
	</div> <br>

	
	<div class="container" style="margin-top: 50px;">

  <div class="float-left">
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBookCategory" > Add new Category</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextCategory">
            <button class="btn btn-outline-success" type="submit" name="searchCategory">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
             
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Book Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php do {  $list = $list + 1;   ?>
                      

                    	<td align="center">
                           
                                <?= $list; ?>
                                                 
                        </td>
                      


                        <td class="" align="center"><a href="admin.php?adminpage=adminBookinCate&IDcategory=<?=$category['id'];?>" style="color: black;"><?= $category['category_name']; ?>
                             </a></td>
                           
                         <td align="center">
                        <a href = "admin.php?adminpage=editBookCategory&ID=<?=$category['id'];?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Edit</a>
                        <a href = "admin.php?adminpage=deleteBookCategory&ID=<?=$category['id'];?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Delete</a>
                        </td>
                  
                    </tr>
                  <?php } while($category = mysqli_fetch_assoc($category_query)); ?>

                                       
                
                    

                 

                </tbody>
           

            </table>
             
        </div>
    </div>
</div>