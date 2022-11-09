<?php
$root = __DIR__;
include($root . '/database/db_connect.php');
session_start();
ob_start();
define('BASE_URL', 'http://localhost/foodNut/');
if (!isset($_SESSION['login']))
{
    header("location: " . BASE_URL . "login.php");
}
function changeLocate($location = null)
{
    if ($_SESSION['user_type'] == "admin")
    {
        echo BASE_URL . "admin/" . $location;
    } 
    elseif ($_SESSION['user_type'] == "restau_admin")
    {
        echo BASE_URL . "restau_admin/" . $location;
    } 
    elseif ($_SESSION['user_type'] == "customer")
    {
        echo BASE_URL . "customer/" . $location;
    } 
    elseif ($_SESSION['user_type'] == "rider")
    {
        echo BASE_URL . "rider/" . $location;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'bootstrap/dist/css/bootstrap.min.css';?>">
    <script src="<?php echo BASE_URL . 'bootstrap/dist/js/bootstrap.min.js';?>"></script>
    <script src="<?php echo BASE_URL . 'bootstrap/dist/js/bootstrap.bundle.min.js';?>"></script>

    <!-- Font Awesome -->
    <!-- <link rel=stylesheet href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css"> -->
    <title>Food</title>
    <style>
        body, html {
            background-color: #f7f7f7;
            color: black;
        }
    </style>
    <link rel=stylesheet href="<?php echo BASE_URL . "style.css"; ?>">
</head>
<body>
    <nav class="navbar navbar-dark bg-danger sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php changeLocate() ?>">Sappachok's Food</a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-lg-0">
                <li><a href="<?php changeLocate(); ?>" class="nav-link px-2 text-white">Home</a></li>
                <?php if ($_SESSION['user_type'] == 'customer') { ?>
                    <li><a href="<?php changeLocate("history.php"); ?>" class="nav-link px-2 text-white">History</a></li>
                <?php } ?>
                <?php if ($_SESSION['user_type'] == 'customer') { ?>
                    <li><a href="<?php changeLocate("cart.php"); ?>" class="nav-link px-2 text-white">Cart</a></li>
                <?php } ?>
                <?php if ($_SESSION['user_type'] == 'restau_admin') { ?>
                    <li><a href="<?php changeLocate('order.php'); ?>" class="nav-link px-2 text-white">Order</a></li>
                    <li><a href="<?php changeLocate('earn.php'); ?>" class="nav-link px-2 text-white">Income</a></li>

                    <div class="btn-group">
                        <a href="#" class="nav-link dropdown-toggle px-2 text-white" data-bs-toggle="dropdown">Manage</a>
                        <ul class="dropdown-menu dropdown-menu-sm-start dropdown-menu-lg-end dropdown-menu-dark">
                            <li><a class="dropdown-item" href="manage_restaurant.php">Restaurant</a></li>
                            <li><a class="dropdown-item" href="view_cate.php">Food Category</a></li>
                            <li><a class="dropdown-item" href="view_discount.php">Discount</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </ul>
            <form class="d-flex" method="post">
                <!-- <input class="form-control form-control-salmon me-2 text-dark" type="search" placeholder="Restaurant" aria-label="Search">
                <button name="Search" class="btn btn-outline-warning me-2" type="submit">Search</button> -->
                <p class='text-white my-auto me-2'><?php echo $_SESSION['username']; ?></p>
                <div class="btn-group">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <?php
                        if (isset($_SESSION['picture']))
                        {
                            if (!empty($_SESSION['picture']) || !ctype_space($_SESSION['picture']))
                            { ?>
                                <img src="<?php echo BASE_URL . 'profile/' . $_SESSION['picture']; ?>" alt="delicious?" width="35" height="35" class="rounded-circle">
                            <?php } else { ?>
                                <img src="<?php echo BASE_URL . 'img/KoonBest.png'; ?>" alt="delicious?" width="35" height="35" class="rounded-circle">
                            <?php }
                        }
                        else
                        { ?>
                            <img src="<?php echo BASE_URL . 'img/KoonBest.png'; ?>" alt="delicious?" width="35" height="35" class="rounded-circle">
                        <?php } ?>   
                    </a>
                    <ul class="dropdown-menu dropdown-menu-sm-start dropdown-menu-lg-end dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL . 'profile.php'; ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL . 'change_password.php'; ?>">Change password</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL . 'logout.php'; ?>">Logout</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </nav>