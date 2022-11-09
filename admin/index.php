<?php
include("../header.php");
?>
<style>
    body, html {
        height: 90vh;
    }
</style>
<div class='container d-flex align-items-center justify-content-center' style='height: 100%;'>
    <div class='card'>
        <div class='card-body'>
            <p>
                <a class='px-4 btn btn-lg btn-primary' href='edit_restaurant.php'>Edit restaurant</a>
            </p>
            <p>
                <a class='px-4 btn btn-lg btn-warning' href='edit_user.php'>Edit user</a>
            </p>
            <p class='mb-0'>
                <!-- <a class='px-4 btn btn-lg btn-success' href='create_restau_type.php'>Create restaurant type</a> -->
                <a class='px-4 btn btn-lg btn-success' href='edit_restau_type.php'>Edit restaurant type</a>
            </p>
        </div>
    </div>
</div>
<?php
include("../footer.php");
?>