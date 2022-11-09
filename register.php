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
            height: 100vh;
            width: 100%;
        }
        .container {
            height: 100%;
        }
    </style>
    <link rel=stylesheet href="style.css">
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div>
            <h1>Register</h1>
            <br>
            <p>
                <a class='btn px-5 btn-primary' href='customer_register.php'>Customer register</a>
            </p>
            <p>
                <a class='btn px-5 btn-success' href='restaurant_register.php'>Restaurant register</a>
            </p>
            <p>
                <a class='btn px-5 btn-danger' href='rider_register.php'>Rider register</a>
            </p>
            <p>
                <a class='btn px-5 btn-secondary' href='login.php'>Login</a>
            </p>
        </div>
    </div>
</body>
</html>