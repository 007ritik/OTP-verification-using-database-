<?php

session_start();

// Check if the user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: taskdisplay.php");
    exit();
}

if (isset($_POST['submit'])) {
    $email = $_POST['username_or_email'];

    $otp = mt_rand(10000, 99999);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "task1";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET otp = '$otp' WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['otp_email'] = $email;
        header("Location: otp_verification.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Login</title>
</head>
<body>
    <h2>OTP Login</h2>
    <form action="" method="post">
        <label for="username_or_email">Username or Email:</label>
        <input type="text" id="username_or_email" name="username_or_email" required><br><br>

        <input type="submit" name="submit" value="Send OTP">
    </form>
</body>
</html>
