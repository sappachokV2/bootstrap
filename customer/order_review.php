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
        .label-l {
            display: flex;
            margin-left:540px;
        }

</style>

        <div class='container-fluid mt-3'>
            <a href='#.php' class="btn btn-success px-2">❮❮</a>
            <h3><b><u>Food Review</u> <img src="../img/icon_ui/review.png" height="50px"></b></h3>
            <form method="post">
            <div class="label-j">
                <label><b>Order ID</b></label>
            </div>
            <div class="label-e">
                <input class="form-control bg-white text-black" type="text" name="food_name" style="width: 200px;margin-bottom:10px;" readonly>
            </div>
            <div class="label-j">
                <label><b>Customer's Name</b></label>
            </div>
            <div class="label-e">
                <input class="form-control bg-white text-black" type="text" name="food_name" style="width: 500px;margin-top:10px;margin-bottom:10px;">
            </div>
            <div class="label-j">
                <label><b>Restaurant's Name</b></label>
            </div>
            <div class="label-e">
                <input class="form-control bg-white text-black" type="text" name="food_name" style="width: 500px;margin-top:10px;margin-bottom:10px;">
            </div>
            <div class="label-j">
                <label><b>Star Rating</b></label>
            </div>
            <div class="label-l">
                <img src="../img/icon_ui/star-selected.png" height="35px">
                <img src="../img/icon_ui/star-selected.png" height="35px" style="margin-left:10px;">
                <img src="../img/icon_ui/star-selected.png" height="35px" style="margin-left:10px;">
                <img src="../img/icon_ui/star-selected.png" height="35px" style="margin-left:10px;">
                <img src="../img/icon_ui/star-unselect.png" height="35px" style="margin-left:10px;">
            </div> <!--make the star clickable-->
            <div class="label-j">
                <label><b>Review Comment</b></label>
            </div><br>
            <div class="label-t">
                <textarea class="form-control bg-white text-black" name="user_review" style="width: 500px;height:100px;margin-top:10px;"></textarea>
            </div>
            </p>
            <p>
            <div class="label-a">
            <p>
                <button type="submit" class="btn px-4 btn-danger" name="">Cancel</button>
                <a class='btn px-4 btn-primary' href="">Post</a>
            </p>
            </div>
            <hr>
        </div>
<?php
include("../footer.php");
?>