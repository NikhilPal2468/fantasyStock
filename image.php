<?php
$User_Id = $_COOKIE['User_Id'];
// $sql = "UPDATE `users`SET `Profile_Image`= `xp`+ 1 WHERE `name` = '".$_REQUEST['name']."'";
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karrot | Choose your Avatar</title>
</head>
<style>
    body{
        background: url(assets/bgspace.jpg) no-repeat center center/cover;
        color: white;
    }
    #profile {
        display: none;
    }

    .chooseprofile {
        height: 60px;
        width: 60px;
        border-radius: 100px;
    }

    .container-toon {
        width: 30%;
        align-content: center;
        
    }
    @media screen and (max-width: 700px) {
        .container-toon {
            width: 80%;
        }
    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #profileImage {
        height: 100px;
        width: 100px;
        border-radius: 100px;
    }

    #submitBtn {
        cursor: not-allowed;
    }

    .savebtn input {
        display: flex;
        background: url(assets/bgspacelight.jpg) no-repeat center;
        border: 1px solid purple;
        height: 32px;
        border-radius: 10px;
        width: 100px;
        align-items: center;
        justify-content: center;
        color: white;
        margin-top: 32px;
    }

    .heading {
        display: flex;
        justify-content: center;
        font-size: 30px;
    }

    input[type="radio"] {
        display: none;
    }
</style>
<?php
// define variables and set to empty values
$profilerr =  "";
$profile = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["test"])) {
        $profilerr = "Please Choose Profile Photo";
    } 
    else {
        $profile = $_POST["test"];
    }
    if (mysqli_query($connect, "UPDATE users SET Profile_Image = '$profile' WHERE User_Id = '$User_Id'")) {
        header("Location: https://karrotlive.com/nsebse.php");
    } else {
        echo "<script>alert(' not done')</script>";
    }
}
?>

<body>
    <center class="heading">
        <h2>Choose your Avatar</h2>
</center>
    <div style="display: flex; justify-content: center; margin-bottom: 25px;">
        <input id="profile" type="file" name="profile">
        <img id="profileImage" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQBAMAAAB8P++eAAAAJ1BMVEXS2d/x9fni6O3s8fXf5Orv8/fp7vPm6/DW3eLU2+Ha4Obc4ufY3+Rrd/KFAAABV0lEQVRIx+3VPUvDUBTG8VAj2uhymhdFHSyIS6dQBAcHWxB084KDa1wEJ12sowpOLlr9AHFwFwcnh340X9Cac+Pz3EKXQvuff9Dem5wTb9Ikd9V2p9O4dLtuJp+Fe05n5Ltwm7vZVH4K+a8/S78t5ubkr7hH4I0UOiQwLcIEO19U+OBTGu5D2NJwGcJMOfInRRffAReIVY8f2n3sig1XRw+WDvMC4LwNczRWxoLDP8KWhhGE9xouQjij4SkeVg3JwNaLrubhHopwk8AAvI30giKPVVFvBGvn1x14g62zxLlK/VStR1KwbuKj3BunbtvnTSMSN4/X3rGqvm6okWmAbfaYiVWy+5+7NlLuouy6CmDpG5uAb2JdQDUyqGxozzBcgJuRbfIrBlfwGoNLLRBaTs4MVvk0Ueor+8ThklokpAg8P3Ll2ZCwfJEph+EoQCO8PnyjMj75Mh9rrXB9VG41/gAAAABJRU5ErkJggg==" alt="">
        <label for="profile" style="cursor: pointer;">
        </label>
    </div>
    <form action="" method="post">

        <div class="container">

            <center class="container-toon">
                <label>
                    <input type="radio" name="test" value="assets/profile/ambani.jpg">
                    <img onclick="first()" class="chooseprofile" src="assets/profile/ambani.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/damani.jpg">
                    <img onclick="second()" class="chooseprofile" src="assets/profile/damani.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/elon.jpg">
                    <img onclick="third()" class="chooseprofile" src="assets/profile/elon.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/graham.jpg">
                    <img onclick="fourth()" class="chooseprofile" src="assets/profile/graham.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/mark.jpg">
                    <img onclick="fifth()" class="chooseprofile" src="assets/profile/mark.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/mehta.jpg">
                    <img onclick="sixth()" class="chooseprofile" src="assets/profile/mehta.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/nita.jpg">
                    <img onclick="seventh()" class="chooseprofile" src="assets/profile/nita.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/rakesh.jpg">
                    <img onclick="eighth()" class="chooseprofile" src="assets/profile/rakesh.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/scott.jpg">
                    <img onclick="ninth()" class="chooseprofile" src="assets/profile/scott.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/tata.jpg">
                    <img onclick="tenth()" class="chooseprofile" src="assets/profile/tata.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/warren.jpg">
                    <img onclick="eleventh()" class="chooseprofile" src="assets/profile/warren.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/profile/jeff.jpg">
                    <img onclick="twelfth()" class="chooseprofile" src="assets/profile/jeff.jpg" alt="">
                </label>
                <br>
                <label>
                    <input type="radio" name="test" value="assets/profile/milinda.jpg">
                    <img onclick="thirteenth()" class="chooseprofile" src="assets/profile/milinda.jpg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/buffet.jpeg">
                    <img onclick="fourteenth()" class="chooseprofile" src="assets/buffet.jpeg" alt="">
                </label>
                <label>
                    <input type="radio" name="test" value="assets/buffet.jpeg">
                    <img onclick="fifteenth()" class="chooseprofile" src="assets/buffet.jpeg" alt="">
                </label>

            </center>
            <div class="savebtn">
                <input id="submitBtn" type="submit" class="submit-btn" name="submit" value="Save" disabled></input>
            </div>
        </div>
    </form>


    <script type="text/javascript">
        // var fs = require('fs');
        // const mysql = require("mysql");
        let allImages = document.getElementsByClassName("chooseprofile");

        var imgChange = document.getElementById("profileImage");

        function first() {
            imgChange.src = allImages[0].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function second() {
            imgChange.src = allImages[1].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function third() {
            imgChange.src = allImages[2].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function fourth() {
            imgChange.src = allImages[3].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function fifth() {
            imgChange.src = allImages[4].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function sixth() {
            imgChange.src = allImages[5].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function seventh() {
            imgChange.src = allImages[6].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function eighth() {
            imgChange.src = allImages[7].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function ninth() {
            imgChange.src = allImages[8].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function tenth() {
            imgChange.src = allImages[9].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function eleventh() {
            imgChange.src = allImages[10].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function twelfth() {
            imgChange.src = allImages[11].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function thirteenth() {
            imgChange.src = allImages[12].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function fourteenth() {
            imgChange.src = allImages[13].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        function fifteenth() {
            imgChange.src = allImages[14].src;
            document.getElementById('submitBtn').disabled = false
            document.getElementById('submitBtn').style.cursor = 'pointer'
        }

        // function setprofile() {
        //   var txtid = document.getElementById('profileImage').src;
        //   console.log(txtid);


        // }
    </script>
</body>

</html>