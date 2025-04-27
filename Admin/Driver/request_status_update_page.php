<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['driverid']==0)) {
  header('location:driver-login.php');
} else {
  
  if(isset($_GET['id']) && isset($_GET['status'])) {
    $requestid = $_GET['id'];
    $status = $_GET['status'];
    $driverid = $_SESSION['driverid'];
    
    // Verify this request belongs to this driver
    $check = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE ID='$requestid' AND DriverID='$driverid'");
    if(mysqli_num_rows($check) > 0) {
      
      // Update status based on current status flow
      $new_status = '';
      
      if($status == 'ontheway') {
        $new_status = 'On the way';
        $redirect = 'driver-ontheway-requests.php';
      } elseif($status == 'pickup') {
        $new_status = 'Pickup';
        $redirect = 'driver-pickup-requests.php';
      } elseif($status == 'reached') {
        $new_status = 'Reached';
        $redirect = 'driver-completed-requests.php';
      }
      
      if(!empty($new_status)) {
        $query = mysqli_query($con, "UPDATE tblambulancehiring SET Status='$new_status' WHERE ID='$requestid'");
        
        if($query) {
          echo "<script>alert('Request status updated successfully.');</script>";
          echo "<script>window.location.href='$redirect'</script>";
        } else {
          echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
      }
    } else {
      echo "<script>alert('Invalid request.');</script>";
      echo "<script>window.location.href='driver-dashboard.php'</script>";
    }
  }
}
?>