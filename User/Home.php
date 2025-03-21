<?php
$title = "LifeSaveConnect - Ambulance Hiring Portal";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <header class="navbar">
        <h1 class="logo">LifeSaveConnect</h1>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="#contact">Contact</a></li> <!-- Updated -->
                <li><a href="#">Ambulance Tracking</a></li>
                <li><a href="#review">Review Us</a></li> <!-- Updated -->
            </ul>
        </nav>
        <!-- Fixed Button for Hiring an Ambulance -->
        <a href="Booking_form.php" class="hire-btn">Hire an Ambulance</a>
    </header>

    <main>
        <section class="hero">
            <h2>Welcome to Ambulance Hiring Portal</h2>
            <p>24/7 Available | Call on +97798012345678</p>
            <!-- Fixed Primary Button -->
            <a href="Booking_form.php" class="primary-btn" style="text-decoration: none;">Hire an Ambulance</a>
        </section>

        <section class="features">
            <h3>Why Choose Us?</h3>
            <div class="features-grid">
                <div class="feature-item">24/7 Availability</div>
                <div class="feature-item">Fastest Response Time</div>
                <div class="feature-item">Experienced Staff</div>
                <div class="feature-item">Variety of Ambulance Services</div>
            </div>
        </section>

        <section class="about">
            <div class="about-image"></div>
            <div class="about-content">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tempor pretium lacinia.</p>
                <button class="learn-more-btn">Learn More</button>
            </div>
        </section>

        <section class="types">
            <h3>Types of Ambulances</h3>
            <div class="types-grid">
                <div class="type-item">Basic Ambulance</div>
                <div class="type-item">Advanced Ambulance</div>
                <div class="type-item">Specialized Ambulance</div>
            </div>
        </section>

        <section class="testimonials">
            <h3>Testimonials</h3>
            <blockquote>
                <p>"LifeSaveConnect provided exceptional service!"</p>
                <cite>- Rista Shah</cite>
            </blockquote>
        </section>

        <section class="review" id="review"> <!-- Updated -->
            <h3>Write a Review</h3>
            <div class="stars">★★★★★</div>
            <form action="" method="post">
                <textarea placeholder="Leave your review"></textarea>
                <button type="submit">Submit</button>
            </form>
        </section>

        <section class="contact" id="contact"> <!-- Updated -->
            <h3>Contact Form</h3>
            <div class="contact-form">
                <h2>Here To Help You</h2>
                <form>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="address" placeholder="Address">
                    <textarea name="message" placeholder="Message" rows="4" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
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
