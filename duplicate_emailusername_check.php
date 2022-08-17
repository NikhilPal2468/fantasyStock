<?php 
require 'connection.php';
if (isset($_POST['email']))
 {
$email = $_POST["email"]; 
$checkEmail=0;
$checkEmail = mysqli_query($connect, "SELECT Email from users WHERE Email='$email'");

 if(mysqli_num_rows($checkEmail) >0)
 {
  echo '<b class="text-danger"> This Email is not Available. </b>';
   }
  
   }
     



?>
<?php
if (isset($_POST['username'])) {
$username = $_POST["username"]; 
if (preg_match('/[\'^£$%&*()}{#~?><>,!:;."|=+¬-]/',$username))
{
    echo '<b class="text-success"> Only @ and _ are allowed. </b>'; 
    }

else
    {


$checkusername=0;
$checkusername = mysqli_query($connect, "SELECT User_Name from users WHERE User_Name='$username'");
 if(mysqli_num_rows($checkusername) >0){
  echo '<b class="text-danger"> This Username is not Available. </b>';
   }
 
}

 }
     ?>
     <?php 
if (isset($_POST["emailLogin"])) {

$email = $_POST["emailLogin"]; 
$checkEmail=0;
$checkEmail = mysqli_query($connect, "SELECT Email from users WHERE Email='$email'");

 if(mysqli_num_rows($checkEmail) == 0)
 {
  echo '<b class="text-danger"> This Email is not Available. </b>';
   }
  
}


?>
<?php

if (isset($_POST["confirm_password"]) && isset($_POST["emailLogin"])) {

$email = $_POST["emailLogin"]; 
$count=0;
 $ch = mysqli_query($connect, "SELECT User_Id,Password FROM users WHERE Email='$email'");
    $row = mysqli_fetch_array($ch);
$password = $row['Password'];
if (password_verify($_POST["confirm_password"], $password)) {
    $count  = mysqli_num_rows($ch);
}
else{
    echo '<b class="text-danger">Password does not match. </b>';
}
}

 ?>
