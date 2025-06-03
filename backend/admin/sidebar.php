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

            <li class="side-nav-title side-nav-item">Navigation</li>

            <!-- Direct Link -->
            <li class="side-nav-item">
                <a href="dashboard.php" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <!-- Dropdown 1: Scholarships -->
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarScholarships" aria-expanded="false" class="side-nav-link">
                    <i class="uil-graduation-hat"></i>
                    <span> Scholarships </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarScholarships">
                    <ul class="side-nav-second-level">
                        <li><a href="add_new_scholar.php">Add Scholarship</a></li>
                        <li><a href="manage-scholarships.php">Manage Scholarships</a></li>
                    </ul>
                </div>
            </li>

            <!-- Dropdown 2: Applications -->
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarApplications" aria-expanded="false" class="side-nav-link">
                    <i class="uil-file-check-alt"></i>
                    <span> Applications </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarApplications">
                    <ul class="side-nav-second-level">
                        <li><a href="all_app.php">See all applications</a></li>
                    </ul>
                </div>
            </li>

            <!-- Dropdown 3: Students -->
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarStudents" aria-expanded="false" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Students </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarStudents">
                    <ul class="side-nav-second-level">
                        <li><a href="all-students.php">All Students</a></li>
                        <li><a href="student-status.php">Status</a></li>
                    </ul>
                </div>
            </li>

            <!-- Direct Link -->
            <li class="side-nav-item">
                <a href="notifications.php" class="side-nav-link">
                    <i class="uil-bell"></i>
                    <span> Notifications </span>
                </a>
            </li>

            

            <!-- Direct Link -->
            <li class="side-nav-item">
                <a href="reports.php" class="side-nav-link">
                    <i class="uil-chart-line"></i>
                    <span> Reports </span>
                </a>
            </li>

            <!-- Direct Link -->
            <li class="side-nav-item">
                <a href="file-manager.php" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span> File Manager </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">system setting</li>

            <!-- Dropdown 4: Settings -->
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false" class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="side-nav-second-level">
                        <li><a href="profile-settings.php">Profile</a></li>
                        <li><a href="system-settings.php">System</a></li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarSiteSettings" aria-expanded="false" class="side-nav-link">
        <i class="uil-wrench"></i>
        <span> Site Settings </span>
        <span class="menu-arrow"></span>
    </a>
        <div class="collapse" id="sidebarSiteSettings">
            <ul class="side-nav-second-level">
                <li><a href="general-settings.php">General Settings</a></li>
                <li><a href="logo-settings.php">Logo & Favicon</a></li>
                <li><a href="seo-settings.php">SEO Settings</a></li>
            </ul>
        </div>
    </li>

        </ul>

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
