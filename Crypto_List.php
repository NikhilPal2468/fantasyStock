<?php
require 'connection.php';
// define variables and set to empty values

$Game_Id = $_GET['gid'];
$User_Id = $_COOKIE['User_Id'];
$stock_Id = "";


if (!empty($_POST['selected_stock'])) {

    $checkbox1 = $_POST['selected_stock'];
    $selected_stock = "";
    foreach ($checkbox1 as $chk1) {
        $selected_stock .= $chk1 . ",";
    }
} else {
    $selected_stock = null;
}

$selected_stock = "-(" . $selected_stock . ")";


 $query4 = "SELECT * FROM users where User_Id =$User_Id";
           $run4=mysqli_query($connect,$query4);
        $row4=mysqli_fetch_array($run4);
$Player_Coin=$row4['Coins'];        
$Player_Coin=explode("??", $Player_Coin);
$Profile_Image=$row4['Profile_Image'];
$Notification=$row4['Notification'];
$Game_History=$row4['Game_History'];
$Coins_Left=0;
 $query1 = "SELECT Coins_To_Enter FROM live_game where Game_Id=$Game_Id";
           $run1=mysqli_query($connect,$query1);
        $row1=mysqli_fetch_array($run1);
$Coins_To_Enter=$row1['Coins_To_Enter'];      
?>
<style>

</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="header_and_footer_4.css">
</head>

