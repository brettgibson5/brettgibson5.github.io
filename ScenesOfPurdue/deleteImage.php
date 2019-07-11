<?php
session_start();
include("DBConn_PHP.inc");
//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}
//bring in id info
$id=$_GET['id']; 
//actually remove file from folder
//set up sql statement to select the image path
$sql="SELECT ImagePath FROM image WHERE ImageID='".$id."'";
//run sql
$result=mysql_query($sql);
//get array
$row = mysql_fetch_array($result);
//get image path
$file = $row["ImagePath"];
//unlink image path from folder, aka delete file
unlink($file);
//create sql query
$sql="DELETE FROM image WHERE ImageID='".$id."'";
//run sql query
$result=mysql_query($sql);
//add message
$_SESSION["message"]="Image deleted";
//return to address
header($_SESSION["page"]);
?>