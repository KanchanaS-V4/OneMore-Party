<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

if (isset($_SESSION['flash_message'])) {
    echo '<div class="flash-message" style="background: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px 0;">' 
         . $_SESSION['flash_message'] . 
         '</div>';
    unset($_SESSION['flash_message']); // Remove after showing once
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Home - One More Party</title>
  <script src="https://kit.fontawesome.com/8a3d3b8cd1.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header Section Start -->
  <header>
    <nav class="navbar">
      <!-- Logo -->
      <div class="logo">
        <img src="image/Logo 1.png" alt="One More Party Logo">
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
        <span></span><span></span><span></span>
      </div>
    </nav>
  </header>

  <script>
    function toggleMenu() {
      document.getElementById('navLinks').classList.toggle('active');
    }
  </script>
  <!-- Header Section End -->
<!-- Hero Section --> 
<main>
    <section class="hero">
        <div class="hero-content">
            <h1 class="animated-text">
              Let us bring your event to life
                on time, on budget
              and beyond expectations
            </h1>
            <button class="button" onclick="window.location.href='Contact.php'">Plan Your Event Now</button>
        </div>
        <div class="scroll-indicator"></div>
    </section>
    
</main>
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
<!--About Section Start-->
<section class="about-section">
    <div class="about-content">
      <h2 class="About-title">About Us</h2>
      <div class="about-text">
        At One More Party, we create unforgettable celebrations with creativity, professionalism, and attention to detail. From birthdays and weddings to corporate 
        and themed events, we offer everything under one roof—decor, floral arrangements, custom cakes, photography, rentals, and more. 
        Our experienced team works closely with you to bring your vision to life, ensuring a stress-free, stylish, and affordable event.
      </div>
      <button class="about-button" onclick="window.location.href='About.php'">Get in Touch</button>
    </div>

    <div class="about-image">
      <img src="https://images.unsplash.com/photo-1519337265831-281ec6cc8514?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Event Planning Team">
    </div>
  </section>

  <!-- Counter Animation Script -->
  <script>
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const target = entry.target;
          const updateCount = () => {
            const targetValue = +target.getAttribute('data-target');
            const count = +target.innerText;
            const increment = Math.ceil(targetValue / speed);

            if (count < targetValue) {
              target.innerText = count + increment;
              setTimeout(updateCount, 20);
            } else {
              target.innerText = targetValue;
            }
          };
          updateCount();
          observer.unobserve(target);
        }
      });
    }, {
      threshold: 0.5
    });

    counters.forEach(counter => observer.observe(counter));
  </script>
<!--Service Section Start-->
<section class="services-section">
    <h2 class="section-title">Our Services</h2>
    <div class="services-grid">
      <!-- Service Card 1 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/Servies 1.jpg" alt="Event Planning">
        </div>
        <div class="service-content">
          <h3 class="service-title">Event Planning & Coordination</h3>
          <p class="service-description">Personalized planning and on-site coordination for birthdays, weddings, corporate events, and more.</p>
        </div>
      </div>

      <!-- Service Card 2 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/WhatsApp Image 2025-05-02 at 22.55.58_c2a86300.jpg" alt="Custom Decorations">
        </div>
        <div class="service-content">
          <h3 class="service-title">Custom Decorations & Theme Styling</h3>
          <p class="service-description">Bespoke décor design, balloon styling, table settings, and backdrops tailored to your vision.</p>
        </div>
      </div>

      <!-- Service Card 3 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/Floral 1.jpg" alt="Floral Arrangements">
        </div>
        <div class="service-content">
          <h3 class="service-title">Floral Arrangements</h3>
          <p class="service-description">Fresh, vibrant flowers for centrepieces, bouquets, arches, and venue styling.</p>
        </div>
      </div>

      <!-- Service Card 4 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/Servise 3.jpg" alt="Photography">
        </div>
        <div class="service-content">
          <h3 class="service-title">Photography & Videography</h3>
          <p class="service-description">Professional coverage with stunning photos and cinematic videos of your event.</p>
        </div>
      </div>

      <!-- Service Card 5 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/Servise 4.jpg" alt="Custom Cakes">
        </div>
        <div class="service-content">
          <h3 class="service-title">Custom Cakes & Dessert Tables</h3>
          <p class="service-description">Delicious, beautiful cakes and treats tailored to your theme and taste.</p>
        </div>
      </div>

      <!-- Service Card 6 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/Servies 5.jpg" alt="Catering">
        </div>
        <div class="service-content">
          <h3 class="service-title">Catering Services</h3>
          <p class="service-description">Full-service catering with menus from elegant plated meals to buffer-style options.</p>
        </div>
      </div>

      <!-- Service Card 7 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/WhatsApp Image 2025-05-02 at 22.22.30_cd497176.jpg" alt="Equipment Rentals">
        </div>
        <div class="service-content">
          <h3 class="service-title">Equipment & Furniture Rentals</h3>
          <p class="service-description">Tents, tables, chairs, lighting, sound systems, and staging—all you need for your event.</p>
        </div>
      </div>

      <!-- Service Card 8 -->
      <div class="service-card">
        <div class="service-image">
          <img src="image/Entertainmaet new.png" alt="Entertainment">
        </div>
        <div class="service-content">
          <h3 class="service-title">Entertainment & Extras</h3>
          <p class="service-description">DJs, live music, kids’ entertainment, photo booths, and more to keep guests engaged.</p>
        </div>
      </div>
    </div>

    <button class="cta-button" onclick="window.location.href='Gallery.php'">Explore All Services</button>
  </section>

  <!-- Scroll Animation Script -->
  <script>
    const cards = document.querySelectorAll('.service-card');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, {
      threshold: 0.2
    });

    cards.forEach(card => {
      observer.observe(card);
    });
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