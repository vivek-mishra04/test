<?php
// Include database connection settings
 include('../config.inc');

// Inialize session
 session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }

$id=$_SESSION['user_id'];

$sql=mysql_query("SELECT * FROM mymembers WHERE USER_ID=".$id."");
$row=mysql_fetch_assoc($sql);

$uploader=$row['username'];

$filename="";
if(isset($_POST["button"]))
{
if (($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/jpg")&& ($_FILES["file"]["size"] < 200000000))
{

                             if ($_FILES["file"]["error"] > 0)
                                {
                                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                                    echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
                                    header("Refresh: 2; url=index.php");
                                }
                             else
                                {
                                 if (file_exists("upload/" . $_FILES["file"]["name"]))
                                    {
                                                 echo $_FILES["file"]["name"] . " already exists. ";
                                                 echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
                                                 header("Refresh: 2; url=inedx.php");
                                    }
                                 else
                                    {
                                                 $filetypearray= explode("/",$_FILES["file"]["type"]);
                                                 $filetype= $filetypearray[1];


                                                 $filename= $_SESSION['sid'].time();
                                                 $filenamehashed= hash("md5",$filename);

                                                 move_uploaded_file($_FILES["file"]["tmp_name"],"../upload/" . $filenamehashed  .".". $filetype);
                                                 $sql="INSERT INTO image (IMAGE_NAME,IMAGE_DESCRIPTION,IMAGE_UPLOAD,IMAGE_TYPE,uploader,USER_ID)VALUES('$_POST[textfield]','$_POST[textarea]','$filenamehashed','$filetype','$uploader',$id)";
                                                 echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
                                                 header("Refresh: 2; url=index.php");

                                     }
                                }
}
else
{
         echo "Invalid file";
         echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
         header("Refresh: 2; url=index.php");
}




if (!mysql_query($sql))
  {
             die('Error: ' . mysql_error());
  }
  else
  {
             echo "image uploaded Successfully";
             echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
             header("Refresh: 2; url=index.php");
  }
}
if(isset($_GET["delimg"]))
{
             mysql_query("DELETE FROM image WHERE IMAGE_ID='$_GET[delimg]'");
             echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
             header("Refresh: 2; url=index.php");

}
?>