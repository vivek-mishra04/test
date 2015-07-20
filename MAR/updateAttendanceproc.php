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
$user_id = $_SESSION['user_id'];
$subject = $_POST['subjectattended'];
//mysql_real_escape_string
$res1 = mysql_query("SELECT ".$subject." FROM subject_attendance WHERE USER_ID = '".$user_id."'");

$row1 = mysql_fetch_assoc($res1);
$attendance = $row1[$subject] + 1;


mysql_query("UPDATE subject_attendance SET ".$subject." = ".$attendance." WHERE USER_ID = ".$user_id."");
echo mysql_error();
echo "<p align = \"center\">Attendance marked for ".$subject."</br>";
echo "Your attendance for the subject is now ".$attendance."</br>";
echo "<a href = \"index.php\">Click here if your browser does not automatically redirect you back to the page...</a></p>";
header("Refresh: 2; url=index.php");
?>