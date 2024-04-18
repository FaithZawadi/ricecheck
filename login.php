<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {


  $password = $_POST["password"];
  $username = $_POST["username"];


  require ("./connection.php");

  $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();

  $incorrectEmail="";
  


  $result = $stmt->get_result();


  if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    if ($password === $row["password"]) {

      echo "Authentication successful";
      $_SESSION["email"] = $row["email"];
      $_SESSION["user_id"] = $row["id"];

      header("Location:index.php");

    } else {

      echo "Incorrect password";
    }
  } else {

    echo "User not found";
  }


  $stmt->close();
  $conn->close();
}

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
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/ricechecklg.png">
  <style>

  </style>
</head>

<body>
  

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <?php require_once 'partials/_success_error.php' ?>

          <div class="container-scroller">
            <div class="col-md-12 grid-margin stretch-card">

              <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth">
                  <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                      <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                          <img src="images/ricechecklg.png">
                        </div>
                        <h4>Admin portal</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>

                        <form class="pt-3" method="POST" action="login.php">
                          <div class="form-group">
                            <input type="text" name="username" class="form-control form-control-lg"
                              id="exampleInputEmail1" placeholder="Username" required>
                          </div>
                          <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-lg"
                              id="exampleInputPassword1" placeholder="Password" required>
                          </div>
                          <div class="mt-3">
                            <button type="submit" name="log_in" class="btn btn-primary mr-2">Submit</button>

                          </div>
                          <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                              <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input"> Keep me signed in </label>
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

</html>