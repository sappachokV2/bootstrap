<?php
include("../header.php");
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
$sql_order = "select * from food_order where order_id = $order_id";
$query = $mysqli -> query($sql_order);
$obj_order = $query -> fetch_object();

echo "<br>";

//Get restaurant detail
$sql_restau = "select * from restau where restau_id = {$obj_order->restau_id}";
$query = $mysqli -> query($sql_restau);
$obj_restau = $query -> fetch_object();

echo "<p><b>Restaurant Name: {$obj_restau->restau_name}</b></p>";

echo "<p><b>Order id: ".$obj_order->order_id."</b></p>";
echo "<p>Order datetime: </p>";


//Get customer detail
$sql_user = "select * from user where user_id = {$obj_order->user_id}";
$query = $mysqli -> query($sql_user);
$obj_user = $query -> fetch_object();

echo "<p>Customer Name: {$obj_user->full_name}</p>";
echo "<p>Customer Address: {$obj_user->address}</p>";
echo "<p>Customer Tel: {$obj_user->tel}</p>";


//Get order detail
$sql_order_detail = "select food_order_detail.*, food.name from food_order_detail 
	left join food on (food_order_detail.food_id=food.food_id)
	where food_order_detail.order_id = $order_id";
$query = $mysqli -> query($sql_order_detail);

echo "<p><b>Order detail</b></p>";
echo "<table border='1' width = '50%'>";
echo "<tr>";
echo "<th align='center'>No</th>";
echo "<th align='center'>Order</th>";
echo "<th align='center'>Price</th>";
echo "<th align='center'>Amount</th>";
echo "<th align='center'>Total</th>";
echo "</tr>";
$no = 1;
$order_total = 0;
$discount = 0;
while($obj = $query -> fetch_object()) {
	echo "<tr>";
	echo "<td align='center'>".$no."</td>";
	echo "<td align='left'>".$obj->name."</td>";
	echo "<td align='right'>".$obj->price."</td>";
	echo "<td align='right'>".$obj->amount."</td>";
	echo "<td align='right'>".$obj->total_price."</td>";
	echo "</tr>";

	$order_total += $obj->total_price;
	$no++;
}

$paid_total = $order_total - $discount;

echo "</table>";
echo "<br>";
echo "<div><p><b>Order total: ".number_format($order_total)."</b></p></div>";
echo "<div><p><b>Discount: ".number_format($discount)."</b></p></div>";
echo "<div><p><b>Amount to be paid: ".number_format($paid_total)."</b></p></div>";
?>

<p>
<a href="order_detail_pdf2.php?id=<?php echo $order_id; ?>" target="_blank" class="btn btn-danger">PDF File</a>
</p>
</div>
