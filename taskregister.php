
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" onsubmit="return validateForm()">
        <label for="name" style="font-size: 16px; display: block;">Name:</label>
        <input type="text" id="name" name="name" style="width: 300px; height: 30px;"><br><br>

        <label for="username" style="font-size: 16px; display: block;">Username:</label>
        <input type="text" id="username" name="username" style="width: 300px; height: 30px;"><br><br>

       <label for="email" style="font-size: 16px; display: block;">Email:</label>
        <input type="email" id="email" name="email" style="width: 300px; height: 30px;"><br><br>

        <label for="password" style="font-size: 16px; display: block;">Password:</label>
        <input type="password" id="password" name="password" style="width: 300px; height: 30px;"><br><br>

        <label for="phone" style="font-size: 16px; display: block;">Phone:</label>
        <input type="text" id="phone" name="phone" style="width: 300px; height: 30px;"><br><br>

        <input type="submit" name="submit" value="Register User" style="width: 150px; height: 40px; font-size: 18px;">
    </form><?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "task1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Checsk connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Check if username or email already exist in the database
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Username or email already exists
        echo "<script>alert('Username or email already exists');</script>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (name, username, email, password, phone) VALUES ('$name', '$username', '$email', '$password', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }            
}
?>
  <script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var phone = document.getElementById('phone').value;

        // Simple email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address");
            return false;
        }

        // Password length validation
        if (password.length < 8) {
            alert("Password must be at least 8 characters long");
            return false;
        }

        // Basic name validation
        if (!name || name.trim() === "") {
            alert("Please enter your name");
            return false;
        }

        // Phone number validation
        var phoneRegex = /^\d{10}$/;
        if (!phoneRegex.test(phone)) {
            alert("Phone number must be 10 digits");
            return false;
        }

        // Other validations can be added here

        return true;
    }
</script>

</body>
</html>