<body>
    <style type="text/css">
    
        .main-div {
            height:auto;
            width: 100%;
            /* background-color: pink; */
            margin-top: 80px;
            margin-bottom:60px;
        }

        @media screen and (max-width: 700px) {
            .main-div {
                margin-top: 50px;
            }
        }


        .title {
            background-color: #ffffff;
            background-image: linear-gradient(315deg, #ffffff 0%, #d7e1ec 74%);
           /* background-color: #e8e8e8; */
/*background-image: linear-gradient(147deg, #923cb5 0%, #000000 74%);
color: white;*/
            font-size: 100px;
        }
        .title p
        {
            margin-left: 20%;

        }

            @media screen and (max-width: 1200px) {
                .title {
                    text-align: center;
                     width: 100%;

                }

                .title p
        {
            margin-left: 0;

        }


            }

        @media screen and (max-width: 700px) {
            .title {
                font-size: 50px;
                width: 100%;
            }
        }
        .game-type-selection {
            margin-top: 50px;
            margin-left: 300px;
        }

        .game-type-selection button {
            border: none;
            padding: 10px;
            font-size: 20px;
        }

        @media screen and (max-width: 700px) {
            .game-type-selection {
                margin-top: 30px;
                margin-left: 10px;
            }
        }

        .game-area {
background-color: #e056fd;
background-image: linear-gradient(315deg, #9b0ab9 0%, #391d75 95%);
            position: inherit;
            display: flex;
            flex-direction: row;
            /* flex-wrap: wrap; */
            width: 75%;
            height: auto;
            margin-left: 20%;
            margin-top: 50px;
        }

@media screen and (max-width: 1200px) {
            .game-area {

                            width: 100%;
                height: auto;
                margin-top: 50px;
                overflow: auto;
                white-space: nowrap;
                margin-left: 0;
        }
    }


        .inputGroup {
            background-color: #fff;
            display: block;
            margin: 10px 0;
            /* position: inherit; */
        }

        .inputGroup label {
            padding: 12px 30px;
            width: 100%;
            display: block;
            text-align: left;
            color: #3C454C;
            cursor: pointer;
            position: relative;
            z-index: 2;
            transition: color 200ms ease-in;
            overflow: hidden;
        }

        .inputGroup label:before {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            content: "";
            background-color: #5562eb;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale3d(1, 1, 1);
            transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            z-index: -1;
        }

        .inputGroup label:after {
            width: 32px;
            height: 32px;
            content: "";
            border: 2px solid #D1D7DC;
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
            background-repeat: no-repeat;
            background-position: 2px 3px;
            border-radius: 50%;
            z-index: 2;
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            transition: all 200ms ease-in;
        }

        .inputGroup input:checked~label {
            color: #fff;
        }

        .inputGroup input:checked~label:before {
            transform: translate(-50%, -50%) scale3d(56, 56, 1);
            opacity: 1;
        }

        .inputGroup input:checked~label:after {
            background-color: #54E0C7;
            border-color: #54E0C7;
        }

        .inputGroup input {
            width: 32px;
            height: 32px;
            order: 1;
            z-index: 2;
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            visibility: hidden;
        }








        .wrapper {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 400px;
            margin: 50vh auto 0;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .switch_box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            max-width: 200px;
            min-width: 200px;
            height: 200px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        /* Switch 1 Specific Styles Start */

        .box_1 {
            background: #eee;
        }

        input[type="checkbox"].switch_1 {
            font-size: 30px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 3.5em;
            height: 1.5em;
            background: #ddd;
            border-radius: 3em;
            position: relative;
            cursor: pointer;
            outline: none;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        input[type="checkbox"].switch_1:checked {
            background: #0ebeff;
        }

        input[type="checkbox"].switch_1:after {
            position: absolute;
            content: "";
            width: 1.5em;
            height: 1.5em;
            border-radius: 50%;
            background: #fff;
            -webkit-box-shadow: 0 0 .25em rgba(0, 0, 0, .3);
            box-shadow: 0 0 .25em rgba(0, 0, 0, .3);
            -webkit-transform: scale(.7);
            transform: scale(.7);
            left: 0;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        input[type="checkbox"].switch_1:checked:after {
            left: calc(100% - 1.5em);
        }

        /* Switch 1 Specific Style End */


        /* Switch 2 Specific Style Start */

        .box_2 {
            background: #666;
        }

        input[type="checkbox"].switch_2 {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 100px;
            height: 8px;
            background: #444;
            border-radius: 5px;
            position: relative;
            outline: 0;
            cursor: pointer;
        }

        input[type="checkbox"].switch_2:before,
        input[type="checkbox"].switch_2:after {
            position: absolute;
            content: "";
            -webkit-transition: all .25s;
            transition: all .25s;
        }

        input[type="checkbox"].switch_2:before {
            width: 40px;
            height: 40px;
            background: #ccc;
            border: 5px solid #666;
            border-radius: 50%;
            top: 50%;
            left: 0;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        input[type="checkbox"].switch_2:after {
            width: 30px;
            height: 30px;
            background: #666;
            border-radius: 50%;
            top: 50%;
            left: 10px;
            -webkit-transform: scale(1) translateY(-50%);
            transform: scale(1) translateY(-50%);
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
        }

        input[type="checkbox"].switch_2:checked:before {
            left: calc(100% - 35px);
        }

        input[type="checkbox"].switch_2:checked:after {
            left: 75px;
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        /* Switch 2 Specific Style End */


        /* Switch 3 Specific Style Start */

        .box_3 {
            background: #19232b;
        }

        .toggle_switch {
            width: 100px;
            height: 45px;
            position: relative;
        }

        input[type="checkbox"].switch_3 {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            outline: 0;
            z-index: 1;
        }

        svg.checkbox .outer-ring {
            stroke-dasharray: 375;
            stroke-dashoffset: 375;
            -webkit-animation: resetRing .35s ease-in-out forwards;
            animation: resetRing .35s ease-in-out forwards;
        }

        input[type="checkbox"].switch_3:checked+svg.checkbox .outer-ring {
            -webkit-animation: animateRing .35s ease-in-out forwards;
            animation: animateRing .35s ease-in-out forwards;
        }

        input[type="checkbox"].switch_3:checked+svg.checkbox .is_checked {
            opacity: 1;
            -webkit-transform: translateX(0) rotate(0deg);
            transform: translateX(0) rotate(0deg);
        }

        input[type="checkbox"].switch_3:checked+svg.checkbox .is_unchecked {
            opacity: 0;
            -webkit-transform: translateX(-200%) rotate(180deg);
            transform: translateX(-200%) rotate(180deg);
        }


        svg.checkbox {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        svg.checkbox .is_checked {
            opacity: 0;
            fill: yellow;
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            -webkit-transform: translateX(200%) rotate(45deg);
            transform: translateX(200%) rotate(45deg);
            -webkit-transition: all .35s;
            transition: all .35s;
        }

        svg.checkbox .is_unchecked {
            opacity: 1;
            fill: #fff;
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            -webkit-transform: translateX(0) rotate(0deg);
            transform: translateX(0) rotate(0deg);
            -webkit-transition: all .35s;
            transition: all .35s;
        }

        @-webkit-keyframes animateRing {
            to {
                stroke-dashoffset: 0;
                stroke: #b0aa28;
            }
        }

        @keyframes animateRing {
            to {
                stroke-dashoffset: 0;
                stroke: #b0aa28;
            }
        }

        @-webkit-keyframes resetRing {
            to {
                stroke-dashoffset: 0;
                stroke: #233043;
            }
        }

        @keyframes resetRing {
            to {
                stroke-dashoffset: 0;
                stroke: #233043;
            }
        }

        /* Switch 3 Specific Style End */


        /* Switch 4 Specific Style Start */

        .box_4 {
            background: #eee;
        }

        .input_wrapper {
            width: 80px;
            height: 40px;
            position: relative;
            cursor: pointer;
        }

        .input_wrapper input[type="checkbox"] {
            width: 80px;
            height: 40px;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: darkgray;
            border-radius: 30px;
            position: relative;
            outline: 0;
            -webkit-transition: all .2s;
            transition: all .2s;
        }

        .input_wrapper input[type="checkbox"]:after {
            position: absolute;
            content: "";
            top: 3px;
            left: 3px;
            width: 34px;
            height: 34px;
            background: #dfeaec;
            z-index: 2;
            border-radius: 30px;
            -webkit-transition: all .35s;
            transition: all .35s;
        }

        .input_wrapper svg {
            position: absolute;
            top: 50%;
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            fill: #fff;
            -webkit-transition: all .35s;
            transition: all .35s;
            z-index: 1;
        }

        .input_wrapper .is_checked {
            width: 18px;
            left: 18%;
            -webkit-transform: translateX(190%) translateY(-30%) scale(0);
            transform: translateX(190%) translateY(-30%) scale(0);
        }

        .input_wrapper .is_unchecked {
            width: 15px;
            right: 10%;
            -webkit-transform: translateX(0) translateY(-30%) scale(1);
            transform: translateX(0) translateY(-30%) scale(1);
        }

        /* Checked State */
        .input_wrapper input[type="checkbox"]:checked {
            background-color: #7f53ac;
background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);


        }

        .input_wrapper input[type="checkbox"]:checked:after {
            left: calc(100% - 37px);
        }

        .input_wrapper input[type="checkbox"]:checked+.is_checked {
            -webkit-transform: translateX(0) translateY(-30%) scale(1);
            transform: translateX(0) translateY(-30%) scale(1);
        }

        .input_wrapper input[type="checkbox"]:checked~.is_unchecked {
            -webkit-transform: translateX(-190%) translateY(-30%) scale(0);
            transform: translateX(-190%) translateY(-30%) scale(0);
        }

        /* Switch 4 Specific Style End */





        .listnames {
            background-color: white;
            /* border: 2px solid black; */
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            height: 75px;
            align-items: center;
            padding: 10px;
            margin: 10px;
        }

        label {
            font-size: 25px;
        }

        #submit-btn {
            background-color: grey;

            padding: 12px;
            border-radius: 26px;
            font-size: 25px;
            cursor: not-allowed;
            color: white;
            text-align: center;
        }

        .labelList {
            background-color: #fff;
            display: block;
            margin: 10px 0;
            width: 800px;
        }

        .labelList label {
            padding: 12px 30px;
            width: 100%;
            display: block;
            text-align: left;
            color: #3C454C;
            cursor: pointer;
            position: relative;
            font-size: 22px;
            z-index: 2;
            transition: color 200ms ease-in;
            overflow: hidden;
        }

        @media screen and (max-width: 700px) {
            .labelList {
                width: 325px;
            }

            .labelList label {
                padding: 15px 15px;
                font-size: 17px;
            }
        }

        .Stock-Specificatons {
            width: 65%;
            text-align: center;
            /* background-color: blue; */
            float:left;

        }

        .Stock-price {
            text-align: right;
            float: left;
            width: 50%;
            /* background-color: red; */
        }

        .Stock-name {
            float: left;
            width: 50%;
            /* background-color: green; */
        }

        @media screen and (max-width: 700px) {

            .Stock-price {
                text-align: left;
                float: none;
            }

            .Stock-name {
                float: none;
                text-align: left;
                width: 50%;
            }

        }
        
        
        
        /*CSS for New Header for Mobile*/
        
        
        #header-mobile{
            display: none;
        }
        
            @media screen and (max-width: 1200px) and (min-width: 900px) {
         #logo{
            width:6%;
        }
        #header-space{
            width: 73%;
        }
        }
        @media screen and (max-width: 1200px) {
        
        #header{
        display: none;
        }
        #header-mobile
        {
        display:block;
        height: 80px;
        width: 100%;
        top: 0;
        background-image: url('assets/bgspace.jpg');
         background-repeat: no-repeat;
           background-size:cover;
           background-position: center;
           position: fixed;
           z-index: 10;
        }
        #logo-arrow{
            color:white;
        margin-top: 20px;
        margin-left: 10px;
        transform: rotate(180deg);
        }
         #logo-arrow img{
             width:45px;
             height:40px;
         }
        }
        @media screen and (max-width: 900px) {
        #header-mobile
        {
        height: 60px;
        }
        #logo-arrow{
        margin-top: 12px;
        width:40px;
        }
         #logo-arrow img{
             width:40px;
             height:35px;
         }
        }
        @media screen and (max-width: 500px) {
        #header-mobile
        {
        height: 50px;
        }
        #logo-arrow{
        margin-top: 10px;
         width:30px;    
        }
          #logo-arrow img{
             width:35px;
             height:30px;
         }
        }
        @media screen and (max-width: 450px) {
        .input_wrapper input[type="checkbox"]:checked:after {
            left: calc(100% - 28px);
        }
        .input_wrapper input[type="checkbox"]:after {
                width: 23px;
            height: 23px;
            }
            .input_wrapper input[type="checkbox"] {
            width: 60px;
            height: 30px;
        }
        .input_wrapper {
        margin-top: 10px;
        }
        }
        
            .Stock-chart{
            width: 25%;
            text-align: right;
            float: left;
        }
       
         @media screen and (max-width: 400px) {
            .labelList label {
                padding: 0;

         }
     }

         @media screen and (max-width: 320px) {
         .Stock-chart{
            width: 33%;
           }

     }
        
    </style>

    </head>

    <body>
        
        <div id="header" style="background-size:cover;">
