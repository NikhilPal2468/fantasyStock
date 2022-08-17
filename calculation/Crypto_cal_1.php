<?php

date_default_timezone_set('Asia/Kolkata');
require 'connection.php';



for ($i=1; $i <=20; $i++)
 { 

                   
$query = "SELECT * FROM crypto_list where unique_id =$i";
$run=mysqli_query($connect,$query);
$row=mysqli_fetch_array($run);
$Stock=$row['Url'];
 
$curl=curl_init($Stock);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
$html=curl_exec($curl);
if(!empty($curl))
{
  $thispage=new DOMDocument;
  libxml_use_internal_errors(true); 
  $thispage->LoadHTML($html);
  libxml_clear_errors();
  $xpath=new DOMXPath($thispage);
  $Stock_3=$xpath->evaluate('string(//*[@class="cion-item coin-price-large"])');

}

$Stock_Name=$row['Stock_Name'];

echo $Stock_Name."<br>";


$Stock_3=explode(".", $Stock_3);
$Stock_3[1]=substr($Stock_3[1], 0,-1);
$Stock_3[0]=substr($Stock_3[0], 1);
$Stock_3=$Stock_3[0].".".$Stock_3[1];

echo $Stock_3."<br>";



mysqli_query($connect, "update crypto_list set Stock_Price='$Stock_3' where unique_id =$i");

if (date("H:i")>="00:01" && date("H:i")<="00:05") {

mysqli_query($connect, "update crypto_list set Stock_Price_Previous='$Stock_3' where unique_id =$i");
  
}


}
?>
