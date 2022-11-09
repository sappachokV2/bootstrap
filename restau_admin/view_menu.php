<?php
include("../header.php");
?>
<style>
        .label-a { 
            display: flex; 
            font-size: 1.5rem; 
            justify-content: center; 
            align-items: center; 
            height: 100%;
        }
        .label-b {
            display: flex;
            margin-left:80px;
        }
</style>
        <div class='container-fluid mt-3'>
            <a href='index.php' class="btn btn-success px-2">❮❮</a>
            <h3><b><u>Menu List <img src="../img/icon_ui/rest-owner.png" height="80px"></u></b></h3>
        <div class="label-b">
            <a class="btn btn-primary" href="create_menu.php">Create More Menu</a>
        </div>
            <div class="col-md-3 card bg-white mt-2 ms-5">
                <img src="../img/pig.jpg" width='100%' height='250' class="img rounded mt-2" alt="delicious?">
                <div class="card-body">
                    <h5 class="card-title">ซีหมูโบราณ</h5>
                    <p class="card-text">100</p>
                </div>
                <div class="card-footer bg-white ps-0 mb-1">
                    <a class="btn btn-danger" href="" style="margin-left:22px;">Delete Menu</a>
                    <a class="btn btn-primary" href="edit_menu.php" style="margin-left:70px;">Edit Menu</a>
                </div>
            </div>
            </div>
<?php
include("../footer.php");
?>