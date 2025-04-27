<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check authentication
if(strlen($_SESSION['eahpaid']) == 0) {
    header('location:logout.php');
    exit();
}

// Get user role
$role = $_SESSION['role'] ?? '';

// Get requests based on role
if($role == 'driver') {
    $driver_id = $_SESSION['eahpaid'];
    $query = "SELECT * FROM tblambulancehiring 
              WHERE DriverID = $driver_id 
              AND Status != 'Reached' 
              AND Status != 'Rejected' 
              ORDER BY HiringDate, HiringTime";
} else {
    // Admin sees all active requests
    $query = "SELECT * FROM tblambulancehiring 
              WHERE Status != 'Reached' 
              AND Status != 'Rejected' 
              ORDER BY HiringDate, HiringTime";
}

$assigned_requests = mysqli_query($con, $query);

// Update status if form submitted
if(isset($_POST['update_status'])) {
    $request_id = $_POST['request_id'];
    $new_status = $_POST['status'];
    
    // Update status
    mysqli_query($con, "UPDATE tblambulancehiring SET Status = '$new_status' WHERE ID = $request_id");
    
    // Add notification
    $request = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tblambulancehiring WHERE ID = $request_id"));
    $message = "Your ambulance status has been updated to: $new_status";
    mysqli_query($con, "INSERT INTO tblnotifications (RequestID, UserMobile, Message, CreatedAt) 
                       VALUES ($request_id, '{$request['MobileNumber']}', '$message', NOW())");
    
    header("Location: tracking.php");
    exit();
}

// Assign driver if form submitted
if(isset($_POST['assign_driver'])) {
    $request_id = $_POST['request_id'];
    $driver_id = $_POST['driver'];
    
    mysqli_query($con, "UPDATE tblambulancehiring 
                       SET DriverID = $driver_id, Status = 'Assigned' 
                       WHERE ID = $request_id");
    
    // Notify driver and user
    $request = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tblambulancehiring WHERE ID = $request_id"));
    $driver = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tbldriver WHERE ID = $driver_id"));
    
    // Notify user
    $message = "Your ambulance has been assigned. Driver: {$driver['FullName']}, Contact: {$driver['MobileNumber']}";
    mysqli_query($con, "INSERT INTO tblnotifications (RequestID, UserMobile, Message, CreatedAt) 
                       VALUES ($request_id, '{$request['MobileNumber']}', '$message', NOW())");
    
    // Notify driver
    $driver_message = "New assignment: Patient {$request['FullName']}, Pickup: {$request['PickupLocation']}, Time: {$request['HiringDate']} {$request['HiringTime']}";
    mysqli_query($con, "INSERT INTO tbldrivernotifications (DriverID, RequestID, Message, CreatedAt) 
                       VALUES ($driver_id, $request_id, '$driver_message', NOW())");
    
    header("Location: tracking.php");
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>EAHP | Ambulance Tracking</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<body>
    <section id="container">
        <?php if($role == 'admin') include_once('includes/header.php'); ?>
        <?php if($role == 'admin') include_once('includes/sidebar.php'); ?>

        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-ambulance"></i> Ambulance Tracking</h3>

                <div class="row mt">
                    <div class="col-md-12">
                        <div class="content-panel">
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient</th>
                                        <th>Relative</th>
                                        <th>Phone</th>
                                        <th>Date/Time</th>
                                        <th>Ambulance Type</th>
                                        <th>Pickup Location</th>
                                        <th>City</th>
                                        <th>Symptoms</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($request = mysqli_fetch_array($assigned_requests)): ?>
                                    <tr>
                                        <td><?php echo $request['ID']; ?></td>
                                        <td><?php echo $request['FullName']; ?></td>
                                        <td><?php echo $request['RelativeName']; ?></td>
                                        <td><?php echo $request['MobileNumber']; ?></td>
                                        <td><?php echo date('d M Y', strtotime($request['HiringDate'])) . ' ' . $request['HiringTime']; ?>
                                        </td>
                                        <td><?php echo $request['AmbulanceType']; ?></td>
                                        <td><?php echo $request['PickupLocation']; ?></td>
                                        <td><?php echo $request['City']; ?></td>
                                        <td><?php echo $request['Symptoms']; ?></td>
                                        <td><?php echo $request['Status'] ?: 'Pending'; ?></td>
                                        <td>
                                            <?php if($role == 'admin' || $role == 'driver'): ?>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="request_id"
                                                    value="<?php echo $request['ID']; ?>">
                                                <select name="status" class="form-control"
                                                    style="width:150px; display:inline;">
                                                    <option value="">Select Status</option>
                                                    <option value="Assigned">Assigned</option>
                                                    <option value="On the way">On the way</option>
                                                    <option value="Pickup">Patient Picked</option>
                                                    <option value="Reached">Patient Reached</option>
                                                </select>
                                                <button type="submit" name="update_status"
                                                    class="btn btn-primary btn-xs">Update</button>
                                            </form>
                                            <?php endif; ?>

                                            <?php if($role == 'admin'): ?>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="request_id"
                                                    value="<?php echo $request['ID']; ?>">
                                                <select name="driver" class="form-control" required>
                                                    <option value="">Select Driver</option>
                                                    <?php 
            $drivers = mysqli_query($con, "SELECT * FROM tbldriver");
            while($driver = mysqli_fetch_array($drivers)) {
                echo "<option value='{$driver['ID']}'>{$driver['FullName']} ({$driver['MobileNumber']})</option>";
            }
            ?>
            
                                                </select>
                                                <button type="submit" name="assign_driver"
                                                    class="btn btn-success btn-xs">Assign</button>
                                            </form>
                                        </td>
                                        <?php endif; ?>

                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>

    <!-- Include your JS files here -->
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>