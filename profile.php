<?php

if (isset($_POST['button1'])) {
    unset($_COOKIE['User_Id']);
    setcookie("User_Id", null, -1, '/');
    header("Location:https://karrotlive.com/registration.php");
}

?>
<?php

require 'connection.php';

$User_Id = $_COOKIE['User_Id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="header_and_footer_5.css">
</head>
<style>
    .main-div {
        /*height: 1150px;*/
        width: 100%;
        /* background-color: pink; */
        margin-top: 80px;
    }


    .right-main {
        background-color: #efefef;
        margin-bottom: 5px;
    }

    @media screen and (max-width: 1200px) {
        .right-main {
            margin-bottom: 65px;
        }


    }



    .gamename {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    .editkarrot {
        cursor: pointer;
        padding: 2px 10px;
    }

    .game-area {
        background-color: #efefef;
        /* position: inherit; */
        display: flex;
        flex-direction: row;
        margin-left: 16%;
        margin-right: 65px;
        /* width: 75%; */
        /* flex-wrap: wrap;
            height: auto;
            margin-top: 50px; */
    }

    .other-area {
        background-color: #efefef;
        position: inherit;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        width: 75%;
        height: auto;
        margin-left: 250px;
        margin-right: 65px;
        margin-top: 50px;
        align-items: center;
    }

    .second-area {
        background-color: #efefef;
        /* position: inherit; */
        display: flex;
        flex-direction: row;
        margin-left: 16%;
        margin-right: 65px;
        height: auto;
    }

    .social-section {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin-top: 25px;
    }

    .social-section a {
        width: 25%;
        text-align: center;
    }








    .dontknow {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 0px solid black;
        border-radius: 20px;
        background-color: white;
        padding: 10px;
        width: 100%;
        margin: 10px;
        overflow: auto;
    }

    .refer {
        padding: 10px;
        margin: 10px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 0px solid black;
        border-radius: 20px;
        background-color: white;
    }


    .refer h3 {
        margin-bottom: 30px;
        font-size: 25px;

    }

    .video {
        width: 100%;
        display: flex;
        flex-direction: column;
        padding: 10px;
        align-items: center;
        border: 0px solid black;
        border-radius: 20px;
        background-color: white;
        margin: 10px;
        height: 350px;
    }

    .video h3 {
        padding-bottom: 10px;
    }

    .details {
        flex-direction: column;
        display: flex;
        border-radius: 50px;
        width: 100%;
        margin: 10px;
        border: 0px solid black;
        border-radius: 20px;
        background-color: white;
    }

    .profile {
        display: flex;
        justify-content: space-around;
        padding: 10px;
    }

    .profileimg {
        align-items: center;
        justify-content: center;
        display: flex;
        flex-direction: column;
    }

    .profileimg img {
        /* height: 100px; */
        width: 105px;
        margin-right: 55px;
        border-radius: 50px;
    }

    .karrot {
        font-size: 26px;
        color: #007fad;
        font-weight: 900;
        padding: 2px 12px;
    }

    /* .section {} */

    .name {
        padding: 10px;
        font-weight: 900;
        background-color: #efefef;
        font-size: 22px;
        width: 262px;
        margin: 17px 2px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .editbutton {
        margin-right: 54px;
    }

    .editbutton button {
        border: 0px;
        cursor: pointer;
        /* height: 48px;
    width: 100px; */
        border-radius: 16px;
    }

    .support {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
        justify-content: center;
    }

    /* .support-heading {} */

    .support-content {
        padding: 20px 5px;
        width: 100%;
    }

    /* .support-email {} */

    /* .support-phone {} */

    .wallet {
        display: flex;
        align-items: center;
        justify-content: space-around;
        border: 0px solid black;
        width: 100%;
        flex-direction: column;
    }

    .wallet h1 {
        font-size: 34px;
    }

    .wallet span {
        font-size: 31px;
        font-weight: 900;
    }

    .played-games {
        display: flex;
        width: 100%;
        justify-content: space-between;
        padding: 3px 20px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .games-played {
        border: 1px solid black;
        border-radius: 10px;
        padding: 10px;
    }

    .games-won {
        border: 1px solid black;
        border-radius: 10px;
        padding: 10px;
    }

    .funds {
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: center;
        border: 0px solid black;
        border-radius: 20px;
        background-color: white;
        margin: 10px;
    }

    .funds-change {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        width: 100%;
        align-items: center;
    }

    .funds-view {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .funds-view button {
        border: 0px;
        height: 28px;
        width: 127px;
        font-size: 18px;
        margin-top: 33px;
    }

    .funds-change button {
        background-color: #15cf69;
        color: white;
        font-size: 15px;
        margin: 10px;
        height: 60px;
        width: 140px;
        border: 0px;
        border-radius: 15px;
    }

    .funds-change button a {
        text-decoration: none;
        color: white;
    }

    .support {
        border: 0px solid black;
        border-radius: 20px;
        background-color: white;
        width: 100%;
    }

    .logout {
        display: flex;
        align-items: center;
    }

    #logoutbutton {
        color: wheat;
        height: 50px;
        width: 180px;
        border-radius: 15px;
        border: 0px;
        font-size: 20px;
        background-color: #ff7878;
        background-image: linear-gradient(315deg, #ff7878 0%, #ff0000 74%);

    }

    /*  Modal CSS */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin-left: 18%;
        padding: 20px;
        border: 0px solid #888;
        width: 80%;
        border-radius: 10px;
    }

    @media screen and (max-width: 1200px) {

        .modal-content {
            margin-left: 2%;
            width: 96%;
        }

    }


    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


    @media screen and (max-width: 1200px) {
        #header {
            height: 0px;
            display: none;
        }

        .game-area {
            margin-left: 2%;
            margin-right: 2%;
        }

        .second-area {
            margin-left: 2%;
            margin-right: 2%;
        }

        .main-div {
            margin-top: 0;
            /*height: 1860px;*/
        }

        .other-area {
            align-items: center;
            width: 97%;
            height: auto;
            margin-left: 6px;
            margin-right: 10px;
            margin-top: 50px;
            overflow: auto;
        }

    }

    @media screen and (max-width: 970px) {


        .logo img {
            width: 50px;
            margin-top: 0px;
            margin-left: 0px;
        }

        .money {
            margin-right: 0;
            margin-top: 8px;
            font-size: 20px;
        }

        .profile img {
            margin-top: 6px;
            width: 100px;
            margin-right: 6px;
        }

        .main-div {
            margin-top: -48px;
            /*height: 1860px;*/
        }

        .game-area {
            flex-direction: column;
            align-items: center;
            width: 97%;
            height: auto;
            margin-left: 6px;
            margin-right: 10px;
            margin-top: 50px;
            overflow: hidden;
        }

        .name {
            width: 230px;
        }

        .editbutton {
            margin-right: 14px;
            font-size: 16px;
        }

        .editbutton button {
            font-size: 16px;
        }

        .second-area {
            flex-direction: column;
            align-items: center;
            width: 97%;
            height: auto;
            margin-left: 6px;
            margin-right: 10px;
            overflow: hidden;
        }

        .dontknow {
            margin: 10px 0px;
        }

        .refer {
            margin: 10px 0px;
        }

        .video {
            margin: 10px 0px;
        }

        .details {
            margin: 10px 0px;
        }

        .funds {
            margin: 10px 0px;
        }

        .support {
            margin: 10px 0px;
        }



        .social-section {
            margin: 10px 0px;
        }

        .wallet h1 {
            font-size: 23px;
        }

        .wallet span {
            font-size: 25px;
        }
    }


    /* Game Hisory */



    .dontknow table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .dontknow th,
    .dontknow td {
        border: 1px solid #ddd;
        padding: 8px;
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
    }

    .dontknow tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .dontknow th {
        background-color: black;
        color: white;
    }


    #EditProfile {
        height: 1150px;
        width: 85%;
        background-color: white;
        top: 80px;
        left: 100%;
        position: fixed;
        margin-left: 15%;

    }

    #EditProfile-top {
        width: 100%;
        display: flex;
        height: 100px;
        /* background: url(assets/bgspace.jpg) no-repeat center center/cover; */
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    #EditProfile-top-backbutton {
        cursor: pointer;
        width: 5%;
        height: inherit;
        float: left;

    }

    #EditProfile-top-title {
        text-align: center;
        width: 95%;
        height: inherit;

    }

    #EditProfile-profilephoto {
        width: 100%;
        text-align: center;
        height: auto;
        margin-top: -45px;
    }

    #EditProfile-profilephoto img {
        /* height: 100px; */
        width: 105px;
        /* border-radius: 50px; */

    }

    #EditProfile-profilefields table {
        width: 70%;
        margin-left: auto;
        margin-right: auto;
    }

    #EditProfile-top img {
        height: 50px;
        transform: rotate(180deg);
    }

    @media screen and (max-width: 1200px) {
        #EditProfile {
            top: 0;
            width: 100%;
            margin-left: 0;
            height: 1860px;
        }

        #EditProfile-profilefields table {
            width: 85%;
            margin-left: auto;
            margin-right: auto;
        }

        #EditProfile-profilefields tr {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #EditProfile-profilefields td {
            height: 35px;
            width: 75%;
            align-items: center;
        }

        #EditProfile-top {
            background: url(assets/bgspace.jpg) no-repeat center center/cover;
            color: white;
        }

        #EditProfile-top img {
            border-radius: 50px;
            height: 35px;
            transform: rotate(180deg);
        }

    }

    @media screen and (max-width: 970px) {
        #EditProfile {
            top: 0;
        }
    }

    #EditProfile-profilefields tr {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #EditProfile-profilefields td {
        height: 35px;
        width: 75%;
        align-items: center;
    }

    .input-field1 {
        width: 100%;
        padding: 10px 5px;
        /* margin-top: 10px; */
        border-top: 0;
        border-left: 0;
        border-right: 0;
        border-bottom: 1px solid #999;
        outline: none;
        border-radius: 10px;
        background: transparent;
        border: 2px solid black;

    }

    /* HIDE RADIO */
    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio]+img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio]:checked+img {
        outline: 2px solid #f00;
    }

    #Edit-button {
        margin-bottom: 10px;
        margin-top: 140px;
        width: 100px;
        height: 31px;
        border-radius: 17px;
        background-color: #007fad;
        border: 0px;
    }

    #EditProfile-profilephoto-Image svg {
        margin-left: -23px;
        border-radius: 24px;
        margin-bottom: 84px;
        cursor: pointer;
    }

    :root {
        --color-light: white;
        --color-dark: #212121;
        --color-signal: #fab700;
        --color-background: var(--color-light);
        --color-text: var(--color-dark);
        --color-accent: var(--color-signal);
        --size-bezel: .5rem;
        --size-radius: 4px;

    }


    .l-design-widht {
        max-width: 40rem;
        padding: 1rem;
    }

    .input {
        position: relative;
    }

    .input__label {
        position: absolute;
        left: 0;
        top: 0;
        padding: calc(var(--size-bezel) * 0.75) calc(var(--size-bezel) * .5);
        margin: calc(var(--size-bezel) * 0.75 + 3px) calc(var(--size-bezel) * .5);
        background: pink;
        white-space: nowrap;
        transform: translate(0, 0);
        transform-origin: 0 0;
        background: var(--color-background);
        transition: transform 120ms ease-in;
        font-weight: bold;
        line-height: 1.2;
    }

    .input__field {
        box-sizing: border-box;
        display: block;
        width: 100%;
        border: 3px solid currentColor;
        padding: calc(var(--size-bezel) * 1.5) var(--size-bezel);
        color: currentColor;
        background: transparent;
        border-radius: var(--size-radius);
    }

    .input__field:not(:-moz-placeholder-shown)+.input__label {
        transform: translate(0.25rem, -65%) scale(0.8);
        color: var(--color-accent);
    }

    .input__field:not(:-ms-input-placeholder)+.input__label {
        transform: translate(0.25rem, -65%) scale(0.8);
        color: var(--color-accent);
    }

    .input__field:focus+.input__label,
    .input__field:not(:placeholder-shown)+.input__label {
        transform: translate(0.25rem, -65%) scale(0.8);
        color: #050df9;
    }



    .collapsible2 {
        cursor: pointer;
    }



    @media screen and (max-width: 1200px) {
        body a {
            cursor: default;
        }

        .collapsible2 {
            cursor: default;
        }

        #EditProfile-profilephoto-Image svg {
            cursor: default;
        }

        .editkarrot {
            cursor: default;
        }

        .editbutton button {
            border: 0px;
            cursor: default;
        }

        .close:hover,
        .close:focus {
            cursor: default;
        }

        #EditProfile-top-backbutton {
            cursor: default;
        }

        [type=radio]+img {
            cursor: default;
        }

    }
