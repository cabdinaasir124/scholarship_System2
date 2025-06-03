<?php
session_start();
if(isset($_SESSION['activeUser']))
{
    header('Location:../admin');
}
else
{
     
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Register | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
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
                        <h4 class="mt-0">Free Sign Up</h4>
                        <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute</p>
                         <div id="alert" style="display: none;" class="alert"></div>
                        <!-- form -->
                        <form id="regform" method="post">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">username</label>
                                <input class="form-control" name="username" type="text" id="username" placeholder="Enter your name" >
                            </div>
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="email" name="email"  placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                            <div class="mb-3">
                                        <label for="password" class="form-label">confirm password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="c_password" name="c_password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="Accept" id="Accept" name="Accept">
                                    <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-muted">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="mb-0 d-grid text-center">
                                <button class="btn btn-primary" id="btn_save" type="submit"><i class="mdi mdi-account-circle"></i> Sign Up </button>
                            </div>
                            <!-- social-->
                            <!-- <div class="text-center mt-4">
                                <p class="text-muted font-16">Sign up using</p>
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
                            <p class="text-muted">Already have account? <a href="./" class="text-muted ms-1"><b>Log In</b></a></p>
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">I love the color!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very much! . <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p>
                        - Hyper Admin User
                    </p>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->
        <!-- jquery cdn link -->
         <script src="../admin/assets/plugin2/jq/jquery-3.7.1.min.js"></script>
         <script src="js/app.js"></script>
        <!-- bundle -->
        <script src="../admin/assets/js/vendor.min.js"></script>
        <script src="../admin/assets/js/app.min.js"></script>
        
    </body>

</html>