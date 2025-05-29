<?php
session_start();
require_once 'dbh.inc.php'; 

ini_set('display_errors', 1);
error_reporting(E_ALL);

function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check login status
$isLoggedIn = isset($_SESSION['user_id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If not logged in, store form data and redirect to login
    if (!$isLoggedIn) {
        $_SESSION['pending_booking'] = $_POST;
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'You must log in to complete your booking.'];
        header('Location: Login.php');
        exit;
    }

    // Logged in: process form
    $name       = clean_input($_POST['name'] ?? '');
    $email      = clean_input($_POST['email'] ?? '');
    $phone      = clean_input($_POST['phone'] ?? '');
    $event_type = clean_input($_POST['event_type'] ?? '');
    $event_date = clean_input($_POST['event_date'] ?? '');
    $guests     = clean_input($_POST['guests'] ?? '');
    $notes      = clean_input($_POST['notes'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($event_type) || empty($event_date)) {
        $_SESSION['flash'] = ['type'=>'error','message'=>'Please fill in all required fields.'];
        header('Location: Booking.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash'] = ['type'=>'error','message'=>'Invalid email format.'];
        header('Location: Booking.php');
        exit;
    }

    $dateObj = DateTime::createFromFormat('Y-m-d', $event_date);
    $currentDate = new DateTime();
    $currentDate->setTime(0, 0, 0); // Reset time for accurate date comparison

    if (!$dateObj || $dateObj < $currentDate) { // Changed to $currentDate to disallow past dates
        $_SESSION['flash'] = ['type'=>'error','message'=>'Event date must be in the future.'];
        header('Location: Booking.php');
        exit;
    }
    // New check: Disallow same-day booking
    if ($dateObj->format('Y-m-d') === $currentDate->format('Y-m-d')) {
        $_SESSION['flash'] = ['type'=>'error','message'=>'Same-day bookings are not allowed. Please select a future date.'];
        header('Location: Booking.php');
        exit;
    }


    // Insert into DB
    $stmt = $conn->prepare("
        INSERT INTO bookings
        (name, email, phone, event_type, event_date, guests, notes)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("sssssis", $name, $email, $phone, $event_type, $event_date, $guests, $notes);
    $success = $stmt->execute();

    if ($success) {
        unset($_SESSION['pending_booking']); 
        $_SESSION['flash'] = ['type'=>'success','message'=>'Thank you! Your booking has been received.'];
    } else {
        $_SESSION['flash'] = ['type'=>'error','message'=>'Oops! Something went wrong. Please try again.'];
    }

    header('Location: Booking.php');
    exit;
}

if ($isLoggedIn && isset($_SESSION['pending_booking'])) {
    $pending = $_SESSION['pending_booking'];
    echo '<form id="autoSubmit" method="POST" action="Booking.php">';
    foreach ($pending as $key => $value) {
        $value = htmlspecialchars($value, ENT_QUOTES);
        echo "<input type='hidden' name='$key' value='$value'>";
    }
    echo '</form>';
    echo '<script>document.getElementById("autoSubmit").submit();</script>';
    exit;
}

// Flash message
$flash = $_SESSION['flash'] ?? null;
if ($flash) unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - One More Party</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="Booking.css">
    <style>
            /* Flash/toast styles */
    #flash {
      position: fixed;
      top: 1rem;
      left: 50%;
      transform: translateX(-50%) translateY(-20px);
      padding: 1rem 1.5rem;
      border-radius: .5rem;
      color: #fff;
      font-weight: bold;
      opacity: 0;
      pointer-events: none;
      transition: opacity .4s ease, transform .4s ease;
      z-index: 9999;
    }
    #flash.show {
      opacity: 1;
      pointer-events: auto;
      transform: translateX(-50%) translateY(0);
    }
    #flash.success { background: #28a745; }
    #flash.error    { background: #dc3545; }
    </style>
</head>

<?php if ($flash): ?>
    <div id="flash" class="<?= $flash['type'] ?>">
      <?= htmlspecialchars($flash['message']) ?>
    </div>
  <?php endif; ?>
<header>
  <nav class="navbar">
    <div class="logo"><img src="image/Logo 1.png" alt="">
    <div class="logo-text">One More Party</div>
    </div>

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
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <script>
    function toggleMenu() {
      const navLinks = document.getElementById('navLinks');
      navLinks.classList.toggle('active');
    }
  </script>
</header>
<section class="hero">
  <div>
    <h1>Book Now</h1>
    <p>We turn celebrations into unforgettable experiences.</p>
  </div>
