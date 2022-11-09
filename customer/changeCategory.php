<?php
session_start();
$cate_id = $_GET['cate_id'];
$_SESSION['currentFoodCate'] = $cate_id;
header("location: food.php?restau_id={$_SESSION['restau_id']}");
?>