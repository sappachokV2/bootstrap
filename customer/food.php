<?php
include("../header.php");
$_SESSION['restau_id'] = $_GET['restau_id'];
$getdis = "select * from restau_discount where restau_id='{$_SESSION['restau_id']}'";
$query = $mysqli -> query($getdis);
$obj = $query -> fetch_object();
if (isset($obj -> discount_percent) != null) {
    $_SESSION['discountPercent'] = $obj -> discount_percent;
} else {
    $_SESSION['discountPercent'] = 0;
}
?>
    <!-- start show product -->
    <div class='container-fluid mt-2'>
        <div class="row">
            <div class="dropdown">
                <form method="post">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Category
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><button name="AllCate" type="submit" class="dropdown-item">all</butt></li>
                        <?php
                        $cate = "select * from food_cate where restau_id={$_SESSION["restau_id"]}";
                        $query = $mysqli -> query($cate);
                        while ($obj = $query -> fetch_object()) {
                        ?>
                        <li>
                            <a type="submit" href="changeCategory.php?cate_id=<?php echo $obj -> cate_id; ?>" class="dropdown-item"><?php echo $obj -> cate_name; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </form>
                <?php
                if (isset($_POST['AllCate']))
                {
                    $_SESSION['currentFoodCate'] = 9000;
                    header("location: food.php?restau_id={$_SESSION['restau_id']}");
                }
                ?>
            </div>
            <?php
            $sql = "select * from food where restau_id = '{$_SESSION['restau_id']}'";
            if (isset($_SESSION['currentFoodCate']))
            {
                if ($_SESSION['currentFoodCate'] == 9000)
                {
                    $sql = "select * from food where restau_id = '{$_SESSION['restau_id']}'";
                }
                else
                {
                    $sql = "select * from food
                    join food_cate on (food.cate_id = food_cate.cate_id)
                    where food.restau_id = '{$_SESSION['restau_id']}' and food_cate.restau_id = '{$_SESSION['restau_id']}' and food_cate.cate_id = '{$_SESSION['currentFoodCate']}'";
                }
            } else {
                $sql = "select * from food where restau_id = '{$_SESSION['restau_id']}'";
            }
            $result = $mysqli -> query($sql);
            while ($obj = $result -> fetch_object()) {
            ?>
            <div class="col-md-2 card bg-white mt-2 ms-2">
                <img src="<?php echo "../food_img/" . $obj -> picture; ?>" width='100%' height='250' class="img rounded mt-2" alt="delicious?">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $obj -> name; ?></h5>
                    <p class="card-text"><?php echo number_format($obj -> price); ?></p>
                </div>
                <div class="card-footer bg-white ps-0 mb-1">
                    <a class="btn btn-primary" href="add_food.php?foodId=<?php echo $obj -> food_id; ?>&price=<?php echo $obj -> price ?>">Add to Cart</a>
                </div>
            </div>
            <?php } ?>
        </div> 
    </div>
    <!-- end show product -->
<?php
include("../footer.php");
?>