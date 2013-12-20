<?php
$lat1=rand(10,17);$lng1=rand(99,101);

$lat2=rand(10,17);$lng2=rand(99,101);
$cars = array(
    'loc1' => array( 'info' => 'Car1', 'lat' => $lat1, 'lng' => $lng1 ),
    'loc2' => array( 'info'=>'Car2','lat'  => $lat2, 'lng' => $lng2 ),
    
);
echo json_encode($cars);
exit();
?>