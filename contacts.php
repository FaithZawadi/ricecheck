
<?php
// Set up the database connection
$host = 'localhost'; // Change to your host
$db = 'jubilee_access_control'; // Change to your database name
$user = 'root'; // Change to your database username
$password = ''; // Change to your database password

$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO home_contacts (name, phone_email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Execute the statement
if ($stmt->execute()) {
    echo "Form submitted successfully! ";
	echo '<a href="index.html">Go back to homepage</a>'; 
} else {
    echo "Error: " . $stmt->error;
	echo '<a href="index.html">Go back to homepage</a>'; 
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>


