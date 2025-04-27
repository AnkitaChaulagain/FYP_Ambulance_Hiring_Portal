<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['driverid']==0)) {
  header('location:driver-login.php');
  } else {
?>

<!DOCTYPE html>
<head>
<title>EAHP || Driver Dashboard</title>

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
		<div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
						<?php 
						$driverid = $_SESSION['driverid'];
						$query = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE DriverID='$driverid' AND Status='Assigned'");
						$assigned_count = mysqli_num_rows($query);
						?>
						<h3><?php echo $assigned_count; ?></h3>
						<h4>Assigned Requests</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-ambulance"></i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-8 market-update-left">
						<?php 
						$query = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE DriverID='$driverid' AND Status='On the way'");
						$ontheway_count = mysqli_num_rows($query);
						?>
						<h3><?php echo $ontheway_count; ?></h3>
						<h4>On The Way</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-map-marker"></i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<?php 
						$query = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE DriverID='$driverid' AND Status='Reached'");
						$completed_count = mysqli_num_rows($query);
						?>
						<h3><?php echo $completed_count; ?></h3>
						<h4>Completed Trips</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-check-circle-o"></i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
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
<?php }  ?>