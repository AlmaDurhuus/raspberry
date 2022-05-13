<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ClassroomDisplay</title>
    <link rel="icon" type="image/x-icon" href="./style/favicon.ico">
    <link rel="stylesheet" type="text/css" href="./style/fancyGraph.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323">
  
    <style>body {font-family: "VT323", monospace;}</style>

<!--Link til google charts-->
  <script  type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <!--Script til google 1IMA charts-->
  <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          // bruker en funksjon fra google til tegne graf
            function drawChart() {
              // coble til databasen 
              <?php
              include "./dbconfig2.php";

                // skrive hva informatjon som skal vises
                $data = "([['time', 'Light', 'Sound', 'Humidity', 'Temperature']";

                // sql henter informasjonen og bruker where for bare ett rum, orderby tid for kun at hente nye informasjoner og desc limit 10 da hentes det bare 10.
                $sql = "SELECT temprature, humidity, light, sound, rasp_time FROM muffins.sensor_data where classroom_id='352' ORDER BY rasp_time DESC LIMIT 10";
                $result = $connection->query($sql);
                
                // while kjorer igjennom alle 10 SELECTS og setter de inn.
                while($rad = $result->fetch_assoc()) {
                    $moist = $rad["humidity"];
                    $temp = $rad["temprature"];
                    $light = $rad["light"];
                    $noise = $rad["sound"];
                    $data = $data . ",['',  $light, $noise, $moist, $temp]";
                    
                
                }
              // slutter coden for informasjon
              $data = $data . "])";
              ?>
              // bruk Echo til insert av informasjon
              var data = google.visualization.arrayToDataTable<?php echo $data; ?>;

                // endre titlen, posisjon og bakgruns farge.
                var options = {
                  title: '1IMA',
                  legend: { position: 'bottom'},
                  backgroundColor: '#f1f8e9'
                  
                };
                // ha div vise grafen
                var chart = new google.visualization.LineChart(document.getElementById('1IMA'));
                
                chart.draw(data, options);
            } 
      
  </script>

  <!-- pressure graph 1IMA-->
  <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          // bruker en funksjon fra google til tegne graf
          function drawChart() {
              // coble til databasen
              <?php
              include "./dbconfig2.php";

              // skrive hva informatjon som skal vises
              /* var $data = google.visualization.arrayToDataTable([ */
                $data = "([['Year', 'Pressure']";

                // sql henter informasjonen og bruker where for bare ett rum, orderby tid for kun at hente nye informasjoner og desc limit 10 da hentes det bare 10.
                // Her hentes det bare pressure
                $sql = "SELECT pressure FROM muffins.sensor_data where classroom_id='352' ORDER BY rasp_time DESC LIMIT 10";

                // while kjorer igjennom alle 10 SELECTS og setter de inn.
                $result = $connection->query($sql);
                while($rad = $result->fetch_assoc()) {
                    $psi = $rad["pressure"];
                    $data = $data . ",['', $psi]";
                    
                
                }
              // slutter coden for informasjon
              $data = $data . "])";
              ?>
          // bruk Echo til insert av informasjon
          var data = google.visualization.arrayToDataTable<?php echo $data; ?>;

            // endre titlen, posisjon og bakgruns farge.
            var options = {
              title: '1IMA pressure',
              legend: { position: 'bottom'},
              backgroundColor: '#f1f8e9'
            };
            // ha div vise grafen
            var chart = new google.visualization.LineChart(document.getElementById('1IMA-pressure'));

            chart.draw(data, options);
          }
  </script>

  <!--Script til google 1IMB pressure charts-->
  <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          // bruker en funksjon fra google til tegne graf
          function drawChart() {

              // coble til databasen 
              <?php
              include "./dbconfig2.php";

                // skrive hva informatjon som skal vises
              /* var $data = google.visualization.arrayToDataTable([ */
                $data = "([['Year', 'Pressure']";
                
                // sql henter informasjonen og bruker where for bare ett rum, orderby tid for kun at hente nye informasjoner og desc limit 10 da hentes det bare 10.
                $sql = "SELECT pressure FROM muffins.sensor_data where classroom_id='356' ORDER BY rasp_time DESC LIMIT 10";

                $result = $connection->query($sql);

                // while kjorer igjennom alle 10 SELECTS og setter de inn.
                while($rad = $result->fetch_assoc()) {
                    $psi = $rad["pressure"];
                    $data = $data . ",['', $psi]";
                    
                
                }
              // slutter coden for informasjon
              $data = $data . "])";
              ?>
          // bruk Echo til insert av informasjon
          var data = google.visualization.arrayToDataTable<?php echo $data; ?>;

            // endre titlen, posisjon og bakgruns farge.
            var options = {
              title: '1IMB Pressure',
              legend: { position: 'bottom' },
              backgroundColor: '#f1f8e9'
            };
            // ha div vise grafen
            var chart = new google.visualization.LineChart(document.getElementById('1IMB-pressure'));

            chart.draw(data, options);
          }
  </script>

  <!--Script til google 1IMB  charts-->
