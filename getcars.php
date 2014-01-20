<?php

require 'condb.php';

/*
  $lat1 = rand(10, 17);
  $lng1 = rand(99, 101);
  $lat2 = rand(10, 17);
  $lng2 = rand(99, 101);
  $lat3 = rand(10, 17);
  $lng3 = rand(99, 101);

 */

$sql = "select * from data inner join  
    (select address , max(id) as id  from data group by address) as dt
     on data.address = dt.address and data.id = dt.id";

//$sql = "select * from vw_data";
$res = mysql_query($sql);
$i = 0;
while ($row = mysql_fetch_array($res)) {

    $car[$i][info] = $row[address]." ".$row[speed]."kmh";
    $car[$i][speed] = $row[speed];
    $car[$i][lat] = $row[lat];
    $car[$i][lng] = $row[lng];
    $car[$i][id] = $row[id];
    $car[$i][vtype] = $row[vtype];
    
    $i++;
}//end while

/*
  for ($i = 0; $i <= 9; $i++) {
  $car[$i][info] = "car" . "$i";
  $car[$i][speed]='33';
  $car[$i][lat] = rand(10, 17);
  $car[$i][lng] = rand(99, 101);


  if ($i < 3)
  $car[$i][type] = 'a';
  if ($i == 4 or $i==3)
  $car[$i][type] = 'b';
  if ($i > 4)
  $car[$i][type] = 'c';
  }

 */

//echo count($car);
//exit;

$all_cars = array();
for ($i = 0; $i < count($car); $i++) {
    array_push($all_cars, $car[$i]);
}
echo json_encode($all_cars);


mysql_close();
exit();
?>