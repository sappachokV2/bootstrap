<?php
// $mysqli = new mysqli("testmysql", "student02", "mydbpassword");
// mysqli_query($mysqli, "SET NAMES UTF8");
// if ($mysqli -> connect_errno)
// {
//     echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
// }
// $mysqli -> select_db("student02_db") or die("Can't connect to db");
$mysqli = new mysqli("localhost", "root", "");
mysqli_query($mysqli, "SET NAMES UTF8");
if ($mysqli -> connect_errno)
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
}
$mysqli -> select_db("fooddelivery_save") or die("Can't connect to db");

if (isset($_SESSION['user_type']))
{
    if ($_SESSION['user_type'] == "admin")
    {
        define('base_url', 'https://ict.nstru.ac.th/student02/foodnut/admin/');
    } 
    elseif ($_SESSION['user_type'] == "restau_admin")
    {
        define('base_url', 'https://ict.nstru.ac.th/student02/foodnut/restau_admin/');
    } 
    elseif ($_SESSION['user_type'] == "customer")
    {
        define('base_url', 'https://ict.nstru.ac.th/student02/foodnut/customer/');
    } 
    elseif ($_SESSION['user_type'] == "rider")
    {
        define('base_url', 'https://ict.nstru.ac.th/student02/foodnut/rider/');
    }
}
?>