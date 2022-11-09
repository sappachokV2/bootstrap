<?php
include("./database/db_connect.php");
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
            color: white;
        }
    </style>
    <link rel=stylesheet href="style.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
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
                <label>Username</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="text" name="username">
            </p>
            <p>
                <label>Full name</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="text" name="fullname">
            </p>
            <p>
                <label>Email</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="text" name="email">
            </p>
            <p>
                <label>Password</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="password" name="password">
            </p>
            <p>
                <label>Address</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="text" name="address">
            </p>
            <p>
                <label>Tel</label>
                <input class="form-control form-control-salmon bg-dark text-white" type="text" name="tel">
            </p>
            <p>
                <button type="submit" class="btn px-4 btn-primary" name="regis">Register</button>
                <a class="btn px-4 btn-secondary" href='login.php'>Login</a>
            </p>
        </form>
        <?php
            if (isset($_POST['regis']))
            {
                function check_empty($yes, $yes2)
                {
                    if (empty($yes) || ctype_space($yes))
                    {
                        $_SESSION['error'] = "$yes2 can't be empty!"; 
                        header("location: customer_register.php"); 
                        return true;
                    } 
                    return false;
                }

                $user_type = "customer";
                $user_name = $_POST['username'];
                $email = $_POST['email'];
                $full_name = $_POST['fullname'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $password = $_POST['password'];

                $check_sql = "select * from user where username = '$user_name'";
                $check = $mysqli -> query($check_sql);
                if ($check -> num_rows > 0)
                {
                    $_SESSION['error'] = "Username is already exists!";
                    header("location: customer_register.php");
                    return;
                }

                if (check_empty($user_name, "Username")) return;
                if (check_empty($password, "Password")) return;
                if (check_empty($email, "Email")) return;
                if (check_empty($full_name, "Full name")) return;
                if (check_empty($address, "Address")) return;
                if (check_empty($tel, "Tel")) return;

                $sql = "insert user (username, email, user_type, full_name, address, tel, password, status)
                value ('$user_name', '$email', '$user_type', '$full_name', '$address', '$tel', '$password', '0')";
                $result = $mysqli -> query($sql);
                if($result) {
                    $_SESSION['success'] = "Success!";
                    header("location: customer_register.php");
                } else {
                    $_SESSION['error'] = "Failed!";
                    header("location: customer_register.php");
                }
            }
        ?>
    </div>
</body>
</html>