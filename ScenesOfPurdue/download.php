<?php
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}

//bring in id info
$id=$_GET['id'];

//create sql statement to select image information that matches up with image ID
$sql="SELECT * FROM image WHERE ImageID='".$id."'";
//run query
$result=mysql_query($sql);
//create array
$row=mysql_fetch_array($result);
//file download
$file=$row["ImageName"];

//set headers
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$file");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");
//read the file from disk
readfile($file);
header("location:image.php?id=".$imageID);

?>