<?php
include("../header.php");
?>
<div class='container-fluid mt-3 px-3 table-responsive'>
    <div class='row'>
        <!-- <div class='p-1 pt-0 mb-2'>
            <a href='create_restaurant.php' class='btn btn-success'>Create restaurant</a>
        </div> -->
        <?php
            $sql = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
            $query = $mysqli -> query($sql);
            if ($query -> num_rows > 0) {
                $obj = $query -> fetch_object();
                $restau_id = $obj -> restau_id;

                $_SESSION['restau_id'] = $obj -> restau_id;
                $_SESSION['restau_name'] = $obj -> restau_name;
                $_SESSION['restau_type'] = $obj -> type_id;
                $_SESSION['restau_admin_id'] = $obj -> restau_admin_id;
                $_SESSION['status'] = $obj -> status;
        ?>
                <div class='p-1 pt-0 mb-2'>
                    <a href='add_food.php' class='btn btn-success'>Add menu</a>
                </div>
        <?php } else { ?>
                <div class='p-1 pt-0 mb-2'>
                    <a href='create_restaurant.php' class='btn btn-success'>Create restaurant</a>
                </div>
        <?php } ?>

        <?php
        if (isset($restau_id))
        {
            // $sql = "select * from food where restau_id=$restau_id";
            $sql = "select * from food
            join food_cate on (food.restau_id = food_cate.restau_id)
            where food.cate_id = food_cate.cate_id and  food.restau_id=$restau_id and food_cate.restau_id=$restau_id";
            $query = $mysqli -> query($sql);
            while ($obj = $query -> fetch_object()) {
        ?>
            <div class='col-md-2' style='min-width: 20rem;'>
                <div class='card'>
                    <div class='card-header p-2 m-0'>
                        <img src="../food_img/<?php echo $obj -> picture; ?>" class='w-100 rounded' height='250' alt="">
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title'>Name: <?php echo $obj -> name; ?></h5>
                        <h5 class='card-text'>Category: <?php echo $obj -> cate_name; ?></h5>
                    </div>
                    <div class='card-footer px-2'>
                        <div class='d-flex'>
                            <a href='edit_food.php?food_id=<?php echo $obj -> food_id; ?>' class='btn btn-primary me-2'>Edit</a>
                            <a href='delete_food.php?food_id=<?php echo $obj -> food_id; ?>' class='btn btn-danger'>delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>
</div>
<?php
include("../footer.php");
?>