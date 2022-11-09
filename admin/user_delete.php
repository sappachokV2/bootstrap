<?php
include("../database/db_connect.php");

$user_id = $_GET['user_id'];
$sql = "delete from user where user_id=$user_id";
$mysqli -> query($sql);

header("location: edit_user.php");
?>