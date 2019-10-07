<?php 
	$category_sql = "SELECT * FROM category ORDER BY category_name ASC";
	if($category_query = mysqli_query($db,$category_sql)) {
  $category = mysqli_fetch_assoc($category_query);
 }
 $list = 0;
 ?>

	
	<div class = "header">
		<h2>Book Category Table</h2>
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
        <button type="button" class="btn btn-primary"><a href = "admin.php?adminpage=addBookCategory" > Add new Category</a></button>
      </div>

  <div class="col-6 col-xl-4">
      <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextCategory">
          <button class="btn btn-outline-success" type="submit" name="searchCategory">Search</button>
      </form>
  </div>
  </div>
  
  <div class="row">
        <div class="col-11 col-md-11 col-xl-12 table-responsive" >
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
                            <i class="far fa-trash-alt" onclick="confirm('Are you sure you want to delete this');"></i></a>
                        </td>
                  
                    </tr>
                  <?php } while($category = mysqli_fetch_assoc($category_query)); ?>


                </tbody>
           

            </table>
      </div>       
</div>
</div>
</div>