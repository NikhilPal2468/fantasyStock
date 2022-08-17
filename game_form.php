<?php
require 'connection.php';
// define variables and set to empty values
$Max_PlayersErr = $CoinsErr = $Game_TimeErr = $Max_Players = $Coins = $Game_Time = $versionErr = $version = $Minutes = $MinutesErr = $HoursErr = $Hours = $Start_time = $CoinsToEnter = $Date = $DateErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["Coins"])) {
    $CoinsErr = "Coins is required";
  } else {
    $Coins = $_POST["Coins"];
  }
  if (empty($_POST["CoinsToEnter"])) {
    $CoinsErr = "Coins is required";
  } else {
    $CoinsToEnter = $_POST["CoinsToEnter"];
  }
  if (empty($_POST["Game_Time"])) {
    $Game_TimeErr = "Game_Time is required";
  } else {
    $Game_Time = $_POST["Game_Time"];
  }

  if (empty($_POST["Date"])) {
    $DateErr = "Date is required";
  } else {
    $Date = $_POST["Date"];
  }


  if (empty($_POST["Hours"])) {
    $HoursErr = "Hours is required";
  } else {
    $Hours = $_POST["Hours"];
  }

  if (empty($_POST["Minutes"])) {
    $MinutesErr = "Minutes is required";
  } else {
    $Minutes = $_POST["Minutes"];
  }
  if (empty($_POST["Minutes"]) && empty($_POST["Hours"])) {
    $MinutesErr = "Minutes is required";
  } else {

    $Start_time = $Hours . ":" . $Minutes;
  }

  if (empty($_POST["version"])) {
    $versionErr = "Version is required";
  } else {
    $version = $_POST["version"];
  }

  if (empty($_POST["Max_Players"])) {
    $Max_PlayersErr = "Max_Players is required";
  } else {
    $Max_Players = $_POST["Max_Players"];
  }



  if (mysqli_query($connect, "INSERT INTO live_game (Version, Max_Players, Coins, Coins_To_Enter ,Game_Time, Date, Start_Time) values  ('$version','$Max_Players','$Coins','$CoinsToEnter', '$Game_Time','$Date','$Start_time')")) {

    echo "<script>alert('done')</script>";
  } else {
    echo "<script>alert(' not done')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Game Maker</title>
</head>

<body>



  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    Winning Coins:<input type="number" class="input-field" required name="Coins">
    <br><br><br>
    Coins to enter:<input type="number" class="input-field" required name="CoinsToEnter">
    <br><br><br>
    Max_Players:<input type="number" class="input-field" required name="Max_Players">
    <br><br><br>
    Game Time:<input type="number" class="input-field" required name="Game_Time"> (in minutes)
    <br><br><br>
    Date: <br>
    <input type="date" class="input-field" required name="Date" id="txtDate">
    <br>
    <br>
    Start Time:<br><br>
    Hours:
    <input type="number" class="input-field" required name="Hours">
    Minutes:
    <input type="number" class="input-field" required name="Minutes">
    <br><br><br>
    Version:
    <label>
      <input type="radio" name="version" required value="stock">Stock
    </label>
    <label>
      <input type="radio" name="version" value="crypto">Crypto
    </label>
    <label>
      <input type="radio" name="version" value="nasdaq">Nasdaq
    </label>
    <br><br><br>
    <input type="submit" class="submit-btn" name="submit" value="submit"></input>
  </form>


</body>
<script>
  $(function() {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
      month = '0' + month.toString();
    if (day < 10)
      day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);
    $('#txtDate').attr('min', maxDate);
  });
</script>

</html>


<?php


echo "Output";

echo "<br>", $Max_Players, "<br>",
$Coins, "<br>",
$Game_Time, "<br>",
$Start_time, "<br>",
$Date, "<br>",
$version, "<br>";

?>