<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ClassroomDisplay</title>
    <link rel="icon" type="image/x-icon" href="./style/favicon.ico">
    <link rel="stylesheet" type="text/css" href="./style/fancy.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323">
  </head>
<style>body {font-family: "VT323", monospace;}</style>

<body>

<?php /*Get time from database*/
  include "dbconfig2.php";
  $sql = "SELECT rasp_time FROM sensor_data ORDER BY id DESC LIMIT 5";
  $result = $connection->query($sql);
  $rad = $result->fetch_assoc();
  $time = $rad["rasp_time"];
  echo "<script>console.log('$time')</script>";
?>

<!--Container for headers (site name, buttons, time)-->
<div class="Hcontainer">
  <div class="header">Classroom Reactive Display</div>
  <div class="button"><a href="graph.php">Look at this graph</a></div>
  <div class='time'>
    <?php /*PHP in html div to show time since last update*/
      echo "Last update: $time";
    ?>
  </div>
  <div class="refresh"><a href="index.php">"Refresh"</a></div>

<!--List container with everything else-->
  <div class="Lcontainer">
    <span>Measured Room</span>
    <span>Time</span>
    <span>Air Pressure (mbar)</span>
    <span>Moist Meter (%H)</span>
    <span>Temperature (°C)</span>
    <span>Light Level (lux)</span>
    <span>Noise Amount (dB)</span>

    <?php
     include "listData.php";
    ?>
  </div>
</div>
</body>
</html>
