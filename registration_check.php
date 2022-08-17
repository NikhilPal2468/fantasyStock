<?php
// Start the session
session_start();
?>
<?php

require 'connection.php';
// define variables and set to empty values
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$nameErr = $emailErr = $usernameErr = $passwordErr = "";
$name = $email = $username = $comment = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Email is required";
    } else {
        $password = test_input($_POST["password"]);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email2 = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
        $count = 0;
        $ch = mysqli_query($connect, "select Email from users where Email='$email2'");
        $count  = mysqli_num_rows($ch);
        if ($count == 0) {
            $email = $email2;
        } else {

            $email = null;
        }
    }
    $_SESSION['email'] = $email;
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $count = 0;
        $username2 = test_username($_POST["username"]);
        $ch = mysqli_query($connect, "select User_Name from users where User_Name='$username2'");
        $count  = mysqli_num_rows($ch);
        if ($count == 0) {
            $username = $username2;
        } else {

            $username = null;
        }
    }
    if (empty($_POST["terms"])) {
        $termsErr = "Terms is required";
    } else {
        $terms = test_input($_POST["terms"]);
    }

    if (empty($_POST["referral"])) {
        $commAmount = null;
    } else {
        $refCode = $_POST["referral"];
        $commAmount = 10;

        $ch = mysqli_query($connect, "SELECT Coins FROM users WHERE Referal_Code ='$refCode'");
        $row = mysqli_fetch_array($ch);
        $Coins = $row['Coins'];
        $Coins = explode('??', $Coins);
        $Coins[1] += $commAmount;
        $newCoins = $Coins[0]."??".$Coins[1];
        mysqli_query($connect, "UPDATE users SET Coins='$newCoins' WHERE Referal_Code ='$refCode'");
    }
    $token  = '1234567890';
    $token = str_shuffle($token);
    $token = substr($token, 0, 6);
    $coins = '0??10';
    if ($username != null && $email != null) {
       
//  if (mysqli_query($connect, "insert into users (User_Name,Name,Password,Terms,Email, token, Referal_Code, Coins) values  ('$username','$name','$hashed_password','$terms','$email', '$token', '$username', '$coins')")) {

                   if (1>0) {
            
                     setcookie("User_Name", $username, time()+60*60*60,'/');
                     setcookie("Name", $name, time()+60*60*60,'/');
                     setcookie("Password", $hashed_password, time()+60*60*60,'/');
                     setcookie("Termsl", $terms, time()+60*60*60,'/');
                     setcookie("Email",$email, time()+60*60*60,'/');
                     setcookie("token",$token, time()+60*60*60,'/');
                     setcookie("Referal_Code", $username, time()+60*60*60,'/');
                     setcookie("Coins", $coins, time()+60*60*60,'/');




            
            // $ch = mysqli_query($connect, "select * from users where User_Name='$username'");
            // $count  = mysqli_num_rows($ch);
            // $row = mysqli_fetch_array($ch);
            // $User_Id = $row['User_Id'];
            // $_SESSION['User_Id'] = $User_Id;




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
            $mail->addAddress($email, $name);
            $mail->Subject = "Please verify Email";
            $mail->isHTML(true);
            $mail->Body = "Hey $name 😎
            Enter the code to verify your account <br><br>
            $token

            
            ";
            if($mail->send())
            header('Location:confirm.php');
            else{
                echo "Something Wrong happend please try again";
            }


            // setcookie("User_Id", $User_Id, time() + 60 * 24 * 60 * 60, "/");

            // header("Location:http://localhost/battle/nsebse.php");
        } else {
        echo "System error occured.<br> Please Try again.<br><a href='registration.php'>Back</a>";
         $DatabaseErrorRegister = "DatabaseErrorRegister";

         setcookie("DatabaseErrorRegister", $DatabaseErrorRegister, time()+60,'/');
            
         header("Location:https://karrotlive.com/registration.php");
        }
    } else {
        echo "Error occured in entering username or email.<br> Please Try again.<br><a href='registration.php'>Back</a>";
        $WrongMail = "WrongMail";

         setcookie("WrongMail", $WrongMail, time()+60,'/');
            
         header("Location:https://karrotlive.com/registration.php");
        
    }
}


function test_username($data)
{
    $data = trim($data);
    if (preg_match('/[\'^£$%&*()}{#~?><>,|=+¬-]/', $data)) {
        return null;
    } else {
        return $data;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
