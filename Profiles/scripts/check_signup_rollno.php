<?php
// Force script errors and warnings to show on page in case php.ini file is set to not display them
error_reporting(E_ALL);
ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------
include_once "connect_to_mysql.php"; // <<---- Connect to database here
$roll = preg_replace('#[^A-Za-z0-9]#i', '', $_POST['roll']); // filter
$sql_roll_check = mysql_query("SELECT id FROM myMembers WHERE USER_ID='$roll' LIMIT 1"); 
$roll_check = mysql_num_rows($sql_roll_check);

if (strlen($roll) >4) {
	echo '<span style="background: #FDD; border:#900 1px solid; padding:4px;">3 characters roll number</span>';
	exit();
}

if ($roll == "" || $roll == " ") {
	echo '<span style="background: #FDD; border:#900 1px solid; padding:4px;">NOT VALID, TRY AGAIN</span>';
	exit();
}

if ($roll_check < 1) {
	echo '<span style="background:#CEFFCE; border:#060 1px solid; padding:4px;"><strong>' . $roll . '</strong> is available</span>';
	exit();
}

 else 
 {
	 echo '<span style="background: #FDD; border:#900 1px solid; padding:4px;"><strong>' . $roll . '</strong> is NOT available</span>';
	exit();
}
?>