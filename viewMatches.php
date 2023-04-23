<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="viewMatchesStyleSheet.css">
  <title></title>
</head>
<body style="margin: 0px; padding: 0px;">
  <h1 style="font-family: Brush Script MT, Brush Script Std, cursive; font-size: 100px; margin: 5px;">Love Connect</h1>
  <div class="login">

    <div class="heading">

      <h1>Your Matches</h1>
    <?php

    include('loveconnect');
    $sqlget = "SELECT * FROM 'matches'";
    $sqldata = mysqli_query($dbcon, $sqlget) or die('Error...');

    echo "<table>";
    echo "<tr><th>matchId</th><th>userId_Sent</th><th>userId_Recieved</th></tr>";

    while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASOC)){

      echo "<tr><td>";
      echo $row['matchId'];
      echo "</td></td>";
      echo "<tr><td>";
      echo $row['userId_Sent'];
      echo "</td></td>";
      echo "<tr><td>";
      echo $row['userId_Recieved'];
      echo "</td></td>";

    }


    ?>
 
    </div>
  </div>
</body>
</html>
