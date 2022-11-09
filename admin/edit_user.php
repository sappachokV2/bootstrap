<?php
include("../header.php");
?>
<div class='container mt-2 table-responsive'>
    <table class='table table-sm table-white table-bordered table-striped'>
        <thead>
            <tr style='background-color: #ff8582;'>
                <th>id</th>
                <th>username</th>
                <th>full name</th>
                <th>user type</th>
                <th>address</th>
                <th>email</th>
                <th>tel</th>
                <th>car regis no</th>
                <th>status</th>
                <th>manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from user";
            $query = $mysqli -> query($sql);
            $index = 0;
            while ($obj = $query -> fetch_object())
            {
                $index++;
            ?>
            <tr>
                <td><?php echo $obj -> user_id; ?></td>
                <td><?php echo $obj -> username; ?></td>
                <td><?php echo $obj -> full_name; ?></td>
                <td><?php echo $obj -> user_type; ?></td>
                <td><?php echo $obj -> address; ?></td>
                <td><?php echo $obj -> email; ?></td>
                <td><?php echo $obj -> tel; ?></td>
                <td><?php echo $obj -> car_regis_no; ?></td>
                <?php
                if ($obj -> status != 0)
                {
                    echo "<td class='text-success'>Active</td>";
                } elseif ($obj -> status == 0)
                {
                    echo "<td class='text-danger'>Inactive</td>";
                }
                ?>
                <td>
                    <?php if ($obj -> user_type != 'admin') { ?>
                        <?php if ($obj -> status != 0) { ?>
                            <a class='btn btn-warning px-1 py-1' href='user_status.php?user_id=<?php echo $obj -> user_id; ?>'>Inactive</a>
                        <?php } else if ($obj -> status == 0)
                        { ?>
                            <a class='btn btn-success px-1 py-1' href='user_status.php?user_id=<?php echo $obj -> user_id; ?>'>Active</a>
                        <?php } ?>
                        <a class='btn btn-danger px-1 py-1' href='user_delete.php?user_id=<?php echo $obj -> user_id; ?>'>Delete</a>
                    <?php } else { echo "<span class='text-danger'>Permission denied!</span>"; } ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan='10'><?php echo "All users: " . $index; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include("../footer.php");
?>