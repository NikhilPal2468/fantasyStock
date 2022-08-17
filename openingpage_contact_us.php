    <?php
require 'connection.php';
// define variables and set to empty values
$nameErr = $emailErr = $MobileErr = $passwordErr =$messageErr= "";
$name = $email = $Mobile = $comment = $password =$message= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["Name"]);
    }

    if (empty($_POST["Email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["Email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["MobileNumber"])) {
        $MobileErr = "Username is required";
    } else {
        $count = 0;
        $Mobile = $_POST["MobileNumber"];
    }
    if (empty($_POST["message"])) {
        $messageErr = "message is required";
    } else {
        $message =$_POST["message"];
    }
    

     if (mysqli_query($connect, "insert into contact_us (Name,Phone_Number,Message,Email) values  ('$name','$Mobile','$message','$email')"))
     {
        
          header("Location:https://karrotlive.com/");
    

        } else {
            echo "<script>alert(' not done')</script>";
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