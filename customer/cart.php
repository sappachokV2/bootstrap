<?php
include("../header.php");
if (!isset($_SESSION['discountPercent']))
{
    $_SESSION['discountPercent'] = 0;
}
if (!isset($_SESSION['restau_id']))
{
    $_SESSION['restau_id'] = 99999999;
}
?>
<div class='container-fluid table-responsive' style="margin-top: 20px;">
    <form method='post'>
        <h4 style="color:#0010ff;">
            <?php if (isset($_SESSION['restau_id']) && $_SESSION['restau_id'] != 99999999) { ?>
                <a href='food.php?restau_id=<?php echo $_SESSION['restau_id']; ?>' class="btn btn-success px-2">❮❮</a>
            <?php } else { ?>
                <a href='index.php' class="btn btn-success px-2">❮❮</a>
            <?php } ?>
            <?php
            if (isset($_SESSION['restau_id']) && $_SESSION['restau_id'] != 99999999)
            {
                $sql = "select * from restau where restau_id='{$_SESSION['restau_id']}'";
                $query = $mysqli -> query($sql);
                $obj = $query -> fetch_object();
                $restau_name = $obj -> restau_name;
                echo $restau_name;
            }
            ?>
        </h4> 
        <?php
        ?>
    </form>
    <h3><b><u>Food Order</u></b> <img src="../img/icon_ui/order.png" height="80px"></h3>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger py-2">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success py-2">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php } ?>
    <hr>
    <table class="table table-white table-bordered table-striped" style='margin-top: 6px;'>
        <thead>
            <tr style="background-color:#ff8582;">
            <th scope="col">No.</th>
            <th scope="col">Items</th>
            <th scope="col">Price</th>
            <th scope="col">Amount</th>
            <th scope="col">Total price</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from food
            join food_cart on (food.food_id = food_cart.food_id)
            where food.food_id=food_cart.food_id and food.restau_id={$_SESSION['restau_id']}";
            $result = $mysqli -> query($sql);
            if ($result -> num_rows > 0 && $_SESSION['restau_id'] != 99999999) {

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
                // $discount2 = $subtotal2 - ($subtotal2 * $_SESSION['discountPercent']) / 100; 
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
                    <td>
                        <a class="btn btn-primary px-4" href="add_food.php?foodId=<?php echo $obj -> food_id; ?>&price=<?php echo $obj -> price ?>">Add</a>
                        <a class="btn btn-danger px-4" href="delete_food.php?foodId=<?php echo $obj -> food_id; ?>&price=<?php echo $obj -> price ?>">Delete</a>
                    </td>
                </tr>
            <?php } } else { $_SESSION['discountPercent'] = 0; } ?>

            <tr>
                <?php if (isset($_SESSION['restau_id']) && $_SESSION['restau_id'] != 99999999) { ?>
                    <th scope="row" colspan='6'><a href="food.php?restau_id=<?php echo $_SESSION['restau_id']; ?>" style="color:#df2637;">Add more items...</a></th>
                <?php } ?>
            </tr>
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
                <th scope="row">Total <span style="color:#797979;">(include VAT)</span></th>
                <td colspan='5'><b><?php if (isset($total2)) { echo number_format($total2); } else { echo "0"; } ?> TH</b></td>
            </tr>
            <tr>
                <td colspan='6' class='text-center'>
                    <a href="cancel_food.php" class="btn btn-danger">Cancel</a>
                    <?php if (isset($restau_name) != null && isset($index) && $index > 0) { ?>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Confirm</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-primary">Confirm</a>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog" style="border-radius: 2rem!important;">
            <div class="modal-content">
                <form method='post'>
                    <div class="modal-header">
                            <h5 class="modal-title">Confirm order</h5>
                            <button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Name: <?php echo $_SESSION['username']; ?></p>
                        <p>Address: <?php echo $_SESSION['address']; ?></p>
                        <p>Tel: <?php echo $_SESSION['tel']; ?></p>
                        <!-- <br>
                        <p class='text-center'>
                            <i style='font-size: 50px; color: lightgreen;' class="fa-light fa-circle-check"></i>
                        </p>
                        <p class='text-center'>Success!</p> -->
                        <div class='d-flex gap-2'>
                            <p class='my-auto'><b>Payment method</b></p>
                            <input type='radio' class='btn-check' name='payMe' value='1' id='Cash' checked>
                            <label for='Cash' class='btn btn-outline-success'>Cash</label>
                            <input type='radio' class='btn-check' name='payMe' value='2' id='Credit'>
                            <label for='Credit' class='btn btn-outline-primary'>Credit card</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" name="save" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                        <?php
                        if (isset($_POST['save']))
                        { ?>
                            <?php

                            // $delete = "delete from food_cart";
                            // $query_delete = $mysqli -> query($delete);

                            $payme = $_POST['payMe'];
                            
                            $select = "select * from food_order where restau_id={$_SESSION['restau_id']} and user_id={$_SESSION['user_id']} and payment_status = 0";
                            $query0 = $mysqli -> query($select);
                            if ($query0 -> num_rows > 0) 
                            { 
                                $_SESSION['error'] = "Cancel your old order first";
                                header("location: cart.php");
                                return; 
                            }

                            $insert = "insert food_order (user_id, restau_id, order_amount, discount_amount, payment_amount, payment_method , payment_status, status)
                            value ({$_SESSION['user_id']}, {$_SESSION['restau_id']}, $subtotal2, $discount2, $total2, $payme, 0, 1)";
                            $insert_order = $mysqli -> query($insert);
                            if ($insert_order)
                            {
                                $order = "select * from food_order where restau_id={$_SESSION['restau_id']} and user_id={$_SESSION['user_id']}";
                                $order_query = $mysqli -> query($order);
                                if ($order_query -> num_rows > 0)
                                {
                                    $get_order = $order_query -> fetch_object();
                                    $_SESSION['order_id'] = $get_order -> order_id;
    
                                    $original = "select * from food_cart";
                                    $get_original = $mysqli -> query($original);
                                    while ($obj = $get_original -> fetch_object())
                                    {
                                        $amount = $obj -> amount;
                                        $total_price = $obj -> total_price;
                                        $price = $total_price / $amount;

                                        $food_id = $obj -> food_id;
                                        $restau_id = $obj -> restau_id;
                                        $user_id = $obj -> user_id;
        
                                        $copy = "insert food_order_detail (order_id, food_id, restau_id, user_id, amount, price, total_price) 
                                        value ({$_SESSION['order_id']}, $food_id, $restau_id, $user_id, $amount, $price, $total_price)";
        
                                        $make_copy = $mysqli -> query($copy);
                                        if ($make_copy)
                                        {
                                            $delete = "delete from food_cart";
                                            $delete_original = $mysqli -> query($delete);
                                            if ($delete_original)
                                            {
                                                unset($_SESSION['calPrice']);
                                                unset($_SESSION['myFood']);
                                                unset($_SESSION['restau_id']);
                                                unset($_SESSION['discountPercent']);
                                                unset($_SESIION['order_id']);
                                                header("location: history.php");
                                            }
                                        }
                                    }
                                }
                            }
                            header('location: history.php');
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include("../footer.php");
?>