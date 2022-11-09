<?php
session_start();
include("../database/db_connect.php");

$id = $_GET['foodId'];
$price = $_GET['price'];

$Read = "select * from food_cart where food_id=$id and user_id={$_SESSION['user_id']} and restau_id={$_SESSION['restau_id']}";
$Read_query = $mysqli -> query($Read);
if ($Read_query -> num_rows > 0) {
    $Update = "update food_cart set amount=amount+1, total_price=total_price+$price where food_id=$id and user_id={$_SESSION['user_id']} and restau_id={$_SESSION['restau_id']}";
    $Update_query = $mysqli -> query($Update);
} else {
    $Create = "insert food_cart (food_id, restau_id, user_id, amount, total_price)
    value ('$id', '{$_SESSION['restau_id']}', '{$_SESSION['user_id']}', '1', '$price')";
    $Create_query = $mysqli -> query($Create);
}

$Read_query2 = $mysqli -> query($Read);
$obj = $Read_query2 -> fetch_object();

$amount = $obj -> amount;
$subtotal = $obj -> total_price;
$discount_percent = $_SESSION['discountPercent'];
$discount = $subtotal - ($subtotal * $discount_percent) / 100;
$total = $subtotal - $discount;

header("location: cart.php");
?>