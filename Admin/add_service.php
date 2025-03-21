<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ambulancehiringdbadmin");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $stmt = $conn->prepare("INSERT INTO service_reports (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        header("Location: Admin_services.php");
        exit();
    } else {
        echo "Error adding service.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link rel="stylesheet" href="css/Admin_services.css">
</head>
<body>

<div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="Admin_services.php">Services</a></li>
            <li><a href="#">Ambulance Management</a></li>
            <li><a href="#">View Booking</a></li>
            <li><a href="#">Registered Drivers</a></li>
        </ul>
        <button class="logout">Logout →</button>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Add New Service</h2>
        <form method="POST">
            <label for="name">Service Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter service name">
            <button type="submit">Add Service</button>
            <a href="Admin_services.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
