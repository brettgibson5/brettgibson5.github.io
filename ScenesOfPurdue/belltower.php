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
<h3>{ bell tower }</h3>
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
	//set url and page session variables
	$_SESSION["page"]="location: belltower.php";
	$_SESSION["url"]="belltower.php";
	//form sql query selecting address book with same username as session
	$sql="SELECT * FROM image WHERE CategoryID='bellTower'";
	//insert query into the database
	$result=mysql_query($sql);
	//count results
	$num_results=mysql_num_rows($result);
	//check to see if there are records in the result, if not, echo message
	if ($num_results==0){
		$_SESSION["message"]="No entries found";
		}
	else
			{
			//loop through array of results
			for($i = 0; $i < $num_results; $i++)
			{
			//split up result in rows
			$row = mysql_fetch_array($result);
			//split data and put in td tags
			echo "<div id='container'>";
			echo "<a href='image.php?id=".$row['ImageID']."'><img src=".$row['ImagePath']."  height='100' style='border:thin black solid;'></a>";
			echo "<br />";
			echo "<span id='caption'>".$row["ImageDesc"]."</span><br />";
			//see if user has authority to delete & edit
			if(!empty($_SESSION["username"])){
			$sql2="SELECT * FROM category WHERE adminID='".$_SESSION["userID"]."'";
			$result2=mysql_query($sql2);
			$row2 = mysql_fetch_array($result2);
			if($row2['bellTower']=='belltower'){
				echo "<a href='deleteImage.php?id=".$row['ImageID']."'>delete</a><br />";
				echo "<a href='editCaption.php?id=".$row['ImageID']."'>edit caption</a><br />";		
				}
			}
			echo "</div>";
			}			
		}
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