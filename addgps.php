<?php
// This file recieve data from iTrackerII (android app)
echo "<meta charset='UTF-8'>";
if(empty($_POST['time'])){
    exit;
}
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
$speed =  number_format($speed*3.6, 2, '.', '');
$address = trim($_POST['address']);
if($address==""){
  $address = substr($imei,-5);  
}

$sql = "insert into data (id,time,simsn,number,imei,net,cellid,lat,lng,speed,address) 
	values (null,'$time','$simsn','$number','$imei','$net','$cellid','$lat','$lng','$speed','$address')";
mysql_query($sql);
mysql_close($con);
?>