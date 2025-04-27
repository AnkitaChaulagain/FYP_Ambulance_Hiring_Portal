<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['driverid']==0)) {
  header('location:driver-login.php');
} else {
  $driverid = $_SESSION['driverid'];
  
  if(isset($_GET['id']) && isset($_GET['bookingnum'])) {
    $requestid = $_GET['id'];
    $bookingnum = $_GET['bookingnum'];
    
    // Verify this request belongs to this driver
    $check = mysqli_query($con, "SELECT * FROM tblambulancehiring WHERE ID='$requestid' AND BookingNumber='$bookingnum' AND DriverID='$driverid'");
    if(mysqli_num_rows($check) <= 0) {
      echo "<script>alert('Unauthorized access'); window.location.href='driver-dashboard.php';</script>";
      exit();
    }
?>

<!DOCTYPE html>
<head>
<title>EAHP || Request Details</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<?php include_once('includes/driver-header.php');?>
<!--header end-->
<!--sidebar start-->
<?php include_once('includes/driver-sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     Request Details
    </div>
    <div class="panel-body">
      <?php
        $ret=mysqli_query($con,"SELECT * FROM tblambulancehiring WHERE ID='$requestid' AND BookingNumber='$bookingnum'");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
      ?>
      <table class="table table-bordered">
        <tr>
          <th>Booking Number</th>
          <td><?php echo $row['BookingNumber']; ?></td>
        </tr>
        <tr>
          <th>Patient Name</th>
          <td><?php echo $row['PatientName']; ?></td>
        </tr>
        <tr>
          <th>Patient Contact Number</th>
          <td><?php echo $row['ContactNumber']; ?></td>
        </tr>
        <tr>
          <th>Patient Age</th>
          <td><?php echo $row['PatientAge']; ?></td>
        </tr>
        <tr>
          <th>Patient Gender</th>
          <td><?php echo $row['PatientGender']; ?></td>
        </tr>
        <tr>
          <th>Patient Address</th>
          <td><?php echo $row['PickupAddress']; ?></td>
        </tr>
        <tr>
          <th>Destination Hospital</th>
          <td><?php echo $row['DropAddress']; ?></td>
        </tr>
        <tr>
          <th>Hiring Date</th>
          <td><?php echo $row['HiringDate']; ?></td>
        </tr>
        <tr>
          <th>Hiring Time</th>
          <td><?php echo $row['HiringTime']; ?></td>
        </tr>
        <tr>
          <th>Request Date</th>
          <td><?php echo $row['BookingDate']; ?></td>
        </tr>
        <tr>
          <th>Current Status</th>
          <td>
            <?php 
            $pstatus=$row['Status'];
            if($pstatus==""){ ?>
              <span class="badge badge-info">New</span>
            <?php } elseif($pstatus=="Assigned"){ ?>
              <span class="badge badge-primary">Assigned</span>
            <?php } elseif($pstatus=="On the way"){ ?>
              <span class="badge badge-primary">On the Way</span>
            <?php } elseif($pstatus=="Pickup"){ ?>
              <span class="badge badge-success">Patient Pick</span>
            <?php } elseif($pstatus=="Reached"){ ?>
              <span class="badge badge-success">Patient Reached Hospital</span>
            <?php } elseif($pstatus=="Rejected"){ ?>
              <span class="badge badge-danger">Rejected</span>
            <?php } ?>
          </td>
        </tr>
      </table>
      
      <div class="row">
        <div class="col-md-12">
          <?php if($pstatus=="Assigned") { ?>
            <a href="update-request-status.php?id=<?php echo $row['ID'];?>&status=ontheway" class="btn btn-info btn-lg">Start Trip</a>
          <?php } elseif($pstatus=="On the way") { ?>
            <a href="update-request-status.php?id=<?php echo $row['ID'];?>&status=pickup" class="btn btn-info btn-lg">Pick Patient</a>
          <?php } elseif($pstatus=="Pickup") { ?>
            <a href="update-request-status.php?id=<?php echo $row['ID'];?>&status=reached" class="btn btn-success btn-lg">Mark Completed</a>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
</section>
 <!-- footer -->
 <?php include_once('includes/footer.php');?>  
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
<?php 
  }  
} 
?>