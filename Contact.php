<?php
session_start();
// Database connection
include 'dbh.inc.php';
$isLoggedIn = isset($_SESSION['user_id']);


// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = sanitizeInput($_POST['FirstName']);
    $lastName = sanitizeInput($_POST['Lastname']);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $phone = sanitizeInput($_POST['Phone']);
    $message = sanitizeInput($_POST['Message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='Contact.php';</script>";
    } else {
        echo "<script>alert('Failed to send message. Please try again.'); window.location.href='Contact.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - One More Party</title>
    <script src="https://kit.fontawesome.com/8a3d3b8cd1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Contact.css">
</head>
<body>
<!--Header Section Start-->
<header>
  <nav class="navbar">
    <!-- Logo -->
    <div class="logo"><img src="image/Logo 1.png" alt="">
    <div class="logo-text">One More Party</div>
    </div>

    <!-- Desktop Links -->
    <div class="nav-links" id="navLinks">
  <a href="index.php" class="nav-link">Home</a>
  <a href="About.php" class="nav-link">About</a>
  <a href="Gallery.php" class="nav-link">Gallery</a>
  <a href="Service.php" class="nav-link">Services</a>
  <a href="Contact.php" class="nav-link">Contact Us</a>
  <button class="btn-book" onclick="location.href='Booking.php'">Book Now</button>
  <?php if ($isLoggedIn): ?>
    <button class="btn-signin" onclick="location.href='Logout.php'">Sign Out</button>
  <?php else: ?>
    <button class="btn-signin" onclick="location.href='Login.php'">Sign In</button>
  <?php endif; ?>
</div>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <!-- Mobile Menu Script -->
  <script>
    function toggleMenu() {
      const navLinks = document.getElementById('navLinks');
      navLinks.classList.toggle('active');
    }
  </script>

</header>  
<!-- WhatsApp Chat Button -->
<a 
href="https://wa.me/1234567890?text=Hello!%20I%20would%20like%20to%20plan%20an%20event." 
target="_blank" 
class="whatsapp-chat"
aria-label="Chat on WhatsApp"
>
<i class="fab fa-whatsapp whatsapp-icon"></i>
<span class="chat-text">Chat Now</span>
</a>
<!--main Section Start-->
<section class="Contact-section">
  <div class="Contact-bg">
      <h3>Get in Touch with Us</h3>
      <h2>Contact Us</h2>
      <div class="line">
          <div></div>
          <div></div>
          <div></div>
      </div>
      <p class="text">If you are impressed with my works, you can hire me for your future projects.</p>
  </div>
  <div class="Contact-body">
      <div class="Contact-info">
          <div class="Contact-item">
              <span1><i class="fa-solid fa-location-dot"></i></span1>
              <span1>Address</span1>
              <span1 class="text">203 Patrik Street North West coast of Scotland</span1>
          </div>
          <div class="Contact-item">
              <span1><i class="fa-solid fa-mobile-screen-button"></i></span1>
              <span1>Mobile No</span1>
              <span1 class="text">+971 5274 48643</span1>
          </div>
          <div class="Contact-item">
              <span1><i class="fa-regular fa-envelope"></i></span1>
              <span1>E-mail</span1>
              <span1 class="text">MalcolmLismore@gmail.com</span1>
          </div>
          <div class="Contact-item">
              <span1><i class="fa-regular fa-clock"></i></span1>
              <span1>Opening Hours</span1>
              <span1 class="text">Monday - Friday (9:00 AM to 5:00 PM)</span1>
          </div>
      </div>
      <div class="Contact-form">
          <form action="Contact.Php" method="post">
              <div>
                  <input type="text" name="FirstName" class="form-control" placeholder="First Name" required>
                  <input type="text" name="Lastname" class="form-control" placeholder="Last Name" required>
              </div>
              <div>
                  <input type="email" name="Email" class="form-control" placeholder="Email" required>
                  <input type="text" name="Phone" class="form-control" placeholder="Phone" required>
              </div>
              <textarea rows="5" name="Message" placeholder="Message" class="form-control" required></textarea>
              <input type="submit" class="send-btn" value="Send Message">
          </form>

          <div>
              <img src="image/contact-png.png" alt="">
          </div>
      </div>
  </div>

  <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7219.867677095101!2d55.27052889444554!3d25.20545360446515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRolex%20Towers%2C%209th%20Floor%20Sheikh%20Zayed%20Road%20Near%20Financial%20Center%20Metro%20Station%20Dubai%2C%20UAE!5e0!3m2!1sen!2slk!4v1747759411756!5m2!1sen!2slk"
       width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  
</section>
<!--Footer Section--> 
<footer class="footer">
  <div class="footer-container">
    
    <!-- Column 1: About -->
    <div class="footer-column">
      <div class="footer-logo"><img src="image/Logo 1.png" alt="">
        <div class="footer-logo-text">One More Party</div>
        </div>
      <p class="footer-text">For more information about our events, please check out our social media and subscribe to our YouTube channel. We bring your celebrations to life with creativity, professionalism, and attention to every detail.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/profile.php?id=61574733720989" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/onemoreparty1/profilecard/?igsh=MXE0bDhuZmlpZHBwMA== " aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://www.tiktok.com/@onemoreparty0?_t=ZS-8wd7C3Nz0Dp&_r=1" aria-label="Tiktok"><i class="fa-brands fa-tiktok"></i>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

    <!-- Column 2: Contact -->
    <div class="footer-column">
      <h3>Contact Us</h3>
      <div class="contact-info">
        <a href="mailto:events@onemoreparty.com">operations@onemore-bloom.com</a>
        <a href="tel:+971 5274 48643">+971 5274 48643</a>
        <a href="#">Rolex Towers, 9th Floor Sheikh Zayed Road Near Financial Center Metro Station Dubai, UAE
      </a>
      </div>
    </div>

    <!-- Column 3: Quick Links -->
    <div class="footer-column">
      <h3>Quick Links</h3>
      <div class="contact-info">
        <a href="Index.php">Home</a>
        <a href="About.php">About Us</a>
        <a href="Gallery.php">Gallery</a>
        <a href="Service.php">Services</a>
        <a href="#">Contact Us</a>
        <a href="Booking.php">Book Now</a>
      </div>
    </div>

    <!-- Column 4: Newsletter -->
    <div class="footer-column">
      <h3>Stay Updated</h3>
      <p class="cta-subscribe">Subscribe to our newsletter for event inspiration and updates!</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Your Email Address" required />
        <button type="submit">Subscribe</button>
      </form>
    </div>

  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    © 2023 One More Party. All rights reserved. Designed with 💖 for unforgettable events.
  </div>
</footer></body>
</html>
