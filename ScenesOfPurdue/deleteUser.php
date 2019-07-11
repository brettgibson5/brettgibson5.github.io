<?php
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}
//bring in id info
$id=$_GET['id']; 

//create sql query
$sql="DELETE FROM admin WHERE UserID='".$id."'";
//create sql query for category database
$sql2="DELETE FROM category WHERE adminID='".$id."'";


//run sql querys
$result=mysql_query($sql);
$result2=mysql_query($sql2);

//add message
$_SESSION["message"]="User deleted";

//return to address
header("location:default.php");
	
?>