<div id="logo">
      <img src="karrotlogo2.png" class="active" id="nav-logo" />
</div>
<div id="header-space">

</div>
<div id="header-money">
<p><?php echo $Player_Coin[0];?></p>
</div>
<div id="header-profile-image">
<img src="<?php echo $Profile_Image;?>">
</div>
<div id="header-bell-icon">
<div id="notif" onclick="displaylastgame()" class="notification" style="display: flex; justify-content: center; align-items: center;">
                <div class="_13lGWV5zrZ" style="cursor: pointer;">
                   
                        <button onclick="Notification_function()" style=" border: none;background: none;">
                            <?php 
                            if($Notification==0 || $Notification==NULL)
                        {?>
                   <img src="assets/bell_icon2.png">
                <?php }?>
                            <?php 
                            if($Notification==1)
                        {
                            ?>
                          <img src="assets/bell_icon2_red.png">
                          <?php } ?>
                </button>
                </div>
                <div id="notif-content">
                    <div class="dontknow">
     <table>                  
      <?php
$Game_History;

$i = $pos2 = 0;    
if(!empty($Game_History)){
do {
        $pos2 = strpos( $Game_History, "</tr>", $pos2+1 );
} while( $i++ < 2);

$Game_History2=substr($Game_History,0, $pos2);
 echo $Game_History2;
}
else
echo null;

