<?php
header('Content-Type: application/json');
// calling the connection file
include('../../admin/config/conn.php');
// here we start session here
session_start();
// here we end session here
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

// sending email function start here
function SEND_EMAIL($username,$token,$email)
{
    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'qoryooley839@gmail.com';                     //SMTP username
    $mail->Password   = 'iuzm vxpe yngu brpd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('qoryooley839@gmail.com', 'Somscholarship');
    $mail->addAddress($email, $username);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email verification from som scholorship!'; //
    $mail->Body    = '
     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f4f7fb;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 60px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            text-align: center;
            color: #333;
        }
        h1 {
            color: #5a67d8;
            font-size: 24px;
        }
        p {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5a67d8;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #434db4;
        }
    </style>
    <title>Verify Your Email</title>
</head>
<body>

    <div class="container">
        <img width="100px" src="admin/assets/images/verification.png" alt="">
        <h1>Verify Your Email</h1>
        <p>Thanks for registering! Please verify your email by clicking the link below:</p>
        <a href="http://localhost/scholarship_system/backend/auth/verify.php?token='.$token.'" class="btn">Verify Now</a>
    </div>

</body>
</html>

    ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo json_encode(['status' => 'success', 'message' => 'successfully registered to complete your registration please verify your email we sent email into this ('.$email.')']);
} catch (Exception $e) {
    echo json_encode([
        'status'=>'error','message'=>'message',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ]);
}

}

// sending email function end here


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

// registeration function starts here 
function regf($conn)
{

  if(isset($_POST['regf']) && $_POST['regf'] =="123@#$")
  {
    //extract all post methods
    extract($_POST);
    //form validation
    if($username==Null || $email==Null || $password==Null || $c_password==Null)
    {
        echo json_encode(['status' =>'error','message' =>'All fields are required']);
    }
    else
    {
        $read_old=mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$email' AND user_token = 'verified'");
        if($read_old && mysqli_num_rows($read_old)>0)
        {
          echo json_encode(['status' =>'error','message' =>"$email already taken!"]);
        }
        else if(!empty($Accept))
        {
           $read_old2=mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email' AND user_token!='verified'");
           if($read_old2 && mysqli_num_rows($read_old2)>0)
           {
             $read_old2=mysqli_fetch_assoc($read_old2);
             echo json_encode(['status' =>'error','message' =>"hey, $read_old2[user_name], you are Already registered please verify your Email to complete your registration process"]);
           }
           else if($password == $c_password)
           {
               // Gen User id
               $read_user = mysqli_query($conn, "SELECT userID FROM users ORDER BY userID DESC LIMIT 1");
               if($read_user && mysqli_num_rows($read_user) > 0)
              {
                 foreach($read_user as $row_user)
                 {
             
                 }
                 $row_user['userID'];
                 $currentUserid=++$row_user['userID'];  
              } 
              else
              {
               echo json_encode(['status' =>'error','message' =>"user id is not generated'"]);  
              }
             $token=md5(rand());
             $hashpassword=password_hash($password,PASSWORD_DEFAULT);
             // insert query
             $insert=mysqli_query($conn,"INSERT INTO users (userID,userName,email,password,token,userImage) VALUES('$currentUserid','$username','$email','$hashpassword','$token','assets/images/user.png');");
             if($insert)
             {
                SEND_EMAIL($username,$token,$email);
             }
             else
             {
               echo json_encode(['status' =>'error','message' =>"something went wrong when you making insert"]);  
             }
           }
           else
           {
               echo json_encode(['status' =>'error','message' =>"password are not match"]);  
           }
        }
        else{
            echo json_encode(['status' =>'error','message' =>"please Accept our terms and conditions"]);
        }
       
    }
    
  }
  else
  {
    echo json_encode(['status' =>'error','message' =>'reg is required or Reg password']);
  }

  
}
// registeration function end here 


// Login function start here
function Loginf($conn)
{
    if (isset($_POST['Loginf']) && $_POST['Loginf'] == "12@d#$") {
        extract($_POST);

        if ($email == null || $password == null) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required!']);
            return;
        }

        $read = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if ($read && mysqli_num_rows($read) > 0) {
            $row = mysqli_fetch_assoc($read);
            $old_password = $row['password'];

            if (password_verify($password, $old_password)) {
                if ($row['token'] == "verified") {
                    // Example login logic
                    $_SESSION['activeUser'] = $row['userID'];
                    $_SESSION['role'] = $row['role']; // 'admin' or 'student'


                    // Check if remember me is set and manage cookies
                    if (isset($_POST['remember'])) {
                        setcookie("email", $email, time() + 60 * 60 * 24 * 7, "/");
                        setcookie("password", $old_password, time() + 60 * 60 * 24 * 7, "/");
                    } else {
                        setcookie("email", "", time() - 3600, "/");
                        setcookie("password", "", time() - 3600, "/");
                    }

                    // Role-based redirection
                    if ($row['role'] == 'admin') {
                        $_SESSION['userID'] = $row['userID'];
                        $_SESSION['activeUser'] = true;
                        echo json_encode(['status' => 'success', 'message' => 'Successfully logged in as admin!', 'redirect' => 'http://localhost/scholarship_system/backend/admin']);
                    } else if ($row['role'] == 'student') 
                    {
                        $_SESSION['userID'] = $row['userID'];
                        $_SESSION['activeUser'] = true;
                        echo json_encode(['status' => 'success', 'message' => 'Successfully logged in as student!', 'redirect' => 'http://localhost/scholarship_system/backend/student']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Role not recognized.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Your account is not verified. Please check your email."]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => "Invalid password. Please try again or <a href='forget.php'>reset your password</a>"]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => "Invalid email. Please try again or <a href='register.php'>sign up</a> for a new account"]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'LoginF is required or LoginF password']);
    }
}


// Login function end here
?>