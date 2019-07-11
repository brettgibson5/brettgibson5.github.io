<?php
session_start();
include("DBConn_PHP.inc");
//unset variables
session_unset();
//destory session
session_destroy();
//go back to default page
header("Location:default.php");
?>