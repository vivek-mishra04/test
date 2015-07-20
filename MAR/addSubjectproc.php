<?php

// Include database connection settings
 include('../config.inc');

// Inialize session
 session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }

$sid = $_SESSION['sid'];
$subject = $_POST['subjectadded'];
echo "<p align = \"center\">".$subject." has been added to the list.</br>";

$subject = $subject.",";

$result1 = mysql_query("SELECT SUBJECTS FROM user WHERE SID = '".$sid."'");
if($result1)
{
  $row1 = mysql_fetch_assoc($result1);
  $subject = $row1['SUBJECTS'].$subject;
}
mysql_query("UPDATE user SET SUBJECTS = '".$subject."' WHERE SID = '".$sid."'");
echo mysql_error();

echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
//header("Refresh: 2; url=index.php");


?>