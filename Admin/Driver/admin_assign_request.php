<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $bookid=$_GET['id'];
    $driverid=$_POST['driverid'];
    $vehno=$_POST['vehno'];
    $status="Assigned";
    
    $query=mysqli_query($con,"UPDATE tblambulancehiring SET VehicleNumber='$vehno', Status='$status', DriverID='$driverid' WHERE ID='$bookid'");
    if($query) {
      echo "<script>alert('Ambulance has been assigned successfully');</script>";
      echo "<script>window.location.href='assigned-ambulance-request.php'</script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  }
?>

<!DOCTYPE html>
<head>
<title>EAHP | Assign Request</title>

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
<?php include_once('includes/header.php');?>
<!--header end-->
<!--sidebar start-->
<?php include_once('includes/sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Assign Request
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Driver</label>
                            <div class="col-sm-8">
                                <select name="driverid" class="form-control" required>
                                    <option value="">Select Driver</option>
                                    <?php
                                    $drivers = mysqli_query($con, "SELECT * FROM tbldrivers");
                                    while($driver = mysqli_fetch_array($drivers)) {
                                        echo "<option value='".$driver['ID']."'>".$driver['DriverName']." - ".$driver['MobileNumber']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Vehicle Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="vehno" required="true">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button type="submit" name="submit" class="btn btn-primary">Assign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
  </div>
</section>
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