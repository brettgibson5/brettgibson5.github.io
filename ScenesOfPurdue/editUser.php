<?

session_start();
include("DBConn_PHP.inc");

//if session did not register, go back to default page
if(!session_is_registered("username")){
header("location:default.php");
}

//bring in id info
$id=$_GET['id'];
//set up query to select admin from correct user id
$sql="SELECT * FROM admin WHERE UserID='".$id."'";
//run in in database
$result=mysql_query($sql);
//set up result in row format
$row = mysql_fetch_array($result);


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
//if session username isn't emtpy, display welcome
if(!empty($_SESSION["username"])){
echo "<div id='floatRight'>";
echo "<h3>Welcome ".$_SESSION["first"]."!</h3>";
echo "</div>";
//if not, display login data
}else{
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
<h3>{ edit user }</h3>
</div>
<hr />
<!--menu-->
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
<div id="cat">
<!--categories-->
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
<!--table for editing user, posts previous data from pulled array from database-->
<form action="doEditUser.php?id=<? echo $id ?>" method="post" name="form1" id="form1" style="border:none;">
  <table width="300" border="none" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#BABABA"><div align="right">Username:</div></td>
        <td bgcolor="#BABABA"><input type="text" name="username" value="<? echo $row["Username"]; //pulling out each variable from returned row ?>" maxlength="20" /></td>
      </tr>
    <tr>
      <td bgcolor="#CCCCCC"><div align="right">Password:</div></td>
        <td bgcolor="#CCCCCC"><input type="text" name="password" value="<? echo $row["Password"]; ?>"maxlength="20" /></td>
      </tr>
    <tr>
      <td bgcolor="#BABABA"><div align="right">First Name:</div></td>
        <td bgcolor="#BABABA"><input type="text" name="firstName" value="<? echo $row["FirstName"]; ?>"maxlength="20" /></td>
      </tr>
    <tr>
      <td bgcolor="#CCCCCC"><div align="right">Last Name:</div></td>
        <td bgcolor="#CCCCCC"><input type="text" name="lastName" value="<? echo $row["LastName"]; ?>"maxlength="15" /></td>
      </tr>
    <tr>
      <td colspan="2"><div align="center">
          <input type="submit" name="Submit"/>
        </div></td>
      </tr>
    </table>
    <?
	//if session isn't empty, echo it out, unset it again so it won't display on every page
	if (!empty($_SESSION["message"]))
	{
	echo "<span id='message' style='padding:3px;'><span id='grey'>";
	echo $_SESSION["message"];
	echo "</span></span>";
	unset ($_SESSION["message"]);
	}		
	?>
      </p>
      <p style="text-align:center;"><a href="default.php">Back</a></p>
</form>
</div>
</div>
</div>
<img src="site/bottom.png" />
</div>
</body>
</html>