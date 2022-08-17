<?php

date_default_timezone_set('Asia/Kolkata');
require 'connection.php';


if (date("H")>="09" && date("H")<="16") {


for ($i=14; $i <=25; $i++)
 { 

                   
$query = "SELECT * FROM stock_list where unique_id =$i";
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
  $Stock_3=$xpath->evaluate('string(//*[@class="font12 mx-auto"])');
}

$Stock_Name=$row['Stock_Name'];
echo $Stock_Name."<br>";
$Stock_3 = explode(".", $Stock_3);

$Stock_5=substr($Stock_3[1],0,2);
$Stock_6=$Stock_3[0].".".$Stock_5;
echo $Stock_6."<br>";

mysqli_query($connect, "update stock_list set Stock_Price='$Stock_6' where unique_id =$i");


if (date("H:i")>="09:16" && date("H:i")<="09:20") {

mysqli_query($connect, "update stock_list set Stock_Price_Previous='$Stock_6' where unique_id =$i");
  
}

}
}

?>
