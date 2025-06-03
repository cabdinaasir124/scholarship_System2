<?php
header("Content-Type: application/json");
session_start();
// var_dump($_SESSION);
include("../config/conn.php");
if (!isset($_SESSION['userID'])) {
    echo json_encode(["error" => "Unauthorized. Please log in first."]);
    exit;
}
$user_id = $_SESSION['userID'];


// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Email sending function
function sendEmail($recipientEmail, $recipientName)
{
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = 0; // Use SMTP::DEBUG_SERVER for full debug
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'qoryooley839@gmail.com';
        $mail->Password   = 'ezdw wuka tbtq xtag'; // Replace with your actual app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('qoryooley839@gmail.com', 'Scholarship Office');
        $mail->addAddress($recipientEmail, $recipientName);

        $htmlBody = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>Thank You</title>
            <style>
                body {
                    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                    background: #f7f9fc;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 50px auto;
                    background: #ffffff;
                    padding: 40px;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
                .header {
                    color: #2d6cdf;
                    font-size: 26px;
                    font-weight: bold;
                    margin-bottom: 20px;
                }
                .message {
                    font-size: 16px;
                    color: #333333;
                    line-height: 1.6;
                }
                .highlight {
                    color: #2d6cdf;
                    font-weight: 600;
                }
                .footer {
                    margin-top: 30px;
                    font-size: 14px;
                    color: #777777;
                }
                .button {
                    display: inline-block;
                    margin-top: 25px;
                    padding: 12px 24px;
                    background-color: #2d6cdf;
                    color: white;
                    text-decoration: none;
                    border-radius: 6px;
                }
                .button:hover {
                    background-color: #1a4fb3;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">🎓 Thank You for Applying!</div>
                <div class="message">
                    <p>Dear <span class="highlight">' . htmlspecialchars($recipientName) . '</span>,</p>
                    <p>We have successfully received your scholarship application.</p>
                    <p>Our review committee will assess all applications carefully. You will be contacted soon regarding the next steps.</p>
                    <p>We appreciate your interest and effort in applying.</p>
                </div>
                <a href="#" class="button">Back to Home</a>
                <div class="footer">— Scholarship Committee</div>
            </div>
        </body>
        </html>';

        $mail->isHTML(true);
        $mail->Subject = 'New Scholarship Application Received';
        $mail->Body    = $htmlBody;
        $mail->AltBody = 'Thank you ' . $recipientName . ', we have received your application.';

        $mail->send();
         // Debug: show email address that was used
        error_log("Email sent to: $recipientEmail");
        return true;
    } catch (Exception $e) {
        return "Mailer Error: {$mail->ErrorInfo}";
    }
}

// Validate input
$requiredFields = ['scholarship_id', 'full_name', 'dob', 'phone', 'email', 'gender', 'nationality', 'last_school', 'qualification', 'gpa', 'graduation_year', 'reason'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(["error" => "$field is required."]);
        exit;
    }
}

// File upload
$upload_dir = "../uploads";
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

function uploadFile($input_name, $upload_dir) {
    if (!isset($_FILES[$input_name])) return null;
    $file = $_FILES[$input_name];
    $filename = time() . "_" . basename($file["name"]);
    $target_path = $upload_dir . $filename;

    return move_uploaded_file($file["tmp_name"], $target_path) ? $filename : null;
}

$id_document = uploadFile("id_document", $upload_dir);
$certificate = uploadFile("certificate", $upload_dir);
$other_docs = [];

if (!empty($_FILES["other_docs"]["name"][0])) {
    foreach ($_FILES["other_docs"]["tmp_name"] as $key => $tmp_name) {
        $filename = time() . "_" . basename($_FILES["other_docs"]["name"][$key]);
        $path = $upload_dir . $filename;
        if (move_uploaded_file($tmp_name, $path)) {
            $other_docs[] = $filename;
        }
    }
}

$other_docs_json = json_encode($other_docs);

// Insert into DB
$query = "INSERT INTO applications (
    user_id, scholarship_id, full_name, dob, phone, email, gender, nationality,
    last_school, qualification, gpa, graduation_year,
    id_document, certificate, other_docs, reason
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$user_id = $_SESSION['userID'];
// var_dump($user_id);
$msg = "You submitted a new scholarship application.";

$stmt = $conn->prepare("INSERT INTO notifications (user_id, message, icon, type) VALUES (?, ?, 'mdi mdi-comment-account-outline', 'primary')");
$stmt->bind_param("ss", $user_id, $msg);
$stmt->execute();


$stmt = $conn->prepare($query);
$stmt->bind_param(
    "sissssssssssssss",
    $user_id, $_POST['scholarship_id'], $_POST['full_name'], $_POST['dob'], $_POST['phone'],
    $_POST['email'], $_POST['gender'], $_POST['nationality'], $_POST['last_school'],
    $_POST['qualification'], $_POST['gpa'], $_POST['graduation_year'],
    $id_document, $certificate, $other_docs_json, $_POST['reason']
);


if ($stmt->execute()) {
    $emailStatus = sendEmail($_POST['email'], $_POST['full_name']);
    if ($emailStatus === true) {
        echo json_encode(["status","success" => "message","Application submitted and email sent."]);
    } else {
        echo json_encode(["status","warning" => "message","Application submitted but email failed: " . $emailStatus]);
    }
} else {
    echo json_encode(["error" => "Database error: " . $stmt->error]);
}

?>
