<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include('config.inc');
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: index.php');
 }
           $style="style.css";
           $sid=$_SESSION['sid'];
           $result = mysql_query("SELECT * FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row = mysql_fetch_assoc($result);
           $style = $row["style"];


?>
<link href="<?php echo $style; ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv1 {
	position: absolute;
	width: 398px;
	height: 33px;
	z-index: 1;
	left: 352px;
	top: 13px;
}
</style>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
<div class="main_resize">
    <div class="header">


        <h1><a href="home.php"><span>iRGIT</span><small>Networking Site</small></a>   </h1>

        <div id="apDiv1" align="right">
        <form id="form1" name="form1" method="post" action="">

            <input type="text" width="500" height="30" name="search" id="search" />
            <a href="../search/">
            SEARCH</a>
          </form>
        </div>


  </div>
 <div class="menu_nav">
      <div class="clr"></div>
  </div>
<div i
class="clr"></div>

  <div class="content">
      <div class="content_bg">
        <div class="mainbar">
          <div class="article">
          <h2><span>Img upload</span></h2>
          <div class="clr"></div>


          </div>



          <script language="javascript">
 function upimg()
{
	if(document.uploadimage.textfield.value=="")
	{
		alert("Please enter image name");
		document.uploadimage.textfield.focus();
		document.uploadimage.textfield.select();
		return false;
	}
	else
             if(document.uploadimage.textarea.value=="")
	     {
	               	alert("Please enter image description");
                        document.uploadimage.textarea.focus();
	          	document.uploadimage.textarea.select();
		        return false;
     	      }
	       else
                    if(document.uploadimage.file.value=="")
	            {
		               alert("Please upload image");
		               document.uploadimage.file.focus();
	                       document.uploadimage.file.select();
		               return false;
	             }
		     else
		         {
                               return true;
		          }
}
	</script>
<?php
$filename="";
if(isset($_POST["button"]))
{
if (($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/jpg")&& ($_FILES["file"]["size"] < 200000000))
{

                             if ($_FILES["file"]["error"] > 0)
                                {
                                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                                }
                             else
                                {
//echo "Upload: " . $_FILES["file"]["name"] . "<br />";//echo "Type: " . $_FILES["file"]["type"] . "<br />";//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                                 if (file_exists("upload/" . $_FILES["file"]["name"]))
                                    {
                                                 echo $_FILES["file"]["name"] . " already exists. ";
                                    }
                                 else
                                    {
                                                 $filetypearray= explode("/",$_FILES["file"]["type"]);
                                                 $filetype= $filetypearray[1];


                                                 $filename= $_SESSION['sid'].time();
                                                 $filenamehashed= hash("md5",$filename);

                                                 move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $filenamehashed  .".". $filetype);
                                                 $sql="INSERT INTO image (IMAGE_NAME,IMAGE_DESCRIPTION,IMAGE_UPLOAD,IMAGE_TYPE)VALUES('$_POST[textfield]','$_POST[textarea]','$filenamehashed','$filetype')";

                                     }
                                }
}
else
{
         echo "Invalid file";
}




if (!mysql_query($sql))
  {
             die('Error: ' . mysql_error());
  }
  else
  {
             echo "image uploaded Successfully";
  }
}
if(isset($_GET["delimg"]))
{
             mysql_query("DELETE FROM image WHERE IMAGE_ID='$_GET[delimg]'");
}
$result = mysql_query("SELECT * FROM image");
?>

<form name="uploadimage" method="POST" action="imageupload.php" onSubmit="return upimg()" enctype="multipart/form-data">
<table width="90%" height="271" border="0" align="center">
  <tr>
    <td width="100">Image Name</td>
    <td width="300">
      <label for="textfield"></label>
      <input name="textfield" type="text" id="textfield" size="40" />
 </td>
  </tr>
  <tr>
    <td>Description</td>
    <td><textarea name="textarea" id="textarea" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>Upload Image</td>
    <td>
      <label for="fileField"></label>
      <input type="file" name="file" id="file" />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Upload Image" /></td>
  </tr>
</table>

</form>
<br>
<table width="90%" border="1"align="center">
  <tr>
    <th width="23%" scope="col"><strong>Image Name</strong></th>
        <th width="23%" scope="col"><strong>Description</strong></th>
    <th width="22%" scope="col"><strong>Uploaded Image</strong></th>
       <td width="6%"><strong>Delete</strong></th></td>
  </tr>
  <?php
  while($row = mysql_fetch_array($result))
  {
    echo "<tr>";
    echo "<td height='34'>&nbsp; ".$row["IMAGE_NAME"]."</td>";
    echo "<td>&nbsp; ".$row["IMAGE_DESCRIPTION"]."</td>";
    echo "<td>&nbsp;<a href='upload/".$row["IMAGE_UPLOAD"].".".$row["IMAGE_TYPE"]."'> <img src='upload/".$row["IMAGE_UPLOAD"].".".$row["IMAGE_TYPE"]."' width='75' height='75'></td>";
    echo "<td><a href='imageupload.php?delimg=".$row["IMAGE_ID"]."'><img src='images/delete.jpg' width='10' height='10'></a></td>";
    echo "</tr>";
  }
  ?>
</table>

<tr>
	<td width="70%">&nbsp;</td>
	<td width="30%" valign="top">&nbsp;</td>
</tr>
</table>

<center>




          <div class="pagenavi"></div>
        </div>
        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li ><a href="home.php">Home</a></li>
              <li class="active"><a href="photos/">Photos</a></li>
              <li><a href="recommender/">Recommender</a></li>
              <li><a href="friends.php">Friend list</a></li>
              <li><a href="messages/">Messages</a></li>
              <li><a href="notices/">Notices</a></li>
            </ul>
          </div>



      <div class="clr"></div>


      <div class="gadget">
        <div class="clr"></div>

        <ul class="sb_menu">
          <li><br />
            <?php
           //$sid=$_SESSION['sid'];
		
		   $roll_no=$_SESSION['user_id'];
           $result = mysql_query("SELECT * FROM mymembers WHERE USER_ID = '".$roll_no."'");
		  // echo $result;
           $row = mysql_fetch_assoc($result);
           echo  "<p class=\"sidebar\">";
		  
		   
           echo $row["firstname"]." ".$row["lastname"];
           echo "</p><p>";
           $uid = $row["id"];
           echo "<a href=profiles/profile.php?id=".$uid."><img src=\"profiles/members/".$uid."/image01.jpg\" width=\"200\" height=\"200\"></a></p>";
          ?>
          <br />
          </div>

          </li>
        </ul>


        <div class="gadget">
          <div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="MAR/">MAR</a></li>
            <li><a href="quiz/">Quiz</a></li>
            <li><a href="forum/">Forum</a></li>
            <li ><a href="profiles/edit_profile.php">Account settings</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>



      <div class="clr"></div>
    </div>


      <div class="clr"></div>
    </div>



  </div>
</div>
<div class="footer">
  <div class="footer_resize">
       <div class="clr"></div>
  </div>
</div>
<div align=center>This is a project by Vivek</div></body>
</html>
