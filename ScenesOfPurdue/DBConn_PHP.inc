<?php
$host = "db1856.perfora.net"; //database location
$user = "dbo297504309"; //database username
$pass = "racket12"; //database password
$db_name = "db297504309"; //database name
//database connection
$link = mysql_connect($host, $user, $pass);
mysql_select_db($db_name);
//sets encoding to utf8
mysql_query("SET NAMES utf8");
?>

