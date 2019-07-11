<?php
//start session
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}

//declare session variables from form
$_SESSION["username"] = $HTTP_POST_VARS["username"];
$_SESSION["password"] = $HTTP_POST_VARS["password"];

//set a variable to be referenced to access our text file
$myFile="log/dataLogger.txt";
//open up the text file in append mode
//on error, echo out "can't open file"
$myTextStream=fopen($myFile, 'a') or die("can't open file");
//write out log data to the file
fwrite($myTextStream, $_SERVER['REMOTE_ADDR']);
fwrite($myTextStream, chr(9));
fwrite($myTextStream, $_SERVER['HTTP_USER_AGENT']);
fwrite($myTextStream, chr(9));
fwrite($myTextStream, date("m-d-y"));
fwrite($myTextStream, chr(9));
fwrite($myTextStream, date("h:i:s A"));
fwrite($myTextStream, chr(9));
fwrite($myTextStream, $_SESSION["username"]);
fwrite($myTextStream, chr(9));
fwrite($myTextStream, $_SESSION["password"]);
fwrite($myTextStream, chr(9));

//check to see if empty 
if(empty($_SESSION["username"])){
$_SESSION["message"]="Please enter a username";
header("location:default.php");
unset($_SESSION["username"]);
unset($_SESSION["password"]);
exit;
}

//check to see if results are empty
if (empty($_SESSION["password"])){
$_SESSION["message"]="Please enter a password";
header("location: default.php");
unset($_SESSION["username"]);
unset($_SESSION["password"]);
exit;
}

//create sql query
$sql="SELECT * FROM admin WHERE Username='".$_SESSION["username"]."'AND Password='".$_SESSION["password"]."'";
//check for matching username and password
$result=mysql_query($sql);
//create session variables from array
while ($row = mysql_fetch_array($result)) { 
$_SESSION["first"]=$row["FirstName"];
$_SESSION["last"]=$row["LastName"];
$_SESSION["type"]=$row["Type"];
$_SESSION["userID"]=$row["UserID"];
}

//if correct match
if(mysql_num_rows($result)==1)
	{
	//go to welcome page
	header("location: default.php");
	$_SESSION["message"]="Login passed";
	//write success
	fwrite($myTextStream, "SUCCESS");
	//create new line
	fwrite($myTextStream, "\r\n");
	//close stream
	fclose($myTextStream);
	}
//if incorrect match
else
	{
	//go to create user page
	header("location:default.php");
	$_SESSION["message"]="Login failed";
	unset($_SESSION["username"]);
	unset($_SESSION["password"]);
	//write failure
	fwrite($myTextStream, "FAILED");
	//new line
	fwrite($myTextStream, "\r\n");
	//close stream
	fclose($myTextStream);
	}
?>