</style>
<?php
$ch = mysqli_query($connect, "SELECT User_Id,User_Name,Profile_Image,Name,Coins,Game_History,Email,Password,isEmailConfirmed FROM users WHERE User_Id='$User_Id'");
$row = mysqli_fetch_array($ch);


$isEmailConfirmed = $row['isEmailConfirmed'];
if ($isEmailConfirmed == 1) {






    $username = $row['User_Name'];
    $Coins = $row['Coins'];
    $Game_History = $row['Game_History'];
    $Name = $row['Name'];
    $Profile_Image = $row['Profile_Image'];
    $Email = $row['Email'];
    $Password = $row['Password'];

    $name = $email = $Username = $profile_image = "";
?>

    <body>
        <div id="header" style="background-size:cover;">
            <a href="nsebse.php" class="logo">
                <div id="logo">
                    <img src="karrotlogo2.png" class="active" id="nav-logo" />
                </div>
            </a>
        </div>

        <div class="main-div">
            <div class="navbar">
                <a href="nsebse.php">

                    <img src="assets/games_unselected.png" width="40px" height="40px" class="navbar-icon">
                    <p>Games</p>
                </a>
                <a href="#"><img src="assets/blog_unselected.png" width="40px" height="40px" class="navbar-icon">
                    <p>Blogs</p>
                </a>
                <a href="profile.php"><img src="assets/user_selected.png" height="35px" width="37px" class="navbar-icon">
                    <p style="color:#a200e4;">Profile</p>

                </a>
            </div>
            <div class="right-main">
                <div class="game-area">
                    <div class="details">
                        <div class="gamename">
                            <div class="karrot">Karrot</div>
                            <div class="editkarrot" onclick="OpenEditProfile()">Edit</div>
                        </div>
                        <div class="profile">
                            <div class="profileimg">
                                <div>
                                    <img src="<?php echo $Profile_Image; ?>" alt="">
                                </div>

                            </div>
                            <div class="section">
                                <div class="name"><?php echo $Name; ?></div>
                                <div class="name">@<?php echo $username; ?></div>
                            </div>
                        </div>
                        <div class="played-games">
                            <div class="games-played">
                                <h4>Played Games</h4>
                                <span><?php
                                        if (!empty($Game_History)) {
                                            $No_of_games = substr_count($Game_History, "</tr>");
                                            echo $No_of_games;
                                        } else {
                                            echo "0";
                                        }
                                        ?></span>
                            </div>
                            <div class="games-won">
                                <h4>Won Games</h4>
                                <span>
                                    <?php
                                    if (!empty($Game_History)) {
                                        $Game_History_array = explode("</tr>", $Game_History);
                                        $No_Of_Win = 0;
                                        for ($k = 0; $k < count($Game_History_array) - 1; $k++) {
                                            $j = $pos3 = 0;

                                            do {
                                                $pos3 = strpos($Game_History_array[$k], "<td>", $pos3 + 1);
                                            } while ($j++ < 2);

                                            $b = substr($Game_History_array[$k], $pos3);
                                            $b = rtrim($b, "</td>");
                                            $b = (int)ltrim($b, "</td>");
                                            if ($b > 0) {
                                                $No_Of_Win = $No_Of_Win + 1;
                                            }
                                        }

                                        echo $No_Of_Win;
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="funds">
                        <div class="wallet">
                            <?php $Coins = explode("??", $Coins) ?>
                            <h1>Coins - <?php echo $Coins[0]; ?></h1>
                            <h1>Bonus - <?php echo $Coins[1]; ?></h1>
                        </div>
                        <div class="funds-change">
                            <button><a href="profilePagePayment.php">Add funds</a></button>
                            <button><a href="profilePageWithdraw.php"> Withdraw funds</a></button>
                        </div>
                    </div>
                    <!-- <div class="support">
                    <h2 class="support-heading">Support</h2>
                    <div class="support-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis natus dolores odit, iure et delectus cupiditate! Quaerat natus distinctio deleniti molestias repellendus repudiandae inventore ipsa ipsam autem cum nihil eius, culpa id sint dicta alias porro eum excepturi. Dicta ut repellendus corporis dolore animi exercitationem!</div>
                    <div class="support-email">
                        Email: karrot247live@gmail.com
                    </div>
                    <div class="support-phone">
                        Whatsapp: 9999999999
                    </div>
                </div> -->
                </div>
                <!-- <div class="other-area">

                <div class="transhistory">
                    <h1>Transaction History</h1>
                </div>
            </div> -->
                <div class="second-area">

                    <div class="dontknow">
                        <h2>Game History</h2>
                        <table>
                            <tr>
                                <th>Time</th>
                                <th>Position</th>
                                <th>Prize</th>
                            </tr>
                            <?php
                            $Game_History;

                            if (!empty($Game_History)) {

                                $i = $pos2 = 0;
                                do {
                                    $pos2 = strpos($Game_History, "</tr>", $pos2 + 1);
                                } while ($i++ < 2);

                                $Game_History2 = substr($Game_History, 0, $pos2);
                                echo $Game_History2;
                            }

                            ?>


                        </table>


                        <button id="myBtn">Full History</button>

                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h1>Game History</h1>

                                <table>
                                    <tr>
                                        <th>Time</th>
                                        <th>Position</th>
                                        <th>Prize</th>
                                    </tr>

                                    <?php
                                    echo $Game_History;
                                    ?>


                                </table>

                            </div>

                        </div>
                    </div>

                    <div class="refer">
                        <h3>Refer and Earn Money</h3>
                        <div>You can earn 10 Bonus coins by refering this application to your friends and family.<br>
                            <br>
                            <br>
                            Your refer code is:
                            <span><i><b><?php echo $username; ?></b></i></span>
                        </div>
                    </div>

                </div>
                <div class="second-area">
                    <div class="video">
                        <h3>How to Play</h3>
                        <iframe width="320" height="215" src="https://www.youtube.com/embed/CIO7auBJnbo" allowfullscreen></iframe>
                    </div>
                    <div class="support">
                        <h2 class="support-heading">Support</h2>
                        <div class="support-content">
                            <div class="social-section">
                                <a target="_blank" href="https://www.instagram.com/karrotlive/?hl=en"><img src="https://www.pnglib.com/wp-content/uploads/2021/02/instagram-logo-png_6023f9ae0feb9-680x680.png" style="margin-left: 0;" height="50px" width="50px"></a>
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=100072290413718"><img src="https://www.freepnglogos.com/uploads/facebook-logo-icon/facebook-logo-icon-facebook-logo-png-transparent-svg-vector-bie-supply-16.png" height="50px" width="50px"></a>
                                <a target="_blank" href="https://twitter.com/KarrotLive"><img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" height="55px" width="55px"></a>
                                <a target="_blank" href="https://www.linkedin.com/in/karrot-live-a3947021b/"><img src="http://pngimg.com/uploads/linkedIn/linkedIn_PNG17.png" height="50px" width="50px"></a>

                            </div>


                        </div>
                        <div class="support-email">
                            Email: karrot247live@gmail.com
                        </div>
                        <div class="support-phone">
                            Phone: (+91) 9935324433
                        </div>
                    </div>
                </div>
                <div class="other-area">

                    <div class="logout">
                        <form method="post">
                            <input type="submit" name="button1" class="button" value="Logout" id="logoutbutton" />
                        </form>
                    </div>
                </div>
            </div>
            <div id="EditProfile">
                <div id="EditProfile-top">

                    <div id="EditProfile-top-backbutton" onclick="CloseEditProfile()">
                        <picture>
                            <source media="(min-width: 1200px)" srcset="assets/back-button5.png">

                            <img src="assets/back-button4.png">
                        </picture>
                    </div>
                    <div id="EditProfile-top-title">
                        Edit Profile
                    </div>

                </div>
                <div id="EditProfile-Editform">


                    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post" autocomplete="off">

                        <div id="EditProfile-profilephoto">
                            <div id="EditProfile-profilephoto-Image">
                                <img id="profileImage" src="<?php echo $Profile_Image; ?>" alt="">
                                <svg id="EditProfile-profilephoto-Imagebutton" class="collapsible" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" style=" fill:#000000;">
                                    <path d="M 19.171875 2 C 18.448125 2 17.724375 2.275625 17.171875 2.828125 L 16 4 L 20 8 L 21.171875 6.828125 C 22.275875 5.724125 22.275875 3.933125 21.171875 2.828125 C 20.619375 2.275625 19.895625 2 19.171875 2 z M 14.5 5.5 L 5 15 C 5 15 6.005 15.005 6.5 15.5 C 6.995 15.995 6.984375 16.984375 6.984375 16.984375 C 6.984375 16.984375 8.004 17.004 8.5 17.5 C 8.996 17.996 9 19 9 19 L 18.5 9.5 L 14.5 5.5 z M 3.6699219 17 L 3.0136719 20.503906 C 2.9606719 20.789906 3.2100938 21.039328 3.4960938 20.986328 L 7 20.330078 L 3.6699219 17 z"></path>
                                </svg>
                                <!-- </div>
                        <div id="EditProfile-profilephoto-Imagebutton" class="collapsible">
                            Edit Profile Image
                        </div> -->
                                <div class="EditProfile-profilephoto-Imagebutton-content" style="display: none;">
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/ambani.jpg">
                                        <img onclick="first()" class="chooseprofile" src="assets/profile/ambani.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/damani.jpg">
                                        <img onclick="second()" class="chooseprofile" src="assets/profile/damani.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/elon.jpg">
                                        <img onclick="third()" class="chooseprofile" src="assets/profile/elon.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/graham.jpg">
                                        <img onclick="fourth()" class="chooseprofile" src="assets/profile/graham.jpg" alt="">
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/mark.jpg">
                                        <img onclick="fifth()" class="chooseprofile" src="assets/profile/mark.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/mehta.jpg">
                                        <img onclick="sixth()" class="chooseprofile" src="assets/profile/mehta.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/nita.jpg">
                                        <img onclick="seventh()" class="chooseprofile" src="assets/profile/nita.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/rakesh.jpg">
                                        <img onclick="eighth()" class="chooseprofile" src="assets/profile/rakesh.jpg" alt="">
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/scott.jpg">
                                        <img onclick="ninth()" class="chooseprofile" src="assets/profile/scott.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/tata.jpg">
                                        <img onclick="tenth()" class="chooseprofile" src="assets/profile/tata.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/warren.jpg">
                                        <img onclick="eleventh()" class="chooseprofile" src="assets/profile/warren.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/jeff.jpg">
                                        <img onclick="twelfth()" class="chooseprofile" src="assets/profile/jeff.jpg" alt="">
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/profile/milinda.jpg">
                                        <img onclick="thirteenth()" class="chooseprofile" src="assets/profile/milinda.jpg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/buffet.jpeg">
                                        <img onclick="fourteenth()" class="chooseprofile" src="assets/buffet.jpeg" alt="">
                                    </label>
                                    <label>
                                        <input type="radio" name="profile_image" value="assets/buffet.jpeg">
                                        <img onclick="fifteenth()" class="chooseprofile" src="assets/buffet.jpeg" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="EditProfile-profilefields">
                            <table>
                                <tr>
                                    <!-- <td>Name</td> -->
                                    <!-- <td> <input type="text" class="input-field1" placeholder="Name" name="name" value="<?php echo $Name; ?>"></td> -->
                                    <td>
                                        <div class="card card--inverted">
                                            <label class="input">
                                                <input class="input__field" type="text" placeholder=" " value="<?php echo $Name; ?>" name="name" />
                                                <span class="input__label">Name</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="text-align: center;">
                                    <td colspan="2"> <label style="font-size:10px ;"></label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="card card--inverted">
                                            <label class="input">
                                                <input class="input__field" type="text" placeholder=" " value="<?php echo $username; ?>" name="username" id="username" />
                                                <span class="input__label">User Name</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="text-align: center; margin-top: 10px;">
                                    <td colspan="2"> <label id="msg" style="font-size:12px;color: red;"></label></td>
                                </tr>
                                <tr>
                                    <td><span class="collapsible2">Change Password</span>
                                    </td>
                                </tr>

                                <tr class="change-password" style="display: none;">
                                    <!-- <td>Email</td> -->
                                    <td>

                                        <div class="card card--inverted">
                                            <label class="input">
                                                <input class="input__field" type="password" placeholder=" " value="" name="opassword" />
                                                <span class="input__label">Old Password</span>
                                            </label>
                                        </div><br>
                                        <div class="card card--inverted">
                                            <label class="input">
                                                <input class="input__field" type="password" placeholder=" " value="" name="npassword" />
                                                <span class="input__label">New Password</span>
                                            </label>
                                        </div>
                                        <br>
                                        <div class="card card--inverted">
                                            <label class="input">
                                                <input class="input__field" type="password" placeholder=" " value="" name="rpassword" />
                                                <span class="input__label">Confirm Password</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="text-align: center;">
                                    <td colspan="2">
                                        <input type="submit" class="submit-btn" name="submit" value="Save" id="Edit-button" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>



                </div>

            </div>



        </div>


    </body>



<?php
} else {
    echo "Email not verified";
    echo "<a href='registration.php'>Please Register again.</a>";
}
?>



<script type="text/javascript">
    $(document).ready(function() {
        $("#username").blur(function() {
            var username = $(this).val();
            if (username == "") {
                $("#msg").fadeOut();
            } else {
                $.ajax({
                    url: "duplicate_username_check_for_profile.php",
                    method: "POST",
                    data: {
                        username: username
                    },
                    success: function(data) {
                        $("#msg").fadeIn().html(data);
                        if (data.includes("not")) {
                            $('#Edit-button').prop('disabled', true);
                        } else {
                            $('#Edit-button').prop('disabled', false);
                        }
                    }
                });
            }
        });
    });
</script>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["name"] == $Name || empty($_POST["name"])) {
        $name = $Name;
    } else {
        $name = $_POST["name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if ($_POST["username"] == $username || empty($_POST["username"])) {
        $Username = $username;
    } else {
        $count = 0;
        $username2 = $_POST["username"];
        $ch = mysqli_query($connect, "select User_Name from users where User_Name='$username2'");
        $count  = mysqli_num_rows($ch);
        if ($count == 0) {
            if (preg_match('/[\'^£$%&*()}{#~?><>,|=+¬-]/', $username2)) {
                $Username = null;
            } else {
                $Username = $username2;
            }
        } else {

            $Username = null;
        }
    }
    if (empty($_POST["profile_image"])) {
        $profile_image = $Profile_Image;
    } else {
        $profile_image = $_POST["profile_image"];
    }

    $opassword = test_input($_POST["opassword"]);
    if (!empty($_POST["rpassword"])) {

        if (password_verify($opassword, $Password)) {
            $npassword = test_input($_POST["npassword"]);
            $rpassword = test_input($_POST["rpassword"]);

            if (strcmp($npassword, $rpassword) == 0) {
                $hashed_password = password_hash($_POST["rpassword"], PASSWORD_DEFAULT);;
                if (mysqli_query($connect, "UPDATE users SET Password='$hashed_password' where User_Id='$User_Id'")) {
                    echo ("<meta http-equiv='refresh' content='1'>");
                } else {
                    echo "<script>alert('System error')</script>";
                }
            } else {
                echo "<script>alert('New passwords dont match')</script>";
            }
        } else {
            echo "<script>alert('Write correct old password')</script>";
        }
    }

    if (strcmp($username, $_POST["username"]) != 0 || strcmp($Name, $_POST["name"]) != 0 || strcmp($Profile_Image, $_POST["profile_image"]) != 0) {
        if ($Username != null && $Name != null && $Profile_Image != null) {
            if (mysqli_query($connect, "UPDATE users SET User_Name='$Username' , Name='$name',Profile_Image='$profile_image' where User_Id='$User_Id' ")) {
                echo ("<meta http-equiv='refresh' content='1'>");
            } else {
                echo "<script>alert('System Error')</script>";
            }
        } else {
            echo "<script>alert('Null fields not allowed')</script>";
        }
    } else {
        echo "<script>alert('Previous Data')</script>";
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>





<script type="text/javascript">
    function OpenEditProfile() {

        document.getElementById("EditProfile").style.left = 0;
        document.getElementById("EditProfile").style.transition = "1s";
        document.getElementById("EditProfile").style.position = "absolute";
    }

    function CloseEditProfile() {

        document.getElementById("EditProfile").style.transition = "1s";
        document.getElementById("EditProfile").style.left = "100%";
        document.getElementById("EditProfile").style.position = "fixed";

    }
    $(document).ready(function() {
        $('.collapsible').click(function() {
            $('.EditProfile-profilephoto-Imagebutton-content').slideToggle(500);
        });
    });

    $(document).ready(function() {
        $('.collapsible2').click(function() {
            $('.change-password').slideToggle(500);
        });
    });
</script>



<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>
    var imgChange = document.getElementById("profileImage");
    let allImages = document.getElementsByClassName("chooseprofile");

    function first() {
        imgChange.src = allImages[0].src;

    }

    function second() {
        imgChange.src = allImages[1].src;

    }

    function third() {
        imgChange.src = allImages[2].src;

    }

    function fourth() {
        imgChange.src = allImages[3].src;

    }

    function fifth() {
        imgChange.src = allImages[4].src;

    }

    function sixth() {
        imgChange.src = allImages[5].src;

    }

    function seventh() {
        imgChange.src = allImages[6].src;

    }

    function eighth() {
        imgChange.src = allImages[7].src;

    }

    function ninth() {
        imgChange.src = allImages[8].src;

    }

    function tenth() {
        imgChange.src = allImages[9].src;

    }

    function eleventh() {
        imgChange.src = allImages[10].src;

    }

    function twelfth() {
        imgChange.src = allImages[11].src;

    }

    function thirteenth() {
        imgChange.src = allImages[12].src;

    }

    function fourteenth() {
        imgChange.src = allImages[13].src;

    }

    function fifteenth() {
        imgChange.src = allImages[14].src;

    }
</script>

</html>