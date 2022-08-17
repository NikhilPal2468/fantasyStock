<?php
// Start the session
session_start();
?>

<?php
require 'connection.php';

$email = $_SESSION['email'];
$Email = $_COOKIE['Email'];
$Password = $_COOKIE['Password'];
$Coins = $_COOKIE['Coins'];
$token = $_COOKIE['token'];
$User_Name = $_COOKIE['User_Name'];
$Name = $_COOKIE['Name'];
$Termsl = $_COOKIE['Termsl'];


$codeErr = "";
$code = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["code"])) {
        $codeErr = "code is required";
    } else {
        $code = test_input($_POST["code"]);
    }

    // echo $email;
    // echo $token;






    // $ch = mysqli_query($connect, "SELECT * FROM users WHERE Email = '$email'");
    // $row = mysqli_fetch_array($ch);
    // $token1 = $row['token'];







    if ($code == $token) {
       mysqli_query($connect, "insert into users (User_Name,Name,Password,Terms,Email, token, Referal_Code, Coins, isEmailConfirmed) values  ('$User_Name','$Name','$Password','$Termsl','$Email', '$token', '$User_Name', '$Coins', '1')");
        
        
        
            $ch = mysqli_query($connect, "select * from users where User_Name='$User_Name'");
            $count  = mysqli_num_rows($ch);
            $row = mysqli_fetch_array($ch);
            $User_Id = $row['User_Id'];
            // $_SESSION['User_Id'] = $User_Id;
        
        // "UPDATE users SET isEmailConfirmed=1,token=NULL WHERE email='$email'"
        
        setcookie("User_Id", $User_Id, time() + 60 * 24 * 60 * 60, "/");
        
        header('Location:image.php');
    } else {
        echo "<script>alert('Invalid Code')</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifying Email...!</title>
</head>
<style>
    body{
        margin: 0px;
    }
       body{
            margin: 0px; 
            font-family: 'Roboto', sans-serif;
    }
        .container{
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
            justify-content: center;
            align-items: center;
            background: url(assets/bgspace.jpg) no-repeat center center/cover;
            
        }     
         #login-help{
            color: white;
            font-size: 35px;

         }
        #main-form{
            background-color:white;
            height: 300px;
            text-align: center;
            width: 300px;
            border-radius: 30px;
        }
         .input-field {
            width: 80%;
            padding: 10px 5px;
            margin-top: 30px;
            border-top: 0;
            border-left: 0;
            border-right: 0;
            border-bottom: 1px solid #999;
            outline: none;
            border-radius: 10px;
            background: transparent;
            background-color: #9a9a9a3b;
          
        }
             #get-code{
                 border: none;
                  background-image: url("assets/bgspacelight2.jpg");
                   background-repeat: no-repeat;
                 background-size: 95% 90%;
                 background-position: center;
                 color: white;
                 height: 30px;
                width: 40%;
                border-radius: 50px;
                margin-top: 40px;
                margin-bottom: 10px;
             }
             #find_your_account{
                font-size: 23px;
             }


        #back-to-login a{
            color: #171077;
            margin-top: 30px;
             }



</style>
<body>
   <div id="main" class="container">
        <h2 id="login-help">Confirmation Code</h2>
        <div id="main-form">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                 <p id="find_your_account">Verify email's code</p>
            <input type="number" name="code" class="input-field" required placeholder="Code">
            <!-- <label for="Code">Code</label>
            <input type="number" name="Code" required> -->
            <input type="submit" value="Submit" id="get-code">
        </form>
       <p id="back-to-login">
        <a href="registration.php">Back to Login page</a>
    </p>  
    </div>
    </div>
</body>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<script language="javascript">
        function autoResizeDiv()
        {
            document.getElementById('main').style.height = window.innerHeight +'px';
        }
        window.onresize = autoResizeDiv;
        autoResizeDiv();
    </script>

</html>