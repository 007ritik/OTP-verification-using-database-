<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "task1";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
    <h2>User Details</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch data from the database and display it in the table
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td><a href='taskupdate.php?id=" . $row['id'] . "'>Update</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }
        ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
