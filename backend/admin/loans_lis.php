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
    <div class="card mt-5">
    <div class="card-header d-flex justify-content-between items-center">
    <h3 class="text-primary">loans list</h3>
    <button class="btn btn-primary">
      <i class="fas fa-plus"></i>&nbsp;Add new loan
    </button>
    </div>
    <div class="card-body">
    <table  id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
    
    <thead class="bg-primary text-white">
        <tr>
            <th>loan id</th>
            <th>Name</th>
            <th>phone</th>
            <th>view more</th>
            <th>update</th>
            <th>delete</th>
        </tr>
    </thead>
     <tbody id="loans_listTbody">
        <!-- the data are becoming from the app.js -->
     </tbody>

    </table>
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
