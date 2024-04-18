<?php 
 // include our database connection
 include("connection.php");
 session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rice Check</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" <!-- End layout styles -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <style>
  .custom-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  text-decoration: none;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.custom-button:hover {
  background-color: #45a049;
}
</style>
  </head>
  <body>
    <div class="container-scroller">
      <?php require_once 'partials/_navbar.php' ?>
      <div class="container-fluid page-body-wrapper">
        <?php require_once 'partials/_sidebar.php' ?>
        <div class="main-panel">
          <div class="content-wrapper">
          <?php require_once 'partials/_success_error.php' ?>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="button-wrapper">
                    <input type="button" value="Add Rooms" onclick="window.location.href='add-rooms.php'" class="custom-button">
                    </div>
                    <div class="d-sm-flex align-items-center mb-4">                   
                      <br><h4 class="card-title mb-sm-0">Hotel Rooms</h4></br>
                      <a  class="text-dark ml-auto mb-3 mb-sm-0"> View all Rooms</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <!-- <th class="font-weight-bold">Count</th> -->
                            <th class="font-weight-bold">Room Number</th>
                            <th class="font-weight-bold">Room Type</th>
                            <th class="font-weight-bold">Room Price</th>
                            <th class="font-weight-bold">Status</th>
                            <th class="font-weight-bold">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                               
                                $sql = "SELECT * FROM rooms ORDER BY room_number";
                                $query = $conn->query($sql);

                                $count = 1;

                                while($row = $query->fetch_assoc()){
                                    $available = $row['available'];
                                    if($available == 1){
                                        $available_data = "<div class=\"badge badge-success p-2\">Vaccant</div>";
                                    }else{
                                        $available_data = "<div class=\"badge badge-warning p-2\">Occupied</div>";

                                    }
                                    echo "
                                        <tr>
                                            <td>Room ".$row['room_number']."</td>
                                            <td>".$row['room_type']."</td>
                                            <td>Ksh. ".$row['room_price']."</td>
                                            <td>".$available_data."</td>
                                            <td>
                                            <!-- <a href=\"#\" class=\"btn btn-warning btn-sm\"><i class=\"bi bi-eye\"></i></a> -->
                                              <a href=\"#\" class=\"btn btn-primary btn-sm action-edit\" data-id=\"".$row['id']."\"><i class=\"bi bi-pencil\"></i>Edit</a>
                                              <a href=\"#\" class=\"btn btn-danger btn-sm action-delete\" data-id=\"".$row['id']."\"><i class=\"bi bi-trash\"></i>Delete</a>
                                            </td>
                                        </tr>
                                    ";
                                    $count++;
                                }
                            ?>


                         
                         </tbody> 
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>




          </div>
          <!-- content-wrapper ends -->
          <?php require_once 'partials/_footer.php' ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this room?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            <form class="forms-sample" method="POST" action="admin.php">
            <input type="hidden" name="room_id" class="form-control" id="delete_room_id" placeholder="Room Number" readonly>

              <button type="submit" name="delete_room" class="btn btn-danger" id="confirmDelete" data-id="">Delete</button>
            </form>
            </div>
        </div>
      </div>
    </div>

    <!-- Edit room modal -->

    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Edit room</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <p class="card-description">Change room details</p>
              <form class="forms-sample" method="POST" action="admin.php">
                <div class="form-group row">
                  <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Room Number: </label>
                  <div class="col-sm-9">
                    <input type="hidden" name="room_id" class="form-control" id="edit_room_id" placeholder="Room Number" readonly>
                    <input type="number" name="room_number" class="form-control" id="edit_room_number" placeholder="Room Number" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Room Price</label>
                  <div class="col-sm-9">
                    <input type="number" name="room_price" class="form-control" id="edit_room_price" placeholder="Room Price" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Room Type</label>
                  <div class="col-sm-9">
                      <select name="room_type" id="edit_room_type">
                          <option>Single Bed</option>
                          <option>Double Bed</option>
                          <option>VIP Suite</option>
                      </select>

                  </div>
                </div>

            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="edit_room" class="btn btn-danger mr-2">Save Changes</button>
            <!-- <button type="button" class="btn btn-danger" id="confirmDelete" data-id="">Delete</button> -->
          </div>
        
          </form>
        </div>
      </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script>
     // jQuery code to handle the delete action
     $(document).ready(function() {
      $('.action-delete').click(function() {
        $('#deleteModal').modal('show');
        var room_id = $(this).data('id'); // Retrieve the data-id attribute value
        $('#confirmDelete').data('id', room_id);
        $('#delete_room_id').val(room_id);

      });
    });
    $(document).ready(function() {
      $('.action-edit').click(function() {
        $('#editRoomModal').modal('show');
        var room_id = $(this).data('id'); // Retrieve the data-id attribute value
        $('#edit_room_id').val(room_id);
        getRoom(room_id);

      });
    });

    // $(document).ready(function() {
    //   $('#confirmDelete').click(function() {
    //       window.location.href = 'admin.php?delete_room=true&id='+$('#confirmDelete').data('id');

    //   });
    // });      
    
    
    function getRoom(id){
      $.ajax({
        type: 'POST',
        url: 'admin.php',
        data: {
          'get_room_details': 'true',
          'id': id,
        },
        dataType: 'json',
        success: function(response){
          console.log(response);
          $('.id').val(response.id);
          $('#edit_room_number').val(response.room_number);
          $('#edit_room_price').val(response.room_price);
          $('#edit_room_type').val(response.room_type);
        }
      });
    }
    </script>


    <!-- End custom js for this page -->
  </body>
</html>
