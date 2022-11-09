<?php
session_start();
include("../database/db_connect.php");
$order_id = $_GET['order_id'];
$sql = "delete from food_order where user_id={$_SESSION['user_id']} and order_id = $order_id";
$mysqli -> query($sql);
header("location: history.php");
?>