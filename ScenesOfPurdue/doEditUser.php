<?php
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}

//bring in id info
$id=$_GET['id'];

//get data from the form
$username=$_POST["username"];
$password=$_POST["password"];
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];

//form validation, if empty, message user, reroute to editUser.php
if (empty($username)){
$_SESSION["message"]="Please fill out all fields";
header("location:editUser.php");
exit;
}
//form validation, if empty, message user, reroute to editUser.php
if (empty($password)){
$_SESSION["message"]="Please fill out all fields";
header("location:editUser.php");
exit;
}
//form validation, if empty, message user, reroute to editUser.php
if (empty($firstName)){
$_SESSION["message"]="Please fill out all fields";
header("location:editUser.php");
exit;
}
//form validation, if empty, message user, reroute to editUser.php
if (empty($lastName)){
$_SESSION["message"]="Please fill out all fields";
header("location:editUser.php");
exit;
}
//see if username already exists
$sql="SELECT * FROM admin WHERE Username='".$username."'";
//run in query
$result=mysql_query($sql);
//if rows does not equal to 0, that username already exists
if(mysql_num_rows($result)!=0)
	{
	//go to welcome page
	header("location: default.php");
	//message username already exists, exit
	$_SESSION["message"]="Username already exists";
	exit;
	}

//set up query to update admin info
$sql="UPDATE admin SET Username='".$username."', Password='".$password."', FirstName='".$firstName."', LastName='".$lastName."' WHERE UserID='".$id."'";
//run query
$result=mysql_query($sql);
//message to user
$_SESSION["message"]="User updated";
//go to default page and exit
header("location:default.php");
exit;

?>