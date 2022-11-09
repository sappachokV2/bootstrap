<?php
include("../header.php");
$restau = "select * from restau where restau_admin_id={$_SESSION['user_id']}";
$query = $mysqli -> query($restau);
$restau_id = $query -> fetch_object() -> restau_id;

$food_id = $_GET['food_id'];
$yesfood = "select * from food where food_id=$food_id";
$yesquery = $mysqli -> query($yesfood);
$yesobj = $yesquery -> fetch_object(); 
$_SESSION['cate_id'] = $yesobj -> cate_id;
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

            <?php
                if(isset($yesobj -> picture)) {
                    if (!empty($yesobj->picture) || !ctype_space($yesobj->picture))
                    {
                        echo "<img class='rounded' src='../food_img/".$yesobj->picture."' alt='delicious?' width='250' height='250'>";
                    }
                }
            ?>
            <p>
                <?php
                    // Both worked
                    $sql = "select * from food_cate
                    join restau on (restau.restau_id = food_cate.restau_id)
                    where restau.restau_admin_id={$_SESSION['user_id']}";
                    // Same result
                    $sql = "select * from food_cate 
                    where restau_id in (
                        select restau_id from restau where restau_admin_id = {$_SESSION['user_id']}
                    )";
                    $query = $mysqli -> query($sql);

                    if (isset($_SESSION['cate_id']))
                    {
                        $cate = "select * from food_cate where cate_id={$_SESSION['cate_id']}";
                        $queryC = $mysqli -> query($cate);
                        $cateObj = $queryC -> fetch_object();
                    }
                ?>          
                <select name="SelectCate" class='col-md-4 form-select mt-2 bg-dark text-white w-auto'>
                    <?php
                        while ($obj = $query -> fetch_object())
                        { $cate_id = $obj -> cate_id; ?>
                            <option value="<?php echo $obj -> cate_id; ?>"><?php echo $obj -> cate_name; ?></option>
                    <?php } ?>
                </select>  
            </p>
            <p>
                <label>Picture</label>
                <input name='picture' type="file" class='form-control form-control-salmon bg-dark text-white'>
            </p>
            <p>
                <label>Name</label>
                <input name='name' value='<?php echo $yesobj -> name; ?>' type="text" class='form-control form-control-salmon bg-dark text-white'>
            </p>
            <p>
                <label>Price</label>
                <input name='price' value='<?php echo $yesobj -> price; ?>' type="number" min="0" class='form-control form-control-salmon bg-dark text-white'>
            </p>
            <p>
                <button type='submit' name='create' class='btn btn-primary px-4'>Save</button>
                <button type='submit' name='cancel' class='btn btn-danger ms-2 px-4'>Cancel</button>
            </p>
        </form>
        <?php
        if (isset($_POST['create'])) {
            $cate = $_POST['SelectCate'];
            echo $cate;
        }
        ?>
    </div>
</div>
<?php
include("../footer.php");
?>