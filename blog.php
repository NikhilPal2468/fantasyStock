<?php

require 'connection.php';

$User_Id = $_COOKIE['User_Id'];

$Game_Ids = [];
$query = "SELECT * FROM users where User_Id='$User_Id'";
$run = mysqli_query($connect, $query);
$row = mysqli_fetch_array($run);
$Live_game = $row['Live_game'];
$Game_History = $row['Game_History'];
$Player_Coin = $row['Coins'];

$Player_Coin = explode("??", $Player_Coin);
$Notification = $row['Notification'];
$Game_Id3 = explode("=>", $Live_game);
$Profile_Image = $row['Profile_Image'];


for ($i = 0; $i < count($Game_Id3) - 1; $i++) {

    $Game_Id2 = explode("#", $Game_Id3[$i]);

    array_push($Game_Ids, $Game_Id2[1]);
}



$query = "SELECT * FROM live_game";
$run = mysqli_query($connect, $query);
$row = mysqli_fetch_array($run);
$query2 = "select Game_Id from live_game ORDER BY Game_Id DESC LIMIT 1";
$run2 = mysqli_query($connect, $query2);
$row2 = mysqli_fetch_array($run2);
$a = $row2['Game_Id'];
$Start_Time;
$cnt = 0;
$numberofplayers = array();
$hoursInGames = array();
$minutesInGames = array();
$gamesTime = array();
$gameId = array();
$PlayersId = array();
$CoinsToEnter = array();
for ($i = 1; $i <= $a; $i++) {
    $query = "SELECT * FROM live_game where Game_Id  =$i AND Version='stock'";
    $run = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($run);
    // echo json_encode($row);
    if ($row != NULL) {
        $Max_Players = $row['Max_Players'];
        $Game_Id = $row['Game_Id'];
        $Game_Time = $row['Game_Time'];
        $version = $row['Version'];
        $Players = $row['Players'];
        $Coins_To_Enter = $row['Coins_To_Enter'];
        $Players = explode(",", $Players);
        $num = count($Players);



        array_push($PlayersId, $Players);
        array_push($numberofplayers, $num - 1);
        array_push($gameId, $Game_Id);
        array_push($gamesTime, $Game_Time);
        array_push($CoinsToEnter, $Coins_To_Enter);
        $Start_Time = $row['Start_Time'];
        $Game_Time = $row['Game_Time'];

        $Time = explode(":", $Start_Time);
        array_push($hoursInGames, $Time[0]);
        array_push($minutesInGames, $Time[1]);
        if ($version == 'stock')
            ++$cnt;
    }
}


// $Game_Id = $_GET['gid'];

