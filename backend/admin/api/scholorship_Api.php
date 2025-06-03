<?php
header('Content-Type: application/json');
// calling the connection file
include('../config/conn.php');
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (function_exists($action)) {
        $action($conn);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Action is not valid! and action is required']);
}


// Insert scholarship function
function inserScholorship($conn)
{
    extract($_POST);

    // Step 1: Validate required fields
    if (
        empty($title) ||
        empty($deadline) ||
        empty($description) ||
        empty($status) ||
        empty($category) ||
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK
    ) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required, including a valid image!']);
        exit;
    }

    // Step 2: Check for duplicates
    $checkQuery = "SELECT * FROM scholarships WHERE title = '$title'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'A scholarship with this title already exists.']);
        exit;
    }

    // Step 3: Validate image type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
        echo json_encode(['status' => 'error', 'message' => 'Only JPG and PNG images are allowed.']);
        exit;
    }

    // Step 4: Validate image size (max 2MB)
    // $maxSize = 2 * 1024 * 1024; // 2MB
    // if ($_FILES['image']['size'] > $maxSize) {
    //     echo json_encode(['status' => 'error', 'message' => 'Image must be less than 2MB.']);
    //     exit;
    // }

    // Step 5: Upload the image
    $uploadDir = '../uploads/scholarships/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['image']['name']);
    $uploadPath = $uploadDir . $filename;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        echo json_encode(['status' => 'error', 'message' => 'Image upload failed.']);
        exit;
    }

    // Step 6: Insert into database
    $created_at = date('Y-m-d H:i:s');
    $query = "INSERT INTO scholarships (title, deadline, description, image, status, category, created_at)
              VALUES ('$title', '$deadline', '$description', '$filename', '$status', '$category', '$created_at')";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Scholarship added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database insert failed: ' . mysqli_error($conn)]);
    }
}


// here i will fetch data
function fetchscholarship($conn)
{
    $read_all = mysqli_query($conn,"SELECT * FROM scholarships");
    if($read_all && mysqli_num_rows($read_all)>0)
    {
        foreach ($read_all as $row)
        {
        ?>
        <?php

        $description = $row['description'];
        $shortDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;

        $deadline = $row['deadline'];
        $today = date('Y-m-d');

        // Check if deadline is expired
        $isExpired = strtotime($deadline) < strtotime($today);

        // Set badge class and text
        $badgeClass = $isExpired ? 'bg-warning' : 'bg-success';
        $badgeText = $isExpired ? 'Expired: ' . $deadline : 'Deadline: ' . $deadline;
        ?>
      <style>
    .card {
        overflow: hidden;
        /* height: 50%; optional: make cards equal height */
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .card-img-top:hover {
        transform: scale(1.1);
        cursor: pointer;
    }
</style>

        <div  class="col-md-8 col-lg-4">
        <!-- Simple card -->
        <div class="card d-block">
            <img class="card-img-top" src="http://localhost/scholarship_system/backend/admin/uploads/scholarships/<?php echo $row['image'];?>" alt="Scholarship Image">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['title'];?></h5>
                <p class="card-text"><?php echo $shortDescription; ?></p>
                <div class="div-space d-flex justify-content-between">
                <span class="badge <?php echo $badgeClass; ?> mb-2 d-inline-block px-2 py-1"><?php echo $badgeText; ?></span>
                <p class="card-text"><?php echo $row['category']; ?></p>
                </div>
                <div class="btns mt-3">
                    <button id="updateBtn" class="btn btn-dark" 
                            data-bs-toggle="modal" 
                            data-bs-target="#scholorship" 
                            btn-id="<?php echo $row['id']; ?>">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </button>
                    <button id="deleteBtn" class="btn btn-danger pl-2" btn-id=<?php echo $row['id'];?>><i class="fas fa-trash"></i>&nbsp;delete</button>
                </div>
            </div> <!-- end card-body-->
        </div>
        </div>
        <?php
        }
    }
    else{
       ?>
       <div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="text-center" role="alert" style="font-size: 16px;">
            <i class="mdi mdi-alert-circle-outline me-2 font-20"></i>
            No scholarships are currently available. Please check back later.
        </div>
    </div>
</div>
        <?php
    }
}


// here i will start deleting scholorship
function deleteF($conn)
{
   $id = $_POST['id'];
   if (empty($id)) {
        echo json_encode(['status' => 'error', 'message' => 'Scholarship ID is required.']);
        return;
   }
   // Optional: Fetch image file and delete it
    $getImage = mysqli_query($conn, "SELECT image FROM scholarships WHERE id = $id");
    if ($getImage && mysqli_num_rows($getImage) > 0) {
        $row = mysqli_fetch_assoc($getImage);
        $imagePath = '../uploads/scholarships/' . $row['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the record
    $deleteQuery = mysqli_query($conn, "DELETE FROM scholarships WHERE id = $id");

    if ($deleteQuery) {
        echo json_encode(['status' => 'success', 'message' => 'Scholarship deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete scholarship.']);
    }
}


function updatereadF($conn)
{
    $id = $_POST['id'];
    $query = "SELECT * FROM scholarships WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Return filled HTML form
        echo '
        <form id="updateF" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="scholar_id" value="' . $row['id'] . '">

            <div class="form-group">
                <label for="title" class="form-label">Scholarship Title</label>
                <input type="text" class="form-control" id="title" name="title" value="' . htmlspecialchars($row['title']) . '">
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select name="category" class="form-control" id="category">
                    <option value="">-- Select Category --</option>
                    <option value="Undergraduate" '.($row['category']=="Undergraduate"?"selected":"").'>Undergraduate</option>
                    <option value="Masters" '.($row['category']=="Masters"?"selected":"").'>Masters</option>
                    <option value="PhD" '.($row['category']=="PhD"?"selected":"").'>PhD</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="' . $row['deadline'] . '">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">' . htmlspecialchars($row['description']) . '</textarea>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">-- Select Status --</option>
                    <option value="Active" '.($row['status']=="Active"?"selected":"").'>Active</option>
                    <option value="Closed" '.($row['status']=="Closed"?"selected":"").'>Closed</option>
                </select>
            </div>

         <div class="form-group">
    <label for="image" class="form-label">Scholarship Image</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
    
    <div class="mt-2">
        <!-- Updated to properly bind the preview image ID -->
        <img id="imagePreview" 
     src="http://localhost/scholarship_system/backend/admin/uploads/scholarships/' . $row['image'] . '" 
     alt="Scholarship Image" width="200">
    </div>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update scholarship</button>
      </div>
        </form>
        <script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById("imagePreview");

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result; // Update the image preview source
            };

            reader.readAsDataURL(input.files[0]); // Read the file
        }
    }
</script>
';
    } else {
        echo '<p>No data found for the selected scholarship.</p>';
    }
}

