<?php

date_default_timezone_set('America/New_York');
require 'connection.php';


if (date("H")>="9" && date("H")<="15") {


for ($i=14; $i <=25; $i++)
 { 

                   
$query = "SELECT Url,Stock_Name FROM nasdaq_list where unique_id =$i";
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
  $Stock_3=$xpath->evaluate('string(//*[@class="QuoteStrip-lastPriceStripContainer"])');

}

$Stock_Name=$row['Stock_Name'];

echo $Stock_Name."<br>";
$Stock_3=explode(".", $Stock_3);
$Stock_3[0]=explode(",", $Stock_3[0]);
$Stock_3[0]=implode("", $Stock_3[0]);
$decimal_point=substr($Stock_3[1],0, 2);
$Stock=$Stock_3[0].".".$decimal_point;
echo $Stock."<br>";



mysqli_query($connect, "update nasdaq_list set Stock_Price='$Stock' where unique_id =$i");

if (date("H:i")>="9:00" && date("H:i")<="9:30") {

mysqli_query($connect, "update nasdaq_list set Stock_Price_Previous='$Stock' where unique_id =$i");
}

}
}
?>
