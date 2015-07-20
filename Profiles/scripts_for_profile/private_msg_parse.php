<?php
session_start();
////////////                ERROR HANDLING AND LOW LEVEL SECURITY CHECKS                      //////////////
$thisWipit = $_POST['thisWipit'];
$sessWipit = base64_decode($_SESSION['wipit']);
/* echo $_SESSION['wipit'] . ' | ' . $_SESSION['id'] . ' | ' . $_POST['senderID'];
exit(); */
// If session variable for wipit is not set OR if session id is not set
if (!isset($_SESSION['wipit']) || !isset($_SESSION['id'])) {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp; <strong>Your session expired from inactivity. Please refresh your browser and continue.</strong>';
    exit();
}
// else if session id IS NOT EQUAL TO the posted variable for sender ID
else if ($_SESSION['id'] != $_POST['senderID']) {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  <strong>Forged submission</strong>';
    exit();
}
// else if session wipit variable IS NOT EQUAL TO the posted wipit variable
else if ($sessWipit != $thisWipit) {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  <strong>Forged submission</strong>';
    exit();
}
// else if either wipit variables are empty
else if ($thisWipit == "" || $sessWipit == "") {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  <strong>Missing Data</strong>';
    exit();
}
require_once "../scripts/connect_to_mysql.php"; // <<---- Require connection to database here
// PREVENT DOUBLE POSTS /////////////////////////////////////////////////////////////////////////////
$checkuserid = $_POST['senderID'];
$prevent_dp = mysql_query("SELECT id FROM private_messages WHERE from_id='$checkuserid' AND time_sent between subtime(now(),'0:0:20') and now()");
$nr = mysql_num_rows($prevent_dp);
if ($nr > 0){
	echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  You must wait 20 seconds between your private message sending.';
	exit();
}
///////////////////////////////////////////////////////////////////////////////////////
// PREVENT MORE THAN 30 IN ONE DAY FROM THIS MEMBER  /////////////////////////////////////////////////////////////////////////////
$sql = mysql_query("SELECT id FROM private_messages WHERE from_id='$checkuserid' AND DATE(time_sent) = DATE(NOW()) LIMIT 40");
$numRows = mysql_num_rows($sql);
if ($numRows > 30) {
	echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  You can only send 30 Private Messages per day.';
    exit();
}
////////////                                                    PARSE THE MESSAGE                                                 // Process the message once it has been sent 
if (isset($_POST['message'])) { 
  // Escape and prepare our variables for insertion into the database 
  $to   = ($_POST['rcpntID']); 
  $from = ($_POST['senderID']); 
  //$toName   = ($_POST['rcpntName']); 
  //$fromName = ($_POST['senderName']); 
  $sub = htmlspecialchars($_POST['subject']); // Convert html tags and such to html entities which are safer to store and display
  $msg = htmlspecialchars($_POST['message']); // Convert html tags and such to html entities which are safer to store and display
  $sub  = mysql_real_escape_string($sub); // Just in case anything malicious is not converted, we escape those characters here
  $msg  = mysql_real_escape_string($msg); // Just in case anything malicious is not converted, we escape those characters here
  // Handle all pm form specific error checking here 
  if (empty($to) || empty($from) || empty($sub) || empty($msg)) { 
    echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  Missing Data to continue';
	exit();
  } else { 
		// Delete the message residing at the tail end of their list so they cannot archive more than 100 PMs ------------------
        $sqldeleteTail = mysql_query("SELECT * FROM private_messages WHERE to_id='$to' ORDER BY time_sent DESC LIMIT 0,100"); 
        $dci = 1;
        while($row = mysql_fetch_array($sqldeleteTail)){ 
                $pm_id = $row["id"];
				if ($dci > 99) {
					$deleteTail = mysql_query("DELETE FROM private_msg WHERE id='$pm_id'"); 
				}
				$dci++;
        }
        // End delete any comments past 100 off of the tail end -------------  
		
    // INSERT the data into your table now
    $sql = "INSERT INTO private_messages (to_id, from_id, time_sent, subject, message) VALUES ('$to', '$from', now(), '$sub', '$msg')"; 
    if (!mysql_query($sql)) { 
	    echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  Could not send message! An insertion query error has occured.';
	    exit();
    } else { 

		// Send back to sent box
		echo '<img src="images/round_success.png" alt="Success" width="31" height="30" /> &nbsp;&nbsp;&nbsp;<strong>Message sent successfully</strong>';
		exit();
    } // close else after the sql DB INSERT check
  } // Close if (empty($sub) || empty($msg)) { 
} // Close if (isset($_POST['message'])) { 
?>