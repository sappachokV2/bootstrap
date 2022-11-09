<?php
include("../header.php");
?>
<style>
        .label-a { 
            display: flex; 
            font-size: 1.5rem; 
            justify-content: center; 
            align-items: center; 
            height: 100%;
        }
        .label-b {
            display: flex;
            margin-left:80px;
        }
</style>
<div class='container-fluid mt-3'>
    <a href='index.php' class="btn btn-success px-2">❮❮</a>
    <h3><b><u>Restaurant's Discount <img src="../img/icon_ui/rest-owner.png" height="80px"></u></b></h3>
    <!-- <div class="label-b">
        <a class="btn btn-secondary" href="create_discount.php">Create Discount</a> 
        <a class="btn btn-primary" href="create_discount.php">Create Discount</a> 
    </div> -->
    <?php 
    $restau = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
    $query = $mysqli -> query($restau);
    if (!$query -> num_rows > 0)
    {
        header("location: create_restaurant.php");
        return;
    }
    $restau_obj = $query -> fetch_object();
    $restau_id = $restau_obj -> restau_id;

    $discount = "select * from restau_discount where restau_id=$restau_id";
    $query = $mysqli -> query($discount);
    $obj = $query -> fetch_object();

    if ($query -> num_rows > 0) {
    ?>
        <div class='row'>
            <div class='col-md-12'>
                <div class="card bg-white">
                    <div class="card-body">
                        <?php if ($obj -> status == 1) { ?>
                            <h5 class="card-title">Discount status : <span style="color:#007a22;">Activated</span></h5>
                        <?php } else { ?>
                            <h5 class="card-title">Discount status : <span style="color:#ce4441;">Deactivated</span></h5>
                        <?php } ?>
                        <h6 class="card-subtitle mt-2 mb-2 text-muted">
                            <p class="card-text">
                                <b>Discount rate : <span style="color:#ce4441;"><?php echo $obj -> discount_percent; ?>%</span>
                                </b>
                            </p>
                        </h6>
                    </div>
                    <div class="card-footer bg-white px-2 d-flex">
                        <a class="btn btn-primary me-2" href="edit_discount.php">Edit Discount</a>
                        <form method="post">
                            <?php if ($obj -> status == 1) { ?>
                                <!-- <button type='submit' name='changeStats' class="btn btn-danger">Deactivate</a> -->
                            <?php } else { ?>
                                <!-- <button type='submit' name='changeStats' class="btn btn-success">Activate</a> -->
                            <?php } ?>
                        </form>
                        <?php 
                        // if (isset($_POST['changeStats']))
                        // {
                        //     if ($obj -> status == 1)
                        //     {
                        //         $sql = "update restau_discount set status = 0 where restau_id=$restau_id";
                        //         $mysqli -> query($sql);
                        //         header("location: view_discount.php");
                        //     } else if ($obj -> status == 0)
                        //     {
                        //         $sql = "update restau_discount set status = 1 where restau_id=$restau_id";
                        //         $mysqli -> query($sql);
                        //         header("location: view_discount.php");
                        //     }
                        // }
                        ?>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-md-11 card bg-white mt-2 ms-5">
                <div class="card-body">
                    <h5 class="card-title">Discount status : <span style="color:#ce4441;">Deactivated</span></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                    <p class="card-text" style="color:#df2637;">80%</p>
                </div>
                
                <div class="card-footer bg-white ps-0 mb-1">
                    <a class="btn btn-danger" href="" style="margin-left:890px;">Delete Discount</a>
                    <a class="btn btn-primary" href="edit_discount.php" style="margin-left:22px;">Edit Discount</a>
                </div>
            </div> 
            -->
        </div>
    <?php } ?>
</div>
<?php
include("../footer.php");
?>