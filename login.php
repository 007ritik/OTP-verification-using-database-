<?php
session_start();

// Check if the user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: taskdisplay.php");
    exit();
}



$remembered_username = "";

// Check if the remember me cookie exists
if(isset($_COOKIE['remembered_username'])) {
    $remembered_username = $_COOKIE['remembered_username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login_process.php" method="post" onsubmit="return validateLoginForm()">
        <label for="username_or_email" style="font-size: 16px; display: block;">Username or Email:</label>
        <input type="text" id="username_or_email" name="username_or_email" value="<?php echo $remembered_username; ?>" style="width: 300px; height: 30px;"><br><br>

        <label for="password" style="font-size: 16px; display: block;">Password:</label>
        <input type="password" id="password" name="password" style="width: 300px; height: 30px;"><br><br>

        <label for="remember_me" style="font-size: 16px; display: block;">
            <input type="checkbox" id="remember_me" name="remember_me"> Remember me
        </label><br><br>

        <input type="submit" name="submit" value="Login" style="width: 150px; height: 40px; font-size: 18px;">
        <input type="button" name="login_with_otp" value="Login with OTP" onclick="window.location.href='otp_login.php';">

    </form>

<script>
        function validateLoginForm() {
            var usernameOrEmail = document.getElementById('username_or_email').value;
            var password = document.getElementById('password').value;

            // Simple email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(usernameOrEmail) && usernameOrEmail.trim() === "") {
                alert("Please enter a valid email address or username");
                return false;
            }

            // Password length validation
            if (password.length < 8) {
                alert("Password must be at least 8 characters long");
                return false;
            }

            // Other validations can be added here

            return true;
        }
    </script>
</body>
</html>
