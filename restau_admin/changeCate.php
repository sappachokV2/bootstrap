<?php
session_start();
$id = $_GET['cate_id'];
$_SESSION['cate_id'] = $id;
header("location: add_food.php");
?>