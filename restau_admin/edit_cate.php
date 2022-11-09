<?php
include("../header.php");
$restau = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
$query = $mysqli -> query($restau);
if (!$query -> num_rows > 0)
{
    header("location: create_restaurant.php");
    return;
}
if (!isset($_GET['cate_id']))
{
    header("location: view_cate.php");
}
$cate_id = $_GET['cate_id'];
$sql = "select* from food_cate where cate_id=$cate_id";
$query = $mysqli -> query($sql);
$obj = $query -> fetch_object();
$cate_name = $obj -> cate_name;
?>

<div class='container-fluid mt-3'>
    <a href='view_cate.php' class="btn btn-success px-2">❮❮</a>
    <h3><b><u>Create Category <img src="../img/icon_ui/rest-owner.png" height="80px"></u></b></h3>
    <div class='container col-md-6'>
        <form method="post">
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
            <p>
                <label><b>Category Name</b></label>
                <input name='cate_name' value='<?php echo $cate_name; ?>' class="form-control form-control-salmon bg-white text-black" type="text" name="food_name">
            </p>
            <p>
                <button type='submit' class='btn px-4 btn-primary' name='edit'>Edit</button>
                <a href='view_cate.php' class="btn px-4 btn-danger" name="cancel">Cancel</a>
            </p>
        </form>
        <?php
        if (isset($_POST['edit']))
        {
            $cate_name = $_POST['cate_name'];
            function check_empty($yes, $yes2)
            {
                if (empty($yes) || ctype_space($yes))
                {
                    $_SESSION['error'] = "$yes2 can't be empty!"; 
                    header("location: create_cate.php"); 
                    return true;
                } 
                return false;
            }
            if (check_empty($cate_name, "Cate name")) return;
            $sql = "update food_cate set cate_name='$cate_name' where cate_id='$cate_id'";
            $query = $mysqli -> query($sql);
            if ($query)
            {
                $_SESSION['success'] = "Success!";
                header("location: edit_cate.php?cate_id=$cate_id");
            }
            else
            {
                $_SESSION['error'] = "Failed!";
                header("location: edit_cate.php?cate_id=$cate_id");
            }
        }
        ?>
    </div>
</div>

<?php
include("../footer.php");
?>