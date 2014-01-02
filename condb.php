<?php

$con = mysql_connect("203.157.118.8","sa","sa") or die (mysql_error());
mysql_select_db("gps") or die (mysql_error());
mysql_query("SET NAMES UTF8");

//echo $con;

?>
