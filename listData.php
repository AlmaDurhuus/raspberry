<?php /*php file that connects to le database*/
include "./dbconfig2.php";
?>

<table>
<?php /*gets the specific data from database*/
$sql = 
"SELECT a.classroom_id, a.rasp_time, a.pressure, a.humidity, a.temprature, a.light, a.sound
FROM sensor_data a
INNER JOIN (
    SELECT classroom_id, MAX(rasp_time) rasp_time
    FROM sensor_data
    GROUP BY classroom_id)
    b ON a.classroom_id = b.classroom_id AND a.rasp_time = b.rasp_time";

$result = $connection->query($sql);

/*keeps gettin the newer data from ol' database*/
while($rad = $result->fetch_assoc()) {
    $class = $rad["classroom_id"];
    $psi = $rad["pressure"];
    $moist = $rad["humidity"];
    $temp = $rad["temprature"];
    $light = $rad["light"];
    $noise = $rad["sound"];
    $Rasp_time = $rad["rasp_time"];

    echo "
    <spans class='Items'>$class</spans>
    <spans class='Items' >$Rasp_time</spans>
    <spans class='Items' >$psi</spans>
    <spans class='Items' >$moist</spans>
    <spans class='Items' >$temp</spans>
    <spans class='Items' >$light</spans>
    <spans class='Items' >$noise</spans>
    ";
}

?>
</table>
