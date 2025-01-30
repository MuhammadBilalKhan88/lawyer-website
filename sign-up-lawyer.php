<?php

include('admin/Database/connection.php');
error_reporting(0);

if (isset($_POST['sign-up-btn'])) {


    $user_Name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_eamil']);
    $user_password = $_POST['user_password'];
    $user_cPassword = $_POST['user_cPasswprd'];
    $user_Type = $_POST['user_type'];


    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);


    $errors = array();

    if (empty($user_Name)  or empty($user_email) or empty($user_password)    or empty($user_cPassword)   or empty($user_Type)) {

        array_push($errors, "All Fields Are Required");
    }

    if (empty($user_Type)) {
        array_push($errors, "Please Select Your Type");
    }

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid Email Address");
    }

    if (strlen($user_password) < 8) {
        array_push($errors, "Password Must Be Greater Than 8 Characters");
    }

    if ($user_password !== $user_cPassword) {
        array_push($errors, "Password Does Not Match");
    }

    $qurey = "SELECT * FROM  users WHERE user_email = '$user_email' ";
    $res = mysqli_query($conn, $qurey);
    $rowCount = mysqli_num_rows($res);

    if ($rowCount > 0) {
        array_push($errors, "Email Already Exist");
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
                        <h3>Sign Up</h3>
                        <p>Join our platform to access trusted lawyers and personalized legal solutions tailored to your needs.</p>
                        <form method="post">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <input type="text" placeholder="Your Name" name="user_name" value="<?php if (isset($_POST['sign-up-btn'])) {
                                                                                                            echo $user_Name;
                                                                                                        } ?>">
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <input type="email" placeholder="Your Email" name="user_eamil" value="<?php if (isset($_POST['sign-up-btn'])) {
                                                                                                                echo $user_email;
                                                                                                            } ?>">
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <input type="password" placeholder="Your Password" name="user_password" value="<?php if (isset($_POST['sign-up-btn'])) {
                                                                                                                        echo $user_password;
                                                                                                                    } ?>">
                                </div>

                                <div class="col-xl-6 col-md-6">

                                    <input type="password" placeholder="Your Confrim Password" name="user_cPasswprd" value="<?php if (isset($_POST['sign-up-btn'])) {
                                                                                                                                echo $user_Name;
                                                                                                                            } ?>">
                                </div>
                                <div class="col-xl-12 col-md-12">

                                    <select class="form-control" name="user_type">

                                        <option value="">Your Type</option>
                                        <option value="lawyer" <?php if (isset($_POST['sign-up-btn']) && $_POST['user_type'] == 'Lawyer') echo 'selected'; ?>>Are You A Lawyer</option>
                                        <option value="client" <?php if (isset($_POST['sign-up-btn']) && $_POST['user_type'] == 'client') echo 'selected'; ?>>Are You A Client</option>
                                    </select>
                                </div>


                                <div class="col-xl-12">
                                    <div class="mt-3">
                                        <button class="boxed-btn5 " type="submit" name="sign-up-btn">Sign Up</button>
                                    </div>
                                    <div class="mt-2">
                                        <?php
                                        if (count($errors) > 0) {
                                            foreach ($errors as $error) {
                                                echo "<div class='alert alert-danger'>" . $error . "</div>";
                                            }
                                        } else {


                                            $sql = "CALL insertUsers(?, ?, ?, ?)";
                                            $stmt = mysqli_stmt_init($conn);

                                            if (mysqli_stmt_prepare($stmt, $sql)) {

                                                mysqli_stmt_bind_param($stmt, "ssss", $user_Name, $user_email, $user_password_hash, $user_Type);
                                                mysqli_stmt_execute($stmt);
                                                echo "<div class='alert alert-success'>You are registered Successfully. <a href='login.php'>Login</a></div>";
                                            } else {

                                                die("Something went wrong.");
                                            }
                                        }

                                        mysqli_stmt_close($stmt);


                                        ?>
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