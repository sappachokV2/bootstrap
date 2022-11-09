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
            margin-left:418px;
            margin-top: -10px;
        }

</style>
    <div class='container-fluid mt-3'>
        <a href='view_discount.php' class="btn btn-success px-2">❮❮</a>
        <h3><b><u>Create Discount <img src="../img/icon_ui/rest-owner.png" height="80px"></u></b></h3>
        <div class="label-j">
            </div>
        </div>
            <div class="label-j">
                <label><b>Discount Percent rate</b></label>
                </div><br>
                <div class="label-e">
                <input class="form-control bg-white text-black" type="text" name="food_name" style="width: 200px;"><span style="margin-top:7px;margin-left:10px;color:#df2637;">%</span>
                <input type="radio" name="status" id="active" style="margin-left:10px;">&nbsp;&nbsp;&nbsp;<span style="margin-top:7px;">Activate</span></input>
                <input type="radio" name="status" id="inactive" style="margin-left:10px;">&nbsp;&nbsp;&nbsp;<span style="margin-top:7px;">Deactivate</input>
                </div>
            </p>
            <div class="label-a">
            <p>
                <button type="submit" class="btn px-4 btn-danger" name="login">Cancel</button>
                <a class='btn px-4 btn-primary' href="">Save</a>
            </p>
            </div>
        <hr>
    </div>
<?php
include("../footer.php");
?>