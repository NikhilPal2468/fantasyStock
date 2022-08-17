<?php
// Start the session
session_start();
?>
<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Forget Password!</title>
</head>
<body>
    <style>
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




    <div id="main" class="container">
        <h2 id="login-help">Login Help</h2>
        <div id="main-form">
        <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        $token  = '1234567890';
        $token = str_shuffle($token);
        $token = substr($token, 0, 6);
        // echo $token;
        $emailErr = "";
        $email = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            }
            else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }
            $ch1 = mysqli_query($connect, "SELECT Name FROM users WHERE Email='$email'");
            $row = mysqli_fetch_array($ch1);
            $name = $row['Name'];



            $ch = mysqli_query($connect, "UPDATE users SET token = '$token' WHERE Email='$email'");
            // $row = mysqli_fetch_array($ch);
            // include_once "src/PHPMailer.php";
            require("src/PHPMailer.php");
            require("src/SMTP.php");
            require("src/Exception.php");
            require("src/OAuth.php");
            require("src/POP3.php");

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'no-reply@karrotlive.com';                     // SMTP username
            $mail->Password   = 'xk8g9vBWhMbByT#';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;   
            
            $mail->setFrom('no-reply@karrotlive.com', 'Karrot');
            $mail->addAddress($email);
            $mail->Subject = "Forget Password";
            $mail->isHTML(true);
            $mail->Body = "Hey $name, 
            Code for resetting the password is <br><br>
            '$token'
            
            ";
            $_SESSION['email'] = $email;
            if($mail->send()){
            echo "Please change your password";
            header('Location:codeforpass.php');
            }
            else{
                echo "Something Wrong happend please try again";
            }
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <p id="find_your_account">Find your account</p>
            <input type="email" name="email" required class="input-field" placeholder="Email"><br>
            <!-- <label for="Code">Code</label>
            <input type="number" name="Code" required> -->
            <input type="submit" value="Get Code" id="get-code">
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