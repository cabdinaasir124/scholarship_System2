<?php
// echo $_GET['token'];
include("../admin/config/conn.php");
if(isset($_GET['token']))
{
   $token=$_GET['token'];
   $readData=mysqli_query($conn, "SELECT * FROM users WHERE token = '$token'");
   if($readData && mysqli_num_rows($readData)>0)
   {
     $row=mysqli_fetch_assoc($readData);
     $update=mysqli_query($conn, "UPDATE users SET token = 'verified' WHERE token = '$token'");
     if($update)
     {
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #011a3b;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 400px;
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
        <div style="font-size: 50px;" class="icon">&#128525;</div>
        <h1>Hey<?php echo $row['userName'];?> welcome to L-M-S</h1>
        <p>Thanks for your verifying your email please wait A few hours to accept your registration request</p>
        <a href="https://wa.link/8ellp1" target="_blank" class="btn">&#128222; &nbsp;contact us</a>
    </div>

</body>
</html>




     <?php
     }
   }
   else
   {
   ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #011a3b;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 350px;
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
            background-color: darkred;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: darkred;
        }
    </style>
    <title>Verify Your Email</title>
</head>
<body>

    <div class="container">
        <div style="font-size: 50px;" class="icon">&#128546;</div>
        <h1>I Am sorry!</h1>
        <p>Token is expired or And new Token is required</p>
        <a href="https://wa.link/8ellp1" target="_blank" class="btn">&#128222; &nbsp;contact us</a>
    </div>

</body>
</html>


   <?php
   }
}
else
{
    header("location:./");
}
?>