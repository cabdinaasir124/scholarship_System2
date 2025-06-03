<?php
// caling auth file
include("../../auth/auth.php");
header('Content-Type: application/json');
// calling the connection file
include('../config/conn.php');
// action start here
if(isset($_POST['action']))
{
    $action=$_POST['action'];
    if(function_exists($action))
    {
        $action($conn);
    }
    else
    {
        echo json_encode(['status' =>'error','message' =>'Action is not valid! and action is required']);
    }
}
else
{
    echo json_encode(['status' =>'error','message' =>'action is required']); 
}
// action end here


// profile reading function
function Myprofile($conn)
{
    if(isset($_POST['Myprofile']) && $_POST['Myprofile']=="dw212u6hd")
    {
    $readUserData=mysqli_query($conn, "SELECT * FROM users WHERE userID='$_SESSION[userID]'");
    if($readUserData && mysqli_num_rows($readUserData)>0)
    {
        $readofUserData=mysqli_fetch_assoc($readUserData);
        echo json_encode(['status' => 'success',
        'userID' => $readofUserData['userID'],
        'userName' => $readofUserData['userName'],
        'email' => $readofUserData['email'],
        'password' => $readofUserData['password'],
        'userImage' => $readofUserData['userImage'],
        'role' => $readofUserData['role'],
        ]);
    }
}
else
{
 echo json_encode(['status' =>'error','message'=>'Myprofile password is invalid or required!']); 
}
}
?>