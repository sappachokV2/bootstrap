<?php
include("../header.php");
?>

<div class='container-fluid mt-3 table-responsive'>
    <h5 class='py-2'>Manage restaurant</h5>

    <table class='table table-striped mt-3'>
        <thead>
            <tr class='bg-warning'>
                <th class='col-md-4'>Id</th>
                <th class='col-md-auto'>Restaurant</th>
                <th class='col-md-auto'>Status</th>
                <th class='col-md-4'>Manage</th>
            </tr>
        </thead>
        <?php
        $sql = "select * from restau";
        $query = $mysqli -> query($sql);
        if ($query -> num_rows > 0)
        {
            while ($obj = $query -> fetch_object()) {
        ?>
            <tr>
                <td><?php echo $obj -> restau_id; ?></td>
                <td><?php echo $obj-> restau_name; ?></td>
                <td>
                    <?php
                    echo ($obj -> status == 1) ? "<span class='text-success'>Activated</span>" : "<span class='text-danger'>Inactivated</span>";
                    ?>
                </td>
                <td>
                <?php if ($obj -> status == 1) { ?>
                            <a href='restau_status.php?restau_id=<?php echo $obj -> restau_id; ?>' class='btn btn-success py-1'>Activate</a>
                            <a href='restau_status.php?restau_id=<?php echo $obj -> restau_id; ?>' class='btn btn-outline-danger py-1'>Deactivate</a>
                        <?php } ?>
                        <?php if ($obj -> status == 0) { ?>
                            <a href='restau_status.php?restau_id=<?php echo $obj -> restau_id; ?>' class='btn btn-outline-success py-1'>Activate</a>
                            <a href='restau_status.php?restau_id=<?php echo $obj -> restau_id; ?>' class='btn btn-danger py-1'>Deactivate</a>
                        <?php } ?>
                </td>
            </tr>
        <?php } 
        } ?>
    </table>

</div>

<?php
include("../footer.php");
?>