<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body, html {
        background-color: #303030;
        color: white;
        height: 100%;
    }
</style>

<?php
include("database/db_connect.php");
?>
<div class='container d-flex align-items-center justify-content-center' style='height: 100%;'>
    <div class='my-auto'>
        <div class='card bg-dark'>
            <div class='card-body'>
                <form class='mb-0' method='post'>
                    <button onclick='YesNotNot()' type='submit' name='YesNot' class='btn btn-primary'>Random number</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function YesNotNot()
    {
        localStorage.setItem("NoNot", <?php echo rand(349172, 491829428719); ?>); 
    }
</script>