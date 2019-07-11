<?
//start session
session_start();
include("DBConn_PHP.inc");
?>
<html>
<head>
<title>Scenes of Purdue</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="center">
<img src="site/top.png" />
<div class="background">
<div class="body">
<div class="header">
<?php
//if username isn't empty, display admin level
if(!empty($_SESSION["username"])){
	echo "<div id='floatRight'>";
	echo "<span id='grey'>Admin: ".$_SESSION["type"];
	//if category admin, display categories they have access to
	if ($_SESSION["type"]=='Category'){
		echo " of ";
		//set up query to select category info with matching user id
		$sql="SELECT * FROM category WHERE adminID='".$_SESSION['userID']."'";
		//run in query
		$result=mysql_query($sql);
		//create into array
		$row=mysql_fetch_array($result);
		//if values aren't null, display them on header
		if ($row["engFountain"]!="null"){
		echo " + Fountain";}
		if ($row["bellTower"]!="null"){
		echo " + Bell Tower";}
		if ($row["Knoy"]!="null"){
		echo " + Knoy";}
		if ($row["Hovde"]!="null"){
		echo " + Hovde";}
		if ($row["Sinninger"]!="null"){
		echo " + Sinninger";}
	echo "</span>";
	}
	echo "</div>";
}else{
//else display login forms
echo "<form name='form1' method='post' action='login.php'>";
echo "<div id='floatRight'><span id='grey'>LOGIN: </span>";
echo "<input type='text' name='username' size='10' id='";
Trim($row['username']);
echo "'/>";
echo "<span id='grey'> PASSWORD: </span>";
echo "<input type='password' name='password' size='10' id='";
Trim($row['password']);
echo "'/>";
echo "&nbsp; <input type='submit' value='Submit'/>";
echo "</div>";
echo "</form>";
}
?>
<h3>{ readme }</h3>
</div>
<hr />
<!--displays menu-->
<div id="menu">
<a href="default.php">home</a>
<a href="readme.php">readme</a>
<?
//if not logged in, do not account settings link
if(empty($_SESSION["username"])){
echo "&nbsp;";
}else{
echo "<a href='editAccount.php'>edit account</a>";
}
//if not logged in, do not display upload link
if(empty($_SESSION["username"])){
echo "&nbsp;";
}else{
echo " <a href='upload.php'>upload</a>";
}
?>
<?
//if not logged in, do not display the logout link
if(empty($_SESSION["username"])){
echo "&nbsp;";
}else{
echo " <a href='logout.php'>log out</a>";
}
?>
<br />
</div>
<!--displays categories-->
<div id="cat">
<a href="fountain.php">Eng. Fountain</a>
<span id="catDash">//</span>
<a href="belltower.php">Bell Tower</a>
<span id="catDash">//</span>
<a href="knoy.php">Knoy Hall</a>
<span id="catDash">//</span>
<a href="hovde.php">Hovde Hall</a>
<span id="catDash">//</span>
<a href="sinninger.php">Sinninger</a>
</div>
<div id="content">
  <h3>// about</h3>
<p>Brett Gibson<br>
 CGT 356 Project 2</p>
 <p>&nbsp;</p>
 <h3>// extras</h3>
 <p>+ Advanced features for modifing category users for<br>
 + Ability to edit own account settings</p>
  <p>&nbsp;</p>
 <h3>// documentation</h3>
 <p>+ Completed in November of 2008</p>
 </div>
</div>
</div>
<img src="site/bottom.png" />
</div>
</body>
</html>