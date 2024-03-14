<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "task1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    // Update data in the database
    $sql = "UPDATE users SET name='$name', username='$username', email='$email', password='$password', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: taskdisplay.php"); // Redirect back to display page after update
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
