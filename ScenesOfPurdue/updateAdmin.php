<?php
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}
//bring in id info
$id=$_GET['id']; 

//make sure one category is filled out
if (empty($_POST["fountain"])&&empty($_POST["belltower"])&&empty($_POST["knoy"])&&empty($_POST["hovde"])&&empty($_POST["sinninger"])){
	$_SESSION["message"]="Please fill out at least one category";
	header("location:default.php");
	exit;
}

//get data from the form
if(empty($_POST["fountain"])){
$fountain='null';}
else{$fountain=$_POST["fountain"];}

if(empty($_POST["belltower"])){
$belltower='null';}
else{$belltower=$_POST["belltower"];}

if(empty($_POST["knoy"])){
$knoy='null';}
else{$knoy=$_POST["knoy"];}

if(empty($_POST["hovde"])){
$hovde='null';}
else{$hovde=$_POST["hovde"];}

if(empty($_POST["sinninger"])){
$sinninger='null';}
else{$sinninger=$_POST["sinninger"];}

//create sql query
$sql="UPDATE category SET engFountain='".$fountain."', bellTower='".$belltower."', Knoy='".$knoy."', Hovde='".$hovde."', Sinninger='".$sinninger."' WHERE adminID='".$id."'";

//run sql query
$result=mysql_query($sql);

//add message
$_SESSION["message"]="User modified";

//return to default.php
header("location:default.php");
	
?>