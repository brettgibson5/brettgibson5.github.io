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
<?
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
//else display login form
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
<h3>{ edit account }</h3>
</div>
<hr />
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
<?
//set up to select admin info to put in form
$sql="SELECT * FROM admin WHERE Username='".$_SESSION['username']."'";
//run query
$result=mysql_query($sql);
//fetch array
$row=mysql_fetch_array($result);
?>
<!--form for editing account-->
<form name="form0" action="doEditAccount.php?id=<? echo $row["UserID"]; ?>" method="post" style="border:none;">
<table  border="0" cellpadding="0" cellspacing="0" style="table-layout:auto;">
<tr>
  	<td>
      <div align="right">Username:</div></td>
    <td>
    <!--bring in data from admin array-->
    <input type="text" name="username" value="<? echo $row["Username"]; ?>" maxlength="15" />
    </td>
</tr>
  <tr>
    <td bgcolor="#999999"><div align="right">Password:</div></td>
    <td bgcolor="#999999"><input type="password" name="password" maxlength="15"/></td>
  </tr>
  <tr>
    <td><div align="right">Confirm Password: </div></td>
    <td><input type="password" name="passwordConfirm" maxlength="15" /></td>
  </tr>
<tr>
  	<td bgcolor="#999999">
      <div align="right">First Name:</div></td>
    <td bgcolor="#999999">
    <input type="text" name="firstName" value="<? echo $row["FirstName"]; ?>" maxlength="15" />
    </td>
</tr>
<tr>
  	<td>
      <div align="right">Last Name:</div></td>
    <td>
    <input type="text" name="lastName" value="<? echo $row["LastName"]; ?>" maxlength="15" />
    </td>
</tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" />
    </div></td>
  </tr>
</table>
</form>
 <p>&nbsp;</p>
 </div>
 <!--if message isn't empty, display message, then unset it again-->
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
<img src="site/bottom.png" />
</div>
</body>
</html>