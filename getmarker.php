<?php
$lat1=rand(10,15);
$lat2=rand(10,15);
$cars = array(
    'loc1' => array( 'info' => 'Car1', 'lat' => $lat1, 'lng' => 100.9634 ),
    'loc2' => array( 'info'=>'Car2','lat'  => $lat2, 'lng' => 100.5244 ),
    'loc3' => array( 'info' => 'Car3','lat'  => 14.9032, 'lng' => 101.5144),
    'loc4' => array( 'info' => 'Car4', 'lat' => 14, 'lng' => 103.60 )
);
echo json_encode($cars);
exit();
?>