function updateF($conn) {
    // Check if the form is submitted
    if (isset($_POST['title'], $_POST['category'], $_POST['deadline'], $_POST['description'], $_POST['status'], $_FILES['image'], $_POST['scholar_id'])) {
        
        // Retrieve the form values
        $scholar_id = $_POST['scholar_id'];
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $deadline = $_POST['deadline'];
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $status = $_POST['status'];
        
        // Initialize image-related variables
        $image = null;
        $image_path = null;
        
        // Check if an image file is uploaded
        if (!empty($_FILES['image']['name'])) {
            // Get the old image name from the database (You should retrieve it based on the scholarship ID)
            $sql = "SELECT image FROM scholarships WHERE id = '$scholar_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            
            // Delete the old image from the server
            if ($row['image']) {
                $old_image_path = "uploads/scholarships/" . $row['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the old image
                }
            }
            
            // Upload the new image
            $target_dir = "../uploads/scholarships/";
            $image_name = basename($_FILES['image']['name']);
            $image_path = $target_dir . $image_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image = $image_name; // Set the image variable to the uploaded image name
            } else {
                // Handle the image upload error
                echo "Error uploading the image.";
                return;
            }
        } else {
            // If no image is uploaded, retain the existing image
            $sql = "SELECT image FROM scholarships WHERE id = '$scholar_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $image = $row['image']; // Keep the current image
        }
        
        // Prepare the update query
        $update_query = "UPDATE scholarships 
                         SET title = '$title', category = '$category', deadline = '$deadline', description = '$description', status = '$status', image = '$image' 
                         WHERE id = '$scholar_id'";

        // Execute the update query
        if (mysqli_query($conn, $update_query)) {
            // Success message
            echo json_encode(['status' => 'success', 'message' => 'Scholarship updated successfully.']);
        } else {
            // Error handling
            echo json_encode(['status' => 'error', 'message' => 'Error updating scholarship.']);
        }
    } else {
        // Missing form data
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    }
}

?>
