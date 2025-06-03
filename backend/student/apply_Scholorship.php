<?php
include("config/conn.php");
if (isset($_GET['id'])) {
    $scholarshipId = intval($_GET['id']);
    // Assuming you have a DB connection $conn
    $query = "SELECT * FROM scholarships WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $scholarshipId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Scholarship not found, handle error or redirect
        echo "Scholarship not found.";
        exit;
    }

    $scholarship = $result->fetch_assoc();
} else {
    // Redirect or show error — no scholarship ID provided
    header("Location: scholarships_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- calling the file data that have a css link -->
    <?php  include("css_links.php");?>
    <title>scholorship available</title>
</head>
<style>
.is-invalid {
    border-color: #dc3545 !important;
}
.disabled-tab {
    pointer-events: none;
    opacity: 0.6;
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
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Som Scholarship</li>
                </ol>
            </div>
            <h4 class="page-title">Apply for: <?php echo htmlspecialchars($scholarship['title']); ?></h4>
        </div>
    </div>
</div>     
<!-- end page title -->

     <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3">Scholarship Application Form</h4>

                                            <form id="applicationForm" method="POST" enctype="multipart/form-data">
                                                <div id="basicwizard">
                                                    <!-- Wizard Tabs -->
                                                    <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                                <li class="nav-item">
                                                    <a href="#tab1" data-bs-toggle="tab" class="nav-link active">Personal Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#tab2" data-bs-toggle="tab" class="nav-link disabled-tab">Academic Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#tab3" data-bs-toggle="tab" class="nav-link disabled-tab">Documents</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#tab4" data-bs-toggle="tab" class="nav-link disabled-tab">Finish</a>
                                                </li>
                                            </ul>


                                                    <!-- Wizard Content -->
                                                    <div class="tab-content">
                                                        <!-- Personal Info -->
                                                        <div class="tab-pane show active" id="tab1">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <input type="hidden" name="scholarship_id" value="<?php echo $scholarshipId; ?>">
                                                                    <label>Full Name</label>
                                                                    <input type="text" name="full_name" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Date of Birth</label>
                                                                    <input type="date" name="dob" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label>Phone</label>
                                                                    <input type="text" name="phone" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Email</label>
                                                                    <input type="email" name="email" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label>Gender</label>
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="">-- Select Gender --</option>
                                                                        <option value="male">Male</option>
                                                                        <option value="female">Female</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Nationality</label>
                                                                    <input type="text" name="nationality" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Academic Info -->
                                                        <div class="tab-pane" id="tab2">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label>Last School Attended</label>
                                                                    <input type="text" name="last_school" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Highest Qualification</label>
                                                                        <select name="qualification" class="form-control" required>
                                                                            <option value="">-- Select Qualification --</option>
                                                                            <option value="High School Certificate">High School Certificate</option>
                                                                            <option value="Diploma">Diploma</option>
                                                                            <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                                                                            <option value="Master’s Degree">Master’s Degree</option>
                                                                            <option value="Vocational Training Certificate">Vocational Training Certificate</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label>GPA</label>
                                                                    <input type="text" name="gpa" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Year Graduated</label>
                                                                    <input type="text" name="graduation_year" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Document Upload -->
                                                        <div class="tab-pane" id="tab3">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label>NIRA ID / Passport</label>
                                                                    <input type="file" name="id_document" class="form-control" accept=".pdf,.jpg,.png" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Certificate / Transcript</label>
                                                                    <input type="file" name="certificate" class="form-control" accept=".pdf,.jpg,.png" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label>Any Other Supporting Documents (Optional)</label>
                                                                <input type="file" name="other_docs[]" class="form-control" multiple>
                                                            </div>
                                                        </div>

                                                        <!-- Finish -->
                                                        <div class="tab-pane" id="tab4">
                                                            <div class="text-center">
                                                                <h4>Why do you deserve this scholarship?</h4>
                                                                <textarea name="reason" class="form-control mb-3" rows="4" required></textarea>

                                                                <div class="form-check mb-3">
                                                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                                                    <label class="form-check-label" for="terms">I agree to the Terms and Conditions</label>
                                                                </div>

                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fas fa-paper-plane"></i> Submit Application
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Wizard Navigation -->
                                                    <ul class="list-inline wizard mt-3">
                                                        <li class="previous list-inline-item">
                                                            <a href="#" class="btn btn-secondary">Previous</a>
                                                        </li>
                                                        <li class="next list-inline-item float-end">
                                                            <a href="#" class="btn btn-primary">Next</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>


                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                           <!-- end col -->
    </div> 
                        <!-- end row -->



</div>
</div>
</div>
</div>






 <!-- calling the file data that have a js link -->
  <?php  include("js_links.php");?>
  
</body>
</html>
