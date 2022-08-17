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



?>

<?php
$query1 = "SELECT * FROM live_game where Game_Id =$Game_Id";
$run1 = mysqli_query($connect, $query1);
$row1 = mysqli_fetch_array($run1);
$Start_Time = $row1['Start_Time'];
$Game_Time = $row1['Game_Time'];
$Start_Time_explode = explode(":", $Start_Time);
$hr = $Start_Time_explode[0];
$min = $Start_Time_explode[1];

$query2 = "SELECT Coins,Profile_Image,Game_History,isEmailConfirmed FROM users where User_Id =$User_Id";
$run2 = mysqli_query($connect, $query2);
$row2 = mysqli_fetch_array($run2);

        $isEmailConfirmed = $row2['isEmailConfirmed'];
if($isEmailConfirmed==1){



$Coins = $row2['Coins'];
$Coins = explode("??", $Coins);
$Profile_Image = $row2['Profile_Image'];
$Game_History = $row2['Game_History'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" type="text/css" href="../header_and_footer_5.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <title>Document</title>
    <script>
        $(document).ready(function() {
            $("#div_refresh").load("Sorting_sorting.php?gid=<?php echo $Game_Id ?>&uid=<?php echo $User_Id ?>");
            setInterval(function() {
                $("#div_refresh").load("Sorting_sorting.php?gid=<?php echo $Game_Id ?>&uid=<?php echo $User_Id ?>");
            },10000);
        });
    </script>

    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
        }

         .main-div {
             height:auto;
            width: 100%;
            /* background-color: pink; */
            margin-top: 80px;
            margin-bottom:10px;
        }
           @media screen and (max-width: 1200px) {
            .main-div {
            margin-bottom:60px;
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
        #div_refresh {
            width: 100%;
        }
        
         
        /*CSS for New Header for Mobile*/


            #header-mobile{
                display: none;
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
            background-image: url('../assets/bgspace.jpg');
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
            
                @media screen and (max-width: 1200px) {
                #logo-arrow{
             width:40px;
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

        .ends-in{
            display:flex;
            flex-direction:row;
        }
        #timer{
            margin:12px 0px;
        }
        
        ._13lGWV5zrZ{
         cursor:pointer;   
        }
         @media screen and (max-width: 1020px) {
             body a{
                 cursor:default;
             }
         ._13lGWV5zrZ{
         cursor:default;   
        }    
             
         }
        
        
    </style>

</head>


<body>
<div id="header" style="background-size:cover;">
<div id="logo">

      <img src="../karrotlogo2.png" class="active" id="nav-logo" />
</div>
<div id="header-space">

</div>
<div id="header-money">
<p><?php echo $Player_Coin[0];?></p>
</div>
<div id="header-profile-image">
  <a href="../profile.php"><img src="../<?php echo $Profile_Image;?>"></a>
</div>
<div id="header-bell-icon">
<div id="notif" onclick="displaylastgame()" class="notification" style="display: flex; justify-content: center; align-items: center;">
                <div class="_13lGWV5zrZ" style="cursor: pointer;">
                   
                        <button onclick="Notification_function()" style=" border: none;background: none;">
                            <?php 
                            if($Notification==0 || $Notification==NULL)
                        {?>
                   <img src="../assets/bell_icon2.png">
                <?php }?>
                            <?php 
                            if($Notification==1)
                        {
                            ?>
                         <img src="../assets/bell_icon2_red.png">
                          <?php } ?>
                </button>
                </div>
                <div id="notif-content">
                    <div class="dontknow">
     <table style="pointer-events: none;">
     <tr><th>Time</th><th>Rank</th><th>Reward</th></tr>
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
    <a href="../nsebse.php" style="text-decoration: none;">
<p id="logo-arrow">
<img src="../assets/back-button4.png">
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
 <a href="../profile.php"><img src="../<?php echo $Profile_Image;?>"></a></div>
</div>


<!-- End of New Header for Mobile  -->




    <div class="main-div" onclick="removenotificationtable()">
        <div class="navbar">
            <a href="../nsebse.php">

                <img src="../assets/games_selected.png" width="40px" height="40px" class="navbar-icon">
                <p style="color:#a200e4;">Games</p>
            </a>
            <a href="../blog.php"><img src="../assets/blog_unselected.png" width="40px" height="40px" class="navbar-icon">
                <p>Blogs</p>
            </a>
            <a href="../profile.php"><img src="../assets/user_unselected.png" height="35px" width="37px" class="navbar-icon">
                <p>Profile</p>

            </a>
        </div>
        <div class="title">
            <p> Live Game</p>


        </div>

        <div class="game-area">
            <div class="ends-in">
            <h5>Ends in :	&nbsp;</h5>
            <div id="timer"></div>
            </div>
            <div id="div_refresh"></div>
        </div>

    </div>

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
    function removenotificationtable()
    {  
        document.getElementById('notif-content').style.display = "none";
    }


    function displaylastgame()
    {
        if(document.getElementById('notif-content').style.display == "block")
        document.getElementById('notif-content').style.display = "none";
        else
        document.getElementById('notif-content').style.display = "block";
    }
    document.getElementById('notif')
</script>
</body>
<script>
    let gameTime = <?php echo json_encode($Game_Time); ?>;
    let hr = <?php echo json_encode($hr); ?>;
    let min = <?php echo json_encode($min); ?>;
    var now = new Date().getTime();
    console.log(now);
    let endTime = gameTime;
    let endCountDown
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth();
    var date = now.getDate();
    var d = new Date(year, month, date, hr, min, 0, 0);
    endCountDown = (d.getTime() + endTime * 60 * 1000)
    console.log(endCountDown);
    var x = setInterval(() => {
        var now = new Date().getTime();
        var distance = endCountDown - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timer").innerHTML = hours + ":" + minutes + ":" + seconds;
    }, 1000);
</script>

<?php
    
} 
else
{
echo "Email not verified";
echo "<a href='registration.php'>Please Register again.</a>";
}?>
</html>