<?php
session_start();
include("../database/db_connect.php");
if (!isset($_GET['cate_id']))
{
    header("location: view_cate.php");
}
$cate_id = $_GET['cate_id'];
$sql = "delete from food_cate where cate_id=$cate_id";
$mysqli -> query($sql);
header("location: view_cate.php");
?>