</section>
<section>
  <div class="container">
    <h2>Book an Event</h2>
    <form id="bookingForm" method="POST" class="booking-form">
      <div class="form-group">
        <label>Event Type <span class="required">*</span></label>
        <select name="event_type" id="event-type" class="form-control" required>
          <option value=""></option>
          <option value="wedding">Wedding</option>
          <option value="corporate">Corporate Event</option>
          <option value="party">Party</option>
          <option value="conference">Conference</option>
          <option value="other">Other</option>
        </select>
        <div id="event-type-error" class="error-message">Select an event type</div>
      </div>
      <div class="form-group">
        <label>Event Date <span class="required">*</span></label>
        <input type="date" name="event_date" id="event-date" class="form-control" required>
        <div id="event-date-error" class="error-message">Pick a future date</div>
      </div>
      <div class="form-group">
        <label>Number of Guests <span class="required">*</span></label>
        <input type="number" name="guests" id="guest-count" class="form-control" min="1" required>
        <div id="guest-count-error" class="error-message">Enter guest count</div>
      </div>
      <div class="form-group">
        <label>Your Name <span class="required">*</span></label>
        <input type="text" name="name" id="name" class="form-control" required>
        <div id="name-error" class="error-message">Enter your name</div>
      </div>
      <div class="form-group">
        <label>Email <span class="required">*</span></label>
        <input type="email" name="email" id="email" class="form-control" required>
        <div id="email-error" class="error-message">Enter valid email</div>
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control">
      </div>
      <div class="form-group">
        <label>Additional Details</label>
        <textarea name="notes" id="message" class="form-control"></textarea>
      </div>
      <button type="submit" id="submitBtn" class="btn">Submit Booking</button>
    </form>
  </div>
</section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Show/hide flash toast
    document.addEventListener('DOMContentLoaded', () => {
      const flash = document.getElementById('flash');
      if (flash) {
        setTimeout(() => flash.classList.add('show'), 100);
        setTimeout(() => flash.classList.remove('show'), 5100);
      }
    });

    // Client-side validation for booking form
    $('#bookingForm').on('submit', function(e){
      e.preventDefault();
      let hasErrors = false;
      $('.error-message').removeClass('show');

      const eventType = $('#event-type').val();
      const eventDate = $('#event-date').val();
      const guestCount = $('#guest-count').val();
      const name = $('#name').val();
      const email = $('#email').val();

      // Validate Event Type
      if (eventType === '') {
        $('#event-type-error').addClass('show');
        hasErrors = true;
      }

      // Validate Event Date
      const today = new Date();
      today.setHours(0, 0, 0, 0); // Reset time to midnight for accurate comparison
      const selectedDate = new Date(eventDate);
      selectedDate.setHours(0, 0, 0, 0); // Reset time for accurate comparison

      if (eventDate === '' || selectedDate < today) {
        $('#event-date-error').text('Pick a future date').addClass('show');
        hasErrors = true;
      } else if (selectedDate.getTime() === today.getTime()) { // Check for same day
        $('#event-date-error').text('Same-day bookings are not allowed.').addClass('show');
        hasErrors = true;
      }

      // Validate Guest Count
      if (guestCount === '' || parseInt(guestCount) < 1) {
        $('#guest-count-error').addClass('show');
        hasErrors = true;
      }

      // Validate Name
      if (name.trim() === '') {
        $('#name-error').addClass('show');
        hasErrors = true;
      }

      // Validate Email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email.trim() === '' || !emailRegex.test(email)) {
        $('#email-error').addClass('show');
        hasErrors = true;
      }

      if (!hasErrors) {
          this.submit();
      } else {
          $('#submitBtn').prop('disabled', false);
      }
    });
  </script>
  <footer class="footer">
  <div class="footer-container">

    <div class="footer-column">
      <div class="footer-logo"><img src="image/Logo 1.png" alt="">
        <div class="footer-logo-text">One More Party</div>
      </div>
      <p class="footer-text">For more information about our events, please check out our social media and subscribe to our YouTube channel. We bring your celebrations to life with creativity, professionalism, and attention to every detail.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/profile.php?id=61574733720989" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/onemoreparty1/profilecard/?igsh=MXE0bDhuZmlpZHBwMA==" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://www.tiktok.com/@onemoreparty0?_t=ZS-8wd7C3Nz0Dp&_r=1" aria-label="Tiktok"><i class="fa-brands fa-tiktok"></i>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

    <div class="footer-column">
      <h3>Contact Us</h3>
      <div class="contact-info">
        <a href="mailto:events@onemoreparty.com">operations@onemore-bloom.com</a>
        <a href="tel:+971 5274 48643">+971 5274 48643</a>
        <a href="#">Rolex Towers, 9th Floor Sheikh Zayed Road Near Financial Center Metro Station Dubai, UAE
        </a>
      </div>
    </div>

    <div class="footer-column">
      <h3>Quick Links</h3>
      <div class="contact-info">
        <a href="#">Home</a>
        <a href="About.php">About Us</a>
        <a href="Gallery.php">Gallery</a>
        <a href="Service.php">Services</a>
        <a href="Contact.php">Contact Us</a>
        <a href="Booking.php">Book Now</a>
      </div>
    </div>

    <div class="footer-column">
      <h3>Stay Updated</h3>
      <p class="cta-subscribe">Subscribe to our newsletter for event inspiration and updates!</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Your Email Address" required />
        <button type="submit">Subscribe</button>
      </form>
    </div>

  </div>

  <div class="footer-bottom">
    © 2023 One More Party. All rights reserved. Designed with 💖 for unforgettable events.
  </div>
</footer>
</body>
</html>