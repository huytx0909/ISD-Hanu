<?php 
	$category_sql = "SELECT * FROM category";
	if($category_query = mysqli_query($db,$category_sql)) {
  $category = mysqli_fetch_assoc($category_query);
 }
 $list = 0;
 ?>

	
	<div class = "header">
		<h2>Book Category Table</h2>
	</div>

	<div class="container">
    
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
                      


                        <td align="center" class="cell-breakWord"><a href="admin.php?adminpage=adminBookinCate&IDcategory=<?=$category['id'];?>"><strong><?= $category['category_name']; ?></strong>
                             </a></td>
                           
                         <td align="center">
                        <a href = "admin.php?adminpage=editBookCategory&ID=<?=$category['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                            <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteBookCategory&ID=<?=$category['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php } while($category = mysqli_fetch_assoc($category_query)); ?>


                </tbody>
           

            </table>
             
        </div>
    </div>
</div>