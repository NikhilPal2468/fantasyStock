<?php 
require 'connection.php';

$User_Id =$_COOKIE['User_Id'];

  $ch = mysqli_query($connect, "SELECT User_Id,User_Name,Profile_Image,Name,Coins,Game_History,Email FROM users WHERE User_Id='$User_Id'");
    $row = mysqli_fetch_array($ch);
    $username = $row['User_Name'];
    $Coins = $row['Coins'];
    $Game_History = $row['Game_History'];
    $Name = $row['Name'];
    $Profile_Image = $row['Profile_Image'];
    $Email = $row['Email'];

    $name = $email = $Username =$profile_image= "";



    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        if(empty($_POST["name"])){
         $name =$Name;   
        }
        else{
            $name = $_POST["name"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name))
             {
                $nameErr = "Only letters and white space allowed";
            }
        }
        if(empty($_POST["username"])){
            $Username =$username;
        }
        else{
            $count=0;
            $username2 = $_POST["username"];
            $ch = mysqli_query($connect, "select User_Name from users where User_Name='$username2'");
            $count  = mysqli_num_rows($ch);
            if($count==0)
            {
            $Username = $username2;
            }
            else{

                $Username=null;
            }
        }
         if(empty($_POST["profile_image"])){
    $profile_image= $Profile_Image;        
        }
        else{
    $profile_image = $_POST["profile_image"];
}

if(empty($_POST["email"])){
    $email= $Email;        
        }
        else{
    $email = $_POST["email"];
}

echo $Username."   ".$Email."    ".$name."    ".$User_Id."       ".$profile_image;




         if (mysqli_query($connect, "UPDATE users SET User_Name='$Username' , Name='$name' , Email='$email' ,Profile_Image='$profile_image' where User_Id='$User_Id' "))
         {
             header("Location:https://karrotlive.com/profile.php");
        } else {
            echo "<script>alert(' not done')</script>";
        }
}
function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
  function test_username($data)
    {
         $data = trim($data);
    if (preg_match('/[\'^£$%&*()}{#~?><>,|=+¬-]/', $data))
{
return null;
}
else{
    return $data;
}
}



?>