<?php
include("../database/db_connect.php");
$user_id = $_GET['user_id'];
$sql = "select * from user where user_id=$user_id";
$query = $mysqli -> query($sql);
$obj = $query -> fetch_object();
if ($query and $obj -> status == 0) {
    $update = "update user set status = 1 where user_id=$user_id";
    $mysqli -> query($update);
} else if ($query and $obj -> status != 0) {
    $update = "update user set status = 0 where user_id=$user_id";
    $mysqli -> query($update);
}

header("location: edit_user.php");
?>