<?php
include("../header.php");
if (!isset($_SESSION['type_id']))
{
    $_SESSION['type_id'] = 9000;
}
?>
    <div class='container-fluid mt-3'>
        <div class='container col-md-6'>
            <form method='post'>
                <div class="input-group mb-2">
                    <input name="keyword" type="text" class="form-control form-control-salmon text-dark" placeholder="Restaurant">
                    <button name="search" type="submit" class="btn btn-outline-warning" type="button">Search</button>
                </div>
            </form>
        </div>

        <div class='row mb-2'>
            <div class='dropdown'>
                <button class='dropdown-toggle btn btn-secondary' data-bs-toggle='dropdown'>Type</button>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li><a href='changeType.php?type_id=9000' class='dropdown-item'>All</a></li>
                    <?php
                    $sql = "select * from restau_type";
                    $query = $mysqli -> query($sql);
                    while ($obj = $query -> fetch_object())
                    { ?>
                        <li><a href='changeType.php?type_id=<?php echo $obj -> id; ?>' class='dropdown-item'><?php echo $obj -> type_name; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class='row'>
            <?php function ShowRestaurants($obj, $error = false) { ?>
                <div class="col-md-2 card bg-white ms-2 mb-2" style="width: 18rem;">
                    <div class="card-body">
                        <?php if($error) { ?>
                            <div class='container alert alert-danger py-0'>Clear your cart for more restaurant.</div>
                        <?php } ?>
                        <h5 class="card-title"><?php echo $obj -> restau_name; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Id: <?php echo $obj -> restau_id; ?></h6>
                        <p class="card-text">Address: <?php echo $obj -> restau_address; ?></p>
                    </div>
                    <div class="card-footer ps-0 bg-white">
                        <a class='btn px-4 py-1 btn-primary' href='food.php?restau_id=<?php echo $obj -> restau_id; ?>'>Visit</a>
                    </div>
                </div>
            <?php } ?>
            <?php
            if (isset($_POST['search']))
            {
                $keyword = $_POST['keyword'];
                $sql = "select * from restau where restau_name like '%$keyword%' and status != 0";
                $query = $mysqli -> query($sql);
                while ($obj = $query -> fetch_object()) { 
                    ShowRestaurants($obj);
                } 
            } 
            else if (!isset($_POST['search']))
            {
                $sql = "select * from restau where status != 0";
                $query = $mysqli -> query($sql);
                while ($obj = $query -> fetch_object()) {
                    if ($_SESSION['type_id'] != 9000 && $obj -> type_id == $_SESSION['type_id']) {
                        ShowRestaurants($obj);
                    } else if ($_SESSION['type_id'] == 9000) {
                        ShowRestaurants($obj);
                    }
                }
            }
            ?>
        </div>
    </div>
<?php
include("../footer.php");
?>