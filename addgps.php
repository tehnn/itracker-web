<?php
// This file recieve data from iTrackerII (android app)
echo "<meta charset='UTF-8'>";
require 'condb.php';
$time = $_POST['time'];
$simsn = $_POST['simsn'];
$number = $_POST['number'];
$imei = $_POST['imei'];
$net = $_POST['net'];
$cellid = $_POST['cellid'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$speed = $_POST['speed'];
$address = $_POST['address'];

$sql = "insert into data (id,time,simsn,number,imei,net,cellid,lat,lng,speed,address) 
	values (null,'$time','$simsn','$number','$imei','$net','$cellid','$lat','$lng','$speed','$address')";
mysql_query($sql);
mysql_close($con);
?>