?>
</table>
                    </div>
                </div>
            </div>
</div>


</div>

<!-- New Header for Mobile  -->





 <div id="header-mobile" style="background-size:cover;">
<div id="logo">
    <a href="crypto.php" style="text-decoration: none;">
<p id="logo-arrow">
    <img src="assets/back-button4.png">
<!--&#8617;-->
<!-- &#8630; -->
<!-- &#10525; -->
</p>
</a>
</div>
<div id="header-space">

</div>
<div id="header-money">

</div>
<div id="header-bell-icon">
<div id="notif" onclick="displaylastgame()" class="notification" style="display: flex; justify-content: center; align-items: center;">
         
            </div>
</div>

<div id="header-profile-image">
<img src="<?php echo $Profile_Image;?>">
</div>
</div>


<!-- End of New Header for Mobile  -->




<div class="main-div">
        <div class="navbar">
            <a href="nsebse.php">
                
      <img src="assets/games_selected.png" width="40px" height="40px" class="navbar-icon">
      <p style="color:#a200e4;">Games</p>
  </a>
            <a href="blog.php"><img src="assets/blog_unselected.png" width="40px" height="40px" class="navbar-icon"><p>Blogs</p></a>
            <a href="profile.php"><img src="assets/user_unselected.png" height="35px" width="37px" class="navbar-icon">
                <p>Profile</p>
            </a>
    </div>
            <div class="right-main">
                <div class="title">
                  <p> Select Crypto</p>
                </div>
                <div class="game-area">
                    <?php
                    for ($i = 1; $i <= 20; $i++) {


                        $query = "SELECT * FROM crypto_list where unique_id =$i";
                        $run = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($run);
                        $Stock_Name = $row['Stock_Name'];
                        $Stock_Price = $row['Stock_Price'];
                        $Stock5 = $row['Unique_Id'];
                        $Stock_Price_Previous = $row['Stock_Price_Previous'];
                        


                        $Stock_Price_Change=$Stock_Price-$Stock_Price_Previous;
                        $Stock_Price_Percentage_Change=($Stock_Price_Change/$Stock_Price_Previous)*100;
                        $Stock_Price_Percentage_Change=round($Stock_Price_Percentage_Change,2);
                       if ($Stock_Price_Percentage_Change < 0) {
                            $Stock_chart ="assets/chart_down.png";
                            $Stock_Price_Percentage_Change = "<span style='color:red;'>" . $Stock_Price_Percentage_Change . "&#8595;</span>";
                        }
                        else if ($Stock_Price_Percentage_Change == 0) {
                            $Stock_chart ="assets/chart_up.png";
                            $Stock_Price_Percentage_Change =  $Stock_Price_Percentage_Change;
                        }
                        else {
                            $Stock_chart ="assets/chart_up.png";
                            $Stock_Price_Percentage_Change = "<span style='color:green;'>" . $Stock_Price_Percentage_Change . "&#8593;</span>";
                        }
                    ?>
                        <form style="width: 95%; margin: 8px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?gid=<?php echo $Game_Id ?>&uid=<?php echo $User_Id ?>" method="post">
                            <div class="listnames">
                                <div class="labelList">

                                    <label for="<?php echo $i; ?>">
                                        <div class="Stock-Specificatons">
                                            <div class="Stock-name">
                                                <?php
                                                echo $Stock_Name; 
                                                ?>
                                            </div>
                                            <div class="Stock-price">
                                                <?php
                                                 echo $Stock_Price," / ",$Stock_Price_Percentage_Change, "<br>";
                                                ?>


                                          </div>
                                        </div>
                                            <div class="Stock-chart">
                                            <img src="<?php echo $Stock_chart; ?>" width="30px">
                                            </div>
                                            </label>
                                </div>
                                <div class="input_wrapper">

                                    <input type="checkbox" class="check-box" onclick="checkboxes()" name="selected_stock[]" id="<?php echo $i; ?>" value="<?php echo $Stock5; ?>">
                                </div>
                            </div>
                        <?php
                    }
                        ?>
                        <?php 

