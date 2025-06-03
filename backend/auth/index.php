<?php
// calling the connection file
include("../admin/config/conn.php");

session_start();

if (isset($_SESSION['activeUser'])) {
    // Check the user's role
    $role = $_SESSION['role']; // assuming 'role' is stored during login

    if ($role === 'admin') {
        header('Location: ../admin');
        exit();
    } elseif ($role === 'student') {
        header('Location: ../student');
        exit();
    } else {
        // fallback in case role is invalid
        echo "Unknown role!";
    }
}
// auto login starting here
if(isset($_COOKIE['email']) && isset($_COOKIE['password']))
{
    $email=$_COOKIE['email'];
    $password=$_COOKIE['password'];
    $read = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
    if($read && mysqli_num_rows($read) > 0)
    {
     echo "success";
     $_SESSION['userID']=$row['userID'];
     $_SESSION['activeUser']=true;
     $_SESSION['username'] = $row['userName'];    // Optionally, for easier access
     $_SESSION['role'] = $row['role'];  
     setcookie("email","$email",time()+ 60 * 60 * 24 * 7,"/");
     setcookie("password",$password($password,PASSWORD_DEFAULT),time()+ 60 * 60 * 24 * 7,"/");
    }
    else
    {
      unset($_SESSION['user_id']);
      unset($_SESSION['activeUser']);
      setcookie("email","$email",time()- 60 * 60 * 24 * 7,"/");
      setcookie("password",$old_password,time()- 60 * 60 * 24 * 7,"/");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Log In | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="../admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="../admin/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <a href="index.html" class="logo-dark">
                                <span><img src="assets/images/logo-dark.png" alt="" height="18"></span>
                            </a>
                            <a href="index.html" class="logo-light">
                                <span><img src="assets/images/logo.png" alt="" height="18"></span>
                            </a>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0">Sign In</h4>
                        <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                        <div id="alert" style="display: none;" class="alert"></div>
                        <!-- form -->
                        <form id="LoginForm">
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="email" name="email"  placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                        <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a>
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-primary" id="btn_log" type="submit"><i class="mdi mdi-login"></i> Log In Now </button>
                            </div>
                            <!-- social-->
                            <!-- <div class="text-center mt-4">
                                <p class="text-muted font-16">Sign in with</p>
                                <ul class="social-list list-inline mt-3">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                    </li>
                                </ul>
                            </div> -->
                        </form>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">Don't have an account? <a href="register.php" class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">Empowering Students!</h2>
                    <p class="lead">
                        <i class="mdi mdi-format-quote-open"></i>
                        This scholarship platform helped me apply easily and get<br> the support I needed for my education.
                        <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p>
                        - Student Applicant
                    </p>
                </div> <!-- end auth-user-testimonial-->
            </div>

            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->
        <!-- jq cdn link -->
         <script src="../admin/assets/plugin2/jq/jquery-3.7.1.min.js"></script>
         <!-- custom javascript link -->
          <script src="js/LoginR.js"></script>
         <!-- bundle -->
         <script src="../admin/assets/js/vendor.min.js"></script>
        <script src="../admin/assets/js/app.min.js"></script>

    </body>

</html>