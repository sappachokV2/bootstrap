<?php
include("../header.php");
if (!isset($_SESSION['type_id'])) {
    $_SESSION['type_id'] = 1;
}
$restau = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
$query = $mysqli -> query($restau);
if (!$query -> num_rows > 0)
{
    header("location: create_restaurant.php");
    return;
}
$obj = $query -> fetch_object();
$restau_id = $obj -> restau_id;
$restau_name = $obj -> restau_name;
$restau_address = $obj -> restau_address;
$restau_admin_id = $_SESSION['user_id'];
$type_id = $obj -> type_id;
$status = $obj -> status; 
$_SESSION['type_id'] = $type_id;
?>
<style>
    body, html {
        height: 90vh;
        background-color: #303030;
        color: white;
    }
</style>
<div class='container-fluid d-flex align-items-center justify-content-center' style='height: 100%;'>
    <div class='col-7 my-auto'>
        <form method="post" enctype='multipart/form-data'>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger pb-2 pt-2">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success pb-2 pt-2">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if ($obj -> status == 0) { ?>
                <div class='alert alert-danger'>Status: Inactive</div>
            <?php } ?>
            <?php if ($obj -> status == 1) { ?>
                <div class='alert alert-success'>Status: Active</div>
            <?php } ?>
            <p>
                <div class='dropdown'>
                    <?php
                        $sql = "select * from restau_type";
                        $query = $mysqli -> query($sql);

                        $type = "select * from restau_type where id = {$type_id}";
                        $type_query = $mysqli -> query($type);
                        $typeObj = $type_query  -> fetch_object();
                    ?>
                    <button class='dropdown-toggle btn btn-secondary' data-bs-toggle='dropdown'>Restaurant Type: <?php echo $typeObj -> type_name; ?></button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <?php
                        while ($obj = $query -> fetch_object())
                        { ?>
                            <li><a href='changeType.php?type_id=<?php echo $obj -> id; ?>' class='dropdown-item'><?php echo $obj -> type_name; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>      
            </p>
            <p>
                <label>Restaurant name</label>
                <input name='name' type="text" value="<?php echo $restau_name; ?>" class='form-control form-control-salmon bg-dark text-white'>
            </p>
            <p>
                <label>Address</label>
                <input name='address' type="text" value="<?php echo $restau_address; ?>" class='form-control form-control-salmon bg-dark text-white'>
            </p>
            <p>
                <button type='submit' name='save' class='btn btn-primary px-4'>Save</button>
                <button type='submit' name='cancel' class='btn btn-danger ms-2 px-4'>Cancel</button>
            </p>
        </form>
        <?php
        if (isset($_POST['save'])) {
            $restau_name = $_POST['name'];
            $restau_address = $_POST['address'];
            $restau_admin_id = $_SESSION['user_id'];
            $type_id = $_SESSION['type_id'];

            $sql = "update restau set restau_name='$restau_name', restau_address='$restau_address', type_id=$type_id where restau_admin_id=$restau_admin_id";
            $mysqli -> query($sql);
            unset($_SESSION['type_id']);
            header("location: index.php");
        }
        if (isset($_POST['cancel'])) {
            unset($_SESSION['type_id']);
            header("location: index.php");
        }
        ?>
    </div>
</div>
<?php
include("../footer.php");
?>