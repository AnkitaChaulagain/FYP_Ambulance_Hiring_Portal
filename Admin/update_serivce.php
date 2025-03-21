<?php
// include './db_connect.php'; // Include database connection

if (isset($_POST['update'])) {
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    
    // Handling file upload
    $image_name = $_FILES['service_image']['name'];
    $image_tmp = $_FILES['service_image']['tmp_name'];
    
    if (!empty($image_name)) {
        $image_path = "uploads/" . $image_name; 
        move_uploaded_file($image_tmp, $image_path);
        
        // Update with image
        $query = "UPDATE services SET name='$service_name', description='$service_description', image='$image_path' WHERE id='$service_id'";
    } else {
        // Update without image
        $query = "UPDATE services SET name='$service_name', description='$service_description' WHERE id='$service_id'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Service updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating service!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service</title>
    <link rel="stylesheet" href="css/update_service.css">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="#">Services</a></li>
                <li><a href="#">Ambulance Management</a></li>
                <li><a href="#">View Booking</a></li>
                <li><a href="#">Registered Drivers</a></li>
            </ul>
            <button class="logout">Logout →</button>
        </div>

        <div class="content">
            <h1>Hello Admin!</h1>
            <div class="update-form">
                <h2>Update Service Page</h2>
                <form method="POST" enctype="multipart/form-data">
                    <label>Service ID</label>
                    <input type="text" name="service_id" required>

                    <label>Service Name</label>
                    <input type="text" name="service_name" required>

                    <label>Service Description</label>
                    <textarea name="service_description" required></textarea>

                    <label>Service Image</label>
                    <input type="file" name="service_image">

                    <div class="buttons">
                        <button type="button" class="close">Close</button>
                        <button type="submit" name="update" class="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
