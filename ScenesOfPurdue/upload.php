<?php
//start session
session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}
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
}
?>
<div class="header">
<h3>{ upload }</h3>
</div>
<hr/>
<!--displays menu-->
<div id="menu">
<a href="default.php">home</a>
<a href="readme.php">readme</a>
<a href="editAccount.php">edit account</a>
<a href="upload.php">upload</a>
<a href="logout.php">log out</a>
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
<form name="form1" method="post" action="doUpload.php" enctype="multipart/form-data">
<span id="grey" style="font-size:14px;">CATEGORY:</span>
<?
//selects category info from matching userID in category table
$sql="SELECT * FROM category WHERE adminID='".$_SESSION['userID']."'";
//enter in database
$result=mysql_query($sql);
//create into array
$row = mysql_fetch_array($result);
//only displays categories that the user has authorization for
echo "<select name='Category' style='margin:1px;'>";
if($row['engFountain']!='null'){
echo "<option value='engFountain'>Engineering Fountain</option>";}
if($row['bellTower']!='null'){
echo "<option value='bellTower'>Bell Tower</option>";}
if($row['Knoy']!='null'){
echo "<option value='Knoy'>Knoy Hall</option>";}
if($row['Hovde']!='null'){
echo "<option value='Hovde'>Hovde Hall</option>";}
if($row['Sinninger']!='null'){
echo "<option value='Sinninger'>Sinninger Pond</option>";}

?>
<!--upload-->
</select><br />
<input type="file" name="userfile" style="margin:1px;"/>
<br />
<textarea name="imageDesc" cols="50" rows="3" width="500px">Enter a description here</textarea>
<br />
<input type="submit" name="uploadFile" value="Upload File" style="margin:1px;"/>
</form><br />
<!--if message session isn't empty, display, unset-->
<?php if (!empty($_SESSION["message"]))
{
	echo "<span id='message' style='padding:3px;'><span id='grey'>";
	echo $_SESSION["message"];
	echo "</span></span>";
	unset($_SESSION["message"]);
}
?>
<p>&nbsp;</p>
</div>
</div>
</div>
<img src="site/bottom.png" />
</div>
</body>
</html>