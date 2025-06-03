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



    <!-- here i will start hero-section -->
     <section class="hero-section">
                <!-- Video Popup Modal -->
        <div id="videoModal" class="video-modal">
            <div class="video-content">
            <span class="close">&times;</span>
            <video id="youtubeVideo" controls width="100%" height="315" src="videos/lesson 3 basic php.mp4"></video>
            </div>
        </div>
  
        <div class="hero-left">
            <h1>Funding <span>Dreams, Empowering</span> Tomorrow</h1>
            <p>Empowering students across Somalia by simplifying scholarship access and application — fair, fast, and fully digital.</p>
            <button class="btn-2 btn btn-white">Browse Scholarships</button>
            <button id="PlayVideo" class="btn-2 btn btn-blue"><i class="fas fa-play"></i></button>
        </div>
        
        <div class="hero-right">
            <div class="circle">
                <img src="images/Group 1.png" alt="">
            </div>
        </div>
     </section>
    <!-- here i will End hero-section -->



    <!-- here we will start building about us section -->
    <div class="about-header">
        <h1>About us</h1>
        <div class="rectangle">
            
        </div>
    </div>
     <section class="about-us">
        
        <div class="about-left">
          <img width="500px" src="images/about3D.png" alt="">  
        </div>
        <div class="about-right">
            <h2>Who we are?</h2>
            <p>
              SomScholarship is a digital platform designed to make scholarship opportunities more accessible and transparent for Somali students. 
              We aim to bridge the gap between academic potential and financial support by providing a streamlined application process.
            </p>
            <button onclick="document.location.href='about.php'" class="btn-about btn btn-white"><i class="fas fa-book-reader"></i>&nbsp;Read More</button>
          </div>
          
     </section>
    <!-- here we will End building about us section -->

    <!-- here we wil start building how it work -->
    <section class="featured-scholarships">
        <div class="section-header">
          <h2>Open Scholarships</h2>
          <div class="rectangle"></div>
        </div>
      
        <div class="cards">
          <div class="card">
            <div class="images">
                <img src="images/about.png" alt="">
            </div>
            <h3>Somaville Need-Based Grant</h3>
            <p><strong>Deadline:</strong> July 1, 2025</p>
            <p>Supports low-income students pursuing undergraduate studies in Somalia.</p>
            <button onclick="document.location.href='../backend/index.php'" class="btn btn-white">Apply Now</button>
            <a class="a" href="read_moreInfo.php">Read more info</a>
          </div>
      
          <div class="card">
            <div class="images">
                <img src="images/about.png" alt="">
            </div>
            <h3>Academic Excellence Award</h3>
            <p><strong>Deadline:</strong> August 15, 2025</p>
            <p>For top-performing students with GPA above 3.5 in STEM fields.</p>
            <button onclick="document.location.href='../backend/index.php'" class="btn btn-white">Apply Now</button>
            <a class="a" href="read_moreInfo.php">Read more info</a>
          </div>
      
          <div class="card">
            <div class="images">
                <img src="images/about.png" alt="">
            </div>
            <h3>Women in Tech Scholarship</h3>
            <p><strong>Deadline:</strong> June 20, 2025</p>
            <p>Encouraging Somali women to join and excel in technology and innovation.</p>
            <button onclick="document.location.href='../backend/index.php'" class="btn btn-white">Apply Now</button>
            <a class="a" href="read_moreInfo.php">Read more info</a>
          </div>
        </div>

        <button onclick="document.location.href='scholarship.php'" class="btn-FS btn btn-white">load more</button>
    </section>
    <!-- here we wil End building how it work -->

    <!-- here we will start FAQ  -->
    <section class="faq-section">
        <div class="section-header">
          <h2>Frequently Asked Questions</h2>
          <div class="rectangle"></div>
        </div>
      
        <div class="faq-container">
          <div class="faq-item">
            <button class="faq-question">How can I apply for scholarships?</button>
            <div class="faq-answer">
              <p>To apply, browse available scholarships and click "Apply Now" to complete the form. Make sure to meet all eligibility criteria.</p>
            </div>
          </div>
      
          <div class="faq-item">
            <button class="faq-question">Can I apply for more than one scholarship?</button>
            <div class="faq-answer">
              <p>Yes, you can apply to multiple scholarships as long as you meet the eligibility requirements for each.</p>
            </div>
          </div>
      
          <div class="faq-item">
            <button class="faq-question">Are these scholarships only for Somali students?</button>
            <div class="faq-answer">
              <p>Most scholarships target Somali students, but some may accept international applicants. Always read the scholarship description carefully.</p>
            </div>
          </div>
        </div>
      </section>
      
    <!-- here we will End FAQ  -->

    <!-- here we will start testnomial section -->
     <div class="testnomial-header">
        <div class="test-right">
          <h1>What Our Applicants Say</h1>
          <p>Lorem ipsum dolor sit.</p>
        </div>
        <div class="test-left">
          <button class="btn btn-white"><i class="fas fa-plus"></i>&nbsp;Add feedback</button>
        </div>
     </div>
    <section class="testnomial">
<!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="swiper-right">
                <div class="images">
                    <img src="images/Group 1.png" alt="">
                </div>
            </div>
            <div class="swiper-left">
              <p class="thank-test">"Thanks to SomScholarship, I found a perfect grant that matched my financial situation. The process was easy and transparent!"</p>
              <h2>Ahmed nuur</h2>
              <h3>student</h3>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="swiper-right">
                <div class="images">
                    <img src="images/Group 1.png" alt="">
                </div>
            </div>
            <div class="swiper-left">
              <p class="thank-test">"Thanks to SomScholarship, I found a perfect grant that matched my financial situation. The process was easy and transparent!"</p>
              <h2>Ahmed nuur</h2>
              <h3>student</h3>
            </div>
          </div>
          <!-- <div class="swiper-slide">
            <div class="swiper-right">
                <div class="images">
                    <img src="images/Group 1.png" alt="">
                </div>
            </div>
            <div class="swiper-left">
              <p class="thank-test">"Thanks to SomScholarship, I found a perfect grant that matched my financial situation. The process was easy and transparent!"</p>
              <h2>Ahmed nuur</h2>
              <h3>student</h3>
            </div>
          </div> -->
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
      
        <!-- If we need navigation buttons -->
        <!-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->
      
        <!-- If we need scrollbar -->
        <!-- <div class="swiper-scrollbar"></div> -->
      </div>
    </section>
      
    <!-- here we will End testnomial section -->


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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
    function toggleDropdown() {
        const menu = document.getElementById("dropdownMenu");
        menu.style.display = menu.style.display === "block" ? "none" : "block";
    }

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
        const menu = document.getElementById("dropdownMenu");
        if (!e.target.closest('.user-dropdown')) {
            menu.style.display = "none";
        }
    });
</script>

<script src="https://unpkg.com/scrollreveal"></script>
<script src="js/app.js"></script>
</body>
</html>