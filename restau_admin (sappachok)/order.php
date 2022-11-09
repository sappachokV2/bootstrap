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
                <th>Payment status</th>
                <th>Order Status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
			$sql = "select * from food_order
            where restau_id in (
                select restau_id from restau where restau_admin_id = {$_SESSION['user_id']}
            ) 
            order by order_id desc";

            //$sql = "select * from food_order where user_id={$_SESSION['user_id']} order by order_id desc";
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
					<?php
						//1-สั่งอาหาร 2-ไรเดอร์รับออเดอร์ 3-รับอาหารแล้ว 4-ส่งอาหารแล้ว
						if ($obj -> status == 1) echo "Customer send order";
						else if($obj -> status == 2) echo "Rider receipt order";
						else if($obj -> status == 3) echo "Rider pick food and Delivery";
						else if($obj -> status == 4) echo "Send food finished";
					?>
					</td>
					<td>
						<a href="order_detail.php?id=<?php echo $obj -> order_id; ?>" class="btn btn-info">View detail</a>
					</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include("../footer.php");
?>