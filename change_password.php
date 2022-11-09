<?php
include("header.php");
?>
    <div class="container" style="margin-top: 20px;">
        <h1>Change password</h1>
        <br>
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
                <label>Old Password</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="password" name="old_password">
            </p>
            <p>
                <label>New Password</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="password" name="new_password">
            </p>
            <p>
                <button type="submit" class="btn px-4 btn-primary" name="change">Change</button>
            </p>
        </form>
        <?php
        if (isset($_POST['change']))
        {
            function check_empty($yes, $yes2)
            {
                if (empty($yes) || ctype_space($yes))
                {
                    $_SESSION['error'] = "$yes2 can't be empty!"; 
                    header("location: change_password.php"); 
                    return true;
                } 
                return false;
            }
            
            $userid = $_SESSION['user_id'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $mypass = $_SESSION['password'];

            if (check_empty($old_password, "Old Password")) return;
            if (check_empty($new_password, "New Password")) return;

            if ($old_password == $mypass)
            {
                $sql = "update user set password='$new_password' where user_id='$userid'";
                $result = $mysqli -> query($sql);
                if ($result)
                {
                    $_SESSION['success'] = "Success!";
                    header('location: change_password.php');
                }
                else
                {
                    $_SESSION['error'] = "Failed!";
                    header("location: change_password.php");                
                }
            }
            else
            {
                $_SESSION['error'] = "Password doesn't match!";
                header("location: change_password.php");
            }
        }
        ?>
    </div>
<?php
include("footer.php");
?>