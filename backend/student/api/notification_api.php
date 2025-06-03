<?php
include("../config/conn.php");
session_start();

if (!isset($_SESSION['userID'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['userID']; // Example: 'USER002'

$sql = "SELECT id, user_id, message, icon, type, is_read, created_at 
        FROM notifications 
        WHERE user_id = ? 
        ORDER BY created_at DESC 
        LIMIT 10";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id); // Bind as string
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];

while ($row = $result->fetch_assoc()) {
    $time = time() - strtotime($row['created_at']);

    if ($time < 5) {
        $ago = 'just now';
    } elseif ($time < 60) {
        $ago = $time . ' sec ago';
    } elseif ($time < 3600) {
        $ago = floor($time / 60) . ' min ago';
    } elseif ($time < 86400) {
        $ago = floor($time / 3600) . ' hours ago';
    } else {
        $ago = floor($time / 86400) . ' days ago';
    }

    $notifications[] = [
        'message' => $row['message'],
        'icon' => $row['icon'],
        'type' => $row['type'],
        'timeAgo' => $ago
    ];
}

header('Content-Type: application/json');
echo json_encode($notifications);
?>
