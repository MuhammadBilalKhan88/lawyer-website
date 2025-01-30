<?php
$login = false;
session_start();


include('admin/Database/connection.php');
$msg = "";
if (isset($_POST['login-btn'])) {



    //$user_email =  ($_POST['user_email']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
    //$user_password = ($_POST['user_password']);

    $qurey = "SELECT * FROM `users` WHERE `user_email` = '{$user_email}' LIMIT 1";
    $res = mysqli_query($conn, $qurey);

    

    if (!$res) {
        die("Query Failed: " . mysqli_error($conn));
    }


    $user = mysqli_fetch_assoc($res);

    if ($user) {

        if (password_verify($user_password, $user['user_password'])) {
       
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_id'] = $user['id'];

            if($user['user_type'] == 'lawyer'){
                header('Location: index.php');
                exit();
            }
             // Redirect to the index page
             header('Location: index.php');
             exit();
        } else {
            $msg = "<div class='alert alert-danger'>Pasword Does Not Match</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email Does Not Exist</div>";
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Lawyer</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>


<body>


    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center justify-content-between no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="index.php">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-8">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.php">home</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <li><a href="Practice.php">Practice Area</a></li>
                                        <li><a href="our_lawyers.php">Our lawyers</a></li>
                                        <li><a href="#">blog</a>

                                            <!-- <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="elements.php">elements</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="contact.php">Contact</a></li>
                                        <!-- <a href="#" class="boxed-btn4 " style="    padding: 9px 40px;">Signup as Lawyer</a> -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-2 d-none d-lg-block">

                            <div class="d-flex" style="align-items: center;    gap: 8px; ">
                                <a href="sign-up-lawyer.php" class="boxed-btn4 " style="padding: 9px 40px;">Signup</a>
                                <a href="login.php" class="boxed-btn4 " style="padding: 9px 40px;">Login</a>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> <!-- header-end -->

    <div class="appointment_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-md-6 col-lg-6">
                    <div class="appiontment_thumb d-none d-lg-block">
                        <img src="img/appointment/1.png" alt="">
                    </div>
                </div>
                <div class="col-xl-6 offset-xl-1 col-md-6 col-md-12 col-lg-6">
                    <div class="appointment_info">
                        <div class="opacity_icon d-none d-lg-block">
                            <i class="flaticon-balance"></i>
                        </div>
                        <h3>Login to Your Account</h3>
                        <p>Welcome back! Please enter your credentials to access your account.</p>
                        <form method="POST">
                            <div class="row">

                                <div class="col-xl-12 col-md-12">
                                    <input type="email" placeholder="Your Email" name="user_email">
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <input type="password" placeholder="Your Password" name="user_password">
                                </div>




                                <div class="col-xl-12">
                                    <div class="login_button">
                                        <button class="boxed-btn5" type="submit" name="login-btn">Login</button>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="signup_link">
                                        <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
                                    </div>
                                    <div class="mt-2">
                                    <?php if (!empty($msg)) { echo $msg; } ?>
                                    </div>
                                </div>


                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- footer_start -->
    <?php include('include/footer.php') ?>
    <!-- footer_end -->


    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/gijgo.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>

    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="js/main.js"></script>

    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            // disableDaysOfWeek: [0, 0],
            //     icons: {
            //      rightIcon: '<span class="fa fa-caret-down"></span>'
            //  }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
        var timepicker = $('#timepicker').timepicker({
            format: 'HH.MM'
        });
    </script>
</body>

</html>