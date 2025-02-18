<?php

include ("Database/connection.php");

$getid = $_GET['id'];

$qurey ="DELETE FROM `lawyers` WHERE `lawyer_id` =  $getid";
$res = mysqli_query($conn,$qurey);

if(!$res){

    die("Qurey Failed". mysqli_error($conn));
}else{
    header('location:lawyer-management.php');
}

?>