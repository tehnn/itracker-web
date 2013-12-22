<?php

$lat1 = rand(10, 17);
$lng1 = rand(99, 101);
$lat2 = rand(10, 17);
$lng2 = rand(99, 101);
$lat3 = rand(10, 17);
$lng3 = rand(99, 101);




$cars = array(
    array('info' => 'กค220พล.', 'lat' => $lat1, 'lng' => $lng1, 'type' => 'a'),
    array('info' => 'กง1234พย.', 'lat' => $lat2, 'lng' => $lng2, 'type' => 'b'),
    array('info' => 'นต3412กทม.', 'lat' => $lat3, 'lng' => $lng3, 'type' => 'c')
);
 

echo json_encode($cars);
exit();
?>