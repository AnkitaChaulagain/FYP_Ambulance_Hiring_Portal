<?php 
// Database connection
$conn = new mysqli("localhost", "root", "", "ambulancehiringdbadmin");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Delete Action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM service_reports WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: Admin_services.php");
    exit();
}

// Fetch all services
$services = $conn->query("SELECT * FROM service_reports");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Services</title>
    <link rel="stylesheet" href="css/Admin_services.css">
</head>
<body> 

<div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li class="active"><a href="#">Services</a></li>
            <li><a href="#">Ambulance Management</a></li>
            <li><a href="#">View Booking</a></li>
            <li><a href="#">Registered Drivers</a></li>
        </ul>
        <button class="logout">Logout →</button>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Hello Admin!</h2>
        <div class="service-list">
            <h3>List of Services</h3>
            <button class="add-btn" onclick="location.href='add_service.php'">Add</button>
            
            <!-- Service Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $services->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td>
                                <a href="edit_service.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                                <a href="Admin_services.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
