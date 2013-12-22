<?php

$lat1 = rand(10, 17);
$lng1 = rand(99, 101);
$lat2 = rand(10, 17);
$lng2 = rand(99, 101);
$lat3 = rand(10, 17);
$lng3 = rand(99, 101);

for ($i = 0; $i <= 9; $i++) {
    $car[$i][info] = "car" . "$i";
    $car[$i][lat] = rand(10, 17);
    $car[$i][lng] = rand(99, 101);
    $t = rand(1, 3);
    if ($t == 1)
        $car[$i][type] = 'a';
    if ($t == 2)
        $car[$i][type] = 'b';
    if ($t == 3)
        $car[$i][type] = 'c';
}

//echo count($car);
//exit;

$all_cars = array();
for ($i = 0; $i < count($car); $i++) {
    array_push($all_cars, $car[$i]);
}
echo json_encode($all_cars);
exit();
?>