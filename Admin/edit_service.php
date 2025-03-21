<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ambulancehiringdbadmin");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the service ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid service ID.");
}

$id = $_GET['id'];

// Fetch service details
$stmt = $conn->prepare("SELECT * FROM service_reports WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();
$stmt->close();

// Handle form submission for updating
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $update_stmt = $conn->prepare("UPDATE service_reports SET name = ? WHERE id = ?");
    $update_stmt->bind_param("si", $name, $id);
    
    if ($update_stmt->execute()) {
        header("Location: Admin_services.php");
        exit();
    } else {
        echo "Error updating record.";
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
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

    <!-- Edit Form Content -->
    <div class="content">
        <h2>Edit Service</h2>
        <form method="POST">
            <label for="name">Service Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($service['name']) ?>" required>
            <button type="submit">Update</button>
            <a href="Admin_services.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
