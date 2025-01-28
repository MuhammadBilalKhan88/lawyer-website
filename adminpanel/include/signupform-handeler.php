<?php  


if(isset($_POST['sign-up-btn'])){


$user_Name = $_POST['user_name'];
$user_email = $_POST['user_eamil'];
$user_password = $_POST['user_password'];
$user_cPassword = $_POST['user_cPasswprd'];
$user_Type = $_POST['user_name'];




$errors = array();

if(empty($ueser_Name)  OR empty($ueser_email) OR empty($user_password)    OR empty($user_cPassword)   OR empty($user_Type)){

    $errors[] = "All Fields Are Required";
}

echo " div class='alert alert-danger'>" . $errors."</div>";	




















}






?> 