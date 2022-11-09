<?php
include("../header.php");
?>
<div class='container-fluid table-responsive mt-3'>
    <h4>History</h4>
    <table class='table table-white table-bordered table-striped'>
        <thead>
            <tr style='background-color: #ff8582;'>
                <th>Order ID</th>
                <th>Order amount</th>
                <th>Payment amount</th>
                <th>Payment method</th>
                <th>Payment status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>200</td>
                <td>cash</td>
                <td><span class='text-danger'>Pending</span></td>
                <td><a href='check_order.php' class='py-1 px-4 btn btn-warning'>Check</a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>4</td>
                <td>400</td>
                <td>credit card</td>
                <td><span class='text-success'>Paid</span></td>
                <td><a href='#.php' class='py-1 px-4 btn btn-danger'>PDF File</a></td>
            </tr>
        </tbody>
    </table>
    <hr>
</div>
<?php
include("../footer.php");
?>