$query = "SELECT * FROM live_game where Game_Id='$Game_Id'";
$run = mysqli_query($connect, $query);
$row = mysqli_fetch_array($run);
$Players = $row['Players'];
$Players = explode(",", $Players);
$Start_Time = $row['Start_Time'];
$Max_Players = $row['Max_Players'];


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="header_and_footer_5.css">
    <title>Karrot | Blog</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style type="text/css">
        .main-div {
            height: 1500px;
            width: 100%;
            /* background-color: red; */
            margin-top: 80px;
        }

        @media screen and (max-width: 700px) {
            .main-div {
                margin-top: 50px;
            }
        }


        .title {
            background-color: #efefef;
            font-size: 100px;
        }

        .title p {
            margin-left: 20%;

        }

        @media screen and (max-width: 1200px) {

            .title p {
                margin-left: 10%;

            }


        }



        @media screen and (max-width: 700px) {
            .title {
                margin-left: 0;
                font-size: 50px;
                width: 100%;
            }
        }

        .game-type-selection {
            margin-top: 50px;
            margin-left: 19%;
            cursor: pointer;
        }

        .game-type-selection a {
            cursor: pointer;
        }

        .game-type-selection button {
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 20px;

        }

        @media screen and (max-width: 1200px) {
            .game-type-selection {

                margin-left: 8%;

            }
        }



        @media screen and (max-width: 700px) {
            .game-type-selection {
                margin-top: 30px;
                margin-left: 0px;
            }

        }

        @media screen and (max-width: 300px) {
            .game-type-selection button {
                font-size: 15px;
            }

        }



        .game-area-heading {
            width: 100%;
            margin-top: 50px;
        }

        .game-area-heading h1 {
            margin-left: 20%;

        }


        .game-area {
            position: inherit;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            background-color: #7f53ac;
            background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
            width: 77%;
            height: auto;
            margin-left: 20%;
            margin-top: 20px;
            text-align: center;
        }

        @media screen and (max-width: 1200px) {
            .game-area {

                margin-left: 5%;
                width: 90%;
            }

            .game-area-heading h1 {
                margin-left: 10%;

            }


        }


        @media screen and (max-width: 700px) {
            .game-area-heading {

                margin-left: 10px;
                margin-top: 50px;
            }

            .game-area {
                width: 94%;
                height: 260px;
                margin-left: 10px;
                margin-top: 10px;
                overflow: auto;
                white-space: nowrap;
            }

            #live-cards {
                display: flex;
                overflow: auto;
                white-space: nowrap;
            }

            #cards {
                display: flex;
                overflow: auto;
                white-space: nowrap;
            }
        }

        @media screen and (max-width: 300px) {
            .game-area-heading {

                margin-left: 0;
                margin-top: 40px;
            }

            .game-area-heading h1 {
                font-size: 24px;
            }

        }

        #live-cards {
            display: block;
        }

        #cards {
            display: block;
        }

        .card {

            /* border: 2px solid black; */
            background-color: white;
            border-radius: 20px;
            height: 310px;
            width: 351px;
            display: inline-block;
            margin: 10px;
        }

        .enter {
            color: white;
            cursor: pointer;
            padding: 10px 130px;
            background: #007fad;
            border-radius: 15px;
            box-shadow: 4px 5px #efefef;
        }

        .enter:hover {
            box-shadow: 0px 0px white;
        }

        .enter a {
            text-decoration: none;
            color: white;
        }

        #timer {
            display: flex;
            /* flex-wrap: wrap; */
            justify-content: flex-end;
            flex-wrap: nowrap;
            top: 0px;
            font-size: 25px;
            position: absolute;
            right: 0px;
            padding: 20px;
        }

        .button-enter {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title-time {
            display: flex;
            justify-content: center;
            margin: 10px;
            padding: 10px;
        }

        .time {
            margin-bottom: 11px;
            border: 2px solid black;
        }

        .entrants-prizes {
            display: flex;
            justify-content: space-evenly;
            margin: 6px;
            padding: 4px;
        }

        .button {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 16px 12px;
        }


        /* card css by soni */



        .card-background {
            border: 1px solid black;
            border-radius: 10px;
            height: 310px;
            width: 351px;

        }

        .card-heading {
            font-size: 25px;
            text-align: center;
        }

        .card-middle {
            height: 140px;
            width: 100%;


        }

        .card-middle-one {
            height: 70px;
            width: 25%;

            float: left;
            margin-top: 50px;
        }

        .card-middle-one-box {
            height: 50px;
            width: 100%;
            margin-top: 10px;
            font-size: 20px;
            text-align: center;
        }

        .card-middle-one-box-description {
            border-radius: 6px;
            background-color: darkgray;
            width: 70%;
            margin-left: 10px;

            font-size: 20px;
        }

        .card-middle-two {
            height: 90px;
            width: 45%;
            float: left;
            margin-left: 10px;
            margin-top: 30px;
            border: 1px solid black;
            text-align: center;

        }

        .card-middle-two-box {
            height: 80px;
            width: 100%;

            margin-top: 1%;

            text-align: center;
        }

        .card-middle-two-box-title {
            font-size: 20px;

        }

        .card-middle-two-box-description {
            margin-top: 10px;
            font-size: 30px;
        }

        .card-middle-three {
            height: 50px;
            width: 25%;
            float: left;
            margin-top: 30px;
        }




        .card-footer {
            height: 100px;
            width: 100%;

        }

        .card-footer-title {
            height: 50px;
            width: 40%;
            padding-top: 10px;
            text-align: center;
            font-size: 20px;

            margin-left: 95px;
            margin-top: 10px;
        }

        .card-footer-description {
            height: 50px;
            width: 100%;
            cursor: pointer;
            background-image: url('assets/bgspacebutton.jpg');
            background-repeat: no-repeat;
            background-size: 95% 90%;
            background-position: center;

        }

        .card-footer-description-text {
            color: white;
            font-size: 25px;
            padding-top: 10px;
            text-align: center;
        }



        @media screen and (max-width: 1200px) {
            .card {
                height: 280px;
                width: 300px;
            }
        }

        @media screen and (max-width: 700px) {
            .card {
                height: 230px;
                width: 250px;
            }

            .card-background {
                height: 230px;
                width: 250px;

            }

            .card-heading {
                font-size: 20px;
            }



            .card-middle {
                height: 110px;

            }

            .card-middle-one {

                margin-top: 30px;
            }

            .card-middle-one-box {

                font-size: 17px;
            }

            .card-middle-one-box-description {

                font-size: 16px;
            }

            .card-middle-two {
                height: 80px;

                margin-left: 5px;
                margin-top: 18px;

            }

            .card-middle-two-box-title {
                font-size: 18px;

            }

            .card-middle-two-box-description {

                font-size: 25px;
            }



            .card-footer {
                height: 70px;


            }

            .card-footer-title {
                height: 40px;


                font-size: 18px;
                margin-left: 70px;
                margin-top: 0px;
            }

            .card-footer-description {
                height: 40px;
                background-size: 90% 90%;


            }

            .card-footer-description-text {
                font-size: 20px;
            }



        }


        @media screen and (max-width: 300px) {
            .card {
                height: 210px;
                width: 230px;
            }
        }

       
        .btnSelection {
            min-width: 150px;
            padding: 15px 10px;
            margin: 20px;
            border: 1px solid;
            color: rgb(180 0 255);
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: -7px -7px 20px 0 rgba(255, 255, 255, 0.7),
                7px 7px 20px 0 rgba(0, 0, 0, 0.2);
        }

        #btnActive {
            background-color: #7f53ac;
            background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
            color: white;
        }

        @media screen and (max-width: 700px) {
            .btnSelection {
                min-width: 100px;
                margin: 10px;
                margin-bottom: -3%;

            }

        }



        #btn:hover {
            box-shadow: inset -7px -7px 20px 0 rgba(255, 255, 255, 0.7),
                inset 7px 7px 20px 0 rgba(0, 0, 0, 0.2);
        }
        @media screen and (max-width: 1200px) {
    body a{
                cursor:default;
            }    
        }
    </style>
    
