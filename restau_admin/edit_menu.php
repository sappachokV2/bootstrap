<?php
include("../header.php");
?>
<style>
        .label-t { 
            display: flex; 
            font-size: 1.5rem; 
            justify-content: center; 
            align-items: center; 
            height: 100%;
            margin-top: -20px;
        }
        .label-a { 
            display: flex; 
            font-size: 1.5rem; 
            justify-content: center; 
            align-items: center; 
            height: 100%;
        }
        .label-j {
            display: flex;
            margin-left:320px;
        }
        .label-e {
            display: flex;
            margin-left:410px;
        }

</style>

        <div class='container-fluid mt-3'>
            <a href='view_menu.php' class="btn btn-success px-2">❮❮</a>
            <h3><b><u>Edit Menu <img src="../img/icon_ui/rest-owner.png" height="80px"></u></b></h3>
            <form method="post">
            <div class="label-j">
                <label><b>Food picture</b></label><br>
            </div>
                <div class="label-e">
                <input type="file" name="picture" style="margin-left:10px;"><br>
                <?php
                if(isset($obj->picture)) {
                    if (!empty($obj->picture) || !ctype_space($obj->picture))
                    {
                        echo "<img src='profile/".$obj->picture."' alt='delicious?' width='250' height='250'>";
                    }
                }
                ?>
            </div>
            <div class="label-j">
                <label><b>Food Name</b></label>
                </div><br>
                <div class="label-t">
                <input class="form-control bg-white text-black" type="text" name="food_name" style="width: 500px;">
                </div>
            </p>
            <p>
            <div class="label-j">
                <label><b>Food's Category</b></label><br>
            </div>
                <div class="label-e">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" style="margin-left:10px;">
                Category
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                        <li><button name="AllCate" type="submit" class="dropdown-item">all</butt></li>
                </ul>
                </div>
            </p>
            <div class="label-a">
            <p>
                <button type="submit" class="btn px-4 btn-danger" name="delete">Delete</button>
                <a class='btn px-4 btn-primary' href="">Save</a>
            </p>
            </div>
        </div>
<?php
include("../footer.php");
?>