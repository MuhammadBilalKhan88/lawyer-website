<?php
include("Database/connection.php");
session_start();
$msg = "";
$date = date('d');
$millisecond = round(microtime(true) * 1000) % 1000;

if (isset($_POST['addLawyer-btn'])) {

    $Lawyer_name = $_POST['lawyer_name'];
    $Lawyer_email = $_POST['lawyer_email'];
    $Lawyer_Specialization = $_POST['lawyer_specialization'];
    $Lawyer_Location = $_POST['lawyer_location'];
    $Lawyer_Image = $_FILES['lawyer_image'];
    $Lawyer_Calendlu = $_POST['lawyer_calendly_url'];
    $lawyer_experince = $_POST['lawyer_experince'];
    $userID = $_POST['userID']; 

    $removespaceLawyer_name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $Lawyer_name));

    if (empty($userID)) {
        die("Please select a user!");
    }

    // Image Processing
    $lawyerimage_Name = $Lawyer_Image['name'];
    $lawyer_FImage =  $removespaceLawyer_name . '-' . $date . '-' . $millisecond . '-' . $lawyerimage_Name;
    $uploadPath = "../img/lawyerImage/" . $lawyer_FImage;
    move_uploaded_file($Lawyer_Image['tmp_name'], $uploadPath);

    // Insert Query
    $query2 = "Call insertlawyer(`userid`, `lawyer_name`, `lawyer_email`, `lawyer_specialization`, `lawyer_location`, `lawyer_pimage`, `lawyer_calendly_url`, `lawyer_experince`) VALUES (?,?,?,?,?,?,?,?)";


    $stmt = $conn->prepare($query2);
    $stmt->bind_param("isssssss", $userID, $Lawyer_name, $Lawyer_email, $Lawyer_Specialization, $Lawyer_Location, $lawyer_FImage, $Lawyer_Calendlu,$lawyer_experince);

    if ($stmt->execute()) {
        header('location:acc-management.php');
    } else {
        die("Query Failed: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add New Account</title>
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
                <li><a href="dashboard.php"> <i class="icon-home"></i>Home </a></li>
                <li class="acc-management.php"><a href="acc-management.php"> <i class="fa-solid fa-Lawyers"></i>Accounts Managemnet</a></li>
                <li><a href="lawyer-management.php"> <i class="fas fa-gavel"></i>Lawyers Managemnet</a></li>
                <li><a href="lawyerservices-management.php"> <i class="fas fa-balance-scale"></i>Services Mangement</a></li>

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
                            <div class="title"><strong class="d-block">Add Lawyer</strong><span class="d-block"></span></div>
                            <?php
                            
                            include("Database/connection.php");
                                $userQuery = "SELECT `user_id`, `user_name`FROM `users`";
                                $userResult = mysqli_query($conn,$userQuery);
                                ?>
                            
                            <form method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                        <label for="userID">Select User:</label>
                                        <select name="userID" class="form-control" required>
                                            <option value="">Select a User</option>
                                            <?php while ($row = mysqli_fetch_assoc($userResult)) { ?>
                                                <option value="<?= $row['user_id'] ?>"><?= $row['user_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter Lawyer Name" class="form-control" name="lawyer_name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" Placeholder="Enter Lawyer Email" class="form-control" name="lawyer_email" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter Lawyer Location" class="form-control" name="lawyer_location" required>
                                </div>
                                <div class="mb-3">
                                    <input type="file" Placeholder="Upload Lawyer Image" class="form-control" name="lawyer_image" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" Placeholder="Upload Your Calendley" class="form-control" name="lawyer_calendly_url" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" Placeholder="Enter Lawyer Experience" class="form-control" name="lawyer_experince" required>
                                </div>
                        </div>
                        <div class="mb-3">
                            <select name="lawyer_specialization" class="form-control" required>
                                <option value="">Select Services</option>
                                <?php 
                                $servicequrey = "SELECT * FROM lawyers_services";
                                $serviceRes = mysqli_query($conn, $servicequrey);
                        
                                while ($servicerow = mysqli_fetch_assoc($serviceRes)) {
                                ?>
                                    <option value="<?php echo $servicerow['service_id']; ?>"><?php echo $servicerow['service_name']; ?></option>=
                                <?php } ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <input class="btn btn-wanring" type="submit" value="Add vLawyer" name="addLawyer-btn">
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