<?php
include_once("header.php");
?>
    <div class="container mt-3">
        <h1>Profile</h1>
        <br>
        <?php
        $sql = "select * from user where user_id='{$_SESSION['user_id']}'";
        $result = $mysqli->query($sql);
        $obj = $result->fetch_object();
        ?>
        <form method="post" enctype="multipart/form-data">
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
                <label>Profile picture</label><br>
                <input type="file" name="picture"><br>
                <?php
                if(isset($obj->picture)) {
                    if (!empty($obj->picture) || !ctype_space($obj->picture))
                    {
                        echo "<img src='profile/".$obj->picture."' alt='delicious?' width='250' height='250'>";
                    }
                }
                ?>
            </p>
            <p>
                <label>Username</label>
                <input type="text" name="user_name" class="form-control form-control-salmon bg-dark text-white" placeholder='<?php if(isset($obj->username)) echo $obj->username; ?>' value="<?php if(isset($obj->username)) echo $obj->username; ?>" readonly>
            </p>     
            <p>
                <label>Full name</label>
                <input type="text" name="full_name" class="form-control form-control-salmon bg-dark text-white" value="<?php if(isset($obj->full_name)) echo $obj->full_name; ?>">
            </p>   
            <p>
                <label>Email</label>
                <input type="text" name="email" class="form-control form-control-salmon bg-dark text-white" value="<?php if(isset($obj->email)) echo $obj->email; ?>">
            </p>    
            <p>
                <label>Address</label>
                <input type="text" name="address" class="form-control form-control-salmon bg-dark text-white" value="<?php if(isset($obj->address)) echo $obj->address; ?>">
            </p>
            <p>
                <label>Telephone</label>
                <input type="text" name="tel" class="form-control form-control-salmon bg-dark text-white" value="<?php if(isset($obj->tel)) echo $obj->tel; ?>">
            </p>
            <?php if ($_SESSION['user_type'] == 'rider') { ?>
            <p>
                <label>Car number</label>
                <input type="text" name="tel" class="form-control form-control-salmon bg-dark text-white" value="<?php if(isset($obj->car_regis_no)) echo $obj->car_regis_no; ?>">
            </p>
            <?php } ?>
            <p class="text-first">
                <button type="submit" name="save" class="btn px-4 btn-primary">Save</button>
            </p>
        </form>
        <?php
        if (isset($_POST['save']))
        {
            $target_dir = "./profile/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            $picture = "KoonBest.png";
            if (isset($obj -> picture))
            {
                if (!empty($obj -> picture) || !ctype_space($obj -> picture))
                {
                    $picture = $obj -> picture;
                }
                else
                {
                    $picture = "KoonBest.png";
                }
            } else {
                $picture = "KoonBest.png";
            }
    
            if (basename($_FILES["picture"]["name"]) != "")
            {
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
                {
                    $picture = basename($_FILES["picture"]["name"]);
                    $_SESSION['picture'] = $picture;
                }
            } 

            $user_id = $_SESSION['user_id'];
            $full_name = $_POST['full_name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $update = "update user set full_name='$full_name', email='$email', tel='$tel', address='$address', picture='$picture' where user_id='$user_id'";
            $isUpdate = $mysqli -> query($update);
            if ($isUpdate)
            {
                $_SESSION['full_name'] = $full_name;
                $_SESSION['address'] = $address;
                $_SESSION['email'] = $email;
                $_SESSION['tel'] = $tel;
                $_SESSION['success'] = "Success!";
                header("location: profile.php");
            }
            else
            {
                $_SESSION['error'] = "Failed!";
                header("location: profile.php");
            }
        }
        ?>
    </div>
<?php
include_once("footer.php");
?>