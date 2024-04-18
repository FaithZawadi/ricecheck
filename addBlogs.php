<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require ("./connection.php"); // Corrected file inclusion
    
    $blogTitle = $_POST['blogTitle'];
    $blogDescription = $_POST['blogDescription'];

    $targetDir = "uploads/";
    $file_name = $_FILES["blogImage"]["name"];
    $file_tmp_name = $_FILES["blogImage"]["tmp_name"];
    $file_size = $_FILES["blogImage"]["size"];
    $file_type = $_FILES["blogImage"]["type"];
    $fileExt = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_new_name = uniqid("", true) . "." . $fileExt; // Unique file name

    $targetFile = $targetDir . $file_new_name;

    $check = getimagesize($file_tmp_name);
    if ($check !== false) {
        if (in_array($fileExt, array("jpg", "jpeg", "png"))) {
            if (move_uploaded_file($file_tmp_name, $targetFile)) {
                $conn->select_db("jubilee_access_control");

                $query_table = "CREATE TABLE IF NOT EXISTS `blogs` (
                    blogId int primary key not null auto_increment,
                    title varchar(100),
                    image_name varchar(100),
                    description_data varchar(250)
                )";

                if ($conn->query($query_table) === TRUE) { 
                    $sql = "INSERT INTO blogs (title, description_data, image_name) VALUES ('$blogTitle', '$blogDescription', '$file_new_name')";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error creating table: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }

    $conn->close();
}
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

            <form class="content" action="http://localhost/ricecheck/admin/addBlogs.php" method="POST"
              enctype="multipart/form-data">
              <p>ADD BLOG</p>
              <div class="form-group">
                <label>Blog Tile</label>
                <input type="text" class="form-control" placeholder="Enter the blog title.." name="blogTitle" Required>
              </div>

              <div class="form-group">
                <label>Blog Image...</label>
                <input type="file" name="blogImage" id="" Required>
              </div>

              <div class="form-group">
                <label for="#">Blog Description...</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="blogDescription"
                  Required></textarea>
              </div>

              <button type="submit" name="blogSubmit" class="btn btn-primary">Submit</button>
            </form>



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
  <center>

</html>