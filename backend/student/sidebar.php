<?php include("../auth/auth.php"); ?>
<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.php" class="logo text-center logo-light">
        <span class="logo-lg">
            <h3 style="color: white; text-transform: capitalize; margin-top: 10px;">som scholorship</h3>
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="Logo" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

    <!-- Dashboard Section -->
    <li class="side-nav-item">
        <a href="index.php" class="side-nav-link">
            <i class="uil-home-alt"></i>
            <span> Dashboard </span>
        </a>
    </li>

    <!-- Apply for Scholarship Section -->
    <li class="side-nav-item">
        <a href="see_available_scholarhips.php" class="side-nav-link">
            <i class="uil-graduation-hat"></i>
            <span>Available scholorsips</span>
        </a>
    </li>

    <!-- My Applications Section -->
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarMyApplications" aria-expanded="false" class="side-nav-link">
            <i class="uil-file-check-alt"></i>
            <span> My Applications </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarMyApplications">
            <ul class="side-nav-second-level">
                <li><a href="pending-application.html">Pending</a></li>
                <li><a href="approved-application.html">Approved</a></li>
                <li><a href="rejected-application.html">Rejected</a></li>
                <li><a href="application-history.html">Application History</a></li>
            </ul>
        </div>
    </li>

    <!-- Notifications Section -->
    <li class="side-nav-item">
        <a href="notification.php" class="side-nav-link">
            <i class="uil-bell"></i>
            <span> Notifications </span>
        </a>
    </li>

    <!-- Profile Section -->
    <li class="side-nav-item">
        <a href="profile-settings.html" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Profile </span>
        </a>
    </li>

    <!-- FAQ Section -->
    <li class="side-nav-item">
        <a href="faq.html" class="side-nav-link">
            <i class="uil-question-circle"></i>
            <span> FAQs </span>
        </a>
    </li>

</ul>


        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
