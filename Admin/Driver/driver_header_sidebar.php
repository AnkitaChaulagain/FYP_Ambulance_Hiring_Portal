<?php
// driver-header.php

?>
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="driver-dashboard.php" class="logo">
        DRIVER PANEL
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <?php
                $driverid=$_SESSION['driverid'];
                $ret=mysqli_query($con,"select DriverName from tbldrivers where ID='$driverid'");
                $row=mysqli_fetch_array($ret);
                $name=$row['DriverName'];
                ?>
                <img alt="" src="images/2.png">
                <span class="username"><?php echo $name; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="driver-profile.php"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="change-password.php"><i class="fa fa-cog"></i> Change Password</a></li>
                <li><a href="driver-logout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>

<?php
// driver-sidebar.php
?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="driver-dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-ambulance"></i>
                        <span>Ambulance Requests</span>
                    </a>
                    <ul class="sub">
                        <li><a href="driver-assigned-requests.php">Assigned Requests</a></li>
                        <li><a href="driver-ontheway-requests.php">On The Way</a></li>
                        <li><a href="driver-pickup-requests.php">Pickup Requests</a></li>
                        <li><a href="driver-completed-requests.php">Completed Requests</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>