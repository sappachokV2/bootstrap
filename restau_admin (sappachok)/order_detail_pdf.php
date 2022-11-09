<?php

require_once '../vendor/autoload.php';
include('../database/db_connect.php');
//include($root . "header.php");
?>
<style>
th {
	text-align: center;
}
</style>
<div class="container">
<?php
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

//$mpdf = new \Mpdf\Mpdf();

//custom font
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        $root . '/fonts',
    ]),
    'fontdata' => $fontData + [
            'thsarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' =>  'THSarabunNew Bold.ttf',
            ]
        ],
	'default_font' => 'thsarabun'
]);


$mpdf->WriteHTML('
<style>
.container{
    font-family: "sarabun";
    font-size: 12pt;
}</style>
');
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

$mpdf->WriteHTML("<p><b>Order detail</b></p>");

$table_html = "";
$table_html .= "<table border='1' width = '50%'>";
$table_html .= "<tr>";
$table_html .= "<th align='center'>No</th>";
$table_html .= "<th align='center'>Order</th>";
$table_html .= "<th align='center'>Price</th>";
$table_html .= "<th align='center'>Amount</th>";
$table_html .= "<th align='center'>Total</th>";
$table_html .= "</tr>";

$no = 1;
$order_total = 0;
$discount = 0;
while($obj = $query -> fetch_object()) {
	$table_html .= "<tr>";
	$table_html .= "<td align='center'>".$no."</td>";
	$table_html .= "<td align='left'>".$obj->name."</td>";
	$table_html .= "<td align='right'>".$obj->price."</td>";
	$table_html .= "<td align='right'>".$obj->amount."</td>";
	$table_html .= "<td align='right'>".$obj->total_price."</td>";
	$table_html .= "</tr>";

	$order_total += $obj->total_price;
	$no++;
}

$paid_total = $order_total - $discount;

$table_html .= "</table>";
$table_html .= "<br>";
$table_html .= "<div><p><b>Order total: ".number_format($order_total)." Baht</b></p></div>";
$table_html .= "<div><p><b>Discount: ".number_format($discount)." Baht</b></p></div>";
$table_html .= "<div><p><b>Amount to be paid: ".number_format($paid_total)." Baht</b></p></div>";
$table_html .= "</div>";

$mpdf->WriteHTML($table_html);

$mpdf->Output();

?>