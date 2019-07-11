<?php
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
<h3>{ view image }</h3>
</div>
<hr />
<!--display menu-->
<div id="menu">
<a href="default.php">home</a>
<a href="readme.php">readme</a>
<?php
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
<?php
//if not logged in, do not display the logout link
if(empty($_SESSION["username"])){
echo "&nbsp;";
}else{
echo " <a href='logout.php'>log out</a>";
}
?>
<br />
</div>
<!--display categories-->
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
<?php
//bring in id info
$id=$_GET['id'];
//create sql statement to select image information that matches up with image ID
$sql="SELECT * FROM image WHERE ImageID='".$id."'";
//run query
$result=mysql_query($sql);
//create array
$row=mysql_fetch_array($result);

//container for picture
echo "<div id='bigContainer'>";
//echo image src, creates image on page
echo "<img src=".$row["ImagePath"]." width='540px' style='border:none;'>";
echo "<br />";
//description, put in caption style
echo "<div id='caption' style='font-size:14px; margin:3px;'>".$row["ImageDesc"]."</div>";
//back link, from session variable 'url'
echo "<a href='".$_SESSION['url']."'>back</a>";
echo "</div>";
?>
<br /><br /><br /><br />
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
 <div id="pic"></div>
 </div>
</div>
</div>
<img src="site/bottom.png" />
</div>
</body>
</html>