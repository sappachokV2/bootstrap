<?php
session_start();
unset($_SESSION['calPrice']);
unset($_SESSION['myFood']);
unset($_SESSION['restau_id']);
unset($_SESSION['discountPercent']);
header("location: cart.php");
?>