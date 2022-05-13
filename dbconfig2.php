<?php 

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


 // connect;
 $server = "piasvg.mysql.database.azure.com";//"localhost";
 $user = "muffins";//"root";
 $pword = "Maffins2022";
 $database = "muffins";// "[insert db name]";
 // do the thing;
 $connection = new mysqli($server, $user, $pword, $database);
 
 if ($connection->connect_error) {
    die("damn. " . $connection->connect_error);
  }
