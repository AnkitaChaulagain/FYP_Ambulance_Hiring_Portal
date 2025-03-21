<?php
$servername = "localhost";  // Change if your database is remote
$username = "root";  // Your MySQL username (default: root)
$password = "";  // Your MySQL password (default: empty)
$database = "ambulancehiringdbadmin"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
