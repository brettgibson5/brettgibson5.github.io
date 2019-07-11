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
$psw1=$_POST["password"];
$psw2=$_POST["passwordConfirm"];
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
//if any forms are empty, tell user to fill out all rows
if (empty($psw1)||empty($psw2)||empty($firstName)||empty($lastName)){
	$_SESSION["message"]="Please fill out all rows";
	header("Location:editAccount.php");
	exit;
	}
//if username is not equal to session username, then search for duplicate usernames
if ($username != $_SESSION['username']){
//check for username
$usernamecheck="SELECT * FROM admin WHERE Username ='".$username."'";
//run in query
$result=mysql_query($usernamecheck);
//get the number of results, or end if doesn't work
$num_results = mysql_num_rows($result);
//if num_results equals to 1 then login already exists, else proceed
	if($num_results==1){
	$_SESSION["message"]="Login already exists";
	header("Location:editAccount.php");
	exit;
	}
}
//if both passwords match
if($psw1==$psw2){
	//set sessions
	$_SESSION["username"]=$username;
	$_SESSION["firstName"]=$firstName;
	$_SESSION["lastName"]=$lastName;
	//form sql query
	$sql="UPDATE admin SET Username='".$username."',FirstName='".$firstName."' , LastName='".$lastName."', Password='".$psw1."' WHERE UserID= '".$id."'";
	//insert query into the database
	$result=mysql_query($sql);
	//message to user
	$_SESSION["message"]="Account updated";
	//redirect
	header("Location:default.php");
}else{ //passwords do not match, let them know
	$_SESSION["message"]="Passwords do not match";
	header("Location:editAccount.php");
}
?>
