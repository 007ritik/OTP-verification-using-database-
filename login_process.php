<?php
session_start();

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
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE (username = '$usernameOrEmail' OR email = '$usernameOrEmail') AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, set session variables
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];

        // Remember Me functionality
        if(isset($_POST['remember_me'])) {
            // Set cookies to remember the username/email and password
            setcookie('remembered_username', $usernameOrEmail, time() + (86400 * 30), "/");
            setcookie('remembered_password', $password, time() + (86400 * 30), "/");
        } else {
            // If the remember me checkbox is unchecked, remove the cookies
            setcookie('remembered_username', '', time() - 3600, "/");
            setcookie('remembered_password', '', time() - 3600, "/");
        }

        // Redirect to display page
        header("Location: taskdisplay.php");
        exit();
    } else {
        // User doesn't exist or credentials are incorrect
        echo "<script>alert('User not found or incorrect credentials');</script>";
    }
    
    $conn->close();
}
?>
