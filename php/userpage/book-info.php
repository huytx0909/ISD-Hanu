<?php
if(isset($_GET['IDbook'])) {
  $IDbook = $_GET['IDbook'];



     $book_sql = "SELECT * FROM book WHERE id = '$IDbook'";
$book_query = mysqli_query($db,$book_sql);
 

      $book = mysqli_fetch_assoc($book_query);

                            $IDimage = $book['id_image'];
                            $IDcate = $book['id_category'];
                              $category1_sql = "SELECT * FROM category where id = '$IDcate'";
                          $category1_query = mysqli_query($db,$category1_sql);
              $category1 = mysqli_fetch_assoc($category1_query);

                            $image_sql = "SELECT * FROM image where id = '$IDimage'";
                            if($image_query = mysqli_query($db,$image_sql)) {
                            $image = mysqli_fetch_assoc($image_query);
                                                          }



?>



 <div class="modal fade" id="book_info"  role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Book Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="float-left">
          <img src="img/<?=$image['url'];?>" width="230" height="400" alt="book">
        </div>

        <div class="book-info" style="margin-left: 250px;">
          <div><h2>Title: <?=$book['book_title'];?></h2></div>
          <div style="margin-top: 20px;"><p>Category: <?= $category1['category_name']; ?></p></div>
          <div style="margin-top: 20px;"><p>Author: <?=$book['author_name'];?></p></div>
          <div style="margin-top: 20px;"><p>Publication date: <?php if(isset($book['date_publication'])) { echo date("d/m/Y",strtotime($book['date_publication'])); } ?></p></div>
          <div style="margin-top: 20px;"><p>Prize(VND): <?php $prize = number_format($book['prize']); echo $prize; ?></p></div>
          <div  <?php if($book['status'] == "unavailable") { ?> style="color: red; margin-top: 20px;"  <?php } else { ?> style="color: green; margin-top: 20px;" <?php } ?>><p>Status: <?=$book['status'];?></p></div>
          <div style="margin-top: 20px;"><p>Max Expired Days: <?=$book['max_expired_day'];?></p></div>
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#book_info').modal('show');
    });
</script>


<?php
}
?>