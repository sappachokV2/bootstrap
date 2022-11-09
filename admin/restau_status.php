<?php
session_start();
include("../database/db_connect.php");
$restau_id = $_GET['restau_id'];

$get = "select * from restau where restau_id=$restau_id";
$query = $mysqli -> query($get);
$obj = $query -> fetch_object();
$status = $obj -> status;

if ($status == 1) // Activate
{
    $update = "update restau set status=0 where restau_id=$restau_id";
    $mysqli -> query($update);
    header("location: edit_restaurant.php");
} 
else if ($status == 0) // Inactivate
{
    $update = "update restau set status=1 where restau_id=$restau_id";
    $mysqli -> query($update);
    header("location: edit_restaurant.php");
}
?>