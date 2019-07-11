<?php
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}

//get caption and ID from the form
$imageDesc=$_POST["imageDesc"];
$imageID=$_POST["imageID"];

//form validation, if empty, message user, redirect to category page
if (empty($imageDesc)){
$_SESSION["message"]="Please enter a caption";
header($_SESSION["page"]);
exit;
}

//set up query to update caption
$sql="UPDATE image SET ImageDesc='".$imageDesc."' WHERE ImageID='".$imageID."'";
//run query
$result=mysql_query($sql);
//message to user
$_SESSION["message"]="Caption updated";
//exit;
header("location:image.php?id=".$imageID);
exit;

?>