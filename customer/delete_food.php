<?php
session_start();
include("../database/db_connect.php");

$id = $_GET['foodId'];
$price = $_GET['price'];

$Update = "update food_cart set amount=amount-1, total_price=total_price-$price where food_id=$id and user_id={$_SESSION['user_id']} and restau_id={$_SESSION['restau_id']}";
$Update_query = $mysqli -> query($Update);

$Read = "select * from food_cart where food_id=$id and user_id={$_SESSION['user_id']} and restau_id={$_SESSION['restau_id']}";
$Read_query = $mysqli -> query($Read);
$obj = $Read_query -> fetch_object();
if ($obj -> amount <= 0)
{
    $Delete = "delete from food_cart where food_id=$id and user_id={$_SESSION['user_id']} and restau_id={$_SESSION['restau_id']}";
    $Delete_query = $mysqli -> query($Delete);
    header("location: cart.php");
}

$amount = $obj -> amount;
$subtotal = $obj -> total_price;
$discount_percent = $_SESSION['discountPercent'];
$discount = $subtotal - ($subtotal * $discount_percent) / 100;
$total = $subtotal - $discount;

header("location: cart.php");
?>