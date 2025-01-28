<?php


if (isset($_POST['sign-up-btn'])) {


    $user_Name = $_POST['user_name'];
    $user_email = $_POST['user_eamil'];
    $user_password = $_POST['user_password'];
    $user_cPassword = $_POST['user_cPasswprd'];
    $user_Type = $_POST['user_name'];




    $errors = array();

    if (empty($ueser_Name)  or empty($user_email) or empty($user_password)    or empty($user_cPassword)   or empty($user_Type)) {

        array_push($errors, "All Fields Are Required");
    }

    if(!filter_var($user_email , FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Invalid Email Address");
    }

    if($user_password < 8){
        array_push($errors , "Password Must Be Greater Than 8 Characters");
    }

    if($user_password !== $user_cPassword){
        array_push($errors , "Password Does Not Match");
    }

    foreach($errors as $error){
        echo "<div class='alert alert-danger'>".$error."</div>"; 
    }

}
