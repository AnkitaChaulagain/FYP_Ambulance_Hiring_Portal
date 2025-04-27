<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']==0)) {
  header('location:logout.php');
} else {
  // Add new driver
  if(isset($_POST['submit'])) {
    $drivername=$_POST['drivername'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    
    $check=mysqli_query($con, "SELECT ID FROM tbldrivers WHERE MobileNumber='$mobile' OR Email='$email'");
    if(mysqli_num_rows($check) > 0) {
      echo "<script>alert('Driver already exists with this mobile number or email');</script>";
    } else {
      $query=mysqli_query($con, "INSERT INTO tbldrivers(DriverName, MobileNumber, Email, Password) VALUES('$drivername', '$mobile', '$email', '$password')");
      if($query) {
        echo "<script>alert('Driver added successfully');</script>";
      } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
      }
    }
  }
  
  // Delete driver
  if(isset($_GET['del'])) {
    $driverid=$_GET['del'];
    $query=mysqli_query($con, "DELETE FROM tbldrivers WHERE ID='$driverid'");
    if($query) {
      echo "<script>alert('Driver deleted successfully');</script>";
      echo "<script>window.location.href='manage-drivers.php'</script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  }
?>

<!DOCTYPE html>
<head>
<title>EAHP | Manage Drivers</title>

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
                    Add New Driver
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Driver Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="drivername" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mobile Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mobile" required="true" maxlength="12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button type="submit" name="submit" class="btn btn-primary">Add Driver</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Manage Drivers
                </header>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Driver Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query=mysqli_query($con, "SELECT * FROM tbldrivers");
                            $cnt=1;
                            while($row=mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['DriverName']; ?></td>
                                <td><?php echo $row['MobileNumber']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['RegDate']; ?></td>
                                <td>
                                    <a href="edit-driver.php?id=<?php echo $row['ID']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="manage-drivers.php?del=<?php echo $row['ID']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this driver?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                            $cnt++;
                            }
                            ?>
                        </tbody>
                    </table>
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