<?php
include("../header.php");
?>
<div class='container-fluid mt-2 table-responsive'>
    <table class='table table-striped table-bordered'>
        <thead class='table-success'>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Income</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 10; $i++) { ?>
            <tr>
                <td><?php echo date('d/m/Y'); ?></td>
                <td><?php echo date('H:i:s'); ?></td>
                <td><?php echo number_format(1000000); ?></td>
            </tr>
            <?php } ?>
            <tr>
                <?php
                $earn = 1000000;
                $total = 0;
                for ($i = 0; $i < 10; $i++) {
                    $total = $earn + $total;
                }
                ?>
                <td colspan=3>Total: <?php echo number_format($total); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include("../footer.php");
?>