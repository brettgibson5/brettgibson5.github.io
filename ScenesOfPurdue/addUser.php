<?php
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}

//get data from the form
$username=$_POST["username"];
$password=$_POST["password"];
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
$userID=$_POST["userID"];

//make sure one category is filled out
if (empty($_POST["fountain"])&&empty($_POST["belltower"])&&empty($_POST["knoy"])&&empty($_POST["hovde"])&&empty($_POST["sinninger"])){
	$_SESSION["message"]="Please fill out at least one category";
	header("location:default.php");
	exit;
}
//if empty, make the value equal null
if(empty($_POST["fountain"])){
	$fountain="null";
	}else{$fountain=$_POST["fountain"];}
if(empty($_POST["belltower"])){
	$belltower="null";
	}else{$belltower=$_POST["belltower"];}
if(empty($_POST["knoy"])){
	$knoy="null";
	}else{$knoy=$_POST["knoy"];}
if(empty($_POST["hovde"])){
	$hovde="null";
	}else{$hovde=$_POST["hovde"];}
if(empty($_POST["sinninger"])){
	$sinninger="null";
	}else{$sinninger=$_POST["sinninger"];}

//form validation, if empty, message user, reroute to default.php
if (empty($username)){
$_SESSION["message"]="Please fill out all fields";
header("location:default.php");
exit;
}
if (empty($password)){
$_SESSION["message"]="Please fill out all fields";
header("location:default.php");
exit;
}
if (empty($firstName)){
$_SESSION["message"]="Please fill out all fields";
header("location:default.php");
exit;
}
if (empty($lastName)){
$_SESSION["message"]="Please fill out all fields";
header("location:default.php");
exit;
}
if (empty($userID)){
$_SESSION["message"]="Please fill out all fields";
header("location:default.php");
exit;
}
//set up query, select admin information
$sql="SELECT * FROM admin WHERE Username='".$username."'";
//run query
$result=mysql_query($sql);
//if the result is not zero, it already exists
if(mysql_num_rows($result)!=0)
	{
	//go to welcome page, message user
	header("location: default.php");
	$_SESSION["message"]="Username already exists";
	exit;
	}
//same as before, only with userID instead of username	
$sql="SELECT * FROM admin WHERE UserID='".$userID."'";
//put in query
$result=mysql_query($sql);
//if not zero
if(mysql_num_rows($result)!=0)
	{
	//go to welcome page, message user
	header("location: default.php");
	$_SESSION["message"]="User ID already exists";
	exit;
	}


//form sql query to add in admin
$sql="INSERT INTO admin(Username, Password, FirstName, LastName, UserID, Type) VALUES('".$username."','".$password."','".$firstName."','".$lastName."','".$userID."','Category')";
//insert query into the database
$result=mysql_query($sql);

//insert categories into category database
$sql="INSERT INTO category(adminID, engFountain, bellTower, Hovde, Knoy, Sinninger) VALUES('".$userID."','".$fountain."','".$belltower."','".$hovde."','".$knoy."','".$sinninger."')";
//insert query into the database
$result=mysql_query($sql);

//message to user
$_SESSION["message"]="Entry added";
//redirect
header("Location:default.php");

?>