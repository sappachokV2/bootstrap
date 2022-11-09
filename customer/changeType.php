<?php
session_start();
$id = $_GET['type_id'];
$_SESSION['type_id'] = $id;
header("location: index.php");
?>