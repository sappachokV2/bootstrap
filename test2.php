<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body, html {
        background-color: #303030;
        color: white;
    }
</style>

<?php
include("database/db_connect.php");
?>
<div class='container d-flex align-items-center justify-content-center' style='height: 100%;'>
    <div class='my-auto'>
        <div class='card bg-dark'>
            <div class='card-body'>
                <h3 class='mb-0 p-2 bg-success rounded'>Status -> <span id='NoNutNumber'>Nut</span></h3>
                <img id='sappachok' class='img rounded' style='width: 100%; height: 0;' src="img/sappachok_hd.png" alt="Error">
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('NoNutNumber').innerText = localStorage.getItem("Rdescription");
    setInterval(function() {
        var currentText = document.getElementById('NoNutNumber').innerText;
        if (currentText != localStorage.getItem("Rdescription"))
        {
            document.getElementById('NoNutNumber').innerText = localStorage.getItem("Rdescription");
        }
        if (localStorage.getItem("Rdescription") == "Payment Received")
        {
            document.getElementById('sappachok').style.height = "400px";
        }
        else
        {
            document.getElementById('sappachok').style.height = "0";
        }
    }, 10);
</script>