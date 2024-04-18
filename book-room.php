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
    <title>Jubilee Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" <!-- End layout styles -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <center>
  <body>
    <div class="container-scroller">
      <?php require_once 'partials/_navbar.php' ?>
      <div class="container-fluid page-body-wrapper">
        <?php require_once 'partials/_sidebar.php' ?>
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="col-md-6 grid-margin stretch-card" style="max-width: 100%;">
                <div class="card">
                  <div class="card-body">
                  <a class="navbar-brand brand-logo">
            <center><img height="100px" width="100px" src="images/Jblack.svg" alt="logo" class="logo-dark" /></center>
          </a>
                    <h4 class="card-title">Book Room</h4>
                    <p class="card-description">Book a room </p>
                    <form class="forms-sample book-room-form" method="POST" action="admin.php">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name: </label>
                        <div class="col-sm-9">
                          <input type="name" name="name" class="form-control" id="exampleInputUsername2" placeholder="Name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Phone number:</label>
                        <div class="col-sm-9">
                          <input type="name" name="phone_number" class="form-control" id="exampleInputEmail2" placeholder="Phone number" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Choose Room To Book:</label>
                        <div class="col-sm-9">
                          <div class="room-table">
                            <table>
                              <tbody>
                              <?php

                                  // Fetch rooms data from the database
                                  $sql = "SELECT * FROM rooms";
                                  $result = $conn->query($sql);

                                  if ($result->num_rows > 0) {
                                    $totalRooms = $result->num_rows; // Total number of rooms
                                    $roomsPerRow = 10; // Number of rooms per row

                                    // Loop through the rooms
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                      // Check if the room is available or not (you can customize this logic based on your data)
                                      $isAvailable = $row['available'] == 1; // Example: Check if available column value is 1

                                      // Determine the CSS class for the room based on availability
                                      $roomClass = $isAvailable ? 'available' : 'unavailable';

                                      // Create a new row for every multiple of $roomsPerRow
                                      if (($i - 1) % $roomsPerRow === 0) {
                                        echo '<tr>';
                                      }

                                      // Create a table cell for the room
                                      echo '<td><div data-id="' . $row['id'] . '" class="room ' . $roomClass . '">' . $row['room_number'] . '</div></td>';

                                      // Close the row for every multiple of $roomsPerRow or if it's the last room
                                      if ($i % $roomsPerRow === 0 || $i === $totalRooms) {
                                        echo '</tr>';
                                      }

                                      $i++;
                                    }
                                  } else {
                                    echo "No rooms found.";
                                  }

                                  // Close the database connection
                                  $conn->close();
                                  ?>

                              </tbody>
                            </table>
                          </div>

                          <!-- Input field to store the selected room -->
                          <input type="hidden" id="selected-room" name="room_id" required>

                        
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Check in date:</label>
                        <div class="col-sm-9">
                          <input type="date" name="check_in_date" class="form-control" id="exampleInputEmail2" placeholder="Check in date" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Check out date:</label>
                        <div class="col-sm-9">
                          <input type="date" name="check_out_date" class="form-control" id="exampleInputEmail2" placeholder="Check out date" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Number of guests:</label>
                        <div class="col-sm-9">
                          <input type="number" min="0" name="number_of_guests" class="form-control" id="exampleInputEmail2" placeholder="Number of guests" required>
                        </div>
                      </div>                    
                      <button type="submit" name="book_room" class="btn btn-primary mr-2">Submit</button>
                    </form>
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
    <script>
      $(document).ready(function() {
        // Handle click event on room cells
        $('.available').click(function() {
          // Remove 'selected-room' class from previously selected room
          $('.available').removeClass('selected-room');
          
          // Add 'selected-room' class to the clicked room
          $(this).addClass('selected-room');

          // Store the selected room number in the input field
          var roomID = $(this).data('id');
          $('#selected-room').val(roomID);
        });
      });

      $(document).ready(function() {
        $('.book-room-form').submit(function(event) {
          var selectedRoom = $('#selected-room').val();

          if (!selectedRoom) {
            event.preventDefault(); // Prevent form submission
            alert('Please select a room First.'); // Show an error message
          }
        });
      });
    </script>
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
  <center>
</html>