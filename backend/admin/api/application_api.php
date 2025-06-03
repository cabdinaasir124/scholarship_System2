<?php
header('Content-Type: application/json');
include("../config/conn.php");
// Fetch all applications from the database
if(isset($_POST['action']))
{
    $action = $_POST['action'];
    if(function_exists($action)) {
        $action($conn);
    } else {
        echo json_encode(["status","error" => "message","Invalid action"]);
    }
}
function fetchApplications($conn) {
    $query = "SELECT 
                a.id, 
                a.full_name, 
                a.status, 
                a.submitted_at AS date_submitted, 
                s.title AS scholarship_name
              FROM applications a
              LEFT JOIN scholarships s ON a.scholarship_id = s.id";

    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $applications = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $applications[] = [
                "id" => $row['id'],
                "student_name" => $row['full_name'],
                "scholarship_name" => isset($row['scholarship_name']) ? substr($row['scholarship_name'], 0, 30) . '...' : 'N/A',
                "status" => $row['status'],
                "date_submitted" => $row['date_submitted']
            ];
        }
        echo json_encode(["status" => "success", "data" => $applications]);
    } else {
        echo json_encode(["status" => "error", "message" => "No applications found"]);
    }
}


function approveApplication($conn) {
    $id = $_POST['id'];

    // Step 1: Update status
    $updateQuery = "UPDATE applications SET status = 'approved' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        
        // Step 2: Get user ID and name
        $selectApp = "SELECT user_id, full_name FROM applications WHERE id = $id";
        $resApp = mysqli_query($conn, $selectApp);
        if ($resApp && mysqli_num_rows($resApp) > 0) {
            $appData = mysqli_fetch_assoc($resApp);
            $user_id = $appData['user_id'];
            $student_name = $appData['full_name'];

            // Step 3: Create notification
            $message = "Congratulations $student_name, your scholarship application has been approved!";
            $notifQuery = "INSERT INTO notifications (user_id, icon, message) VALUES ('$user_id', 'mdi mdi-check-circle-outline', '$message')";
            mysqli_query($conn, $notifQuery);
        }

        echo json_encode(["status" => "success", "message" => "Application approved and student notified"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to approve"]);
    }
}


function rejectApplication($conn) {
    $id = $_POST['id'];

    // Step 1: Update status
    $updateQuery = "UPDATE applications SET status = 'rejected' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        
        // Step 2: Get user ID and name
        $selectApp = "SELECT user_id, full_name FROM applications WHERE id = $id";
        $resApp = mysqli_query($conn, $selectApp);
        if ($resApp && mysqli_num_rows($resApp) > 0) {
            $appData = mysqli_fetch_assoc($resApp);
            $user_id = $appData['user_id'];
            $student_name = $appData['full_name'];

            // Step 3: Create notification
            $message = "Dear $student_name, unfortunately your scholarship application was rejected.";
            $notifQuery = "INSERT INTO notifications (user_id, icon, message) VALUES ('$user_id','mdi mdi-close-circle-outline', '$message')";
            mysqli_query($conn, $notifQuery);
        }

        echo json_encode(["status" => "success", "message" => "Application rejected and student notified"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to reject"]);
    }
}
// function sendEmail($email, $name) {
//     $subject = "Scholarship Application Status";
//     $message = "Dear $name,\n\nThank you for your scholarship application. We will review it and get back to you soon.\n\nBest regards,\nLMS Team";
//     $headers = "From:

?>