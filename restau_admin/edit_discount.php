<?php
include("../header.php");
?>
    <div class='container-fluid mt-3'>
        <a href='view_discount.php' class="btn btn-success px-2 mb-2">❮❮</a>
        <div class='card bg-white'>
            <?php
            $restau = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
            $query = $mysqli -> query($restau);
            $restau_obj = $query -> fetch_object();
            $restau_id = $restau_obj -> restau_id;
        
            $discount = "select * from restau_discount where restau_id=$restau_id";
            $query = $mysqli -> query($discount);
            $obj = $query -> fetch_object();

            ?>
            <form method="post">
                <div class='card-header pb-0'>
                    <h3 class='card-title'>Edit Discount</h3>
                </div>
                <div class='card-body'>
                    <p>
                        <label>Discount Percent</label>
                        <input type="number" value='<?php echo $obj -> discount_percent; ?>' placeholder='Min = 0, Max = 100' name='percent' class='form-control' min='0' max='100'>
                    </p>
                    <div class='d-flex'>
                        <h5 class='my-auto me-2'>Status</h5>
                        <?php if ($obj -> status == 1) { ?>
                            <input id='aa' name='Ahhh' type="radio" class='btn-check' value='1' checked>
                            <label for="aa" class='btn btn-outline-success me-1'>Activate</label>

                            <input id='bb' name='Ahhh' type="radio" class='btn-check' value='0'>
                            <label for="bb" class='btn btn-outline-danger'>Deactivate</label>
                        <?php } else if ($obj -> status == 0) { ?>
                            <input id='aa' name='Ahhh' type="radio" class='btn-check' value='1'>
                            <label for="aa" class='btn btn-outline-success me-1'>Activate</label>

                            <input id='bb' name='Ahhh' type="radio" class='btn-check' value='0' checked>
                            <label for="bb" class='btn btn-outline-danger'>Deactivate</label>
                        <?php } ?>
                    </div>
                </div>
                <div class='card-footer px-2'>
                    <button type='submit' name='save' class='btn btn-primary px-4'>Save</button>
                    <button type='submit' name='cancel' class='btn btn-danger px-4'>Cancel</button>
                </div>
            </form>
            <?php
            if (isset($_POST['save']))
            {
                $percent = $_POST['percent'];
                $status = $_POST['Ahhh'];
                $sql = "update restau_discount set discount_percent=$percent, status=$status where restau_id=$restau_id";
                $mysqli -> query($sql);
                header("location: view_discount.php");
            }
            ?>
        </div>
    </div>
<?php
include("../footer.php");
?>