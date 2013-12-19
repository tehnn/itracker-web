<?php

$con = mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("gps") or die (mysql_error());
mysql_query("SET NAMES UTF8");

//echo $con;

?>
