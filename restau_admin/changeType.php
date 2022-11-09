<?php
session_start();
$id = $_GET['type_id'];
$_SESSION['type_id'] = $id;
header("location: create_restaurant.php");
?>