<script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          // bruker en funksjon fra google til tegne graf
          function drawChart() {
          
              // coble til databasen
              <?php
              include "./dbconfig2.php";

              // skrive hva informatjon som skal vises
              /* var $data = google.visualization.arrayToDataTable([ */
              $data = "([['Year', 'Light', 'Sound', 'Humidity', 'Temperature']";
              // sql henter informasjonen og bruker where for bare ett rum, orderby tid for kun at hente nye informasjoner og desc limit 10 da hentes det bare 10.
              $sql = "SELECT temprature, humidity, light, sound, rasp_time FROM muffins.sensor_data where classroom_id='356' ORDER BY rasp_time DESC LIMIT 10";

                $result = $connection->query($sql);
                // while kjorer igjennom alle 10 SELECTS og setter de inn.
                while($rad = $result->fetch_assoc()) {
                    $moist = $rad["humidity"];
                    $temp = $rad["temprature"];
                    $light = $rad["light"];
                    $noise = $rad["sound"];
                    $data = $data . ",['',  $light, $noise, $moist, $temp]";
                    
                
                }
              // slutter coden for informasjon
              $data = $data . "])";
              ?>
          // bruk Echo til insert av informasjon
          var data = google.visualization.arrayToDataTable<?php echo $data; ?>;

            // endre titlen, posisjon og bakgruns farge.
            var options = {
              title: '1IMB',
              legend: { position: 'bottom' },
              backgroundColor: '#f1f8e9'
            };

            // ha div vise grafen
            var chart = new google.visualization.LineChart(document.getElementById('1IMB'));

            chart.draw(data, options);
          }
  </script>
</head>
<body>
  <!--hente tid-->
<?php
  include "dbconfig2.php";
  $sql = "SELECT rasp_time FROM sensor_data ORDER BY id DESC LIMIT 5";
  $result = $connection->query($sql);
  $rad = $result->fetch_assoc();
  $time =  $rad["rasp_time"];
  echo "<script>console.log('$time')</script>";
?>

   
<!--grid til alt og layout-->
    <div class="bodyGrid">
      <div class="header">Classroom Reactive Display</div>
      <!--Knapp til start siden-->
      <div class="button"><a href="index.php">This doin numbers</a></div>
      <!--Vise latest updated-->
      <div class='time'>
      <?php
      echo "Last update: $time";
      ?>
      </div>
      <!--Refresh knapp-->
      <div class="refresh"><a href="graph.php">"Refresh"</a></div>
      </div>
      <div class="Graph-1IMA">
      <!--creting the tables with google-->
      
     </div>

    <!--Grafer-->
    <div class="Graph">
      <div id="1IMA" class="Graph-1IMA" ></div>
      <div id="1IMA-pressure" class="Graph-1IMA" ></div>
      <div id="1IMB" class="Graph-1IMB" ></div>
      <div id="1IMB-pressure" class="Graph-1IMB" ></div>
    </div>

  

          