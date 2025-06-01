<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - One More Party</title>
    <script src="https://kit.fontawesome.com/8a3d3b8cd1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="About.css">
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
<!-- Hero Section -->
<section class="hero">
    <div>
      <h1>About Us</h1>
      <p>We turn celebrations into unforgettable experiences with creativity, professionalism, and attention to every detail.</p>
    </div>
  </section>

  <!-- About Section -->
  <section class="about-section">
    <div class="about-container">
      <div class="about-image">
        <img src="https://images.unsplash.com/photo-1519337265831-281ec6cc8514?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Team Working" />
      </div>
      <div class="about-content">
        <h2>Our Story</h2>
        <p>At One More Party, we turn celebrations into unforgettable experiences. As a full-service party and event planning company, we specialize in bringing your vision to life with creativity, professionalism, and attention to every detail.</p>
        <p>Whether you're planning an intimate birthday party, a lavish wedding, a corporate event, or a themed celebration, we’ve got everything you need under one roof. From elegant decorations and stunning floral arrangements to custom cakes, professional photography, 
            and high-quality equipment rentals, we take care of it all—so 
            you can enjoy your special moments without stress.</p>
        <p>Our passionate team of designers, planners, and creatives work closely with you to ensure every element reflects your style and purpose. With years of experience and a strong network of trusted vendors, we offer services 
            that are not only beautiful but also reliable and affordable.</p>
      </div>
    </div>
  </section>
    <!-- About Section1 -->
  <section class="about-section1">
    <div class="about-container1">
      <div class="about-content1">
        <h2>Our Mission</h2>
        <p>AAt One More Party, we specialize in transforming life’s special moments into unforgettable celebrations. Our mission is to bring your unique vision to life with creativity, precision, and a personal touch. Whether it's a birthday, wedding, or corporate event, 
          we combine thoughtful design, expert planning, and seamless execution to deliver experiences that truly shine.  </p>
        <p>From decor and entertainment to catering and coordination, every detail is handled with care and professionalism. We’re passionate about creating joyful, stress-free events that leave lasting impressions. 
          Let us take the lead, so you can relax, celebrate, and make beautiful memories with those you love.
        </p>
      </div>
      <div class="about-image1">
        <img src="image/About mission.png" alt="Team Working" />
      </div>
    </div>
  </section>
    <!-- About Section2 -->
  <section class="about-section2">
      <div class="about-container2">
        <div class="about-image2">
          <img src="image/About vision.png" alt="Team Working" />
        </div>
        <div class="about-content2">
          <h2>Our Vision</h2>
          <p>Our vision is to become a globally respected leader in the cosmetics and personal care industry, renowned for setting new standards in sustainability, inclusivity, and ethical responsibility. We are committed to creating high-quality, 
            cruelty-free products that cater to diverse beauty needs 
            while minimizing our environmental impact.</p>
          <p>By combining innovation, safety, and natural ingredients, we aim to enhance the confidence and well-being of our customers around the world. Through continuous improvement and a deep respect for people and the planet, we aspire
             to inspire positive change in the beauty industry and beyond.</p>
          
        </div>
      </div>
  </section>

  <section class="team-section">
    <div class="container">
        <h2>Meet Our Dedicated Team</h2>
        <p class="team-intro">
            Our team is the driving force behind our success. Get to know the people
            who work tirelessly to bring your event dreams to life.
        </p>

        <!-- Team Group Photo -->
        <div class="team-photo">
            <img 
                src="image/WhatsApp Image 2025-05-13 at 10.02.04_0ace61fb.jpg" 
                alt="Our Team Group Photo" 
                class="team-group-image"
            />
        </div>

        <!-- Individual Team Members -->
        <div class="team-members">
            <div class="team-member">
                <div class="member-image-wrapper">
                    <img src="image/Team 1.png" alt="General Manager" class="team-member-image" />
                </div>
                <div class="member-info">
                    <h3 class="member-name">Thilina Kowmudu</h3>
                    <p class="member-designation">General Manager</p>
                </div>
            </div>

            <div class="team-member">
                <div class="member-image-wrapper">
                    <img src="image/Team 2.png" alt="Operations Executive" class="team-member-image" />
                </div>
                <div class="member-info">
                    <h3 class="member-name">Isuru Lakshan</h3>
                    <p class="member-designation">Operations Executive</p>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    // No need for separate JS file, we can include it here
    document.addEventListener('DOMContentLoaded', () => {
        const teamMembers = document.querySelectorAll('.team-member');

        teamMembers.forEach(member => {
            member.addEventListener('mouseenter', () => {
                member.style.transform = 'translateY(-10px)';
                member.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
            });

            member.addEventListener('mouseleave', () => {
                member.style.transform = 'translateY(0)';
                member.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            });
        });
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
          <a href="#">About Us</a>
          <a href="Gallery.php">Gallery</a>
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
</head>
</html>