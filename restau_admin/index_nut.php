<?php
include("../header.php");
?>
<div class='container-fluid mt-3 px-3 table-responsive'>
    <div class='row'>
        <div class='p-1 pt-0 mb-2'>
            <a href='create_restaurant.php' class='btn btn-success'>Create restaurant</a>
        </div>
        <!--
        <table class='table table-white table-striped'>
            <thead>
                <tr class='bg-warning'>
                    <th class='col-md-auto'>Restaurant</th>
                    <th class='col-md-auto'>Restaurant Type</th>
                    <th class='col-md-auto'>Status</th>
                    <th class='col-md-3'>Manage</th>
                </tr>
            </thead>
            <?php
            $sql = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
            $query = $mysqli -> query($sql);
            if ($query -> num_rows > 0) {
                while ($obj = $query -> fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $obj -> restau_name; ?></td>
                    <td>
                        <?php 
                        $type_id = $obj -> type_id;
                        $type = "select * from restau_type where id=$type_id";
                        $type_query = $mysqli -> query($type);
                        $getType = $type_query -> fetch_object();
                        echo $getType -> type_name; 
                        ?>
                    </td>
                    <td>
                        <?php if ($obj -> status == 1) { ?>
                            <span class='text-success'>Allowed</span>
                        <?php } else if ($obj -> status == 1) { ?>
                            <span class='text-danger'>Not allowed</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href='manage_restaurant.php' class='btn btn-primary p-1 px-4'>Manage</a>
                    </td>
                </tr> -->
                <!-- <div class='col-md-6 gx-1 gy-1'>
                    <div class='card bg-white'>
                        <div class='card-header bg-white'>
                            <h4 class='card-title mb-0'>Restaurant Management</h4>
                        </div>
                        <div class='card-body'>
                            <p class='card-text'>Name: <?php // echo $obj -> restau_name; ?></p>
                            <p class='card-text'>Address: <?php // echo $obj -> restau_address; ?></p>
                        </div>
                        <div class='card-footer bg-white px-1 py-1'>
                            <a class='btn px-4 btn-primary' href='manage_restaurant.php'>Manage</a>
                        </div>
                    </div>
                </div> -->
            <?php } 
            } else { ?>
                <!-- <button class='btn btn-primary'>Create restaurant</button> -->
            <?php } ?>
        </table>
        <br>
        <div class='col-md-12'>
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title">New order from : customer1</h5>
                        <h6 class="card-subtitle mt-2 mb-2 text-muted">
                            <p class="card-text">
                                <b>
                                    Order accepted by : rider1
                                </b>
                            </p>
                        </h6>
                        <h6 class="card-subtitle mt-2 mb-2 text-muted">
                            <p class="card-text">
                                <b>
                                Order status : <span style="color:#ffae18;">Pending</span>
                                </b>
                            </p>
                        </h6>
                    </div>
                    <div class="card-footer bg-white px-2 d-flex">
                        <a class="btn btn-primary me-2" href="check_order.php">Check order</a> <!--note: you can see customer's order at restau admin's main page-->
                    </div>
                </div>
            </div>
    </div>
</div>
<?php
include("../footer.php");
?>