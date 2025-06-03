<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- calling the file data that have a css link -->
    <?php  include("css_links.php");?>
    <title>scholorship available</title>
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
                    <li class="breadcrumb-item active">Som Scholarship</li>
                </ol>
            </div>
            <h4 class="page-title">Available scholorships</h4>
        </div>
    </div>
</div>     
<!-- end page title -->

    <div class="scholorship-grid mt-5">
      <!-- here i will fetch data from database -->
      <div id="dataSholorship" class="row">
        
        <!-- end card-->
      </div>
        
        <!-- end col -->            
     </div>



</div>
</div>
</div>
</div>

 <!-- calling the file data that have a js link -->
  <?php  include("js_links.php");?>
  
</body>
</html>
