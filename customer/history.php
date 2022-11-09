<?php
include("../header.php");
?>
<div class='container-fluid table-responsive mt-3'>
    <h4>History</h4>
    <table class='table table-white table-bordered table-striped'>
        <thead>
            <tr style='background-color: #ff8582;'>
                <th>Order ID</th>
                <th>Restaurant</th>
                <th>Order amount</th>
                <th>Discount amount</th>
                <th>Payment amount</th>
                <th>Payment method</th>
                <th>Payment status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from food_order where user_id={$_SESSION['user_id']} order by order_id desc";
            $query = $mysqli -> query($sql);
            while ($obj = $query -> fetch_object())
            { ?>
                <tr>
                    <td><?php echo $obj -> order_id; ?></td>
                    <td>
                        <?php 
                        $sql2 = "select * from restau where restau_id=$obj->restau_id";
                        $query2 = $mysqli -> query($sql2);
                        $obj2 = $query2 -> fetch_object();
                        if ($query2 -> num_rows > 0)
                        {
                            echo $obj2 -> restau_name; 
                        }
                        else
                        {
                            echo "Alien Restaurant"; 
                        }
                        ?>
                    </td>
                    <td><?php echo number_format($obj -> order_amount); ?></td>
                    <td><?php echo number_format($obj -> discount_amount); ?></td>
                    <td><?php echo number_format($obj -> payment_amount); ?></td>
                    <td>
                        <?php 
                            if ($obj -> payment_method == 1)
                            {
                                echo "Cash";
                            } else if ($obj -> payment_method == 2)
                            {
                                echo "Credit card";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if ($obj -> payment_status == 0)
                            {
                                echo "<span class='text-danger'>Pending</span>";
                            } else if ($obj -> payment_status == 1)
                            {
                                echo "<span class='text-success'>Paid</span>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php if ($obj -> payment_status == 0) { ?>
                            <form method='post'>
                                <a href='view_order.php?order_id=<?php echo $obj -> order_id ?>' class='py-1 px-4 btn btn-warning'>View</a>
                                <a href='order_cancel.php?order_id=<?php echo $obj -> order_id; ?>' class='py-1 px-4 btn btn-danger'>Cancel</a>
                            </form>
                        <?php } else { ?>
                            <a href='view_order.php?order_id=<?php echo $obj -> order_id ?>' class='py-1 px-4 btn btn-warning'>View</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include("../footer.php");
?>