<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Event Planning</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8a3d3b8cd1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Service.css">
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
href="https://wa.me/+971527448643?text=Hello!%20I%20would%20like%20to%20plan%20an%20event." 
target="_blank" 
class="whatsapp-chat"
aria-label="Chat on WhatsApp"
>
<i class="fab fa-whatsapp whatsapp-icon"></i>
<span class="chat-text">Chat Now</span>
</a>
<!--Hero Section-->
<section class="hero">
    <div>
      <h1>Our Services</h1>
      <p>We offer a wide range of event planning services to make your event unforgettable.</p>
    </div>
  </section>
 <!--main Section--> 
 <section style="padding: 100px 5% 60px;">
    <h2 class="section-title">What We Do</h2>
    <p class="section-subtitle">From planning to execution, we offer a full range of services to make your event unforgettable.</p>

    <div class="services-grid">
      <!-- Service 1 -->
      <div class="service-card">
        <img src="image/hamza-nouasria-OWEPHt9a-90-unsplash.jpg" alt="Event Planning" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-calendar-check"></i></div>
          <div class="service-title">Event Planning & Coordination</div>
          <div class="service-description" id="service1-desc">
            Personalized planning and on-site coordination to ensure every event runs smoothly from start to finish.
            We handle birthdays, baby showers, weddings, corporate events, and more.
          </div>
          <div class="read-more" onclick="toggleDescription('service1-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="service-card">
        <img src="image/Our Service.jpg" alt="Decorations" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-gifts"></i></div>
          <div class="service-title">Custom Decorations & Theme Styling</div>
          <div class="service-description" id="service2-desc">
            Bespoke décor design, balloon styling, table settings, backdrops, and more to match your vision.
            From elegant to playful—we bring your theme to life with creativity and precision.
          </div>
          <div class="read-more" onclick="toggleDescription('service2-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="service-card">
        <img src="image/Our Service 1.jpg" alt="Floral Arrangements" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-seedling"></i></div>
          <div class="service-title">Floral Arrangements</div>
          <div class="service-description" id="service3-desc">
            Fresh, vibrant flowers for centrepieces, bouquets, arches, and venue styling.
            Elevate the beauty of your event with our floral design expertise.
          </div>
          <div class="read-more" onclick="toggleDescription('service3-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="service-card">
        <img src="image/Our Service 2.jpg" alt="Photography" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-camera-retro"></i></div>
          <div class="service-title">Photography & Videography</div>
          <div class="service-description" id="service4-desc">
            Professional coverage that captures the heart of your event with stunning photos and cinematic videos.
            Relive your special day with memories that last a lifetime.
          </div>
          <div class="read-more" onclick="toggleDescription('service4-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 5 -->
      <div class="service-card">
        <img src="image/Our Service 3.jpg" alt="Cakes" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-birthday-cake"></i></div>
          <div class="service-title">Custom Cakes & Dessert Tables</div>
          <div class="service-description" id="service5-desc">
            Delicious, beautiful cakes and treats tailored to your theme and taste.
            Our dessert tables are sure to be the highlight of your celebration.
          </div>
          <div class="read-more" onclick="toggleDescription('service5-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 6 -->
      <div class="service-card">
        <img src="image/Our Service 4.jpg" alt="Catering" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-concierge-bell"></i></div>
          <div class="service-title">Catering Services</div>
          <div class="service-description" id="service6-desc">
            Full-service catering with a wide selection of menu options—from elegant plated meals to buffet-style service.
            We partner with top chefs and caterers to deliver exceptional cuisine.
          </div>
          <div class="read-more" onclick="toggleDescription('service6-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 7 -->
      <div class="service-card">
        <img src="image/Our Service 5.jpg" alt="Equipment Rentals" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-tents"></i></div>
          <div class="service-title">Equipment & Furniture Rentals</div>
          <div class="service-description" id="service7-desc">
            Everything you need—from tents, tables, and chairs to lighting, sound systems, and staging.
            Reliable and high-quality rentals to suit any event size or setting.
          </div>
          <div class="read-more" onclick="toggleDescription('service7-desc')">Read More</div>
        </div>
      </div>

      <!-- Service 8 -->
      <div class="service-card">
        <img src="image/Our Service 6.jpg" alt="Entertainment" class="service-image">
        <div class="service-content">
          <div class="service-icon"><i class="fas fa-music"></i></div>
          <div class="service-title">Entertainment & Extras</div>
          <div class="service-description" id="service8-desc">
            DJs, live music, kids’ entertainment, photo booths, and more to keep your guests engaged and smiling.
            We provide fun and interactive experiences for all ages.
          </div>
          <div class="read-more" onclick="toggleDescription('service8-desc')">Read More</div>
        </div>
      </div>
    </div>

    <button class="cta-button" onclick="window.location.href='Booking.php'">Book Your Event Now</button>
  </section>

  <script>
    function toggleDescription(id) {
      const desc = document.getElementById(id);
      desc.classList.toggle("expanded");
      desc.nextElementSibling.textContent = desc.classList.contains("expanded") ? "Show Less" : "Read More";
    }
  </script>
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
          <a href="#">Services</a>
          <a href="Contact.php">Contact Us</a>
          <a href="Booking.php">Book Now</a>
        </div>
      </div>

      <!-- Column 4: Newsletter -->
      <div class="footer-column">
        <h3>Stay Updated</h3>
        <p class="cta-subscribe">Subscribe to our newsletter for event inspiration and updates!</p>
      <form class="newsletter-form" action="subscribe.php" method="POST">
      <input type="email" name="email" placeholder="Your Email Address" required />
        <button type="submit">Subscribe</button>
      </form>
      </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      © 2023 One More Party. All rights reserved. Designed with 💖 for unforgettable events.
    </div>
  </footer>
</body>
</html>
