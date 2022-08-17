<?php 
require 'connection.php';
$User_Id = $_COOKIE['User_Id'];
if (isset($_POST['username'])) {
$username = $_POST["username"]; 
if (preg_match('/[\'^£$%&*()}{#~?><>,!:;."|=+¬-]/',$username))
{
    echo '<b class="text-success"> Only @ and _ are allowed. </b>'; 
    }

else
    {


$checkusername=0;

$checkusername = mysqli_query($connect, "SELECT User_Name from users WHERE User_Name='$username' AND User_Id != $User_Id");

 if(mysqli_num_rows($checkusername) >0){
  echo '<b class="text-danger"> This Username is not Available. </b>';
   }
 
}

 }
 
 ?>
 
 <?php
 
 
 
 if (isset($_POST['amount'])) {
    (int) $amt =$_POST['amount'];
     if($amt > 2000 || $amt < 500)
     {
         echo "Withdraw Limit is between 500 and 2000";
     }
 
 
     }
     
 
 
 
 
 
 
 
 
     ?>