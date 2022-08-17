<?php

   $Game_Id=$_GET['gid'];

require "Sorting_calculation.php";

if (date("H:i") < $End_Time) {

    $array_value = array();

    $User_Name2 = array_keys($array);
    $User_Name = array();
    foreach ($User_Name2 as $Key) {
        $Key1 = explode("??", $Key);
        $Key = $Key1[0];
        array_push($User_Name, $Key);
    }


    // foreach ($array as $key) {
    //     $key1=explode("??",$key);
    //     $key=$key1[0];
    // array_push($array_value, $key);
    // }
    // print_r($array_value);

    $array_value = array_values($array);

    $stock_selected_images = array(array());
    $stock_selected_image = array();

    foreach ($array as $i => $value_of_key) {

        $Stock_Id_Collective = explode("??", $i);

        $Stock_Id_Collective2 = explode("%#", $Stock_Id_Collective[1]);

        // print_r($Stock_Id_Collective2);

        for ($j = 1; $j < count($Stock_Id_Collective2); $j++) {

            $query2 = "SELECT * FROM $Market_list where Unique_Id =$Stock_Id_Collective2[$j]";
            $run2 = mysqli_query($connect, $query2);
            $row2 = mysqli_fetch_array($run2);
            $Stock_Name = $row2['Stock_Name'];

            $selected_stock = $row2['Stock_Image'];
            array_push($stock_selected_image, $selected_stock);
            // echo ($stock_selected_image);  
            // $array1 = explode('??', $array);
            // echo $array1;
        }
        array_push($stock_selected_images, $stock_selected_image);
        $stock_selected_image = array();
        // print_r($stock_selected_images);
    }


?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style type="text/css">
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .game-area {
            position: inherit;
            /* background-color: yellow; */
            width: 70%;
            height: auto;
            margin-left: 22%;
            margin-top: 10px;
            display: flex;
            flex-direction:column;
        }

        @media screen and (max-width: 1200px) {
            .game-area {
                width: 94%;
                height: 500px;
                margin-left: 10px;
                margin-top: 10px;
                overflow: auto;
                white-space: nowrap;
            }
        }

        .Stock-Specificatons {
            width: 90%;
            text-align: center;

        }

        .Stock-price {
            text-align: right;
            float: left;
            width: 50%;
        }

        .Stock-name {
            float: left;
            width: 50%;
        }

        @media screen and (max-width: 1200px) {

            .Stock-price {
                text-align: left;
                float: none;
            }

            .Stock-name {
                float: none;
                text-align: left;
                width: 50%;
            }

        }



        /* Stock Images CSS */


        svg {
            border-radius: 100px;
        }

        @media screen and (max-width: 1200px) {
            svg {
                width: 25px;
                height: 25px;
            }
        }

        #sorted {
            height: 1000px;
            border: 2px solid red;
        }

        #content {
            /* height: 500px; */
            border: 0.1px solid #efefef;
            border-radius: 10px;
            background-color: #efefef;
            width: 100%;
        }

        .w3-animate-opacity {
            height: 100px;
            border: 0px solid black;
            padding: 10px;
            margin: 25px 25px;
            /* width: max-content; */
            /* border: 2px solid black; */
            background-color: white;
            border-radius: 5px;
            animation: opac 1s;
        }

        @media screen and (max-width: 1200px) {
            .w3-animate-opacity {
                width: 89%;
                height: 74px;
                margin: 25px 5%;
            }
        }

        .title {
            background-color: #efefef;
        }

        .idn {
            width: 100%;
            display: flex;
            /*margin-bottom: 16px;*/
            flex-wrap: nowrap;
            overflow-y: auto;
        }

        .one {
            display: flex;

        }

        .two {
            display: flex;
            margin-top: -50px;
        }



        .first {
            margin-top: 0px;
            margin-left: 2px;
            z-index: 15;
        }


        .second {
            margin-left: -4px;
            margin-top: 0px;
            z-index: 15;
        }

        .third {
            z-index: 5;
            margin-top: -9px;
            margin-left: -7px;
        }

        .fourth {
            margin-top: -8px;
            margin-left: 13px;
            z-index: 3px;
        }

        .fifth {
            margin-left: 16px;
            margin-top: -45px;
            /* z-index: 4px; */
        }

        .stock-images {
            display: inline-block;
            font-size: 40px;
            height: 0px;
            width: 63px;
            -webkit-animation: spin 4s linear infinite;
            -moz-animation: spin 4s linear infinite;
            animation: spin 4s linear infinite;
        }

        @media screen and (max-width: 1200px) {
            .third {
                margin-top: -15px;
                margin-left: -4px;
            }

            .fourth {
                margin-top: -15px;
                margin-left: 8px;
            }

            .fifth {
                margin-left: 12px;
                margin-top: -40px;
            }

            .stock-images {
                width: 50px;
                height: 0px;
                margin-left:20px;
            }
            .two {
                display: flex;
                margin-top: -24px;
            }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(-360deg);
                transform: rotate(-360deg);
            }
        }
        
        .boxidn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 75px;
        }
        
        .box {
            width: 30%;
            align-items: center;
            display: flex;
        }
        .container{
            display: flex;
        }
        .username{
            margin: 14px 0px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: block;
        }
        
        
        
        
  
        
    </style>

    <body>



        <div id="content">

        </div>




        <script>
            function revisedRandId() {
                return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
            }

            function order_bingo_item() {
                var $divs = $("div.w3-animate-opacity");
                var alphabeticallyOrderedDivs = $divs.sort(function(a, b) {
                    return $(b).find("idn").text() - $(a).find("idn").text();
                });
                $("#content").html(alphabeticallyOrderedDivs);
            }
            // var ajax = new XMLHttpRequest();
            // ajax.open("GET", "data3.php?gid=<?php echo $Game_Id; ?>", true);

            // ajax.send();

            // ajax.onreadystatechange = function() {
            //     console.log(this.readyState)
            //     console.log(this.status)
            //     console.log(ajax.response)
            //     if (this.readyState == 4 && this.status == 200) {

            //         if (ajax.response != "") {


            // var data = JSON.parse(this.responseText);



            var stock_selected_images = <?php echo json_encode($stock_selected_images); ?>;
            console.log(stock_selected_images);
            numbers2 = [<?php echo '"' . implode('","', $User_Name) . '"' ?>];
            console.log(numbers2);
            numbers = [<?php echo '"' . implode('","', $array_value) . '"' ?>];
            console.log(numbers);

            console.log(numbers.length);
            for (let i = 0; i < numbers.length; ++i) {

                let box = document.createElement("div");
                let boxid = revisedRandId();
                // box.className = "box";
                box.className = "w3-animate-opacity";
                // box.className = "w3-center";
                // box.className = "box";
                box.id = boxid;
                document.getElementById("content").append(box);

                let box1 = document.createElement("div");
                // let boxid = revisedRandId();
                // box.className = "box";
                box1.className = "box";
                // box.className = "w3-center";
                // box.className = "box";
                // box.id = boxid;
                document.getElementById(boxid).append(box1);
                box1.innerHTML = `<h4>${i+1}</h4>`+  `  <div class="username">&nbsp;${numbers2[i]}</div>`;

                let box2 = document.createElement("div");
                let box2id = revisedRandId();
                // box.className = "box";
                box2.className = "stock-images";
                // box.className = "w3-center";
                // box.className = "box";
                box2.id = box2id;
                document.getElementById(boxid).append(box2);


                let one = document.createElement("div");
                let oneid = revisedRandId();
                one.className = "one";
                one.id = oneid;
                document.getElementById(box2id).append(one);

                let two = document.createElement("div");
                let twoid = revisedRandId();
                two.className = "two";
                two.id = twoid;
                document.getElementById(box2id).append(two);

                let three = document.createElement("div");
                let threeid = revisedRandId();
                three.className = "three";
                three.id = threeid;
                document.getElementById(box2id).append(three);

                let first = document.createElement("div");
                // let firstid = revisedRandId();
                first.className = "first";
                // first.id = firstid;
                document.getElementById(oneid).append(first);
                first.innerHTML = stock_selected_images[i + 1][0];

                let second = document.createElement("div");
                // let secondid = revisedRandId();
                second.className = "second";
                // second.id = secondid;
                document.getElementById(oneid).append(second);
                second.innerHTML = stock_selected_images[i + 1][1];

                let third = document.createElement("div");
                // let thirdid = revisedRandId();
                third.className = "third";
                // third.id = thirdid;
                document.getElementById(twoid).append(third);
                third.innerHTML = stock_selected_images[i + 1][2];

                let fourth = document.createElement("div");
                // let fourthid = revisedRandId();
                fourth.className = "fourth";
                // fourth.id = fourthid;
                document.getElementById(twoid).append(fourth);
                fourth.innerHTML = stock_selected_images[i + 1][3];

                let fifth = document.createElement("div");
                // let fifthid = revisedRandId();
                fifth.className = "fifth";
                // fifth.id = fifthid;
                document.getElementById(threeid).append(fifth);
                fifth.innerHTML = stock_selected_images[i + 1][4];




                let boxst = document.getElementById(boxid);
                boxst.style.display = "flex";
                boxst.style.alignItems = "center";
                boxst.style.justifyContent = "space-between";


                let boxidn = document.createElement("div");
                let boxidnid = revisedRandId();
                // box.className = "box";
                boxidn.className = "boxidn";
                // box.className = "w3-center";
                // box.className = "box";
                boxidn.id = boxidnid;
                document.getElementById(boxid).append(boxidn);
                
                
                let boxidn2 = document.createElement("div");
                let boxidnid2 = revisedRandId();
                boxidn2.className = "boxidn2";
                // box.className = "w3-center";
                // box.className = "box";
                boxidn2.id = boxidnid2;
                document.getElementById(boxidnid).append(boxidn2);



                let idn = document.createElement("idn");
                document.getElementById(boxidnid2).append(idn);
                idn.className = "idn";
                idn.innerHTML = numbers[i];

                let tag = document.createElement("th");
                tag.className = "th"
                let text = document.createTextNode(numbers[i]);
                tag.appendChild(text);
            }

            //         }
            //     }
            // }
        </script>
    <?php
}
if (date("H:i") >= $End_Time) {
    
    ?>
<style>
    
            /*---------Results---------*/
        .title{
            height:0;
            width:0;
        }
        .title p{
            font-size:0;
        }
        .ends-in{
            height:0;
            width:0;
        }
        .ends-in h5{
                        font-size:0;
        }
        
    .result-title {
        background-color: #ffffff;
        background-image: linear-gradient(315deg, #ffffff 0%, #d7e1ec 74%);
        font-size: 80px;
    }

    .result-title p {
        margin-left: 20%;

    }

    @media screen and (max-width: 1200px) {
        .result-title {
            text-align: center;
            width: 100%;
             font-size: 60px;

        }

        .result-title p {
            margin-left: 0;

        }
    }

    @media screen and (max-width: 700px) {
        .title {
            font-size: 50px;
            width: 100%;
        }
    }
        #timer{
                        font-size:0;
        }
       #game-over{
           margin-left: 20%;
           font-size: 30px;

       } 
        @media screen and (max-width: 1200px) {
                   #game-over{
           margin-left: 0;
                      font-size: 22px;
                   }
        }
        
      
    
