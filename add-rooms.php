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
          <?php require_once 'partials/_success_error.php' ?>
          <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <a class="navbar-brand brand-logo">
            <center><img height="100px" width="100px" src="images/Jblack.svg" alt="logo" class="logo-dark" /></center>
          </a>
                    <h4 class="card-title">Add Rooms</h4>
                    <p class="card-description">Add a room </p>
                    <form class="forms-sample" method="POST" action="admin.php">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Room Number: </label>
                        <div class="col-sm-9">
                          <input type="number" name="room_number" class="form-control" id="exampleInputUsername2" placeholder="Room Number" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Room Price</label>
                        <div class="col-sm-9">
                          <input type="number" name="room_price" class="form-control" id="exampleInputEmail2" placeholder="Room Price" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Room Type</label>
                        <div class="col-sm-9">
                            <select name="room_type">
                                <option>Single Bed</option>
                                <option>Double Bed</option>
                                <option>VIP Suite</option>
                            </select>

                        </div>
                      </div>
                    
                      <button type="submit" name="add_room" class="btn btn-primary mr-2">Submit</button>
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
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</center>
</html>