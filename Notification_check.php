<?php
 require 'connection.php';

$User_Id = $_COOKIE['User_Id'];
 $Notification=0;
mysqli_query($connect, "UPDATE users SET Notification='$Notification' where User_Id =$User_Id");
?>