	<?php
  if(isset($_GET['id'])){
//getting id of the data from url
    $id = $_GET['id'];
  if(isset($_POST['deleteID'])){
//deleting the row from table
 $delete_sql = "DELETE FROM user WHERE id='$id'";

//redirecting to the display page (index.php in our case)
$_SESSION['success'] = "Success.";
header("Location: admin.php?adminpage=adminUser");
}
}
?>

<!-- Modal -->
  <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="admin.php?adminpage=deleteUser&id=<?=$res['id'];?>" class="beta-form-checkout">

        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        	<input type="text" name="roleId" id="Id">
         <h5>Are you sure you want to delete this?</h5>

        </div>
        <div class="modal-footer">
          <button  name="deleteID" id="delete-btn" value="Delete" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

        </div>
      </form>
      </div>
      
    </div>
  </div>

<script>
  $(document).on("click", "#delete", function () {
     var dataId = $(this).data('id');
     $(".modal-body #Id").val( dataId );
});

</script>

