<?php
header("Refresh:250");
require 'connection.php';
$User_Id = $_COOKIE['User_Id'];
$Game_Ids = [];
$query = "SELECT * FROM users where User_Id='$User_Id'";
$run = mysqli_query($connect, $query);
$row = mysqli_fetch_array($run);

$isEmailConfirmed = $row['isEmailConfirmed'];
if ($isEmailConfirmed == 1) {


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
    $maxplayers = array();
    $hoursInGames = array();
    $minutesInGames = array();
    $gamesTime = array();
    $gameId = array();
    $PlayersId = array(array());
    $CoinsToEnter = array();
    $PrizeMoney = array();
    $Years = array();
    $Months = array();
    $Dates = array();
    for ($i = 1; $i <= $a; $i++) {
        $query = "SELECT * FROM live_game where Game_Id  =$i AND Version='stock'";
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
            $Coins = $row['Coins'];
            $Coins_To_Enter = $row['Coins_To_Enter'];
            $Players = explode(",", $Players);
            $num = count($Players);

            $Date = $row['Date'];
            $Date = explode("-", $Date);
            array_push($Years, $Date[0]);
            array_push($Months, $Date[1]);
            array_push($Dates, $Date[2]);



            array_push($PlayersId, $Players);
            array_push($maxplayers, $Max_Players);
            array_push($numberofplayers, $num - 1);
            array_push($gameId, $Game_Id);
            array_push($gamesTime, $Game_Time);
            array_push($PrizeMoney, $Coins);
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
        <link rel="stylesheet" type="text/css" href="nsebse_nasdaq_css.css">

        <title>Karrot | BSE</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        
        <script>
            function removenotificationtable() {
                document.getElementById('notif-content').style.display = "none";
            }

            function displaylastgame() {
                document.getElementById('notification_bell_image').src = "assets/bell_icon2.png";
                if (document.getElementById('notif-content').style.display == "block")
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
                <p><?php echo $Player_Coin[0] + $Player_Coin[1]; ?></p>
            </div>
            <div id="header-profile-image">
                <a href="profile.php"><img src="<?php echo $Profile_Image; ?>"></a>
            </div>
            <div id="header-bell-icon">
                <div id="notif" onclick="displaylastgame()" class="notification" style="display: flex; justify-content: center; align-items: center;">
                    <div class="_13lGWV5zrZ">

                        <button onclick="Notification_function()" style="border: none;background: none;">
                            <?php
                            if ($Notification == 0 || $Notification == NULL) {
                            ?>
                                <img src="assets/bell_icon2.png" id="notification_bell_image">
                            <?php

                            }

                            if ($Notification == 1) {
                            ?>
                                <img src="assets/bell_icon2_red.png" id="notification_bell_image">
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
        <div class="main-div" onclick="removenotificationtable()">
            <div class="navbar">
                <a href="nsebse.php">

                    <img src="assets/games_selected.png" width="40px" height="40px" class="navbar-icon">
                    <p style="color:#a200e4;">Games</p>
                </a>
                <a href="#"><img src="assets/blog_unselected.png" width="40px" height="40px" class="navbar-icon">
                    <p>Blogs</p>
                </a>
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
                <a href="nsebse.php"><button class="btnSelection" id="btnActive">NSE/BSE</button></a>
                <a href="nasdaq.php"><button class="btnSelection">Nasdaq</button></a>

            </div>
            <div class="game-area-heading">
                <h1>Upcoming</h1>
            </div>
            <div class="game-area">
                <div id="cards">
                </div>
            </div>
            <div class="game-area-heading">
                <h1>Live</h1>
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

        function revisedRandId() {
            return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
        }

        function guidGenerator() {
            var S4 = function() {
                return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
            };
            return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
        }

        var players = <?php echo json_encode($Players); ?>;
        var playersId = <?php echo json_encode($PlayersId); ?>;
        var numberofplayers = <?php echo json_encode($numberofplayers); ?>;
        var hoursInGames = <?php echo json_encode($hoursInGames); ?>;
        var minutesInGames = <?php echo json_encode($minutesInGames); ?>;
        var max_players = <?php echo json_encode($maxplayers); ?>;
        var gamesTime = <?php echo json_encode($gamesTime); ?>;
        var gameId = <?php echo json_encode($gameId); ?>;
        var gameIds = <?php echo json_encode($Game_Ids); ?>;
        var CoinsToEnter = <?php echo json_encode($CoinsToEnter); ?>;
        var PrizeMoney = <?php echo json_encode($PrizeMoney); ?>;

        // Date
        var years = <?php echo json_encode($Years); ?>;
        var months = <?php echo json_encode($Months); ?>;
        var dates = <?php echo json_encode($Dates); ?>;

        // var currentplayers = players.length-1;
        var uid = <?php echo json_encode($User_Id) ?>;
        let cards = document.getElementById("cards");
        let liveCards = document.getElementById("live-cards");

        let total = <?php echo $cnt; ?>;
        var endCountDown = [];
        for (var i = 1; i <= total; i++) {
            let endTime = gamesTime[i - 1];

            // var now = new Date();
            // var year = now.getFullYear();
            // var month = now.getMonth();
            // var date = now.getDate();
            var d = new Date(years[i - 1], months[i - 1] - 1, dates[i - 1], hoursInGames[i - 1], minutesInGames[i - 1], 0, 0);
            endCountDown.push(d.getTime() + endTime * 60 * 1000)


            let card = document.createElement("div");
            let cardid = revisedRandId();
            card.className = "card"
            card.id = cardid;
            cards.append(card);
            let cardBackground = document.createElement("div");
            cardBackground.className = "card-backgroud"
            card.append(cardBackground);

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
            currentbytotal.innerHTML = numberofplayers[i - 1] + "/" + max_players[i - 1]
            cardMiddleOneBox.append(currentbytotal);

            let cardMiddleTwo = document.createElement("div");
            cardMiddleTwo.className = "card-middle-two"
            cardMiddle.append(cardMiddleTwo);

            let cardMiddleTwoBox = document.createElement("div");
            cardMiddleTwoBox.className = "card-middle-two-box"
            cardMiddleTwo.append(cardMiddleTwoBox);


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


            let cardMiddleThree = document.createElement("div");
            cardMiddleThree.className = "card-middle-three"
            cardMiddle.append(cardMiddleThree);

            let cardMiddleThreeBox = document.createElement("div");
            cardMiddleThreeBox.className = "card-middle-three-box"
            cardMiddleThree.append(cardMiddleThreeBox);

            let cardMiddleThreeBoxTitle = document.createElement("div");
            cardMiddleThreeBoxTitle.className = "card-middle-three-box-title";
            cardMiddleThreeBox.append(cardMiddleThreeBoxTitle);

            let prize = document.createElement("b");
            cardMiddleThreeBoxTitle.append(prize);
            prize.innerHTML = "Prize";

            let prizeMoney = document.createElement("div");
            prizeMoney.className = "card-middle-three-box-description"
            prizeMoney.innerHTML = PrizeMoney[i - 1];
            cardMiddleThreeBox.append(prizeMoney);


            let cardFooter = document.createElement("div");
            cardFooter.className = "card-footer";
            cardBackground.append(cardFooter);

            let cardFooterTitle = document.createElement("div");
            cardFooterTitle.className = "card-footer-title";
            cardFooter.append(cardFooterTitle);
            cardFooterTitle.innerHTML = gamesTime[i - 1] + " mins game";


            let link = document.createElement("a");
            let linkid = revisedRandId();
            link.id = linkid;

            link.href = "Stock_List.php?gid=<?php echo $gameId[0]; ?>";
            link.style.textDecoration = "none";
            cardFooter.append(link);


            let cardFooterDescription = document.createElement("div");
            cardFooterDescription.className = "card-footer-description";
            link.append(cardFooterDescription);

            let linkDescription = document.createElement("div");
            linkDescription.className = "card-footer-description-text";
            let buttonid = revisedRandId();
            linkDescription.id = buttonid;

            cardFooterDescription.append(linkDescription);
            linkDescription.innerHTML = "Enter/Rs. " + CoinsToEnter[i - 1];

            document.getElementById(linkid).setAttribute('href', 'Stock_List.php?gid=' + gameId[i - 1]);
            var x = setInterval(interval, 1000, d, timerid, startinid, linkid, endCountDown[i - 1], gameId[i - 1]);


            for (var j = 0; j < playersId.length; j++) {
                for (var k = 0; k < playersId[j].length; k++) {
                    for (var l = 0; l < gameIds.length; l++) {
                        if (playersId[j][k] == uid && gameIds[l] == gameId[i - 1]) {
                            document.getElementById(buttonid).innerHTML = "EDIT";
                            document.getElementById(linkid).setAttribute('href', 'Edit_Stock_List.php?gid=' + gameId[i - 1]);
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
                // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"

                // If the count down is over, write some text
                if (distance <= 0) {
                    // countDownDate = countDownDate + endTime * 60 * 1000;
                    document.getElementById(startinid).innerHTML = "Ends in";
                    document.getElementById(buttonid).innerHTML = "see the game";
                    document.getElementById(linkid).setAttribute('href', 'Sorting/Sorting_display.php?gid=' + gid);
                    endsin(endCount, timerid, d, cardid, card, gid);
                } else {
                    document.getElementById(timerid).innerHTML = hours + ":" + minutes + ":" + seconds;
                }
            }

            function endsin(endCountDow, timerid, d, cardid, card, gid) {
                liveCards.append(card)
                var x = setInterval(() => {
                    var now = new Date().getTime();
                    var distance = endCountDow - now;

                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById(timerid).innerHTML = hours + ":" + minutes + ":" + seconds;
                    players.forEach((user) => {
                        if (user == uid) {
                            document.getElementById(buttonid).innerHTML = "see the game";
                            document.getElementById(linkid).setAttribute('href', 'Sorting/Sorting_display.php?gid=' + gid);
                        }
                    });
                    if (distance <= 0) {
                        document.getElementById(cardid).style.display = "none"
                        document.getElementById(timerid).innerHTML = "EXPIRED";
                    }
                }, 1000);
            }
        }
    </script>
<?php } else {

    unset($_COOKIE['User_Id']);
    setcookie("User_Id", null, -1, '/');

    echo "Email not verified";
    echo "<a href='registration.php'>Please Register again.</a>";
}
?>

    </html>