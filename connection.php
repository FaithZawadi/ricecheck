<?php
    
// ////////////////////////////////////////////////////
// create a config.php file in this admin directory with the following structure 

// <?php 
  
//   return[
//     'database'=>
//         [
//             'host'=> 'localhost',
//             'dbname'=> 'jubilee_access_control',
//             'username'=> 'root',
//             'password'=> '',
//         ]
// ];
//////////////////////////////////////////////////////////////////////////

    $config = require_once('C:\xampp\htdocs\jubilee-access-control\admin\config.php');   //this requires a config file which contains db credentials


    // Create connection
    $conn = new mysqli($config['database']['host'], $config['database']['username'],
    $config['database']['password'], $config['database']['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // echo 'Connection successful.';

    }

?>