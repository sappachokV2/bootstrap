<?php
include("../database/db_connect.php");
$food_id = $_GET['food_id'];
$sql = "delete from food where food_id=$food_id";
$mysqli -> query($sql);
header("location: index.php");
?>