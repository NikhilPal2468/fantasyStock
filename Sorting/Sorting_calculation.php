<?php

header("Refresh:1");

date_default_timezone_set('Asia/Kolkata');

require 'connection.php';

   $Game_Id=$_GET['gid'];



   $Stock_Sum=0;
    $array = array();

        $query = "SELECT * FROM live_game where Game_Id =$Game_Id";
        $run=mysqli_query($connect,$query);
        $row=mysqli_fetch_array($run);
        $Players=$row['Players'];
        
        // ------------------------------------------------------------------
        $Max_Players=$row['Max_Players'];
        $Current_Players=$row['Players'];
        // ------------------------------------------------------------------        

        
        $Version=$row['Version'];
        if($Version=="stock"){
            $Market_list="stock_list";
        }
        if($Version=="crypto"){
         $Market_list="crypto_list";   
        }
        if($Version=="nasdaq"){
         $Market_list="nasdaq_list";   
        }

$User_Names=[];
        $Players=explode(",", $Players);
for ($i=0; $i <count($Players)-1 ; $i++) { 
        $query4 = "SELECT User_Name FROM users where User_Id =$Players[$i]";
           $run4=mysqli_query($connect,$query4);
        $row4=mysqli_fetch_array($run4);
$User_Names3=$row4['User_Name'];        
array_push($User_Names, $User_Names3);

}
//print_r($User_Names);



        $Stocks_Selected=$row['Stocks_Selected'];
        $Stocks_Selected=explode("-", $Stocks_Selected);
         
        $Start_Time=$row['Start_Time'];

         $Game_Time=$row['Game_Time'];
         $Game_Time=(int)$Game_Time;
        
        $Start_Time=explode(":", $Start_Time);

        $Start_Time[1]=(int)$Start_Time[1];
        $Start_Time[0]=(int)$Start_Time[0];



        //New Time


 $Previous_Time[0]=$Start_Time[0];
        $Previous_Time[1]=$Start_Time[1]-1;
        if($Previous_Time[1]==-1){
            $Previous_Time[0]=$Previous_Time[0]-1;
            $Previous_Time[1]=59;
            if($Previous_Time[0]==-1){
                $Previous_Time[0]=11;
                $Previous_Time[1]=59;
            }
        }

        if($Previous_Time[0]<10)
        {
            $Previous_Time[0]="0".$Previous_Time[0];
        }


        if($Previous_Time[1]<10)
        {
            $Previous_Time[1]="0".$Previous_Time[1];
        }

        $Previous_Time=implode(":", $Previous_Time);
        

