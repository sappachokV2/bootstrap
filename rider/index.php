<?php
include("../header.php");
if (!isset($_SESSION['type_id']))
{
    $_SESSION['type_id'] = 9000;
}
?>
    <div class='container-fluid mt-3'>
        <div class='row'>
            <div class='col-auto my-auto'>
                <h3><b><u>Customer's Pending Order</u></b></h3>
            </div>
            <div class='col-md-auto'>
                <img src="../img/sappachok_hd.png" width="80px" height="80px">
            </div>
        </div>
        <div class='row mt-2 ms-1'>
            <?php
                $food_order = "select * from food_order
                join restau on (restau.restau_id = food_order.restau_id)
                where food_order.status = 1";
                $queryF = $mysqli -> query($food_order);

                while ($fObj = $queryF -> fetch_object())
                {
                    $restau_id = $fObj -> restau_id;
                    $order_id = $fObj -> order_id; 
                    $user_id = $fObj -> user_id;

                    $getuser = "select * from user where user_id=$user_id";
                    $query = $mysqli -> query($getuser);
                    $user_obj = $query -> fetch_object();
                    $username = $user_obj -> username;
                    $user_address = $user_obj -> address;
                ?>
                    <div class="col-md-3 card me-2 bg-white mb-2">
                        <div class="card-body">
                            <h5 class="card-title">Customer: <?php echo $username; ?></h5>
                            <p class="card-text">Address: <?php echo $user_address; ?></p>
                            <h5 class="card-title">Restaurant: <?php echo $fObj -> restau_name; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Id: <?php echo $fObj -> restau_id; ?></h6>
                            <p class="card-text">Address: <?php echo $fObj -> restau_address; ?></p>
                        </div>
                        <div class="card-footer ps-0 bg-white">
                            <a class='btn px-4 py-1 btn-primary' href='order.php?order_id=<?php echo $order_id; ?>'>View Order</a>
                        </div>
                    </div>
                <?php }
            ?>
        </div>
    </div>

<?php
include("../footer.php");
?>