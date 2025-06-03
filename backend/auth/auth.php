<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['activeUser']) || !isset($_SESSION['userID'])) {
    header("Location: ../auth");
    exit();
}

// Get actual folder user is trying to access (after 'backend/')
$currentScriptPath = $_SERVER['PHP_SELF'];
$pathParts = explode('/', $currentScriptPath);
$roleFolder = $pathParts[array_search('backend', $pathParts) + 1] ?? '';

// If the current folder doesn't match user role, redirect
if ($_SESSION['role'] !== $roleFolder) {
    header("Location: ../" . $_SESSION['role'] . "/");
    exit();
}
?>
