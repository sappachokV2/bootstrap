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
</style>
<div class='container-fluid table-responsive' style="margin-top: 20px;">
    <h4 style="color:#0010ff;">
        <a href='index.php' class="btn btn-success px-2">❮❮</a>
    </h4>
    <div class='d-flex mb-2'>
        <h3 class='my-auto me-2'><u><b>Details</b></u></h3>
    </div>
    <p>
        <b>Order ID :
        <br>Customer Name :
        <br>Customer Address : 
        <br>Tel :
        </b>
    </p>
    <hr>
    <table class="table table-white table-bordered table-striped" style='margin-top: 6px;'>
        <thead>
            <tr style="background-color:#ff8582;">
            <th scope="col">No.</th>
            <th scope="col">Items</th>
            <th scope="col">Price</th>
            <th scope="col">Amount</th>
            <th scope="col">Total price</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <th scope="row">6</th>
                    <td>ซีหมูโบราณ</td>
                    <td>100</td>
                    <td>2</td>
                    <td>200</td>
                </tr>
            <tr>
                <th scope="row">Subtotal <span style="color:#797979;">(THB)</span></th>
                <td colspan='5'>0</td>
            </tr>
            <tr>
                <th scope="row">Discount Rate</th>
                <td colspan='5'style="color:#df2637;"><b>20%</b></td>
            </tr>
            <tr>
                <th scope="row">Discount <span style="color:#797979;">(THB)</span></th>
                <td colspan='5'>0</td>
            </tr>
            <tr>
                <th scope="row">Total <span style="color:#797979;">(Including VAT)</span></th>
                <td colspan='5'>0</td>
            </tr>
        </tbody>
    </table>
            <div class="label-a">
                <p>
                    <button type="submit" class="btn px-4 btn-danger" name="login">Close</button>
                    <a class='btn px-4 btn-primary' href="">Confirm</a>
                </p>
            </div>
</div>
<?php
include("../footer.php");
?>