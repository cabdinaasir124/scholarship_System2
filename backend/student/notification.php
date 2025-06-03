<?php
//calling auth file from
//include("../auth/auth.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- calling the file data that have a css link -->
    <?php  include("css_links.php");?>
    <title>LMS</title>
</head>
<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<div class="wrapper">
    <!-- calling the sidebar of admin -->
    <?php  include('sidebar.php');?>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
    <div class="content">
    <!-- calling the header of admin panel -->
     <?php include('header.php');?>
     <!-- Start Content-->
     <div class="container-fluid">
    
     <!-- notification -->
      <div class="card shadow-sm rounded border-0 mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Notifications</h5>
        <button id="clearNotifications" class="btn btn-sm btn-light text-danger">Clear All</button>
    </div>
    <div class="card-body p-2" style="max-height: 300px; overflow-y: auto;" id="notification-container">
        <!-- Notifications will be loaded here -->
    </div>
</div>


</div>
</div>
</div>
</div>

 <!-- calling the file data that have a js link -->
  <?php  include("js_links.php");?>
</body>
</html>
