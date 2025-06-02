<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery - One More Party</title>
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="Gallery.css">
</head>
<body>
<!--Header Section Start-->
<header>
    <nav class="navbar">
      <!-- Logo -->
      <div class="logo"><img src="image/Logo 1.png" alt="">
      <div class="logo-text">One More<span> Party</span></div>
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
<!-- Hero Section -->
<section class="hero">
    <div>
      <h1>Gallery</h1>
      <p>Explore our latest collection of images.</p>
    </div>
  </section>
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
</section> 
<!-- Gallery Section -->
<section class="gallery-section">
    <h1 class="section-title">Our Image Gallery </h1>

    <!-- Filter Buttons -->
    <div class="filter-buttons">
      <button class="active" onclick="filterSelection('all')">All</button>
      <button onclick="filterSelection('Planning')">Planning & Cordination </button>
      <button onclick="filterSelection('Dec')">Decorations & Theme Styling</button>
      <button onclick="filterSelection('floral')">Floral,Custom Cakes & Dessert Tables</button>
      <button onclick="filterSelection('Photo')">Photography & Videography</button>
      <button onclick="filterSelection('entertainment')">Entertainment</button>
      <button onclick="filterSelection('Rentals')">Equipment & Furniture Rentals</button>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery">
      <!-- Planning -->
      <div class="card Planning">
        <img src="image/Gallery p.jpg" alt=" Planning" onclick="openModal(this.src)">
      </div>

      <!-- Dec -->
      <div class="card Dec">
        <img src="image/Img Gallery Dr.jpg" alt="Decorations & Theme Styling" onclick="openModal(this.src)">
      </div>

      <!-- Floral -->
      <div class="card floral">
        <img src="image/Galleery 2.jpg" alt="Floral,Custom Cakes & Dessert Tables" onclick="openModal(this.src)">
      </div>
       <!-- Photo -->
       <div class="card Photo ">
        <img src="image/Gallery W.jpg" alt="Photography & Videography" onclick="openModal(this.src)">
      </div>

      <!-- entertainment -->
      <div class="card entertainment">
        <img src="image/Gallery img2.jpg" alt="Entertainment" onclick="openModal(this.src)">
      </div>

      <!-- Rentals -->
      <div class="card Rentals">
        <img src="image/Img Gallery Er1.jpg" alt="Equipment & Furniture Rentals" onclick="openModal(this.src)">
      </div>
            <!-- Planning -->
      <div class="card Planning">
        <img src="image/hamza-nouasria-CgNNyDO1pcY-unsplash.jpg" alt=" Planning" onclick="openModal(this.src)">
      </div>

      <!-- Dec -->
      <div class="card Dec">
        <img src="image/Img Gallery Dr1.jpg" alt="Decorations & Theme Styling" onclick="openModal(this.src)">
      </div>

      <!-- Floral -->
      <div class="card floral">
        <img src="image/Gallery C2.jpg" alt="Floral,Custom Cakes & Dessert Tables" onclick="openModal(this.src)">
      </div>
       <!-- Photo -->
       <div class="card Photo ">
        <img src="image/Gallery W1.jpg" alt="Photography & Videography" onclick="openModal(this.src)">
      </div>

      <!-- entertainment -->
      <div class="card entertainment">
        <img src="image/Gallery E.jpg" alt="Entertainment" onclick="openModal(this.src)">
      </div>

      <!-- Rentals -->
      <div class="card Rentals">
        <img src="image/Gallery R2.jpg" alt="Equipment & Furniture Rentals" onclick="openModal(this.src)">
      </div>

    <!-- Lightbox Modal -->
    <div id="imageModal" class="modal" onclick="closeModal(event)">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="modalImage" />
    </div>
    <!-- Dec -->
      <div class="card Dec">
        <img src="image/Gallery D 1.jpg" alt="Decorations & Theme Styling" onclick="openModal(this.src)">
      </div>

      <!-- Floral -->
      <div class="card floral">
        <img src="image/Gallery C1.jpg" alt="Floral,Custom Cakes & Dessert Tables" onclick="openModal(this.src)">
      </div>
       <!-- Photo -->
       <div class="card Photo ">
        <img src="image/Gallery W2.jpg" alt="Photography & Videography" onclick="openModal(this.src)">
      </div>
  </section>

  <!-- JavaScript -->
  <script>
    // Filter Functionality
    function filterSelection(category) {
      const cards = document.querySelectorAll('.card');
      const buttons = document.querySelectorAll('.filter-buttons button');

      // Remove active class from all buttons
      buttons.forEach(btn => btn.classList.remove('active'));

      // Add active class to clicked button
      event.target.classList.add('active');

      // Show filtered items
      cards.forEach(card => {
        card.style.display = "none";
        if (category === 'all' || card.classList.contains(category)) {
          card.style.display = "block";
        }
      });
    }

    // Lightbox Modal Functions
    function openModal(imageSrc) {
      const modal = document.getElementById("imageModal");
      const modalImg = document.getElementById("modalImage");
      modal.style.display = "block";
      modalImg.src = imageSrc;
    }

    function closeModal(e) {
      const modal = document.getElementById("imageModal");

      // Only close if user clicks on the modal background or close button
      if (e.target === modal || e.target.className === "close") {
        modal.style.display = "none";
      }
    }

    // Close modal on ESC key press
    window.addEventListener('keydown', function(e) {
      const modal = document.getElementById("imageModal");
      if (e.key === "Escape") {
        modal.style.display = "none";
      }
    });

    // Close modal when clicking outside the image
    window.onclick = function(event) {
      const modal = document.getElementById("imageModal");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
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
          <a href="#">Gallery</a>
          <a href="Service.php">Services</a>
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