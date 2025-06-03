<?php
// session_start();

// if (isset($_SESSION['activeUser'])) {
//     // Check the user's role
//     $role = $_SESSION['role']; // assuming 'role' is stored during login

//     if ($role === 'admin') {
//         header('Location: ../admin');
//         exit();
//     } elseif ($role === 'student') {
//         header('Location: ../student');
//         exit();
//     } else {
//         // fallback in case role is invalid
//         echo "Unknown role!";
//     }
// }

header("location:  http://localhost/scholarship_system/backend/auth");

?>