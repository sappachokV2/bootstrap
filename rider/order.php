<?php
include("../header.php");
if (!isset($_SESSION['discountPercent']))
{
    $_SESSION['discountPercent'] = 0;
}
$order_id = $_GET['order_id'];
?>
<div class='container-fluid table-responsive' style="margin-top: 20px;">
    <h4 style="color:#0010ff;">
        <a href='index.php' class="btn btn-success px-2">❮❮</a>
    </h4>
    <div class='row'>
        <div class='col-auto my-auto'>
            <h3><b><u>Pending Delivery</u></b></h3>
        </div>
        <div class='col-md-auto'>
            <img src="../img/sappachok_hd.png" width="80px" height="80px">
        </div>
    </div>
    <p>
        <?php
        $sql = "select * from restau
        join food_order on (restau.restau_id = food_order.restau_id)
        where food_order.order_id=$order_id and food_order.restau_id = restau.restau_id";
        $query = $mysqli -> query($sql);
        $obj = $query -> fetch_object();
        $_SESSION['restau_name'] = $obj -> restau_name;
        $restau_id = $obj -> restau_id;

        $user_id = $obj -> user_id;

        $getdis = "select * from restau_discount where restau_id=$restau_id";
        $disquery = $mysqli -> query($getdis);
        $objDis = $disquery -> fetch_object();
        if (isset($objDis -> discount_percent) != null) {
            $_SESSION['discountPercent'] = $objDis -> discount_percent;
        } else {
            $_SESSION['discountPercent'] = 0;
        }

        $getuser = "select * from user where user_id=$user_id";
        $query = $mysqli -> query($getuser);
        $user_obj = $query -> fetch_object();

        ?>
        <b>Order ID : <?php echo $order_id; ?>
        <br>Restaurant Name : <?php echo $_SESSION['restau_name']; ?>
        <br>Customer Name : <?php echo $user_obj -> username; ?>
        <br>Customer Address : <?php echo $user_obj -> address; ?>
        <br>Tel : <?php echo $user_obj -> tel; ?>
        </b>
    </p>
    <hr>
    <table class="table table-white table-bordered table-striped" style='margin-top: 6px;'>
        <thead>
            <tr style="background-color:#ff8582;">
            <th scope="col">No.</th>
            <th scope="col">Items</th>
            <th scope="col">Price</th>
            <th scope="col">Amount</th>
            <th scope="col">Total price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from food_order_detail
            join food on (food.restau_id = food_order_detail.restau_id)
            where food_order_detail.order_id=$order_id and food.food_id=food_order_detail.food_id";
            $result = $mysqli -> query($sql);
            if ($result -> num_rows > 0) {

            $index = 0;
            $amount = 0;


            $subtotal2 = 0;
            $discount2 = 0;
            $total2 = 0;

            while ($obj = $result -> fetch_object()) {
            $index++;
            $amount = $amount + $obj -> amount;

            $price2 = $obj -> price * $obj -> amount;
            $subtotal2 = $subtotal2 + $price2;
            $discount2 = 0;
            if ($_SESSION['discountPercent'] != 0)
            {
                $discount2 = ($_SESSION['discountPercent'] / 100) * $subtotal2;
                //$discount2 = $subtotal2 - ($subtotal2 * $_SESSION['discountPercent']) / 100;
            }
            else
            {
                $discount2 = 0;
            }
            $total2 = $subtotal2 - $discount2;
            ?>
                <tr>
                    <th scope="row"><?php echo $index; ?></th>
                    <td><?php echo $obj -> name ?></td>
                    <td><?php echo number_format($obj -> price); ?></td>
                    <td><?php echo number_format($obj -> amount); ?></td>
                    <td><?php echo number_format($obj -> total_price); ?></td>
                </tr>
            <?php } } ?>

            <tr>
                <th scope="row">Subtotal <span style="color:#797979;">(THB)</span></th>
                <td colspan='5'><?php if (isset($subtotal2)) { echo number_format($subtotal2); } else { echo "0"; } ?></td>
            </tr>
            <tr>
                <th scope="row">Discount Rate</th>
                <td colspan='5'style="color:#df2637;"><b><?php if ($_SESSION['discountPercent'] != 0) { echo $_SESSION['discountPercent'] . "%"; } else if ($_SESSION['discountPercent'] == 0 ) { echo "No discount ;("; } ?></b></td>
            </tr>
            <tr>
                <th scope="row">Discount <span style="color:#797979;">(THB)</span></th>
                <td colspan='5'><?php if (isset($discount2)) { echo number_format($discount2); } else { echo "0"; } ?></td>
            </tr>
            <tr>
                <th scope="row">Total <span style="color:#797979;">(THB)</span></th>
                <td colspan='5'><?php if (isset($total2)) { echo number_format($total2); } else { echo "0"; } ?></td>
            </tr>
            <tr>
                <td colspan='6' class='text-center'>
                    <a href="#" class="btn btn-danger">Cancel</a>
                    <?php if (isset($_SESSION['restau_name']) && isset($index) && $index > 0) { ?>
                        <a href="order_status.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">Confirm</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-primary">Confirm</a>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include("../footer.php");
?>