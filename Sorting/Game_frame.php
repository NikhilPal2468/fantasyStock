<!DOCTYPE html>
<html>
<head>

    <?php header("Refresh:1");?>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
require 'connection.php';

$query = "SELECT Game_Id FROM live_game";
$run=mysqli_query($connect,$query);
$row=mysqli_fetch_array($run);
$a=mysqli_num_rows($run);

///// Starting of loop
$b=125;
/////


for ($i=$b; $i <$a+$b; $i++)
 { 
                   
$query = "SELECT Game_Id,Game_Time FROM live_game where Game_Id =$i AND Game_Time>0";
$run=mysqli_query($connect,$query);
$row=mysqli_fetch_array($run);
$Game_Id=$row['Game_Id'];
$Game_Time=$row['Game_Time'];
$Url="https://karrotlive.com/Sorting/Sorting_sorting.php?gid=".$Game_Id;
echo $Url."<br>";

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL =>$Url,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);
}

?>
</body>
</html>