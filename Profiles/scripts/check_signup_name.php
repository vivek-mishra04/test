<?php
// Force script errors and warnings to show on page in case php.ini file is set to not display them
error_reporting(E_ALL);
ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------
include_once "connect_to_mysql.php"; // <<---- Connect to database here
$username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST['username']); // filter
$sql_uname_check = mysql_query("SELECT id FROM myMembers WHERE username='$username' LIMIT 1"); 
$uname_check = mysql_num_rows($sql_uname_check);

if (strlen($username) < 4) {
	echo '<span style="background: #FDD; border:#900 1px solid; padding:4px;">4 - 20 characters please</span>';
	exit();
}

if ($username == "" || $username == " ") {
	echo '<span style="background: #FDD; border:#900 1px solid; padding:4px;">NOT VALID, TRY AGAIN</span>';
	exit();
}

if ($uname_check < 1) {
	echo '<span style="background:#CEFFCE; border:#060 1px solid; padding:4px;"><strong>' . $username . '</strong> is available</span>';
	exit();
} else {
	echo '<span style="background: #FDD; border:#900 1px solid; padding:4px;"><strong>' . $username . '</strong> is NOT available</span>';
	exit();
}
?>