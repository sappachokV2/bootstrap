<?php
include("../header.php");
?>
<style>
    body, html {
        height: 90vh;
    }
</style>
<div class='container d-flex align-items-center justify-content-center' style='height: 100%;'>
    <div class='col-12 col-sm-10 col-md-7' style='min-width: 60%;'>
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
                    <h4 class='card-text'>Create restaurant type</h4>
                </div>
                <div class='card-body'>
                    <p class='mt-2'>
                        <label>Restaurant type</label>
                        <input name='type_name' type="text" class='form-control mt-2'>
                    </p>
                </div>
                <div class='card-footer px-2'>
                    <button type='submit' name='create' class='btn btn-primary'>Create</button>
                    <a href='index.php' class='btn btn-danger'>Cancel</a>
                </div>
            </form>
            <?php
            if (isset($_POST['create']))
            {
                function check_empty($yes, $yes2)
                {
                    if (empty($yes) || ctype_space($yes))
                    {
                        $_SESSION['error'] = "$yes2 can't be empty!"; 
                        header("location: create_restau_type.php"); 
                        return true;
                    } 
                    return false;
                }
                if (check_empty($_POST['type_name'], 'Type name')) return;

                $type_name = $_POST['type_name'];

                $check = "select * from restau_type where type_name='$type_name'";
                if ($mysqli -> query($check) -> num_rows > 0)
                {
                    $_SESSION['error'] = "Already exists!";
                    header("location: create_restau_type.php");
                    return;
                }

                $sql = "insert restau_type (type_name) value ('$type_name')";
                $result = $mysqli -> query($sql);
                if ($result) {
                    $_SESSION['success'] = "Success!";
                }
                else
                {
                    $_SESSION['error'] = "Failed!";
                }
                header("location: create_restau_type.php");
            }
            ?>
        </div>
    </div>
</div>
<?php
include("../footer.php");
?>