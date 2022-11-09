<?php
include("../header.php");
$restau = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
$query = $mysqli -> query($restau);
if (!$query -> num_rows > 0)
{
    header("location: create_restaurant.php");
    return;
}
$obj = $query -> fetch_object();
?>
<div class='container-fluid mt-3'>
    <a href='index.php' class="btn btn-success px-2">❮❮</a>
    <h3><b><u>Restaurant's Category <img src="../img/icon_ui/rest-owner.png" width="80px" height="80px"></u></b></h3>
    <a class="btn btn-primary" href="create_cate.php">Create More Category</a>
    <div class="container-fluid row">
    <?php
        $sql = "select * from food_cate where restau_id={$_SESSION['restau_id']}";
        $query = $mysqli -> query($sql);
        while ($obj = $query -> fetch_object()) {
        ?>
            <div class="col-md-5 card bg-white mt-2 me-2">
                <div class="card-body">
                    <h5 class='card-title my-2'>Category</h5>
                    <h5 class="card-subtitle text-muted"><?php echo $obj -> cate_name; ?></h5>
                </div>
                <div class="card-footer bg-white ps-0 mb-1">
                <a class="btn btn-primary" href="edit_cate.php?cate_id=<?php echo $obj -> cate_id; ?>">Edit Category</a>
                    <a class="btn btn-danger" href="delete_cate.php?cate_id=<?php echo $obj -> cate_id; ?>" >Delete Category</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include("../footer.php");
?>