</style>    
     
    <div class="result-title">
    <p>    
        Results
       </p> 
    </div>
       <div id="game-over">
    
    <div id="results-area">
    <?php
            $query3 = "SELECT Results FROM live_game where Game_Id =$Game_Id";
            $run3 = mysqli_query($connect, $query3);
            $row3 = mysqli_fetch_array($run3);
            $Results = $row3['Results'];

      //echo $Result. "<br>";
    $New_Results=explode("/", $Results);

?>
<br><br>
<div class="results-area">
<?php

for ($y=0; $y <2 ; $y++) { 
   $No_one_present=0;
   $No_one_present=strpos($New_Results[$y], "(1)");
if($No_one_present!=0){
$Draw_Result_1=explode("=>",$Results);
for ($p=1; $p <3; $p++) { 
   $Draw_Result_2=explode("?", $Draw_Result_1[$p]);
   // echo $Draw_Result_2[0]."<br>";
   if($p==1){
$Draw_Result_3=$Draw_Result_2[0];
}
   if($p==2){
$Draw_Result_4=$Draw_Result_2[0];
}
}

if($Draw_Result_4==$Draw_Result_3){
    echo "Runner-up"."<br>";
}
else{
    echo "Winner"."<br>";
}   
$New_Results_name=explode("(", $New_Results[$y]);
$New_Results_name[0]=substr($New_Results_name[0],2);
    
?>

  <div id="results-area-name" style="border:1px solid black;border-right:none;width:50%;float:left;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;display: block;margin-bottom:60px;padding:10px;">
<?php
echo $New_Results_name[0]."<br>";


?>
  </div>
  <div id="results-area-percent" style="border:1px solid black;border-left:none;width:50%;float:left;text-align:center;margin-bottom:60px;padding:10px;">
      
      <?php
      $New_Results_percent_1=explode(">", $New_Results_name[1]);
$New_Results_percent_2=explode("?",$New_Results_percent_1[1]);
echo $New_Results_percent_2[0]."<br>";
}

}

      ?>
      
      </div>
    </div>
          
      
      
      
      
      
      
      
      
      
    
      
      
      
      
      
<div class="results-area">
  
      <?php
      for ($y=0; $y <2 ; $y++) { 
   $No_one_present=0;
   $No_one_present=strpos($New_Results[$y], "(1)");
if($No_one_present==0){

echo "Runner-up"."<br>";   

$New_Results_name=explode("(", $New_Results[$y]);
$New_Results_name[0]=substr($New_Results_name[0],2);
?>
  <div id="results-area-name" style="border:1px solid black;border-right:none;width:50%;float:left;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;display: block;margin-bottom:60px;padding:10px;">
<?php
echo $New_Results_name[0]."<br>";


?>
  </div>
  <div id="results-area-percent" style="border:1px solid black;border-left:none;width:50%;float:left;text-align:center;margin-bottom:60px;padding:10px;">
      
      <?php
      $New_Results_percent_1=explode(">", $New_Results_name[1]);
$New_Results_percent_2=explode("?",$New_Results_percent_1[1]);
echo $New_Results_percent_2[0]."<br>";
}

}

      ?>
      
      </div>
    </div>
      
      
 
    </div>
    
        </div>
    <?php

}
    ?>

    </body>

    </html>