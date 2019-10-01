<?php 
	
  $holiday_sql = "SELECT * FROM holiday ORDER BY start_date ASC";
  if($holiday_query = mysqli_query($db,$holiday_sql)) {
  $holiday = mysqli_fetch_assoc($holiday_query);

 }

 $list = 0;
 ?>




  
  <div class = "header">
    <h2>Holiday table</h2>
  </div> 

  
  <div class="container">
    <div class="float-left">
        <button type="button" class="btn btn-primary"> <a href = "admin.php?adminpage=addHoliday" >Add new holiday event!</a></button>

  </div>

 <div class="float-right">
        <form  class="form-inline" action="admin.php?adminpage=search" method="post" enctype="multipart/form-data">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchtextHoliday">
            <button class="btn btn-outline-success" type="submit" name="searchHoliday">Search</button>
          </form>
      </div>

      <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-md-10 col-md-offset-1">
            <table class="table">
            
                <thead class="thead-dark">
                    <tr>
                       <th>list</th>                  
                        <th>Event name</th>               
                        <th>Description</th>
                        <th>start date</th>  
                       <th>end date</th>                        
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                     
                    <tr>
                         <?php 
                          do {
                            $list = $list + 1;   
                            ?>
                      

                                <td align="center">
                           
                                <?= $list; ?>
                                                 
                                </td>
                      


                              <td class="" align="center" class="cell-breakWord"><?= $holiday['event_name']; ?>
                             </td>

                               <td class="" align="center" class="cell-breakWord"><?= $holiday['description']; ?>
                              </td>

                            

                                 <td class="" align="center" class="cell-breakWord"> <?php if(isset($holiday['start_date'])) {  echo date("d-m-Y",strtotime($holiday['start_date'])); } ?>
                              </td>    
                               <td class="" align="center" class="cell-breakWord"> <?php if(isset($holiday['end_date'])) {  echo date("d-m-Y",strtotime($holiday['end_date'])); } ?>
                              </td>                              

                         <td align="center">
                        <a href = "admin.php?adminpage=editHoliday&ID=<?=$holiday['id'];?>" class="btn btn-primary" data-toogle="tooltip" title="Edit">
                           <i class="far fa-edit"></i></a>
                        <a href = "admin.php?adminpage=deleteHoliday&ID=<?=$holiday['id'];?>" class="btn btn-danger" data-toogle="tooltip" title="Delete">
                           <i class="far fa-trash-alt"></i></a>
                        </td>
                  
                    </tr>
                  <?php 

                      } while($holiday = mysqli_fetch_assoc($holiday_query));
                   ?>

                                       
                
                    

                 

                </tbody>

            </table>
             
        </div>
    </div>
</div>

