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
  <link rel="stylesheet" href="css/style.css" <!-- End layout styles -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<center>

  <style>
    img {
      width: 100%;
    }

    .display-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
    }
  </style>

  <body>
    <div class="container-scroller">
      <?php require_once 'partials/_navbar.php' ?>
      <div class="container-fluid page-body-wrapper">
        <?php require_once 'partials/_sidebar.php' ?>
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="display-grid">


              <?php

              require ("./connection.php");

              $conn->select_db("jubilee_access_control");

              $sql = "SELECT * FROM blogs";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                  echo "<div class='blog-card'>
                  <img src='./uploads/{$row["image_name"]}' alt=''>
                  <p class='blog-title'>{$row["title"]}</p>
                  <p class='description'>{$row["description_data"]}</p>
              </div>";
                }

              } else {
                echo "No results found.";
              }
              ?>




            </div>

            <!-- 
          



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
  <center>

</html>