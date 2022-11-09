<?php
include("../header.php");
?>
<div class='container-fluid mt-3 table-responsive'>
    <a href='create_restau_type.php' class='mt-1 btn btn-success'>Create restaurant type</a>

    <table class='table table-striped mt-3'>
        <thead>
            <tr class='bg-warning'>
                <th class='col-md-4'>Id</th>
                <th class='col-md-auto'>Type name</th>
                <th class='col-md-4'>Manage</th>
            </tr>
        </thead>
        <?php
        $sql = "select * from restau_type";
        $query = $mysqli -> query($sql);
        if ($query -> num_rows > 0)
        {
            while ($obj = $query -> fetch_object()) {
        ?>
            <tr>
                <td><?php echo $obj -> id; ?></td>
                <td><?php echo $obj-> type_name; ?></td>
                <td>
                    <a href='manage_restau_type.php?id=<?php echo $obj -> id; ?>' class='btn btn-warning py-1'>Manage</a>
                </td>
            </tr>
        <?php } 
        } ?>
    </table>

</div>

<?php
include("../footer.php");
?>