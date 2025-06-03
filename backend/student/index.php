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
    <?php  include("dashboard.php");?>
</div>
</div>
</div>
</div>

 <!-- calling the file data that have a js link -->
  <?php  include("js_links.php");?>
</body>
</html>
