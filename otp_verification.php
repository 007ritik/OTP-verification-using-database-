<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: taskdisplay.php");
    exit();
}

if (!isset($_SESSION['otp_email'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $entered_otp = $_POST['otp'];

    // Retrieve OTP from the database
    $email = $_SESSION['otp_email'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "task1";

    // Create connection3
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch OTP
    $sql = "SELECT * FROM users WHERE email = '$email' OR username = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_otp = $user['otp'];

        if ($entered_otp == $stored_otp) {
            // OTP matched, redirect to display page
            $_SESSION['user_id'] = $user['id'];
            header("Location: taskdisplay.php");
            exit();
        } else {
            // Incorrect OTP, display error
            echo "<script>alert('Incorrect OTP');</script>";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>
    <form action="" method="post">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required><br><br>

        <input type="submit" name="submit" value="Verify OTP">
    </form>
</body>
</html>
