<?php

require 'connection.php';

$User_Id = $_COOKIE['User_Id'];

$Game_Ids = [];
$query = "SELECT * FROM users where User_Id='$User_Id'";
$run = mysqli_query($connect, $query);
$row = mysqli_fetch_array($run);
$Live_game = $row['Live_game'];
$Game_History=$row['Game_History'];
$Player_Coin=$row['Coins'];        
$Player_Coin=explode("??", $Player_Coin);
$Notification=$row['Notification'];
$Game_Id3 = explode("=>", $Live_game);
$Profile_Image=$row['Profile_Image'];


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
$maxplayers = array();
$hoursInGames = array();
$minutesInGames = array();
$gamesTime = array();
$gameId = array();
$PlayersId = array();
for ($i = 1; $i <= $a; $i++) {
    $query = "SELECT * FROM live_game where Game_Id  =$i AND Version='crypto'";
    $run = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($run);
    $Game_Time = $row['Game_Time'];
    // echo json_encode($row);
    if ($row != NULL && !empty($Game_Time)) {
        $Max_Players = $row['Max_Players'];
        $Game_Id = $row['Game_Id'];
        $Game_Time = $row['Game_Time'];
        $version = $row['Version'];
        $Players = $row['Players'];
        $Players = explode(",", $Players);
        $num = count($Players);



        array_push($PlayersId, $Players);
        array_push($maxplayers, $Max_Players);
        array_push($numberofplayers, $num - 1);
        array_push($gameId, $Game_Id);
        array_push($gamesTime, $Game_Time);
        $Start_Time = $row['Start_Time'];
        $Game_Time = $row['Game_Time'];
        $Time = explode(":", $Start_Time);
        array_push($hoursInGames, $Time[0]);
        array_push($minutesInGames, $Time[1]);
        if ($version == 'crypto')
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
        <link rel="stylesheet" type="text/css" href="header_and_footer_4.css">
    <title></title>
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
            background-color: #ffffff;
            background-image: linear-gradient(315deg, #ffffff 0%, #d7e1ec 74%);
            font-size: 100px;
        }
        .title p
        {
            margin-left: 20%;

        }

            @media screen and (max-width: 1200px) {

                .title p
        {
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
           
        }

        .game-type-selection a {
            cursor: pointer;
        }

        .game-type-selection button {
            border: none;
           
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
        .game-area-heading h1{
            margin-left: 20%;

        }


        .game-area {
            position: inherit;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
   /*background-color: #efefef;*/
/*background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);*/
background-color: #e056fd;
background-image: linear-gradient(315deg, #9b0ab9 0%, #391d75 95%);
            width: 77%;
            height: auto;
            margin-left:20%;
            margin-top: 20px;
            text-align: center;
        }
 @media screen and (max-width: 1200px) {
.game-area {

margin-left: 5%;
width: 90%;
}
        .game-area-heading h1{
            margin-left: 10%;

        }


 }


        @media screen and (max-width: 700px) {
.game-area-heading {

                margin-left: 0px;
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
.game-area-heading h1{
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



.card-background{
border: 1px solid black;
border-radius: 10px;
height: 310px;
width: 351px;

}

.card-heading{
    font-size: 25px;
    text-align: center;
}

.card-middle{
    height: 140px;
    width: 100%;

                
}
.card-middle-one{
height: 70px;
width: 25%;

float: left;
margin-top: 50px;
}
.card-middle-one-box{
height: 50px;
width: 100%;margin-top: 10px;
font-size: 20px;
text-align: center;
}

.card-middle-one-box-description{
border-radius: 6px;
background-color: darkgray;
width: 70%;
margin-left: 10px;

font-size: 20px;
}
.card-middle-two{
height: 90px;
width: 45%;
float: left;margin-left: 10px;
margin-top: 30px;
border: 1px solid black;
text-align: center;

}
.card-middle-two-box{
height: 80px;
width: 100%;

margin-top: 1%;

text-align: center;
}
.card-middle-two-box-title{
    font-size: 20px;

}
.card-middle-two-box-description{
margin-top: 10px;
    font-size: 30px;
}

.card-middle-three{
height: 50px;
width: 25%;
float: left;
margin-top: 30px;
}




.card-footer{
height: 100px;
width: 100%;

}

.card-footer-title{
    height: 50px;
    width: 40%;
    padding-top: 10px;
    text-align: center;
    font-size: 20px;

margin-left: 95px;
margin-top: 10px;}

.card-footer-description{
    height: 50px;
    width: 100%;
    cursor: pointer;
background-image: url('assets/bgspacebutton.jpg');
 background-repeat: no-repeat;
   background-size: 95% 90%;
   background-position: center;
  
}
.card-footer-description-text{
color: white;   font-size: 25px; 
   padding-top: 10px;
   text-align: center;}



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

.card-background{
height: 230px;
width: 250px;

}

.card-heading{
    font-size: 20px;
}



.card-middle{
    height: 110px;
                
}
.card-middle-one{

margin-top: 30px;
}
.card-middle-one-box{

font-size: 17px;
}

.card-middle-one-box-description{

font-size: 16px;
}
.card-middle-two{
height: 80px;

margin-left: 5px;
margin-top: 18px;

}

.card-middle-two-box-title{
    font-size: 18px;

}
.card-middle-two-box-description{

    font-size: 25px;
}



.card-footer{
height: 70px;


}

.card-footer-title{
    height: 40px;
 

    font-size: 18px;
margin-left: 70px;
margin-top: 0px;}

.card-footer-description{
    height: 40px;
   background-size: 90% 90%;

  
}
.card-footer-description-text{
  font-size: 20px; 
   }



}


@media screen and (max-width: 300px) {
        .card {
            height: 210px;
            width: 230px;
}
}
#notif-content{
    top: 100px;
    right: 0;
    width: 245px;
    position: absolute;
    background: #fff;
    border-radius: 10px;
    padding: 8px 0;
    max-height: calc(100vh - 100px);
    overflow-y: scroll;
    display: none;
}



.dontknow table{
    margin-top: 20px;
    width: 90%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.dontknow th,.dontknow td{
     border: 1px solid #ddd;
  padding: 8px;
   padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
}
.dontknow tr:nth-child(even)
{
    background-color: #f2f2f2;
}
.dontknow th{
  background-color: black;
  color: white;
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
#btnActive{
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

    </style>
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
        <div class="title">
            <p>
            Games
        </p>
        </div>
        <div class="game-type-selection">
            <a href="nsebse.php"><button class="btnSelection">NSE/BSE</button></a>
            <a href="crypto.php"><button class="btnSelection"  id="btnActive">Crypto</button></a>
        
        </div>
        <div class="game-area-heading">
                <h1 >Upcoming</h1>
        </div>
        <div class="game-area">
            <div id="cards">
       
                
                
            </div></div>

        <div class="game-area-heading">
                <h1 >Live</h1>
        </div>
            <div class="game-area">
        
            <div id="live-cards">
                   </div>
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







<script>
    function revisedRandId() {
        return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
    }

    function guidGenerator() {
        var S4 = function() {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        };
        return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
    }
    // console.log(guidGenerator());
    // console.log(revisedRandId());

    var players = <?php echo json_encode($Players); ?>;
    var playersId = <?php echo json_encode($PlayersId); ?>;
    var numberofplayers = <?php echo json_encode($numberofplayers); ?>;
    var hoursInGames = <?php echo json_encode($hoursInGames); ?>;
    var minutesInGames = <?php echo json_encode($minutesInGames); ?>;
    var max_players = <?php echo json_encode($maxplayers); ?>;
    var gamesTime = <?php echo json_encode($gamesTime); ?>;
    var gameId = <?php echo json_encode($gameId); ?>;
    var gameIds = <?php echo json_encode($Game_Ids); ?>;
    // var currentplayers = players.length-1;
    console.log(players);
    console.log(playersId);
    console.log(numberofplayers);
    console.log(hoursInGames);
    console.log(minutesInGames);
    console.log(max_players);
    console.log(gamesTime);
    console.log(numberofplayers);
    console.log(gameId);
    console.log(gameIds);
    var uid = <?php echo json_encode($User_Id) ?>;
    players.forEach(user => {
        if (user == uid)
            console.log("Nik");
    });
    let cards = document.getElementById("cards");
    let liveCards = document.getElementById("live-cards");

    let total = <?php echo $cnt; ?>;
    console.log(total);
    var endCountDown = [];
    for (var i = 1; i <= total; i++) {
        let endTime = gamesTime[i - 1];

        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth();
        var date = now.getDate();
        var d = new Date(year, month, date, hoursInGames[i - 1], minutesInGames[i - 1], 0, 0);
        endCountDown.push(d.getTime() + endTime * 60 * 1000)
        console.log(endCountDown.length);
        console.log(endCountDown);


        let card = document.createElement("div");
        let cardid = revisedRandId();
        card.className = "card"
        card.id = cardid;
        cards.append(card);
        // let cardst = document.getElementById(cardid);
        // cardst.style.height = "200px";
        // cardst.style.width = "350px";
        // cardst.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2)";
        // cardst.style.transition = "0.3s";
        // cardst.style.padding = "30px";
        // cardst.onmouseover = function() {
        //     this.style.boxShadow = "0 8px 16px 0 rgba(0, 0, 0, 0.2)";
        // }
        // cardst.onmouseout = function() {
        //     this.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2)";
        // }
        let cardBackground = document.createElement("div");
        cardBackground.className = "card-backgroud"
        card.append(cardBackground);
        
        
        // let description = document.createElement("div");
        // let descriptionid = revisedRandId();
        // description.id = descriptionid;
        // description.innerHTML = "15-minutes game"
        // document.getElementById(cardid).append(description);
        // let descriptionst = document.getElementById(descriptionid);
        // descriptionst.style.fontWeight = "800";
        // descriptionst.style.fontFamily = "Play";

        let heading = document.createElement("div");
        heading.className = "card-heading";
        cardBackground.append(heading);
        
        
        let h4 = document.createElement("h4");
        heading.append(h4);
        h4.innerHTML = "NSE/BSE";

        let cardMiddle = document.createElement("div");
        cardMiddle.className = "card-middle"
        cardBackground.append(cardMiddle);

        let cardMiddleOne = document.createElement("div");
        cardMiddleOne.className = "card-middle-one"
        cardMiddle.append(cardMiddleOne);
        
        let cardMiddleOneBox = document.createElement("div");
        cardMiddleOneBox.className = "card-middle-one-box"
        cardMiddleOne.append(cardMiddleOneBox);
        
        let cardMiddleOneBoxTitle = document.createElement("div");
        cardMiddleOneBoxTitle.className = "card-middle-one-box-title";
        cardMiddleOneBox.append(cardMiddleOneBoxTitle);
        
        let slots = document.createElement("b");
        cardMiddleOneBoxTitle.append(slots);
        slots.innerHTML = "Slots";

        let currentbytotal = document.createElement("div");
        currentbytotal.className = "card-middle-one-box-description"
        currentbytotal.innerHTML = numberofplayers[i - 1] + "/" + max_players[i-1]
        cardMiddleOneBox.append(currentbytotal);
        
        let cardMiddleTwo = document.createElement("div");
        cardMiddleTwo.className = "card-middle-two"
        cardMiddle.append(cardMiddleTwo);
        
        let cardMiddleTwoBox = document.createElement("div");
        cardMiddleTwoBox.className = "card-middle-two-box"
        cardMiddleTwo.append(cardMiddleTwoBox);
        
        // let cardMiddleTwoBoxTitle = document.createElement("div");
        // cardMiddleTwoBoxTitle.innerHTML = "Starts In";
        // cardMiddleTwoBoxTitle.className = "card-middle-two-box-title";
        // cardMiddleTwoBox.append(cardMiddleTwoBoxTitle);
        
        
        
        let startin = document.createElement("div");
        let startinid = revisedRandId();
        startin.className = "card-middle-two-box-title";
        startin.id = startinid;
        startin.innerHTML = "Starts in"
        cardMiddleTwoBox.append(startin);

        let timer = document.createElement("div");
        timer.className = "card-middle-two-box-description";
        let timerid = revisedRandId();
        timer.id = timerid;
        cardMiddleTwoBox.append(timer);
        

        let cardFooter = document.createElement("div");
        cardFooter.className = "card-footer";
        cardBackground.append(cardFooter);
        
        let cardFooterTitle = document.createElement("div");
        cardFooterTitle.className = "card-footer-title";
        cardFooter.append(cardFooterTitle);
        cardFooterTitle.innerHTML = "<?php echo $row['Game_Time']; ?> mins game";
        
        
        let link = document.createElement("a");
        let linkid = revisedRandId();
        link.id = linkid;
        
        link.href = "Crypto_List.php?gid=<?php echo $gameId[0]; ?>";
        link.style.textDecoration = "none";
        cardFooter.append(link);
        

        let cardFooterDescription = document.createElement("div");
        cardFooterDescription.className = "card-footer-description";
        link.append(cardFooterDescription);
        
        let linkDescription = document.createElement("div");
        linkDescription.className = "card-footer-description-text";
        let buttonid = revisedRandId();
        linkDescription.id=buttonid;

        cardFooterDescription.append(linkDescription);
        linkDescription.innerHTML = "Enter/Rs. <?php echo $row['Coins_To_Enter']; ?>";


        // let button = document.createElement("button");
        // let buttonid = revisedRandId();
        // button.id = buttonid;
        // button.innerHTML = "Enter";
        // document.getElementById(linkid).append(button);
        // let buttonst = document.getElementById(buttonid);
        // buttonst.style.color = "white";
        // buttonst.style.cursor = "pointer";
        // buttonst.style.padding = "10px 130px";
        // buttonst.style.background = "blue";
        // buttonst.style.borderRadius = "15px";
        // buttonst.style.width = "150px";
        // buttonst.style.display = "flex";
        // buttonst.style.textAlign = "center";
        // buttonst.style.justifyContent = "center";


        document.getElementById(linkid).setAttribute('href', 'Crypto_List.php?gid=' + gameId[i - 1]);
        // console.log(minutestostart);
        // var countDownDate = new Date().getTime() + minutestostart * 60 * 1000 + 2000;

        // + minutestostart * 60 * 1000
        // var now = new Date();
        // var year = now.getFullYear();
        // var month = now.getMonth();
        // var date = now.getDate();
        // var d = new Date(year, month, date, hoursInGames[i - 1], minutesInGames[i - 1], 0, 0);
        // var endCountDown = [];
        // endCountDown.push(d.getTime() + endTime * 60 * 1000)
        // console.log(endCountDown.length);
        // console.log(endTime);
        var x = setInterval(interval, 1000, d, timerid, startinid, linkid, endCountDown[i - 1], gameId[i - 1]);
        // document.getElementById(startinid).innerHTML = "Ends in";
        //         console.log(i);
        //         document.getElementById(linkid).setAttribute('href', 'Edit_Stock_List.php?gid=' + gameId[i - 1]);
        //         // clearInterval(x);
        //         endsin(endCountDown[i-1], timerid, d);
        //         console.log("endCountDow");

        for (var j = 0; j < playersId.length; j++) {
            for (var k = 0; k < playersId[j].length -1; k++) {
                for (var l = 0; l < gameIds.length; l++) {
                    if (playersId[j][k] == uid && gameIds[l] === gameId[i - 1]) {
                        document.getElementById(buttonid).innerHTML = "EDIT";
                        document.getElementById(linkid).setAttribute('href', 'Edit_Crypto_List.php?gid=' + gameId[i - 1]);
                      }
                }
            }
        }

        function interval(d, timerid, startinid, linkid, endCount, gid) {
            var countDownDate = d.getTime();
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById(timerid).innerHTML = hours + ":" + minutes + ":" + seconds;
            // console.log(minutes);
            // If the count down is over, write some text
            if (distance <= 0) {
                // countDownDate = countDownDate + endTime * 60 * 1000;
                document.getElementById(startinid).innerHTML = "Ends in";
                document.getElementById(buttonid).innerHTML = "see the game";
                document.getElementById(linkid).setAttribute('href', 'Sorting/Sorting_display.php?gid=' + gid);
                // clearInterval(x);
                // console.log(endCount);
                // console.log("endCount");
                console.log(cardid);
                console.log("cardid");
                console.log(card);
                endsin(endCount, timerid, d, cardid, card);

            }
        }
        // j++;
        function endsin(endCountDow, timerid, d, cardid, card) {
            // console.log(endCountDown);
            // + minutestostart * 60 * 1000
            // Update the count down every 1 second
            liveCards.append(card)
            var x = setInterval(() => {

                // Get today's date and time
                var now = new Date().getTime();
                // Find the distance between now and the count down date
                var distance = endCountDow - now;

                // Time calculations for days, hours, minutes and seconds
                // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById(timerid).innerHTML = hours + ":" + minutes + ":" + seconds;
                // document.getElementById(timerid).innerHTML = "EXPIRED";

                // If the count down is over, write some text
                players.forEach((user) => {
                    if (user == uid) {

                        document.getElementById(buttonid).innerHTML = "see the game";
                        document.getElementById(linkid).setAttribute('href', 'Sorting/Sorting_display.php?gid=' + gameId[i - 1]);
                    }
                });
                if (distance <= 0) {
                    document.getElementById(cardid).style.display = "none"
                    document.getElementById(timerid).innerHTML = "EXPIRED";
                    // document.getElementById(startinid).innerHTML = "Ends in";
                    // document.getElementsByClassName("enter").innerHTML = "EDIT";
                    // document.getElementsByClassName("enter").href="Edit_Stock_List.php"; 
                    // document.getElementById("btn2").href = "Edit_Stock_List.php";
                    // clearInterval(x);

                }
            }, 1000);
        }
    }
</script>

</html>