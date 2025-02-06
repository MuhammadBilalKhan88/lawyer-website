<?php

include ("Database/connection.php");

$getid = $_GET['id'];

$qurey ="DELETE FROM `users` WHERE `user_id` =  $getid";
$res = mysqli_query($conn,$qurey);

if(!$res){

    die("Qurey Failed". mysqli_error($conn));
}else{
    header('location:acc-management.php');
}

?>