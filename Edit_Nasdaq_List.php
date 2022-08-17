<?php
require 'connection.php';

date_default_timezone_set('Asia/Kolkata');

$Game_Id = $_GET['gid'];
$User_Id = $_COOKIE['User_Id'];
$query4 = "SELECT * FROM users where User_Id =$User_Id";
$run4 = mysqli_query($connect, $query4);
$row4 = mysqli_fetch_array($run4);


$isEmailConfirmed = $row4['isEmailConfirmed'];
if ($isEmailConfirmed == 1) {
    $Player_Coin = $row4['Coins'];
    $Player_Coin = explode("??", $Player_Coin);
    $Profile_Image = $row4['Profile_Image'];
    $Notification = $row4['Notification'];
    $Game_History = $row4['Game_History'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="header_and_footer_5.css">
    </head>
    <style type="text/css">
        .main-div {
            height: auto;
            width: 100%;
            /* background-color: pink; */
            margin-top: 80px;
            margin-bottom: 60px;
        }

        @media screen and (max-width: 1200px) {
            .main-div {
                margin-bottom: 60px;
            }
        }

        @media screen and (max-width: 900px) {
            .main-div {
                margin-top: 60px;
            }
        }

        @media screen and (max-width: 500px) {
            .main-div {
                margin-top: 50px;
            }
        }

        .title {
            background-color: #ffffff;
            background-image: linear-gradient(315deg, #ffffff 0%, #d7e1ec 74%);
            font-size: 80px;
        }

        .title p {
            margin-left: 20%;

        }

        @media screen and (max-width: 1200px) {
            .title {
                text-align: center;
                width: 100%;
                font-size: 60px;

            }

            .title p {
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

        .game-area2 {
            background-color: #e056fd;
            background-image: linear-gradient(315deg, #9b0ab9 0%, #391d75 95%);
            position: inherit;
            width: 75%;
            height: auto;
            margin-left: 20%;
            margin-top: 50px;
            text-align: right;
        }

        @media screen and (max-width: 1200px) {
            .game-area2 {

                width: 100%;
                height: auto;
                margin-top: 50px;
                overflow: auto;
                white-space: nowrap;
                margin-left: 0;
                text-align: center;
            }
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
            width: 150px;
            height: 40px;
            position: relative;

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
            background-color: #3b35d4;
            border: none;
            padding: 8px;
            border-radius: 7px;
            font-size: 25px;
            cursor: not-allowed;
            color: white;
            background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
            text-align: center;
            box-shadow: 5px 5px 15px 5px #5e5eef;
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
            position: relative;
            font-size: 22px;
            z-index: 2;
            transition: color 200ms ease-in;
            overflow: hidden;
        }

        @media screen and (max-width: 900px) {
            .labelList {
                width: 490px;
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
            float: left;

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


        #header-mobile {
            display: none;
        }

        @media screen and (max-width: 1200px) and (min-width: 900px) {
            #logo {
                width: 6%;
            }

            #header-space {
                width: 73%;
            }
        }

        @media screen and (max-width: 1200px) {

            #header {
                display: none;
            }

            #header-mobile {
                display: block;
                height: 80px;
                width: 100%;
                top: 0;
                background-image: url('assets/bgspace.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                position: fixed;
                z-index: 10;
            }

            #logo-arrow {
                color: white;
                margin-top: 20px;
                margin-left: 10px;
                transform: rotate(180deg);
            }

            #logo-arrow img {
                width: 45px;
                height: 40px;
            }
        }

        @media screen and (max-width: 900px) {
            #header-mobile {
                height: 60px;
            }

            #logo-arrow {
                margin-top: 12px;
                width: 40px;
            }

            #logo-arrow img {
                width: 40px;
                height: 35px;
            }
        }

        @media screen and (max-width: 500px) {
            #header-mobile {
                height: 50px;
            }

            #logo-arrow {
                margin-top: 10px;
                width: 30px;
            }

            #logo-arrow img {
                width: 35px;
                height: 30px;
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


        .Stock-chart {
            width: 25%;
            text-align: right;
            float: left;
        }

        .Stock-chart img {
            cursor: pointer;
        }

        @media screen and (max-width: 400px) {
            .labelList label {
                padding: 0;

            }
        }

        @media screen and (max-width: 320px) {
            .Stock-chart {
                width: 33%;
            }

        }


        #searchbar {
            padding: 10px;
            border-radius: 8px;
            margin: 10px 10px;
            width: 50%;
            border: 0;
        }

        @media screen and (max-width: 1200px) {
            #searchbar {
                width: 80%;
            }

        }

        @media screen and (max-width: 1200px) {
            body a {
                cursor: default;
            }

            .input_wrapper input[type="checkbox"] {
                cursor: default;
            }

            .Stock-chart img {
                cursor: default;
            }

            .Stock-chart a {
                cursor: default;
            }
        }

        .submit2 {
            bottom: 56px;
            display: flex;
            align-items: center;
            position: fixed;
            /* background: blue; */
            /* border: 2px solid black; */
            width: 80%;
            z-index: 100;
            text-align: center;
            justify-content: space-around;
            color: white;
            height: 76px;
            margin: 10px 0px;
        }

        .submit {
            display: flex;
            align-items: center;
            position: fixed;
            bottom: 0px;
            background: white;
            background-image: url('assets/list_footer_background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            border: 1px solid black;
            width: 75%;
            z-index: 100;
            text-align: center;
            justify-content: space-around;
            color: white;
            height: 60px;
            /* box-shadow: 5px 10px #888888; */
            /* box-shadow: -5px -5px 30px 5px purple, 5px 5px 30px 5px blue; */
        }

        .submit img {
            height: 45px;
            width: 45px;
            border-radius: 40px;
            /*opacity: 0.3;*/
        }

        .submit svg {
            height: 45px;
            width: 45px;
            border-radius: 40px;
        }

        @media screen and (max-width: 1200px) {
            #searchbar {
                width: 80%;
            }

            .submit {
                width: 100%;
            }

            .submit2 {
                width: 100%;
            }
        }

        #selected1 {
            height: 45px;
            width: 45px;
            /* border: 2px solid black; */
            border-radius: 40px;
        }

        #selected2 {
            height: 45px;
            width: 45px;
            /* border: 2px solid black; */
            border-radius: 40px;
        }

        #selected3 {
            height: 45px;
            width: 45px;
            /* border: 2px solid black; */
            border-radius: 40px;
        }

        #selected4 {
            height: 45px;
            width: 45px;
            /* border: 2px solid black; */
            border-radius: 40px;
        }

        #selected5 {
            height: 45px;
            width: 45px;
            /* border: 2px solid black; */
            border-radius: 40px;
        }

        #selected6 {
            height: 40px;
            width: 40px;
            border: 2px solid red;
            border-radius: 10px;
            display: none;
        }

        #selected7 {
            height: 40px;
            width: 40px;
            border: 2px solid red;
            border-radius: 10px;
            display: none;
        }
    </style>

    <body>
        <div id="header" style="background-size:cover;">
            <div id="logo">
                <img src="karrotlogo2.png" class="active" id="nav-logo" />
            </div>
            <div id="header-space">

            </div>
            <div id="header-money">
                <p><?php echo $Player_Coin[0] + $Player_Coin[1]; ?></p>
            </div>
            <div id="header-profile-image">
                <a href="profile.php"><img src="<?php echo $Profile_Image; ?>"></a>
            </div>
            <div id="header-bell-icon">
                <div id="notif" onclick="displaylastgame()" class="notification" style="display: flex; justify-content: center; align-items: center;">
                    <div class="_13lGWV5zrZ">

                        <button onclick="Notification_function()" style=" border: none;background: none;">
                            <?php
                            if ($Notification == 0 || $Notification == NULL) { ?>
                                <img src="assets/bell_icon2.png">
                            <?php } ?>
                            <?php
                            if ($Notification == 1) {
                            ?>
                                <img src="assets/bell_icon2_red.png">
                            <?php } ?>
                        </button>
                    </div>
                    <div id="notif-content">
                        <div class="dontknow">
                            <table>
                                <tr>
                                    <th>Time</th>
                                    <th>Rank</th>
                                    <th>Reward</th>
                                </tr>
                                <?php
                                $Game_History;

                                $i = $pos2 = 0;
                                if (!empty($Game_History)) {
                                    do {
                                        $pos2 = strpos($Game_History, "</tr>", $pos2 + 1);
                                    } while ($i++ < 2);

                                    $Game_History2 = substr($Game_History, 0, $pos2);
                                    echo $Game_History2;
                                } else
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
                <a href="nasdaq.php" style="text-decoration: none;">
                    <p id="logo-arrow">
                        <img src="assets/back-button4.png">
                        <!-- &#8630; -->
                        <!-- &#10525; -->
                        <!--&#8617;-->
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
                <a href="profile.php"><img src="<?php echo $Profile_Image; ?>"></a>
            </div>
        </div>


        <!-- End of New Header for Mobile  -->


        <div class="main-div" onclick="removenotificationtable()">
            <div class="navbar">
                <a href="nsebse.php">

                    <img src="assets/games_selected.png" width="40px" height="40px" class="navbar-icon">
                    <p style="color:#a200e4;">Games</p>
                </a>
                <a href="blog.php"><img src="assets/blog_unselected.png" width="40px" height="40px" class="navbar-icon">
                    <p>Blogs</p>
                </a>
                <a href="profile.php"><img src="assets/user_unselected.png" height="35px" width="37px" class="navbar-icon">
                    <p>Profile</p>
                </a>
            </div>
            <div class="right-main">
                <div class="title">
                    <p>Edit Stocks</p>
                </div>
                <div class="game-area2">
                    <input id="searchbar" oninput="search_stock()" type="text" name="search" placeholder="Search stocks..">
                </div>
                <div class="game-area">
                    <?php
                    $stock_Id = "";
                    $query2 = "SELECT * FROM live_game where Game_Id =$Game_Id";
                    $run2 = mysqli_query($connect, $query2);
                    $row2 = mysqli_fetch_array($run2);
                    $Previous_Selected_Stocks = $row2['Stocks_Selected'];
                    $Players = $row2['Players'];
                    $Entering_Position = $row2['Entering_Position'];

                    $Start_Time = $row2['Start_Time'];


                    $Players = explode($User_Id, $Players);
                    $No_of_comma = substr_count($Players[0], ",");
                    $Position = (int)$No_of_comma + 1;
                    // echo $Previous_Selected_Stocks . "<br>";
                    $pattern2 = "/[-]/";
                    $components = preg_split($pattern2, $Previous_Selected_Stocks);
                    // echo $components[$Position] . "<br>";
                    // print_r($components[0]);
                    // echo "<br>";
                    // print_r($components[1]);
                    // echo "<br>";
                    // print_r($components[2]);
                    // echo "<br>";
                    $b = explode("(", $components[$Position]);
                    $b = explode(")", $b[1]);
                    $b = explode(",", $b[0]);
                    $c = $b;
                    // print_r($c);
                    // $c=array(2, 3,4);
                    if (!empty($_POST['selected_stock'])) {

                        $checkbox1 = $_POST['selected_stock'];
                        $selected_stock = "";
                        foreach ($checkbox1 as $chk1) {
                            $selected_stock .= $chk1 . ",";
                        }
                    } else {
                        $selected_stock = null;
                    }
                    $selected_stock = "(" . $selected_stock . ")";
                    $components[$Position] = $selected_stock;
                    $t = implode("-", $components);
                    $Stock_Images = array();
                    for ($i = 1; $i <= 25; $i++) {
                        $query = "SELECT * FROM nasdaq_list where Unique_Id =$i";
                        $run = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($run);
                        $Stock_Name = $row['Stock_Name'];
                        $Stock_Price = $row['Stock_Price'];
                        // $Stock3 = $row['Stock_Price_Change'];
                        // $Stock4 = $row['Stock_Percentage_Change'];
                        $Stock5 = $row['Unique_Id'];
                        $Stock_Price_Previous = $row['Stock_Price_Previous'];
                        $Stock_chart_url = $row['Stock_chart'];
                        $Stock_Image = $row['Stock_Image'];
                        array_push($Stock_Images, $Stock_Image);



                        $Stock_Price_Change = $Stock_Price - $Stock_Price_Previous;
                        $Stock_Price_Percentage_Change = ($Stock_Price_Change / $Stock_Price_Previous) * 100;
                        $Stock_Price_Percentage_Change = round($Stock_Price_Percentage_Change, 2);
                        if ($Stock_Price_Percentage_Change < 0) {
                            $Stock_chart = "assets/chart_down.png";
                            $Stock_Price_Percentage_Change = "<span style='color:red;'>" . $Stock_Price_Percentage_Change . "&#8595;</span>";
                        } else if ($Stock_Price_Percentage_Change == 0) {
                            $Stock_chart = "assets/chart_up.png";
                            $Stock_Price_Percentage_Change =  $Stock_Price_Percentage_Change;
                        } else {
                            $Stock_chart = "assets/chart_up.png";
                            $Stock_Price_Percentage_Change = "<span style='color:green;'>" . $Stock_Price_Percentage_Change . "&#8593;</span>";
                        }
                    ?>
                        <form style="width: 98%; margin: 1%;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?gid=<?php echo $Game_Id ?>&uid=<?php echo $User_Id ?>" method="post">
                            <div class="listnames">
                                <div class="labelList">

                                    <label for="<?php echo $i; ?>">
                                        <div class="Stock-Specificatons">
                                            <div class="Stock-name">
                                                <?php echo $Stock_Name; ?>
                                            </div>
                                            <div class="Stock-price">
                                                <?php
                                                echo $Stock_Price, " / ", $Stock_Price_Percentage_Change, "<br>";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="Stock-chart">
                                            <a href="<?php echo $Stock_chart_url; ?>">
                                                <img src="<?php echo $Stock_chart; ?>" width="30px"></a>
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
                        <div class="submit">
                            <div id="selected1">
                                <img src="assets/backimage.jpeg" alt="profile">

                            </div>
                            <div id="selected2">
                                <img src="assets/backimage.jpeg" alt="profile">

                            </div>
                            <div id="selected3">
                                <img src="assets/backimage.jpeg" alt="profile">

                            </div>
                            <div id="selected4">
                                <img src="assets/backimage.jpeg" alt="profile">

                            </div>
                            <div id="selected5">
                                <img src="assets/backimage.jpeg" alt="profile">

                            </div>
                            <div id="selected6">

                            </div>
                            <div id="selected7">

                            </div>
                        </div>
                        <div class="submit2" id="submit-button-display" style="display: none;pointer-events:none;">
                            <a href="nasdaq.php">
                                <input id="submit-btn" type="submit" class="submit-btn" name="submit" value="submit" disabled style="pointer-events:all;"></input>
                            </a>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </body>

    </html>


    <script>
        setTimeout(() => {
            checkboxes();
        }, 0);
        var arr = <?php echo json_encode($c); ?>

        let input = document.querySelectorAll(`input[type="checkbox"]`);
        let inputwr = document.getElementsByClassName("input_wrapper")
        var total = input.length;
        let submitButton = document.getElementById("submit-btn");
        var k = 0;
        submitButton.disabled = false;
        submitButton.style.backgroundColor = "black";
        // submitButton.style.cursor = "pointer";
        for (var i = 0; i < total; i++) {
            if (input[i].type == "checkbox" && arr[k] == i + 1) {
                inputwr[i].style.display = "inline";
                input[i].checked = true;
                ++k;
            } else if (input[i].type == "checkbox") {
                input[i].style.display = "none";
                input[i].checked = false;
            }
        }

        let images = <?php echo json_encode($Stock_Images); ?>;

        function checkboxes() {
            let submitButton = document.getElementById("submit-btn");
            let input = document.querySelectorAll(`input[type="checkbox"]`);
            let checkBox = document.getElementsByClassName("check-box");
            let inputwr = document.getElementsByClassName("input_wrapper")
            let label = document.querySelectorAll('label');
            let submitButtonDisplay = document.getElementById("submit-button-display");
            var cnt = document.querySelectorAll('input[type="checkbox"]:checked').length;
            var total = input.length;
            let j = 1;

            if (cnt == 5) {
                submitButton.disabled = false;
                // submitButton.style.backgroundColor = "black";
                submitButton.style.cursor = "pointer";
                submitButtonDisplay.style.display = "flex";
                for (let i = 0; i < total; i++) {
                    if (input[i].type == "checkbox" && input[i].checked == false) {
                        // label[i].style.display = "none";
                        input[i].style.display = "none";
                        checkBox[i].disabled = true;
                    } else if (input[i].type == "checkbox" && input[i].checked == true) {
                        // document.getElementById("selected"+(j++)).innerHTML = images[i];
                    }
                }
            } else {
                submitButton.disabled = true;
                // submitButton.style.backgroundColor = "grey";
                submitButtonDisplay.style.display = "none";
                submitButton.style.cursor = "not-allowed";
                for (var i = 0; i < total; i++) {
                    if (input[i].type == "checkbox") {
                        // input[i].style.display = "block";
                        input[i].style.display = "block";
                        checkBox[i].disabled = false;
                    }
                }
            }
            for (let i = 0; i < total; i++) {
                if (input[i].checked == true) {
                    document.getElementById("selected" + (j)).innerHTML = images[i];
                    ++j;
                } else {
                    document.getElementById("selected" + (j)).innerHTML = `<img src="assets/backimage.jpeg" alt="profile">`;
                }
            }
            if (j < 6) {
                for (; j <= 5; j++) {
                    document.getElementById("selected" + (j)).innerHTML = `<img src="assets/backimage.jpeg" alt="profile">`;
                }
            }
        }
    </script>

    <script>
        function search_stock() {
            let input = document.getElementById('searchbar').value
            input = input.toLowerCase();
            console.log(input);
            let x = document.getElementsByClassName('Stock-name');
            let list = document.getElementsByClassName('listnames');

            for (let i = 0; i < x.length; i++) {
                if (x[i].innerHTML.toLowerCase().includes(input) && input !== "") {
                    // x[i].style.display="none";
                    // x[i].style.backgroundColor = "blue";
                    // x[i].style.color = "white";
                    x[i].style.display = "block";
                    list[i].style.display = "flex";
                } else {
                    // x[i].style.color = "black";
                    // x[i].style.backgroundColor = "white";
                    list[i].style.display = "none";
                }
            }
            if (input == "")
                for (let i = 0; i < x.length; i++) {
                    list[i].style.display = "flex";
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
        function removenotificationtable() {
            document.getElementById('notif-content').style.display = "none";
        }

        function displaylastgame() {
            if (document.getElementById('notif-content').style.display == "block")
                document.getElementById('notif-content').style.display = "none";
            else
                document.getElementById('notif-content').style.display = "block";
        }
        document.getElementById('notif')
    </script>
<?php
    if (isset($_POST['submit'])) {

        if (date("H:i") < $Start_Time) {

            if (mysqli_query($connect, "update live_game set Stocks_Selected='$t' where Game_Id =$Game_Id")) {
                echo ("<script>location.href = 'https://karrotlive.com/nasdaq.php';</script>");
            } else {
                echo "<script>alert('not done')</script>";
            }
        } else {
            echo "<script>alert('Sorry! Game started already')</script>";
        }
    }
} else {
    echo "Email not verified";
    echo "<a href='registration.php'>Please Register again.</a>";
}
// echo "<h2>Your Input:</h2>";
// echo $selected_stock;
?>