//Till here



        
        $End_Time[0]=$Start_Time[0];

        $End_Time[1]=$Start_Time[1]+$Game_Time;
              

        if($End_Time[1]>60){
            $End_Time[0]=$End_Time[0]+1;
            $End_Time[1]=$End_Time[1]-60;
        }
        if($End_Time[1]<10){
            $End_Time[1]="0".$End_Time[1];
        }
        if($End_Time[0]<10){
            $End_Time[0]="0".$End_Time[0];
        }

         if($Start_Time[1]<10){
            $Start_Time[1]="0".$Start_Time[1];
        }
        if($Start_Time[0]<10){
            $Start_Time[0]="0".$Start_Time[0];
        }


          $End_Time=implode(":", $End_Time);
        //  echo $End_Time."<br>";





        $Start_Time=implode(":", $Start_Time);

        //echo $Start_Time;


       /* print_r($Stocks_Selected);
        echo "<br>";
        print_r($Players);
        echo "<br>";
*/
        $len=count($User_Names);  

        if(date("H:i")==$Previous_Time){
$Players_number=substr_count($Current_Players, ",");
if($Players_number==$Max_Players)
{
    
            
$Unique_Stock="";



        for ($i=1; $i <= $len; $i++)
         {

        $Stocks_Selected[$i]=substr($Stocks_Selected[$i], 1);

       $Stocks[$i]=explode(",", $Stocks_Selected[$i]);
      // print_r($Stocks[$i]);
$len1=count($Stocks[$i]);
$Single_Stock=$Stocks[$i];

       for ($j=0; $j <=$len1-2; $j++)
    {                    
        $Single_Stock2=(string)$Single_Stock[$j];
        $query = "SELECT * FROM $Market_list where Unique_Id =$Single_Stock2";
        $run=mysqli_query($connect,$query);
        $row=mysqli_fetch_array($run);
        $Stock_Price=$row['Stock_Price'];

        $Unique_Stock2="#".$Single_Stock2."=>";
        if(strpos($Unique_Stock, $Unique_Stock2) == false){
        $Unique_Stock=$Unique_Stock."#".$Single_Stock2."=>".$Stock_Price."$";
    }
    }
        }

//        echo $Unique_Stock."<br>";
         mysqli_query($connect, "UPDATE live_game SET Starting_Price='$Unique_Stock' where Game_Id =$Game_Id"); 

}

else{

$Start_Time_new=explode(":", $Start_Time);

(int)$Start_Time_new_1[0]=$Start_Time_new[0];

(int)$Start_Time_new_1[1]=$Start_Time_new[1]+15;

if($Start_Time_new_1[1]>=60){

    $Start_Time_new_1[1]=$Start_Time_new_1[1]-60;

if($Start_Time_new_1[0]==23){
    
    (int)$Start_Time_new_1[0]="00";    
    }
    else{
    $Start_Time_new_1[0]=$Start_Time_new_1[0]+1;
}
}


if($Start_Time_new_1[1]<10)
{
(int)$Start_Time_new_1[1]="0".$Start_Time_new_1[1];
}
if($Start_Time_new_1[1]==60)
{
(int)$Start_Time_new_1[1]="00";
}
if($Start_Time_new_1[0]<10)
{
$Start_Time_new_1[0]=$Start_Time_new_1[0];
$Start_Time_new_1[0]="0".$Start_Time_new_1[0];
$Start_Time_new_1_tripple=substr_count($Start_Time_new_1[0],"0");
if($Start_Time_new_1_tripple>1){
$Start_Time_new_1[0]=substr($Start_Time_new_1[0], 1);
}
}

        $Start_Time_new=implode(":", $Start_Time_new_1);

 mysqli_query($connect, "UPDATE live_game SET Start_Time='$Start_Time_new' where Game_Id =$Game_Id"); 


  }
}


  
$query2 = "SELECT * FROM live_game where Game_Id =$Game_Id";
        $run2=mysqli_query($connect,$query2);
        $row2=mysqli_fetch_array($run2);
        $Starting_Price_Combined=$row2['Starting_Price'];

 if(date("H:i")>=$Start_Time)
 {
$Total_Stock="";
        $Results="";

        for ($i=1; $i <=$len; $i++)
         {
        $Stocks_Selected[$i]=substr($Stocks_Selected[$i], 1);
       $Stocks[$i]=explode(",", $Stocks_Selected[$i]);
      // print_r($Stocks[$i]);
$len1=count($Stocks[$i]);
$Single_Stock=$Stocks[$i];
       for ($j=0; $j <=$len1-2; $j++)
    {                   
        $Single_Stock2=(string)$Single_Stock[$j];
 $Previous_Price1=strpos($Starting_Price_Combined, "#".$Single_Stock2."=>");
 $Previous_Price2=substr($Starting_Price_Combined, $Previous_Price1);
      
       $Previous_Price1 = strpos($Previous_Price2, '$');
       $Previous_Price=substr($Previous_Price2,0, $Previous_Price1);
       $Previous_Price1 = strpos($Previous_Price2, '>');
       $Previous_Price=substr($Previous_Price, $Previous_Price1+1);

           
        $query = "SELECT * FROM $Market_list where Unique_Id =$Single_Stock2";
        $run=mysqli_query($connect,$query);
        $row=mysqli_fetch_array($run);
        $Stock_Price=$row['Stock_Price'];
        
        $Price_Change = (float)$Stock_Price-(float)$Previous_Price;

        $Percentage_Change=($Price_Change/(float)$Previous_Price)*100;

        $Stock_Sum=$Stock_Sum+$Percentage_Change;
        $Stock_Sum=round($Stock_Sum,2);
$Total_Stock=$Total_Stock."%#".$Single_Stock2;



    }

   //echo "Sum=",$Stock_Sum,"<br>";
$Stock_Sum2=$Stock_Sum;
$Stock_Sum=$Stock_Sum."??".$Total_Stock;


   $array= array_push_assoc($array,$User_Names[$i-1]."??".$Total_Stock,$Stock_Sum2);


   $Results=$Results."%#".$User_Names[$i-1]."=>".$Stock_Sum."/";
     
      $Stock_Sum=0;
      $Total_Stock="";

//echo "<br>";
        }

arsort($array);


if(date("H:i")>=$End_Time){


    $Winner_Percent3=array();

    $Winner2=array();
     $Winner=array();
      $Winner_database=""; 

        $Winner_Percent1=explode("=>", $Results);
      //  print_r($Winner_Percent1);
        for ($i=1; $i <count($Winner_Percent1) ; $i++) 
        { 
           $Winner_Percent2=explode("%", $Winner_Percent1[$i]);
  
 $Winner_Percent2[0]=str_replace('??', "",  $Winner_Percent2[0]);
            array_push($Winner_Percent3, $Winner_Percent2[0]);

           
        }
        for ($i=0; $i <count($Winner_Percent1)-1 ; $i++) { 
            $Winner4=explode("#", $Winner_Percent1[$i]);
            array_push($Winner2, $Winner4[1]);        
        }
//print_r($Winner_Percent3);
if($Winner_Percent3!=null){
  
       $Winner_Percent= max($Winner_Percent3);
  
       $Winner_Search=explode("=>".$Winner_Percent."??", $Results);
      $cut= strripos($Winner_Search[0], "#");
      $Winner_Search2=substr($Winner_Search[0], $cut);
      
      $Winner= array_push_assoc($Winner,$Winner_Search2,$Winner_Percent);
      $Winner_database="%#".$Winner_Search2."=>".$Winner_Percent;
  }



if(date("H:i")==$End_Time){


$Position_cal1=explode("=>",$Results);
$Position_cal3="";
$d="";
$array=array();
for ($i=1; $i <count($Position_cal1) ; $i++) { 
$Position_cal2=stripos($Position_cal1[$i], "??");
if($Position_cal2!=null)
$Position_cal3=substr($Position_cal1[$i],0, $Position_cal2);

array_push($array, $Position_cal3);
}
rsort($array); 

//print_r($array);


$data=array();
    foreach($array as $value ){

        $data[$value]= $value;

    }
$array=array_values($data);
$sorted_result="";

$counter=1;
for ($i=0; $i <count($array) ; $i++)
 {     

$Result_with_position=explode("=>".$array[$i]."?", $Results);
$Result_with_position[0]=$Result_with_position[0]."(".$counter.")=>";
if(count($Result_with_position)>2)
{
    $dup=1;
    while (count($Result_with_position)-1>$dup)
    { 
$counter=$counter+ 1;
$Result_with_position[$dup]=$Result_with_position[$dup]."(".$counter.")=>";
$dup+=1;
}
}
$counter=$counter+ 1;

$Results=implode($array[$i], $Result_with_position);


}


////////////////////////////////////////////////////////////////////////////////////
        $Players=$row2['Players'];


$Players=explode(",",$Players);


for ($i=0; $i <count($Players)-1   ; $i++) { 
 $New_Coins=0.0;
 $New_Coins1=0.0;
 $Previous_Price[1]="";
$User_Id=$Players[$i];
 $Live_Game_remover_pos1=0;
$Live_Game_remover2=""; 

  $query4 = "SELECT User_Name,Game_History,Coins FROM users where User_Id =$User_Id";
           $run4=mysqli_query($connect,$query4);
        $row4=mysqli_fetch_array($run4);
$User_Names3=$row4['User_Name'];
$Game_History=$row4['Game_History'];
$Live_game =$row4['Live_game'];

$Live_Game_remover1="%#".$Game_Id."=";

$Live_Game_remover1=explode($Live_Game_remover1,$Live_game);

$Live_Game_remover_pos1=strpos($Live_Game_remover1[1],"%");


$Live_Game_remover2=substr($Live_Game_remover1[1], $Live_Game_remover_pos1);


if (empty($Live_Game_remover_pos1)) {
$New_Live_game=$Live_Game_remover1[0];
}
if (!empty($Live_Game_remover_pos1)) {
$New_Live_game=$Live_Game_remover1[0].$Live_Game_remover2;
}


(string) $Previous_Coins=$row4['Coins'];

$Previous_Coins=explode("??",$Previous_Coins);
if(empty($Previous_Coins[1])){
$Previous_Coins[1]=0;
}
(float)$Previous_Coins[0]=$Previous_Coins[0];





$Name_in_result2=explode($User_Names3,$Results);




$Name_in_result2_pos=strpos($Name_in_result2[1], '/');

$Name_in_result=substr($Name_in_result2[1],0, $Name_in_result2_pos);
$Position_in_result3_pos2=strpos($Name_in_result, ')');

$Position_in_result2=substr($Name_in_result,0, $Position_in_result3_pos2);

(int)$Position_in_result=substr($Position_in_result2, 1);


if($Position_in_result==1){
      $query = "SELECT Coins FROM live_game where Game_Id =$Game_Id";
        $run=mysqli_query($connect,$query);
        $row=mysqli_fetch_array($run);
        $Coins_won=$row['Coins'];

}
else{
    $Coins_won=0;

}


$Results_percentage_for_coin=explode("=>", $Results);
$Results_percentage_for_coin_2=0;
for ($k=1; $k <3; $k++)
{ 
    $Results_percentage_for_coin_1=explode("?",$Results_percentage_for_coin[$k]);
    $Results_percentage_for_coin_2=$Results_percentage_for_coin_2."^".$Results_percentage_for_coin_1[0];
}
$Results_percentage_for_coin_3=explode("^", $Results_percentage_for_coin_2);
if($Results_percentage_for_coin_3[1]==$Results_percentage_for_coin_3[2])
{
        $query = "SELECT  Coins_To_Enter FROM live_game where Game_Id =$Game_Id";
        $run=mysqli_query($connect,$query);
        $row=mysqli_fetch_array($run);
        $Coins_won=$row['Coins_To_Enter'];
}


(string)$New_Coins1= $Previous_Coins[0] + $Coins_won;

$New_Coins=$New_Coins1."??".$Previous_Coins[1];

$Table='<tr><td><a href="Sorting/Sorting_display.php?gid='.$Game_Id.'" style="text-decoration:none;color:black;">'.date("H:i").' | '.date("d-m-Y").'</a></td><td><a href="Sorting/Sorting_display.php?gid='.$Game_Id.'" style="text-decoration:none;color:black;">'.$Position_in_result.'</a></td><td><a href="Sorting/Sorting_display.php?gid='.$Game_Id.'" style="text-decoration:none;color:black;">'.$Coins_won.'</a></td></tr>'
.$Game_History;
$Notification=1;


mysqli_query($connect, "UPDATE users SET Game_History = '$Table',Coins='$New_Coins',Notification='$Notification',Live_game='$New_Live_game' where User_Id =$User_Id");     
}

mysqli_query($connect, "UPDATE live_game SET Results = '$Results',Winner = '$Winner_database',Game_Time=null,Start_Time=null where Game_Id =$Game_Id");     
 
   }


  }
  }


function array_push_assoc($array, $key, $value)
{
   $array[$key] = $value;
   return $array;
}
    
?>  




    <!--<tr><td>".date("H:i")." | ".date("d-m-Y")."</td><td>".$Position_in_result."</td><td>".$Coins_won."</td></tr>-->
    
    <!--<tr><td><a href='Sorting/Sorting_display.php?gid=".$Game_Id."'>".date("H:i")." | ".date("d-m-Y")."</a></td><td><a href='Sorting/Sorting_display.php?gid=".$Game_Id."'>".$Position_in_result."</a></td><td><a href='Sorting/Sorting_display.php?gid=".$Game_Id."'>".$Coins_won."</a></td></tr>-->