<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ambulancehiringdbuser");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch about us content
$result = $conn->query("SELECT * FROM about_us LIMIT 1");
$about = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LifeSaveConnect</title>
    <link rel="stylesheet" href="about.css">
</head>
<body>

<header class="navbar">
    <h1 class="logo">LifeSaveConnect</h1>
    <nav>
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Ambulance Tracking</a></li>
            <li><a href="#">Review Us</a></li>
        </ul>
    </nav>
    <a href="Booking_form.php" class="hire-btn">Hire an Ambulance</a>
</header>

<main class="about-container">
    <section class="about-section">
        <div class="about-text">
            <h2>Reliable Emergency Ambulance Services</h2>
            <p>LifeSaveConnect provides a fast and reliable ambulance hiring service to ensure patients receive immediate medical attention. Our system allows users to book ambulances in real time, reducing response times in emergencies.</p>
        </div>
        <div class="about-image">
            <img src="ambulance1.jpeg" Emergency Ambulance>
        </div>
    </section>

    <section class="about-section reverse">
        <div class="about-image">
            <img src="booking.jpeg"Ambulance Booking System>
        </div>
        <div class="about-text">
            <h2>Easy Online Booking</h2>
            <p>Our platform enables quick ambulance booking with just a few clicks. Users can track the nearest available ambulance and get real-time updates about arrival times.</p>
        </div>
    </section>

    <section class="about-section">
        <div class="about-text">
            <h2>GPS-Based Ambulance Tracking</h2>
            <p>With integrated GPS tracking, users can monitor ambulance locations in real time, ensuring faster response times and better route optimization.</p>
        </div>
        <div class="about-image">
            <img src="tracking.jpeg"GPS Tracking System>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="footer-links">
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li>Home</li>
                <li>About</li>
                <li>Services</li>
                <li>Contact</li>
            </ul>
        </div>
        <div>
            <h4>Contact Us</h4>
            <p>Email: hireambulance@gmail.com</p>
            <p>Location: ABC Street, Kathmandu</p>
            <p>Phone: +9779812345678</p>
        </div>
        <div>
            <h4>Follow Us</h4>
            <ul>
                <li>Facebook</li>
                <li>Instagram</li>
            </ul>
        </div>
    </div>
    <p>&copy; 2025 LifeSaveConnect</p>
</footer>

</body>
</html>