if(empty($Player_Coin[1])){
$Player_Coin[1]=0;
}


$Total_Coins_Of_Player=(float)$Player_Coin[0]+(float)$Player_Coin[1];

$Bonus_Coins_Left=(float)$Player_Coin[1]-$Coins_To_Enter;
if($Bonus_Coins_Left<0){
    $Coins_Left1=(float)$Player_Coin[0]+(float)$Bonus_Coins_Left;
$Coins_Left=$Coins_Left1."??"."0";
}
else{
$Coins_Left=$Player_Coin[0]."??".$Bonus_Coins_Left;
}


 if ($Total_Coins_Of_Player >=$Coins_To_Enter)
            { 
       ?>  
               <div class="submit" style="text-align: center;">
 
                <a href="crypto.php">
     <input id="submit-btn" type="submit" class="submit-btn" name="submit" value="submit" disabled></input>
          </a>
      </div>
<?php 
} 
 
else
 {
    ?>
                        <div style="text-align: center;">
                             <a href="#">
                        <input id="submit-btn" type="submit" disabled></input>
                            </a>

                        </div>

<?php 
 }

?>
                        </form>
                </div>
            </div>
        </div>



    </body>

</html>

<script>
    function checkboxes() {
        let submitButton = document.getElementById("submit-btn");
        let input = document.querySelectorAll(`input[type="checkbox"]`)
        let inputwr = document.getElementsByClassName("input_wrapper")
        let checkBox = document.getElementsByClassName("check-box");

        var cnt = document.querySelectorAll('input[type="checkbox"]:checked').length;
        var total = input.length;
        if (cnt == 5) {
            submitButton.disabled = false;
            submitButton.style.backgroundColor = "black";
            submitButton.style.cursor = "pointer";
            for (var i = 0; i < total; i++) {
                if (input[i].type == "checkbox" && input[i].checked == false) {
                    // label[i].style.display = "none";
                    inputwr[i].style.display = "none";
                    checkBox[i].disabled = true;
                    // input[i].style.display = "none";
                    // labelBefore[i].style.display = "none";
                }
            }

        } else {
            submitButton.disabled = true;
            submitButton.style.backgroundColor = "grey";
            submitButton.style.cursor = "not-allowed";
            for (var i = 0; i < total; i++) {
                if (input[i].type == "checkbox") {
                    // input[i].style.display = "block";
                    inputwr[i].style.display = "block";
                    checkBox[i].disabled = false;
                }
            }

        }
    }
