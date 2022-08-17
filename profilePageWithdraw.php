<?php

require 'connection.php';

$User_Id = $_COOKIE['User_Id'];
$ch = mysqli_query($connect, "SELECT Coins FROM users WHERE User_Id='$User_Id'");
$row = mysqli_fetch_array($ch);
$Coins = $row['Coins'];
(int)$Coins = explode("??", $Coins);
$Total_coins = $Coins[0];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="header_and_footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title></title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style type="text/css">
        body {
            display: flex;
            justify-content: center;
            background: url("assets/bgspace.jpg") center;
            background-size: cover;
        }

        #main-div {
            border: 1px solid black;
            width: 600px;
            height: auto;
            background-color: white;
            padding: 50px;
            margin-top: 20px;
        }

        #title-name {
            font-size: 35px;
            margin-bottom: 25px;
        }

        #title-price {
            margin-bottom: 25px;
        }

        #price-input {
            text-align: center;
        }

        #price-input input {
            width: 75%;
            height: 30px;
            border: 2px solid black;
            font-size: 20px;

        }

        #price-selection {
            text-align: center;
            margin-top: 50px;
        }

        #price-selection-button {
            background-color: transparent;
            width: 40%;
            height: 30px;
            margin-bottom: 20px;
            margin-left: 10px;
            font-size: 20px;
            background: url("assets/bgspacelight2.jpg") center;
            background-size: cover;
            color: white;
        }

        .savebtn {
            margin-top: 30px;
            width: 100%;
            text-align: center;
        }

        .savebtn input {
            height: 35px;
            width: 200px;
            background-color: #7f53ac;
            background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
            color: white;
            border: 0;
            font-size: 22px;
        }

        @media screen and (max-width: 1020px) {

            #main-div {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div id="main-div">
        <div id="title">
            <div id="title-name">
                <p>
                    Amount
                </p>
            </div>
            <div id="title-price">
                <p>Available balance:<b>&nbsp;<?php echo $Total_coins; ?></b></p>
            </div>
        </div>
        
        
          <form method="post" action="duplicate_username_check_for_profile.php">
        <div id="price-input">
            <input type="number" name="amount" value="500" id="amount"><br>
            <label id="msg" style="font-size:12px;color: red;"></label>
        </div>
       
         </form>
        
        
        <div id="price-selection">
            <button id="price-selection-button" onclick="first()">500</button>
            <button id="price-selection-button" onclick="second()">1000</button>
            <button id="price-selection-button" onclick="third()">1500</button>
            <button id="price-selection-button" onclick="fourth()">2000</button>
        </div>
        <div class="savebtn">
            <input id="submitBtn" type="submit" class="submit-btn" name="submit" value="Withdraw Amount" disabled></input>
        </div>
    </div>
</body>


<script type="text/javascript">
    $(document).ready(function() {
        $("#amount").blur(function() {
            var amount = $(this).val();
            if (amount == "") {
                $("#msg").fadeOut();
            } else {
                $.ajax({
                    url: "duplicate_username_check_for_profile.php",
                    method: "POST",
                    data: {
                        amount: amount
                    },
                    success: function(data) {
                        $("#msg").fadeIn().html(data);
                               if(data.includes("between") ){
                           $('#submitBtn').prop('disabled', true);
                    }
                    else{
                     $('#submitBtn').prop('disabled', false);   
                    }
                    }
                });
            }
        });
    });

</script>



<script type="text/javascript">
    // var fs = require('fs');
    // const mysql = require("mysql");
    var images = ["500", "1000", "1500", "2000"]


    var imgChange = document.getElementById("amount");

    function first() {
        imgChange.value = images[0];
        document.getElementById('submitBtn').disabled = false
        document.getElementById('submitBtn').style.cursor = 'pointer'
    }

    function second() {
        imgChange.value = images[1];
        document.getElementById('submitBtn').disabled = false
        document.getElementById('submitBtn').style.cursor = 'pointer'
    }

    function third() {
        imgChange.value = images[2];
        document.getElementById('submitBtn').disabled = false
        document.getElementById('submitBtn').style.cursor = 'pointer'
    }

    function fourth() {
        imgChange.value = images[3];
        document.getElementById('submitBtn').disabled = false
        document.getElementById('submitBtn').style.cursor = 'pointer'
    }

    // function setprofile() {
    //   var txtid = document.getElementById('profileImage').src;
    //   console.log(txtid);


    // }
    function imposeMinMax(el) {
        if (el.value != "") {
            if (parseInt(el.value) < parseInt(el.min)) {
                el.value = el.min;
            }
            if (parseInt(el.value) > parseInt(el.max)) {
                el.value = el.max;
            }
        }
    }
</script>

</html>