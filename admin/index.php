<?php 

include("Database/connection.php");
$msg="";

if(isset($_POST['admin-login'])){
  $user_email = mysqli_escape_string($conn , $_POST['user_email']);
$user_password = mysqli_escape_string($conn , $_POST['user_password']);

$login = false;
session_start();



$msg = "";




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
        // Password Verification
        if (password_verify($user_password, $user['user_password'])) {
    
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_id'] = $user['user_id'];

              //  Admin Redirect
              if ($user['user_email'] == "admin@gmail.com") {
                header('Location: dashboard.php');
                exit();
              }else{
                $msg = "<div class='alert alert-danger'>Email And Pasword Does Not Match</div>";
              }
            
        } else {
            $msg = "<div class='alert alert-danger'>Pasword Does Not Match</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email Does Not Exist</div>";
    }
}



?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin Dashboard </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">


  <?php include('include/head-link.php');   ?>
</head>

<body style="background-color: #22252a;">

  <section style="height: 100vh;     align-content: center;">
    <div class="container justify-content-center align-items-center " >

      <div class="row justify-content-center " >

        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong class="d-block">lAWYER</strong><span class="d-block"></span></div>
            <in>Admin Login Password</P>
            <div class="block-body">
              <form  method="post">
                <div class="form-group">
                  <label class="form-control-label">Email</label>
                  <input type="email" placeholder="Email Address" class="form-control" name="user_email">
                </div>
                <div class="form-group">
                  <label class="form-control-label">Password</label>
                  <input type="password" placeholder="Password" class="form-control" name="user_password">
                </div>
                <div class="form-group">
                  <input type="submit" value="Login" class="btn btn-primary" name="admin-login">
                </div>
                <?php echo $msg; ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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