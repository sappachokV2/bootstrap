<?php
include("../header.php");
$id = $_GET['id'];
$sql = "select * from restau_type where id=$id";
$query = $mysqli -> query($sql);
$obj = $query -> fetch_object();
?>
<style>
    body, html {
        height: 90vh;
    }
</style>
<div class='container d-flex align-items-center justify-content-center' style='height: 100%;'>
    <div class='col-12 col-sm-10 col-md-7' style='min-width: 60%'>
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
        <div class='card'>
            <form method='post'>
                <div class='card-header'>
                    <h4 class='card-text'>Edit restaurant type</h4>
                </div>
                <div class='card-body'>
                    <p class='mt-2'>
                        <label>Restaurant type</label>
                        <input name='type_name' value='<?php echo $obj -> type_name; ?>' type="text" class='form-control mt-2'>
                    </p>
                </div>
                <div class='card-footer px-2'>
                    <button type='submit' name='edit' class='btn btn-primary px-5'>Edit</button>
                    <a href='index.php' class='btn btn-danger px-5'>Cancel</a>
                </div>
            </form>
            <?php
            if (isset($_POST['edit']))
            {
                $type_name = $_POST['type_name'];
                $sql = "update restau_type set type_name='$type_name'";
                $result = $mysqli -> query($sql);
                if ($result) {
                    $_SESSION['success'] = "Success!";
                }
                else
                {
                    $_SESSION['error'] = "Failed!";
                }
                header("location: manage_restau_type.php?id=$id");
            }
            ?>
        </div>
    </div>
</div>
<?php
include("../footer.php");
?>