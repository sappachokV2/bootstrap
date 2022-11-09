<?php
include("../header.php");
$order_id = $_GET['order_id'];
?>
<div class='container d-flex align-items-center justify-content-center' style='height: 90vh;'>
    <div class='my-auto'>
        <form method='post'>
            <div class='card bg-dark'>
            <h4 class='card-header bg-primary text-white'>Payment method <?php if (isset($_SESSION['payment'])) { echo $_SESSION['payment']; unset($_SESSION['payment']); } ?></h4>
                <div class='card-body'>
                    <div class="row gap-2 mx-auto">
                        <input type="radio" class="btn-check" name="Payment" value="Cash" id="AAA" checked>
                        <label class="btn btn-outline-success px-5 " for="AAA">Cash</label>

                        <input type="radio" class="btn-check" name="Payment" value="Credit card" id="BBB">
                        <label class="btn btn-outline-primary px-5" for="BBB">Credit card</label>
                    </div>
                </div>
                <div class='card-footer px-0 mx-2'>
                    <div class='d-grid'>
                        <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                        <?php
                        if (isset($_POST['submit']))
                        {
                            header('location: history.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include("../footer.php");
?>