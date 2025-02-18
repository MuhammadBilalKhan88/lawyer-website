<?php

include("Database/connection.php");


$getid = $_GET['id'];
$qurey = "SELECT * FROM `lawyers_services` WHERE  `service_id` = $getid ";
$res = mysqli_query($conn, $qurey);




$row = mysqli_fetch_assoc($res);

if (!$res) {
    die("Qurey Failed " .  mysqli_error($conn));
}

$msg = "";

if (isset($_POST['editServices-btn'])) {

    $services_name = $_POST['services_name'];

    $query2 = "UPDATE `lawyers_services` SET `service_name`='$services_name' WHERE `service_id` = $getid";

    $res2 = mysqli_query($conn, $query2);

    if (!$res2) {
        die("Qurey Failed " . mysqli_error($conn));
    }

    header('location:lawyerservices-management.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Lawyer Services</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">


    <?php include('include/head-link.php');   ?>
</head>

<body>

    <?php include('include/header.php') ?>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">

                <div class="title">
                    <h1 class="h5">Admin Daashboard</h1>

                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li><a href="index.php"> <i class="icon-home"></i>Home </a></li>
                <li class=""><a href="acc-management.php"> <i class="fa-solid fa-users"></i>Accounts Managemnet</a></li>
                <li><a href="#"> <i class="fas fa-gavel"></i>Lawyers Managemnet</a></li>
                <li><a href="#"> <i class="fas fa-balance-scale"></i>Services Mangement</a></li>

        </nav>
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="col-lg-12">

                    <div class="block">

                        <div class="block-body">
                            <div class="title"><strong class="d-block">Edit Account</strong><span class="d-block"></span></div>
                            <form action="" method="POST">

                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter Service Name" class="form-control" name="services_name" value="<?php echo $row['service_name'];  ?>">
                                </div>
                              
                        </div>
                    
                        <div class="mb-3">
                            <input class="btn btn-wanring" type="submit" value="Edit User" name="editServices-btn">
                        </div>








                        </form>
                    </div>
                </div>
        </div>

        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                    <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank"
                            href="https://templateshub.net">Templates Hub</a>.</p>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
</body>

</html>