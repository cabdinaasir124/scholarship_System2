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
<style>
    /* Ensure the button is always visible even on small screens */
#addScholarshipBtn {
    visibility: visible;
    display: inline-block;
    margin-top: 0;
}

/* Ensure proper button size and padding on smaller screens */
@media (max-width: 576px) {
    #addScholarshipBtn {
        font-size: 14px;
        padding: 8px 12px;
    }
}

/* Make sure the container is not overflowing and keeps the layout neat */
.page-title-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding: 10px 50px;
}

</style>
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
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
            <h4 class="page-title m-0">Som Scholarship</h4>
            <button class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i>&nbsp;Add scholarship
            </button>
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

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">update scholarship</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form id="insertS" method="POST" enctype="multipart/form-data">
        <div class="form-group">
         <label for="title" class="form-label">Scholarship Title</label>
         <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
        <label for="category" class="form-label">Category</label>
        <select name="category" class="form-control" id="category">
            <option value="">-- Select Category --</option>
            <option value="Undergraduate">Undergraduate</option>
            <option value="Masters">Masters</option>
            <option value="PhD">PhD</option>
        </select>
        </div>
        <div class="form-group">
          <label for="deadline" class="form-label">Deadline</label>
          <input type="date" class="form-control" id="deadline" name="deadline">
        </div>
        <div class="form-group">
         <label for="description" class="form-label">Description</label>
         <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>
        
        <div class="form-group">
          <label for="status" class="form-label">Status</label>
           <select name="status" class="form-control" id="">
            <option value="">-- Select Status --</option>
            <option value="Active">Active</option>
            <option value="Closed">Closed</option>
           </select>
        </div>

        <div class="form-group">
          <div class="mb-3">
            <label for="image" class="form-label">Scholarship Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
          </div>
        </div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save scholar</button>
      </div>
      </form>
    </div>
  </div>
</div>
    

<div class="modal fade" id="scholorship" tabindex="-1" aria-labelledby="scholorshipLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="scholorshipLabel">Insert scholarship</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="ScholorB" class="modal-body">
       <!--here i will fetch data  -->
      </div>
      
      </form>
    </div>
  </div>
</div>
    <!-- Right Sidebar -->
    <div class="end-bar">

        <div class="rightbar-title">
            <a href="javascript:void(0);" class="end-bar-toggle float-end">
                <i class="dripicons-cross noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <div class="rightbar-content h-100" data-simplebar="">

            <div class="p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                </div>

                <!-- Settings -->
                <h5 class="mt-3">Color Scheme</h5>
                <hr class="mt-1">

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked="">
                    <label class="form-check-label" for="light-mode-check">Light Mode</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
                    <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                </div>


                <!-- Width -->
                <h5 class="mt-4">Width</h5>
                <hr class="mt-1">
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked="">
                    <label class="form-check-label" for="fluid-check">Fluid</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                    <label class="form-check-label" for="boxed-check">Boxed</label>
                </div>
    

                <!-- Left Sidebar-->
                <h5 class="mt-4">Left Sidebar</h5>
                <hr class="mt-1">
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                    <label class="form-check-label" for="default-check">Default</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked="">
                    <label class="form-check-label" for="light-check">Light</label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                    <label class="form-check-label" for="dark-check">Dark</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked="">
                    <label class="form-check-label" for="fixed-check">Fixed</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                    <label class="form-check-label" for="condensed-check">Condensed</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                    <label class="form-check-label" for="scrollable-check">Scrollable</label>
                </div>

                <div class="d-grid mt-4">
                    <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
        
                    <a href="../../product/hyper-responsive-admin-dashboard-template/index.htm" class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                </div>
            </div> <!-- end padding-->

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
