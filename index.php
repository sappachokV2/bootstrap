<?php
session_start();
if (!isset($_SESSION['login']))
{
    header("location: login.php");
}
if ($_SESSION['user_type'] == "admin")
{
    header("location: admin/index.php");
} 
elseif ($_SESSION['user_type'] == "restau_admin")
{
    header("location: restau_admin/index.php");
} 
elseif ($_SESSION['user_type'] == "customer")
{
    header("location: customer/index.php");
} 
elseif ($_SESSION['user_type'] == "rider")
{
    header("location: rider/index.php");
}
?>