<style type="text/css">
.pseudolink { 
   color:blue; 
   text-decoration:underline; 
   cursor:pointer; 
   }
</style>


    
<script>
    function removenotificationtable()
    {  
        document.getElementById('notif-content').style.display = "none";
     
    }
    function displaylastgame()
    {
        document.getElementById('notification_bell_image').src = "assets/bell_icon2.png";
        if(document.getElementById('notif-content').style.display == "block")
        document.getElementById('notif-content').style.display = "none";
        else
        document.getElementById('notif-content').style.display = "block";
    }
    
    

    document.getElementById('notif')
</script>




</head>

<body>
    <div id="header"  style="background-size:cover;">
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
<div id="notif" onclick="displaylastgame()"  class="notification" style="display: flex; justify-content: center; align-items: center;">
                <div onclick="updateDiv()" class="_13lGWV5zrZ" style="cursor: pointer;">
                   
                        <button onclick="Notification_function()" style="border: none;background: none;"
                        id="notif-button">
                            
                            <div id="notif-bell-image">
                            <?php 
                            if($Notification==0 || $Notification==NULL)
                        {
                        ?>
                   <img src="assets/bell_icon2.png" id="notification_bell_image">
                <?php 
                            
                        }
                
                            if($Notification==1)
                        {
                            ?>
                           <img src="assets/bell_icon2_red.png" id="notification_bell_image">
                          <?php } ?>
                </div>
                </button>
                </div>
                <div id="notif-content">
                    <div class="dontknow">
     <table style="pointer-events: none;">  
     <tr><th>Time</th><th>Rank</th><th>Result</th></tr>
      <?php
$Game_History;

$i = $pos2 = 0;    
if(!empty($Game_History)){
    
$number_of_history=substr_count($Game_History,"</tr>");
   
   if($number_of_history==1){
    
do {
        $pos2 = strpos( $Game_History, "</tr>", $pos2);
} while( $i++ < 1);
}

if($number_of_history==2){
    
do {
        $pos2 = strpos( $Game_History, "</tr>", $pos2+1);
} while( $i++ < 1);
}

if($number_of_history>2){
    
do {
        $pos2 = strpos( $Game_History, "</tr>", $pos2+1);
} while( $i++ < 2);
}
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
    <div class="main-div" onclick="removenotificationtable()">
        <div class="navbar">
            <a href="nsebse.php">

                <img src="assets/games_unselected.png" width="40px" height="40px" class="navbar-icon">
                <p>Games</p>
            </a>
            <a href="blog.php"><img src="assets/blog_selected.png" width="40px" height="40px" class="navbar-icon">
                <p style="color:#a200e4;">Blogs</p>
            </a>
            <a href="profile.php"><img src="assets/user_unselected.png" height="35px" width="37px" class="navbar-icon">
                <p>Profile</p>
            </a>
        </div>
        <div class="title">
            <p>Blog</p>
        </div>
        <div class="game-area">
            <div id="cards">
         
            </div>
 

        
        </div>
        
        
        <div class="game-area">
            <div id="live-cards"></div>
        </div>
        
        
        
        
        
  
        
        
        
    </div>

    </div>
</body>
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



<!--if (1>0) {-->
            
<!--                     setcookie("User_Name", $username, time()+60*60*60,'/');-->
<!--                     setcookie("Name", $name, time()+60*60*60,'/');-->
<!--                              setcookie("Password", $hashed_password, time()+60*60*60,'/');-->
<!--                                       setcookie("Termsl", $terms, time()+60*60*60,'/');-->
<!--                                                setcookie("Email",$email, time()+60*60*60,'/');-->
<!--                                                setcookie("token",$token, time()+60*60*60,'/');-->
<!--                                                setcookie("Referal_Code", $username, time()+60*60*60,'/');-->
<!--                                                setcookie("Coins", $coins, time()+60*60*60,'/');-->









  
</html>