 <!-- ======= Top Bar ======= -->
 <div id="topbar" class="d-flex align-items-center fixed-top">
     <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
         <?php 
      //  fetching this contact info from your database
 $query=mysqli_query($con,"select * from  tblpage where PageType='contactus'");
 while ($row=mysqli_fetch_array($query)) {


 ?>
         <!-- loop through the result: -->
         <div class="align-items-center d-none d-md-flex">
             <i class="bx bx-envelope"></i> Email: <?php  echo $row['Email'];?>
         </div>
         <div class="d-flex align-items-center">
             <i class="bi bi-phone"></i> Call us now +<?php  echo $row['MobileNumber'];?>
         </div><?php } ?>
     </div>
 </div>

 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
     <div class="container d-flex align-items-center">

         <!-- Clicking the logo takes you back to the homepage -->
         <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="logo"></a>

         <nav id="navbar" class="navbar order-last order-lg-0">
             <ul>
                 <!-- links scroll to specific sections of the homepage -->
                 <li><a class="nav-link scrollto " href="index.php#hero">Home</a></li>
                 <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                 <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                 <li><a class="nav-link scrollto" style="color: red;" href="ambulance-tracking.php">Ambulance Tracking</a></li>
                 <!-- <li><a href="notifications.php">notification</a></li> -->
             </ul>
             <!-- Used for opening the nav menu on small screens (Bootstrap behavior) -->
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!-- .navbar -->

         <!-- Direct link to the appointment/booking section (form) on the homepage -->
         <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Hire an </span> Ambulance</a>

     </div>


 </header><!-- End Header -->