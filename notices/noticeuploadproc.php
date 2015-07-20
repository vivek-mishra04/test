<?php
// Include database connection settings
 include('../config.inc');

// Inialize session
 session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: index.php');
 }
$filename="";
if(isset($_POST["button"]))
{
if (($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/jpg")&& ($_FILES["file"]["size"] < 200000000))
{

                             if ($_FILES["file"]["error"] > 0)
                                {
                                    //some error has occured.
                                    echo "<p align = \"center\">Return Code: " . $_FILES["file"]["error"] . "<br />";
                                    echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
                                    header("Refresh: 2; url=notices.php");
                                }
                             else
                                {
                                  //everything alright. The file is saved in the /notices directory.
                                  $result = mysql_query("SELECT NOTICE_ID FROM notices");
                                  $count = mysql_num_rows($result);
                                  $count++;
                                  move_uploaded_file($_FILES["file"]["tmp_name"],"notices/notice" . $count .".jpg");
                                  //get the UPLOADER NAME
                                  $result = mysql_query("SELECT FIRST_NAME, LAST_NAME FROM user WHERE SID = '".$_SESSION['sid']."'");
                                  $row = mysql_fetch_assoc($result);
                                  $UPLOADER_NAME = $row['FIRST_NAME']." ".$row['LAST_NAME'];
                                  //get the TIME UPLOADED
                                  $DATE_UPLOADED = date("Y-m-d H:i:s");
                                  //make entry about the successful addition to the notices table.
                                  $sql="INSERT INTO notices (NOTICE_ID,NOTICE_NAME,UPLOADER_NAME,DATE_UPLOADED, NOTICE_DESC)VALUES(".$count.",'".$_POST['textfield']."','".$UPLOADER_NAME."','".$DATE_UPLOADED."','".$_POST['textarea']."')";
                                  if (!mysql_query($sql))
                                  {
                                      die('Error: ' . mysql_error());
                                  }
                                  else
                                  {
                                      echo "<p align = \"center\">Notice Uploaded Successfully</br>";
                                      echo "<a href = \"notices.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
                                      header("Refresh: 2; url=index.php");

                                  }
}

                                }
}
else
{
         echo "<p align = \"center\">Invalid file</br>";
         echo "<a href = \"notices.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
         header("Refresh: 2; url=notices.php");
}

?>
