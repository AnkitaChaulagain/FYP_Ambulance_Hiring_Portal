<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// When form is submitted
if(isset($_POST['login'])) {
  $mobile = $_POST['mobile'];
  $password = md5($_POST['password']);
  
  $query = mysqli_query($con, "SELECT ID, DriverName FROM tbldrivers WHERE MobileNumber='$mobile' AND Password='$password'");
  $ret = mysqli_fetch_array($query);
  
  if($ret > 0) {
    $_SESSION['driverid'] = $ret['ID'];
    $_SESSION['drivername'] = $ret['DriverName'];
    
    header('location:driver-dashboard.php');
  } else {
    echo "<script>alert('Invalid Details');</script>";
  }
}
?>

<!DOCTYPE html>
<head>
<title>EAHP || Driver Login</title>

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
<div class="log-w3">
<div class="w3layouts-main">
    <h2>Driver Login</h2>
    <form action="#" method="post" name="login">
        <input type="text" class="ggg" name="mobile" placeholder="MOBILE NUMBER" required="true">
        <input type="password" class="ggg" name="password" placeholder="PASSWORD" required="true">
        <span><input type="checkbox" />Remember Me</span>
        <h6><a href="forgot-password.php">Forgot Password?</a></h6>
        <div class="clearfix"></div>
        <input type="submit" value="Sign In" name="login">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>