</script>

<script>
function Notification_function() {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      this.responseText;
    }
  };
  request.open("GET", "Notification_check.php", true);
  request.send();
}
</script>
<script>
    function displaylastgame()
    {
        if(document.getElementById('notif-content').style.display == "block")
        document.getElementById('notif-content').style.display = "none";
        else
        document.getElementById('notif-content').style.display = "block";
    }
    document.getElementById('notif')
</script>
<?php

$query1 = "SELECT Stocks_Selected,Entering_Position,Players,Max_Players FROM live_game where Game_Id =$Game_Id";
$run1 = mysqli_query($connect, $query1);
$row1 = mysqli_fetch_array($run1);
$Previous = $row1['Stocks_Selected'];
$Position = $row1['Entering_Position'];
$Previous_Players = $row1['Players'];
$selected_stock = $Previous . $selected_stock;
//echo $selected_stock;

$Commas = substr_count($Position, ",");
$Commas = number_format($Commas) + 1;
$Commas2 = $Position . (string)$Commas . ",";
$Player = $Previous_Players . $User_Id . ",";




$query2 = "SELECT * FROM users where User_Id =$User_Id";
$run2 = mysqli_query($connect, $query2);
$row2 = mysqli_fetch_array($run2);
$User_Pos = $row2['Live_game'];
$User_Pos = $User_Pos . "%#" . $Game_Id . "=>" . $Commas;



if (isset($_POST['submit'])) {

$Max_Players = $row1['Max_Players'];
$Players = $row1['Players'];

//echo $Players;


$No_of_playes_available=substr_count($Players,",");





if($No_of_playes_available<$Max_Players){
    if (mysqli_query($connect, "update live_game set Stocks_Selected='$selected_stock',Entering_Position='$Commas2',Players='$Player' where Game_Id =$Game_Id") && mysqli_query($connect, "update users set Live_game='$User_Pos',Coins='$Coins_Left' where User_Id  =$User_Id")) {
        echo("<script>location.href = 'https://karrotlive.com/crypto.php';</script>");
       
    } 
    else {
        echo "<script>alert('not done')</script>";
    }
}
else{
 echo "<script>alert('Sorry! Game is already full')</script>";

}

}



?>