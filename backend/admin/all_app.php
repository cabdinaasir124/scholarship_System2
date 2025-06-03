<?php
// calling auth file from
// include("../auth/auth.php");

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
    
      <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Applications</li>
                    </ol>
                </div>
                <h4 class="page-title">Som Scholarship</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="card">
        <div class="card-body">
            <h4 class="header-title">All Applications</h4>
            <p class="text-muted font-14">
                Below is the list of all applications submitted by students.
            </p>
            <div class="table-responsive">
           <table id="applicationTable" class="display table dt-responsive nowrap w-100">
            <thead class="bg-primary text-white">
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Scholarship Name</th>
                    <th>Status</th>
                    <th>Date Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="applicationData">
                <!-- Data will be injected here -->
            </tbody>
        </table>


            </div>
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
