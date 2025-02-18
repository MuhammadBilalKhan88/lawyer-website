<?php

include("Database/connection.php");

$getid = $_GET['id'];

// Fetch the lawyer's details
$qurey = "SELECT * FROM `lawyers` WHERE `lawyer_id` = $getid";
$res = mysqli_query($conn, $qurey);
$row = mysqli_fetch_assoc($res);

if (!$res) {
    die("Query Failed " . mysqli_error($conn));
}

$service_id = $row['lawyer_specialization']; 

$service_query = "SELECT service_name FROM `lawyers_services` WHERE `service_id` = $service_id";
$service_res = mysqli_query($conn, $service_query);
$service_row = mysqli_fetch_assoc($service_res);
$current_service_name = $service_row['service_name'];

$msg = "";

if (isset($_POST['editLawyer-btn'])) {
    $lawyer_name = $_POST['lawyer_name'];
    $lawyer_email = $_POST['lawyer_email'];
    $lawyer_location = $_POST['lawyer_location'];
    $lawyer_image = $_FILES['lawyer_image'];
    $lawyer_clandly = $_POST['lawyer_clandly'];
    $lawyer_services = $_POST['lawyer_services']; // This will be the service_name selected by the user

    // Get the service_id for the selected service_name
    $service_query = "SELECT service_id FROM `lawyers_services` WHERE `service_name` = '$lawyer_services'";
    $service_res = mysqli_query($conn, $service_query);
    $service_row = mysqli_fetch_assoc($service_res);
    $service_id = $service_row['service_id']; // Get the corresponding service_id

    // Handle the image upload if it's set
    if ($lawyer_image['name']) {
        $lawyer_image_name = $lawyer_image['name'];
        move_uploaded_file($lawyer_image['tmp_name'], "../img/lawyerImage/" . $lawyer_image_name);
    } else {
        $lawyer_image_name = $row['lawyer_pimage']; // Keep the old image if no new image is uploaded
    }

    // Update the lawyer's details
    $query2 = "UPDATE `lawyers` 
               SET `lawyer_name`='$lawyer_name', `lawyer_email`='$lawyer_email', 
                   `lawyer_location`='$lawyer_location', `lawyer_pimage`='$lawyer_image_name', 
                   `lawyer_calendly_url`='$lawyer_clandly', `lawyer_specialization`='$service_id' 
               WHERE `lawyer_id` = $getid";

    $res2 = mysqli_query($conn, $query2);

    if (!$res2) {
        die("Query Failed " . mysqli_error($conn));
    }

    header('Location: lawyer-management.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Account</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <?php include('include/head-link.php'); ?>
</head>

<body>

    <?php include('include/header.php') ?>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="title">
                    <h1 class="h5">Admin Dashboard</h1>
                </div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <span class="heading">Main</span>
            <ul class="list-unstyled">
                <li><a href="index.php"> <i class="icon-home"></i>Home </a></li>
                <li class=""><a href="acc-management.php"> <i class="fa-solid fa-lawyers"></i>Accounts Management</a></li>
                <li><a href="#"> <i class="fas fa-gavel"></i>Lawyers Management</a></li>
                <li><a href="#"> <i class="fas fa-balance-scale"></i>Services Management</a></li>
            </ul>
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
                            <div class="title"><strong class="d-block">Edit Lawyer</strong></div>
                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter lawyer Name" class="form-control" name="lawyer_name" value="<?php echo $row['lawyer_name']; ?>">
                                </div>

                                <div class="mb-3">
                                    <input type="email" Placeholder="Enter lawyer Email" class="form-control" name="lawyer_email" value="<?php echo $row['lawyer_email']; ?>">
                                </div>

                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter lawyer Location" class="form-control" name="lawyer_location" value="<?php echo $row['lawyer_location']; ?>">
                                </div>

                                <div class="mb-3">
                                    <img src="../img/lawyerImage/<?php echo $row['lawyer_pimage']; ?>" alt="Lawyer Image" style="width:150px;">
                                    <input type="file" Placeholder="Upload lawyer Image" class="form-control" name="lawyer_image">
                                </div>

                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter lawyer Calendly URL" class="form-control" name="lawyer_clandly" value="<?php echo $row['lawyer_calendly_url']; ?>">
                                </div>

                                <div class="mb-3">
                                    <select name="lawyer_services" class="form-control">
                                        <?php
                                        // Get all services from the services table
                                        $services_query = "SELECT * FROM `lawyers_services`";
                                        $services_res = mysqli_query($conn, $services_query);

                                        if (!$services_res) {
                                            die("Query Failed " . mysqli_error($conn));
                                        }

                                        // Loop through all available services and display them in the dropdown
                                        while ($service = mysqli_fetch_assoc($services_res)) {
                                            $selected = ($service['service_name'] == $current_service_name) ? "selected" : "";
                                            echo "<option value=\"" . $service['service_name'] . "\" $selected>" . $service['service_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <input type="submit" class="btn btn-warning" value="Edit Lawyer" name="editLawyer-btn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
</body>

</html>
