<?php
$root = __DIR__;
include $root . '/database/db_connect.php';

session_start();
if (isset($_SESSION['login']))
{
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Food</title>
    <style>
        body, html {
            background-color: #303030;
            color: black;
            background: #333333 url(./img/background/backgroundlol.png) no-repeat center center fixed;
            background-size: 100% 100%;
            height: 100vh;
        }
    </style>
    <link rel=stylesheet href="style.css">
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center h-100">
        <div class='col-md-6 my-auto'>
            <h1 class='pb-3' style="text-align:center;color:#f8563e;"><b><u>Sappachok Food Delivery</u></b></h1>
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
                    <h4><u>Sign Up</u></h4>
                </p>
                <p>
                    <label>Username</label>
                    <input class="form-control form-control-salmon bg-dark text-white" type="text" name="user_name">
                </p>
                <p>
                    <label>Password</label>
                    <input class="form-control form-control-salmon bg-dark text-white" type="password" name="password">
                </p>
                <div class="label-a">
                    <p>
                        <button type="submit" class="btn px-4 btn-primary" name="login">Login</button>
                        <a class='btn px-4 btn-secondary' href="register.php">Register</a>
                    </p>
                </div>
            </form>
            <?php
            function session_user($user_id, $username, $user_type, $full_name, $picture, $address, $password, $email, $tel, $car_regis_no, $status)
            {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['picture'] = $picture;
                $_SESSION['address'] = $address;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                $_SESSION['tel'] = $tel;
                $_SESSION['car_regis_no'] = $car_regis_no;
                $_SESSION['status'] = $status; 
            }
            if (isset($_POST['login']))
            {
                function check_empty($yes, $yes2)
                {
                    if (empty($yes) || ctype_space($yes))
                    {
                        $_SESSION['error'] = "$yes2 can't be empty!"; 
                        header("location: login.php"); 
                        return true;
                    } 
                    return false;
                }
                
                $username = $_POST['user_name'];
                $password = $_POST['password'];

                if (check_empty($username, "Username")) return;
                if (check_empty($password, "Password")) return;

                $sql = "select * from user where username = '$username' and password = '$password'";
                $result = $mysqli -> query($sql);
                $obj = $result -> fetch_object();

                if ($result -> num_rows > 0)
                {
                    $userType = $obj -> user_type;
                    $status = $obj -> status;
                    if ($userType == "admin" and $status != 0) // admin
                    {
                        session_user($obj -> user_id, $obj -> username, $obj -> user_type, $obj -> full_name, $obj -> picture, $obj -> address, $obj -> password, $obj -> email, $obj -> tel, $obj -> car_regis_no, $obj -> status);
                        header("location: admin/index.php"); 
                    }
                    else if ($userType == "customer" and $status != 0) // customer
                    {
                        session_user($obj -> user_id, $obj -> username, $obj -> user_type, $obj -> full_name, $obj -> picture, $obj -> address, $obj -> password, $obj -> email, $obj -> tel, $obj -> car_regis_no, $obj -> status);
                        header("location: customer/index.php"); 
                    }
                    else if ($userType == "restau_admin" and $status != 0) // restaurant admin
                    {
                        session_user($obj -> user_id, $obj -> username, $obj -> user_type, $obj -> full_name, $obj -> picture, $obj -> address, $obj -> password, $obj -> email, $obj -> tel, $obj -> car_regis_no, $obj -> status);
                        header("location: restau_admin/index.php"); 
                    }
                    else if ($userType == "rider" and $status != 0) // sappachok rider
                    {
                        session_user($obj -> user_id, $obj -> username, $obj -> user_type, $obj -> full_name, $obj -> picture, $obj -> address, $obj -> password, $obj -> email, $obj -> tel, $obj -> car_regis_no, $obj -> status);
                        header("location: rider/index.php"); 
                    }
                    else if ($status == 0)
                    {
                        $_SESSION['error'] = "Inactive!";
                        header("location: login.php"); 
                    }
                }
                else
                {
                    $_SESSION['error'] = "Invalid!";
                    header("location: login.php");                
                }
            }
            ?>
        </div> 
    </div>
</body>
</html>