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

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $phone = $row['phone'];
} else {
    echo "0 results";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form action="taskupdate_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>"><br><br>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>"><br><br>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>"><br><br>
        
        <input type="submit" name="submit" value="Update User">
    </form>
</body>
</html>
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
      ///  header("Location: taskdisplay.php"); // Redirect back to display page after update
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>