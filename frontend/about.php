<?php
if (session_status() == PHP_SESSION_NONE) {
  // Put this BEFORE session_start()
// session_set_cookie_params([
//     'lifetime' => 0, // Cookie lasts only during the browser session
//     'path' => '/',
//     'secure' => false, // Set to true if using HTTPS
//     'httponly' => true,
//     'samesite' => 'Lax'
// ]);

    session_start();
    // var_dump($_SESSION);
}

$userData = null;

// Check if logged in
if (isset($_SESSION['activeUser']) && isset($_SESSION['userID'])) {
    // ✅ Correct way to create a connection
    $conn = new mysqli("localhost", "root", "", "scholarship_db");

    // ✅ Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userID = $_SESSION['userID'];


    // ✅ Use prepared statement
    $stmt = $conn->prepare("SELECT userName, userImage FROM users WHERE userID = ?");
    $stmt->bind_param("s", $userID); // ✅ 's' for string


    $stmt->execute();
    $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
          $userData = $result->fetch_assoc();
          $firstLetter = strtoupper(substr($userData['userName'], 0, 1));
          $colors = [
    'A' => '#1abc9c',
    'B' => '#3498db',
    'C' => '#9b59b6',
    'D' => '#e67e22',
    'E' => '#e74c3c',
    'F' => '#2ecc71',
    'G' => '#f39c12',
    'H' => '#8e44ad',
    'I' => '#16a085',
    'J' => '#2980b9',
    'K' => '#d35400',
    'L' => '#c0392b',
    'M' => '#7f8c8d',
    'N' => '#27ae60',
    'O' => '#f1c40f',
    'Q' => '#34495e',
    'R' => '#d35400',
    'S' => '#9b59b6',
    'T' => '#1abc9c','U' => '#2c3e50','W' => '#e67e22','X' => '#e84393','Y' => '#00cec9','SH' => '#6c5ce7', // Special case
      // Add more if you like, fallback is used for others
          ];

  $defaultColor = '#34495e'; // Fallback color
  $avatarColor = $colors[$firstLetter] ?? $defaultColor;

    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Som scholarship</title>
    <!-- fontwesome  links -->
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/fontawesome.css">
    <!-- custom css link -->
     <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  </head>
  <style>
    /* avatart */
.user-dropdown {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 8px;
    font-size: 18px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.username {
    color: #2c3e50;
    font-weight: 500;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 45px;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 6px;
    min-width: 150px;
    z-index: 999;
}

.dropdown-menu a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    transition: 0.3s;
}

.dropdown-menu a:hover {
    background-color: #f5f5f5;
}
  </style>
<body>
    <!-- here we will start header-section -->
     <header>
        <div class="logo">
            <a href="#">
                <img src="images/logo.png" alt="">
            </a>
        </div>
     <nav>
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="scholarship.php">Scholarship</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        
       <div class="btns">
    <?php if ($userData): ?>
        <?php $firstLetter = strtoupper(substr($userData['userName'], 0, 1)); ?>
        <div class="user-dropdown">
            <div class="user-avatar" style="background-color: <?php echo $avatarColor; ?>;">
              <span><?php echo $firstLetter; ?></span>
          </div>
            <span class="username" onclick="toggleDropdown()">
                <?php echo htmlspecialchars($userData['userName']); ?>
                <i class="fas fa-caret-down"></i>
            </span>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="../backend/<?php echo $_SESSION['role']; ?>/profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="../backend/<?php echo $_SESSION['role']; ?>/index.php"><i class="fas fa-home"></i> Dashboard</a>
                <a href="../backend/<?php echo $_SESSION['role']; ?>/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    <?php else: ?>
        <button onclick="document.location.href='../backend/index.php'" class="btn btn-white">
            <i class="fas fa-lock"></i>&nbsp;Login
        </button>
    <?php endif; ?>
</div>
       
     </nav>
     <button class="bars"><i class="fas fa-bars"></i></button>
     </header>
    <!-- here we will End header-section -->



    <!-- ========== About Section ========== -->
<section class="about-section">
    <div class="about-container">
      <div class="about-image">
        <img src="images/hero3.png" alt="SomScholarship Mission">
      </div>
      <div class="about-content">
        <h2>About SomScholarship</h2>
        <p>SomScholarship is a digital platform dedicated to helping Somali students find, apply for, and win scholarship opportunities locally and internationally. We believe that financial limitations should not prevent brilliant students from achieving their academic goals.</p>
  
        <p>We are committed to ensuring transparency, accessibility, and ease in the scholarship application process. Whether you're a high school graduate or a university student, SomScholarship connects you with grants that match your academic level and background.</p>
  
        <h3>Our Mission</h3>
        <p>To create equal access to quality education for Somali students through verified, updated, and user-friendly scholarship listings.</p>
  
        <h3>What We Offer</h3>
        <ul>
          <li><i class="fas fa-check-circle"></i> Verified and up-to-date scholarships</li>
          <li><i class="fas fa-check-circle"></i> Application tracking and reminders</li>
          <li><i class="fas fa-check-circle"></i> Support in preparing scholarship documents</li>
          <li><i class="fas fa-check-circle"></i> A growing community of scholarship winners</li>
        </ul>
      </div>
    </div>
  </section>
  












      <!-- here we will start footer section -->
     <!-- ========== Footer Section ========== -->
<footer class="footer">
    <div class="footer-container">
      <div class="footer-column">
        <img src="images/logo.png" alt="SomScholarship Logo" class="footer-logo">
        <p>SomScholarship helps Somali students access educational opportunities through fair, fast, and digital solutions.</p>
      </div>
  
      <div class="footer-column">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Scholarships</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
  
      <div class="footer-column">
        <h4>Contact Us</h4>
        <p><i class="fas fa-map-marker-alt"></i> Mogadishu, Somalia</p>
        <p><i class="fas fa-envelope"></i> support@somscholarship.org</p>
        <p><i class="fas fa-phone-alt"></i> +252 61 995 1562</p>
      </div>
  
      <div class="footer-column">
        <h4>Subscribe</h4>
        <p>Get the latest scholarship updates:</p>
        <form action="#">
          <input type="email" placeholder="Your Email" required>
          <button type="submit" class="btn btn-blue">Subscribe</button>
        </form>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-x-twitter"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 SomScholarship. All rights reserved.</p>
    </div>
  </footer>
  
    <!-- here we will End footer section -->

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="js/app.js"></script>
</body>
</html>