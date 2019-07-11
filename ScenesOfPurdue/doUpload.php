<?php
session_start();
include("DBConn_PHP.inc");

//set time limit in upload
set_time_limit(300);

//check if user selected a file
if($HTTP_POST_VARS["uploadFile"]!="")
{
	//get file extension
	$fileExt = strrchr($HTTP_POST_FILES['userfile']['name'],".");
	if($fileExt !=".jpg" && $fileExt !=".gif")
	{
		$_SESSION["message"]="Your file must be a jpg or a gif";
	}
	else
	{
		//get file name
		$fileName = $HTTP_POST_FILES['userfile']['name'];
		//get image description
		$imageDesc=$HTTP_POST_VARS["imageDesc"];
		//get file and upload it
		if(!is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name']))
		{
			$_SESSION["message"]="Error";
			exit;
		}
		//declare counter
		$counter=1;
		//declar category
		$category=$HTTP_POST_VARS["Category"];
		//get image count from the database, increment
		$sql="SELECT * FROM image WHERE CategoryID='".$category."'";
		//insert in query
		$result=mysql_query($sql);
		//count rows
		$num_results=mysql_num_rows($result)+1;
		//loop statement, finds number of files per category
		for($i=0;$i< $num_results; $i++)
		{
			$filename=$category.$counter.$fileExt;
			
			if (!file_exists("images/".$filename))
			{
			break;
			}else
			{$counter++;}
		}
		//name the file path
		$upfile="images/".$filename;
		//check if the file was copied
		if(!copy($HTTP_POST_FILES['userfile']['tmp_name'], $upfile))
		{
			//error message, exit
			$_SESSION["message"]="Error";
			exit;				
		}
		//name imageID with cateogry id and counter
		$imageID = $category.$counter;
		//run sql query to see if image ID already exists
		$sql="SELECT * FROM image WHERE ImageID='".$imageID."'";
		$result=mysql_query($sql);
		//if rows do not equal to 0
		if(mysql_num_rows($result)!=0)
		{
			//go to welcome page, message user, exit
			header("location: default.php");
			$_SESSION["message"]="Image ID already exists";
			exit;
		}
		//enter data in image database
		$sql="INSERT INTO image(CategoryID, ImageID, ImageName, ImageDesc, ImagePath, UserID) VALUES ('".$category."', '".$imageID."','".$fileName."','".$imageDesc."','".$upfile."','".$_SESSION["username"]."')";
		//run in query
		$result=mysql_query($sql);
		//message user
		$_SESSION["message"]="Upload successful";
	}//end file type check
}
//end form check, go back to upload
header("location:upload.php");
?>