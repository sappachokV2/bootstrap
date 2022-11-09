<?php

require_once '../vendor/autoload.php';
include('../database/db_connect.php');

$mpdf = new \Mpdf\Mpdf();

$order_id = $_GET['id'];
// Get food order by id

$sql_order = "select * from food_order 
		where order_id = $order_id";
$query = $mysqli -> query($sql_order);
$obj_order = $query -> fetch_object();

//Get restaurant detail
$sql_restau = "select * from restau where restau_id = {$obj_order->restau_id}";
$query = $mysqli -> query($sql_restau);
$obj_restau = $query -> fetch_object();

$mpdf->WriteHTML("<div class='container'>");
$mpdf->WriteHTML("<p><b>Restaurant Name: {$obj_restau->restau_name}</b></p>");
$mpdf->WriteHTML("<p><b>Order id: ".$obj_order->order_id."</b></p>");
$mpdf->WriteHTML("<p>Order datetime: </p>");

//Get customer detail
$sql_user = "select * from user where user_id = {$obj_order->user_id}";
$query = $mysqli -> query($sql_user);
$obj_user = $query -> fetch_object();

$mpdf->WriteHTML("<p>Customer Name: {$obj_user->full_name}</p>");
$mpdf->WriteHTML("<p>Customer Address: {$obj_user->address}</p>");
$mpdf->WriteHTML("<p>Customer Tel: {$obj_user->tel}</p>");

//Get order detail
$sql_order_detail = "select food_order_detail.*, food.name from food_order_detail 
	left join food on (food_order_detail.food_id=food.food_id)
	where food_order_detail.order_id = $order_id";
$query = $mysqli -> query($sql_order_detail);

$table_html = "";
$table_html .= "<table border='1' width = '50%'>";
$table_html .= "<tr>";
$table_html .= "<th align='center'>No</th>";
$table_html .= "<th align='center'>Order</th>";
$table_html .= "<th align='center'>Price</th>";
$table_html .= "<th align='center'>Amount</th>";
$table_html .= "<th align='center'>Total</th>";
$table_html .= "</tr>";

$mpdf->Output();
?>