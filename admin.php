<?php
// include our database connection
include("connection.php");
session_start();
 

if(isset($_POST['log_in'])){
    login();
}else if(! isset( $_SESSION['admin_logged_in'] )){
    $_SESSION['success'] = 'You are not logged in, log in to continue';

    header("location: login.php");
    exit();

}


if(isset($_POST['add_room'])){
    add_room();
}else if(isset($_POST['edit_room'])){
    edit_room();
}else if(isset($_POST['delete_room'])){
    delete_room();
}else if(isset($_POST['get_room_details'])){
    get_room_details();
}else if(isset($_POST['add_tag'])){
    add_tag();
}else if(isset($_POST['book_room'])){
    book_room();
}else if(isset($_POST['edit_booked_room'])){
    edit_booked_room();
}else if(isset($_POST['check_out_room'])){
    check_out_room();
}

if(isset($_GET['action'])){
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            login();
            break;
        case 'logout':
            login();
            break;
        case 'add_room':
            add_room();
            break;
        case 'add_tag':
            add_tag();
            break;
        
        default:
            break;
    }
}

// if ($_GET['action'] === 'log_in') {
//     // Call your function or perform the desired action
//     login();
// }


function login(){
    // global $conn;

    // $username= $_POST['username'];
    // $password= $_POST['password'];


    // $sql = "SELECT * FROM admin WHERE username =?";

    // $stmt = $conn->prepare($sql);

    // if ($stmt) {
    //     $stmt->bind_param("s", 
    //         $username
          
    //     );
    // }

    // if($stmt->num_rows < 1){
    //     $_SESSION['error'] = 'You have entered an invalid username';
    // }else{
    //     $row = $sql->fetch_assoc();
    //     if($password == $row['password']){
    //         $_SESSION['admin_logged_in'] = true;

    //         header('location: dashboard.php');

    //     } else{
    //         $_SESSION['error'] = 'Incorrect password. Enter password again';
    //     }
    // }

    ///////////////////////////////////////
    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

        
    

    $sql = "SELECT * FROM admin WHERE username = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            $_SESSION['error'] = 'You have entered an invalid username';
        } else {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                $_SESSION['admin_logged_in'] = true;
                header('location: index.php');
                exit();
            } else {
                $_SESSION['error'] = 'Incorrect password. Enter password again';
            }
        }
    

    header('location: login.php');

}	


}

function logout(){
	session_destroy();

	header('location: index.php');
    
}

function add_room(){
    global $conn;

    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $room_price = $_POST['room_price'];

    $sql = "INSERT INTO rooms (room_number, room_type, room_price, available) 
            VALUES (?, ?, ?, '1')";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", 
            $room_number,
            $room_type,
            $room_price,
        );


        if ($stmt->execute()) {
            $_SESSION['success'] = 'Room added successfully';
            header("Location: view-rooms.php");
        } else {
            $_SESSION['error'] = 'Failed to add room --> '. $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }


    
}

function add_tag(){
    global $conn;
    
    $tag_number=$_POST['tag_number'];

    $sql =  "INSERT INTO tags (tag_number) 
    VALUES (?)";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", 
            $tag_number,
        );

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Tag added successfully';
            header("Location: add-tags.php");
        } else {
            $_SESSION['error'] = 'Failed to add tag --> '. $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }
    
    
}

function edit_room(){
    global $conn;
    
    $room_number = $_POST['room_number'];
    $room_price = $_POST['room_price'];
    $room_type = $_POST['room_type'];
    // $tag_id= $_POST['tag_id'];
    $room_id = $_POST['room_id'];


    $sql = "UPDATE rooms SET room_number = ?,room_type = ?, room_price = ? WHERE id = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", 
            $room_number,
            $room_type,
            $room_price,
            $room_id,
        );


        if ($stmt->execute()) {
            $_SESSION['success'] = 'Room Edited successfully';
            header("Location: view-rooms.php");
        } else {
            $_SESSION['error'] = 'Failed to edit room --> '. $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }


}
 
function delete_room(){
    global $conn;
    
    $room_id=$_POST['room_id'];

    $sql = "DELETE FROM rooms WHERE id=?";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", 
            $room_id,
        );

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Room deleted successfully';
            header("Location: view-rooms.php");
        } else {
            $_SESSION['error'] = 'Failed to delete room --> '. $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }

        
}

function get_room_details(){
    global $conn;

    $room_id = $_POST['id'];
    $sql = "SELECT * FROM rooms WHERE id = ?";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", 
            $room_id,
        );

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Get the result set
            $row = $result->fetch_assoc(); // Fetch the first row as an associative array

            echo json_encode($row);

        } else {
        }
        
        $stmt->close();
    } else {
    }

}


function delete_tag(){
    global $conn;


    $tag_id=$_POST['id'];

    $sql = "DELETE FROM tags WHERE id=$tag_id";

    if($conn->query($sql)){
        $_SESSION['success'] = 'Tag deleted successfully';

        header("location: view-rooms.php");
    }
    else{
        $_SESSION['error'] = $conn->error;

    }
}
    
 function book_room (){
    global $conn;

    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $number_of_guests = $_POST['number_of_guests'];
    $room_id= $_POST['room_id'];




    $sql = "INSERT INTO users (name, phone_number, check_in_date,check_out_date,number_of_guests,checked_out,room_id) 
            VALUES (?, ?, ?, ?, ?,0, ?)";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", 
            $name,
            $phone_number,
            $check_in_date,
            $check_out_date,
            $number_of_guests,
            $room_id,


        );
        

        if ($stmt->execute()) {
// -------------------------------------------------------------------------------
                $sql = "UPDATE rooms SET available = 0 WHERE id = ?";
                 $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("s", 
                        $room_id,
                    );

                    if ($stmt->execute()) {

                        $_SESSION['success'] = 'Room booked successfully';
                        header("Location: view-booked-rooms.php");
                    }
                }
// -------------------------------------------------------------------------------
                
        } else {
            $_SESSION['error'] = 'Failed to book room --> '. $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }

    


}

function edit_booked_room(){
    global $conn;

    $check_out_date = $_POST['check_out_date'];
    $user_id= $_POST['user_id'];

    
    $sql = "UPDATE users SET check_out_date = ? WHERE id = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", 
            
            $check_out_date, 
            $user_id
            
    
        );


        if ($stmt->execute()) {
            $_SESSION['success'] = 'Booked Room Edited successfully';
            header("Location: view-booked-rooms.php");
        } else {
            $_SESSION['error'] = 'Failed to edit room --> '. $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }
}


function check_out_room(){
    global $conn;

    $user_id= $_POST['user_id'];
    $room_id= $_POST['room_id'];



    
    $sql = "UPDATE users SET checked_out =1 WHERE id = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", 
            
            $user_id,
            
        );


        if ($stmt->execute()) {
            $sql = "UPDATE rooms SET available =1 WHERE id = ?";

    
            $stmt = $conn->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param("s", 
                    $room_id
                );
        
        
                if ($stmt->execute()){

                        $_SESSION['success'] = 'Booked Room checked out successfully '.$room_id;
                        header("Location: view-booked-rooms.php");        
                }
            }    
        }else {
            $_SESSION['error'] = 'Failed to check out room --> '. $stmt->error;
        }
    
    
        $stmt->close();
    } else {
        $_SESSION['error'] = $conn->error;
    }
}
function dd($value)
{
   echo "<pre>";
   var_dump($value);
   echo "</pre>";


   die();
}


?>
