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
    <title>Jubilee admin</title>
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
                    <input type="button" value="Book Room" onclick="window.location.href='book-room.php'" class="custom-button">
                    </div>
                    <div class="d-sm-flex align-items-center mb-4">                   
                      <br><h4 class="card-title mb-sm-0">Hotel Rooms</h4></br>
                      <a  class="text-dark ml-auto mb-3 mb-sm-0"> View all booked Rooms</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <!-- <th class="font-weight-bold">Count</th> -->
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">Phone Number</th>
                            <th class="font-weight-bold">Check in Date</th>
                            <th class="font-weight-bold">Check Out Date</th>
                            <th class="font-weight-bold">Room number</th>
                            <th class="font-weight-bold">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                               
                                $sql = "SELECT u.*, r.room_number
                                FROM users u
                                LEFT JOIN rooms r ON u.room_id = r.id
                                WHERE u.checked_out = 0";
                                $query = $conn->query($sql);
                                
                                if ($query->num_rows > 0) {

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
                                            <td> ".$row['name']."</td>
                                            <td>".$row['phone_number']."</td>
                                            <td> ".$row['check_in_date']."</td>
                                            <td> ".$row['check_out_date']."</td>
                                            <td> Room ".$row['room_number']."</td>


                                            <td>

                                            
                                            
                                            <!-- <a href=\"#\" class=\"btn btn-warning btn-sm\"><i class=\"bi bi-eye\"></i></a> -->
                                              
                                              <a href=\"#\" class=\"btn btn-primary btn-sm action-edit\" data-id=\"".$row['id']."\"><i class=\"bi bi-pencil\"></i>Edit</a>
                                              <a href=\"#\" class=\"btn btn-danger btn-sm action-delete\" data-user-id=\"".$row['id']."\" data-room-id=\"".$row['room_id']."\"><i class=\"bi bi-trash\"></i>Check Out</a>
                                            </td>
                                        </tr>
                                    ";
                                   
                                    $count++;
                                 

                                }
                              } else {
                                echo "<center>There are no booked rooms.</center>";
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
            Are you sure you want to check out this room?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            <form class="forms-sample" method="POST" action="admin.php">
            <input type="hidden" name="room_id" class="form-control" id="delete_room_id" placeholder="Room Number" readonly>
            <input type="hidden" name="user_id" class="form-control" id="delete_user_id" placeholder="Room Number" readonly>

              <button type="submit" name="check_out_room" class="btn btn-danger" id="confirmDelete" data-id="">Check out</button>
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
                  <a class="navbar-brand brand-logo">
            <center><img height="100px" width="100px" src="images/Jblack.svg" alt="logo" class="logo-dark" /></center>
          </a>
                    <h4 class="card-title">Edit Rooms</h4>
                    <p class="card-description">Edit booked room </p>
                    <form class="forms-sample" method="POST" action="admin.php">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Check Out Date: </label>
                        <div class="col-sm-9">
                        <input type="hidden" name="user_id" class="form-control" id="user_id" placeholder="Room Number" readonly>
                          <input type="date" name="check_out_date" class="form-control" id="exampleInputUsername2" placeholder="Check out" required>
                        </div>
                     
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="edit_booked_room" class="btn btn-danger mr-2">Save Changes</button>
            <!-- <button type="button" class="btn btn-danger" id="confirmDelete" data-id="">Delete</button> -->
          </div>
        
          </form>
        </div>
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
        var user_id = $(this).data('user-id'); // Retrieve the data-id attribute value
        var room_id = $(this).data('room-id'); // Retrieve the data-id attribute value

        $('#delete_room_id').val(room_id);
        $('#delete_user_id').val(user_id);

      });
    });
    $(document).ready(function() {
      $('.action-edit').click(function() {
        $('#editRoomModal').modal('show');
        var room_id = $(this).data('id'); // Retrieve the data-id attribute value
        $('#user_id').val(room_id);
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
