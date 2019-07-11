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
//if username isn't empty, display greeting
if(!empty($_SESSION["username"])){
echo "<div id='floatRight'>";
echo "<h3>Welcome ".$_SESSION['first']."!</h3>";
echo "</div>";
}else{
//if not, display login
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
<h3>{ home }</h3>
</div>
<hr />
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
//if message isn't empty, display message
if (!empty($_SESSION["message"]))
{
	echo "<span id='message' style='padding:3px;'><span id='grey'>";
	echo $_SESSION["message"];
	echo "</span></span>";
	unset($_SESSION["message"]);
}
//if not logged in, give description of site
if(empty($_SESSION["username"])){
echo "Welcome to Scenes of Purdue University! Feel free to browse the pictures or login as an admin.";
}
//select userID from username session
$sql="SELECT UserID FROM admin WHERE Username='".$_SESSION['username']."'";
//run query
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//set userID to session userID
$_SESSION["userID"]=$row["UserID"];
//check if session username isn't empty and ID is the sa
if(!empty($_SESSION["username"]) && $_SESSION["userID"]=="3"){
echo "<br /><br />";
//displays user management system header
echo "<div id='column'><h3>User Management System</h3><hr style='width:200px;border: solid #B1946C 2px;'>";
//sets up sql to select all category users
$sql="SELECT UserID, Username FROM admin WHERE Type='Category'";
//runs query
$result=mysql_query($sql);
//counts the number of results
$num_results=mysql_num_rows($result);
	//entered in loop
	if ($num_results==0){
		//if no rows, message no category admins
		$_SESSION["message"]="No Category Admins";
		}
	else
		{
		//unset message
		unset($_SESSION["message"]);
		//loop through array of results
		for($i = 0; $i < $num_results; $i++)
			{
			//fetch array
			$row = mysql_fetch_array($result);
			//UPDATE ADMINS
			//select all from category table where adminID is current category user
			$sql2="SELECT * FROM category WHERE adminID='".$row['UserID']."'";
			//entered in array
			$result2=mysql_query($sql2);
			//fetch array
			$row2 = mysql_fetch_array($result2);
			//put in div column, displays username, line underneath
			echo "<div id='column'><b>Username: </b>" .$row["Username"]."<br /><hr style='width:auto; border: 1px solid grey; margin:3px 0;'>";
			//set up form, goes to updateAdmin.php with id posted
			echo "<form method='post' action='updateAdmin.php?id=".$row['UserID']."'>";
			//CHECKBOXES
			//if category isn't null
			if($row2['engFountain']!='null'){
				//display the checkbox as checked = true
				echo "<input type='checkbox' name='fountain' value='fountain' checked='true'> Eng. Fountain<br />";
				//else display it as false
				}else{echo "<input type='checkbox' name='fountain' value='fountain'> Eng. Fountain<br />";}
			//repeat for all categories////////////////////////////////////////////////////////////////////
			if($row2['bellTower']!='null'){
				echo "<input type='checkbox' name='belltower' value='belltower' checked='true'> Bell Tower<br />";
				}else{echo "<input type='checkbox' name='belltower' value='belltower'> Bell Tower<br />";}			
			if($row2['Knoy']!='null'){
				echo "<input type='checkbox' name='knoy' value='knoy' checked='true'> Knoy Hall<br />";
				}else{echo "<input type='checkbox' name='knoy' value='knoy'> Knoy Hall<br />";}		
			if($row2['Hovde']!='null'){
				echo "<input type='checkbox' name='hovde' value='hovde' checked='true'> Hovde Hall<br />";
				}else{echo "<input type='checkbox' name='hovde' value='hovde'> Hovde Hall<br />";}
			if($row2['Sinninger']!='null'){
				echo "<input type='checkbox' name='sinninger' value='sinninger' checked='true'> Sinninger Pond<br />";
				}else{echo "<input type='checkbox' name='sinninger' value='sinninger'> Sinninger Pond<br />";}
			//submit button
			echo "<input type='submit' value='Submit Changes'></form>";
			//delete link, goes to deleteUser.php
			echo "&nbsp;<a href='deleteUser.php?id=".$row['UserID']."' style='text-decoration:none;color:black;'>";
			echo "<span style='color:#CC3333;font-weight:bold;font-size:18px;'>x</span>&nbsp;Delete User</a><br />";
			//edit link, goes to editUser.php
			echo "&nbsp;<a href='editUser.php?id=".$row['UserID']."' style='text-decoration:none;color:black;'>";
			echo "<span style='color:#666666;font-weight:bold;font-size:18px;'>?</span>";
			echo "&nbsp;Edit User</a><br /><br /></div>";
			}
		}
		echo "</div>";
		echo "<div id='column' style='margin-left:20px;'>";
		//ADD ADMINS
		echo "<h3><span style='color:green;font-weight:bold;font-size:18px;'>+</span>";
		echo " Add Admins</h3><hr style='width:200px;border: solid #B1946C 2px;'>";
		//posts to addUser.php
		echo "<form method='post' action='addUser.php';'>";
		//input textbox for create user
		echo "<div id='inputText'>Username: <input type='text' name='username' maxlength='20' /></div><br />";
		//input textbox for create user
		echo "<div id='inputText'>Password: <input type='password' name='password' maxlength='20' /></div><br />";
		//input textbox for create user
		echo "<div id='inputText'>First Name: <input type='text' name='firstName' maxlength='20' /></div><br />";
		//input textbox for create user
		echo "<div id='inputText'>Last Name: <input type='text' name='lastName' maxlength='20' /></div><br />";
		//input textbox for create user
		echo "<div id='inputText'>User ID: <input type='text' name='userID' maxlength='20' /></div><br />";
		//fieldset for checkboxes
		echo "<fieldset style='padding:5px;margin:2px;'>";
		//legend
		echo "<legend>&nbsp;Please pick at least one category &nbsp;</legend>";
		//displays options for categories
		echo "<input type='checkbox' name='fountain' value='fountain' checked='yes'> Eng. Fountain<br />";
		echo "<input type='checkbox' name='belltower' value='belltower'> Bell Tower<br />";
		echo "<input type='checkbox' name='knoy' value='knoy'> Knoy Hall<br />";
		echo "<input type='checkbox' name='hovde' value='hovde'> Hovde Hall<br />";
		echo "<input type='checkbox' name='sinninger' value='sinninger'> Sinninger<br />";
		echo "</fieldset>";
		echo "<div id='inputText' style='width:80px;'>&nbsp;</div><input type='submit' value='Add User'/></form><br />";
		echo "</div>";
}
?>
 <p>
<!--spaces helps with display--> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
 </div>
</div>
</div>
<img src="site/bottom.png"/>
</div>


</body>
</html>