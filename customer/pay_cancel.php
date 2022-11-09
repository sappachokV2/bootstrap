<?php
session_start(); 
include('../database/db_connect.php');

$order_id = $_GET['order_id'];
$sql = "delete from food_order where order_id=$order_id";
$query = $mysqli -> query($sql);
header("location: history.php");
?>