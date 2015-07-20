<?php
@session_start(); // Start Session First Thing
// Force script errors and warnings to show on page in case php.ini file is set to not display them
error_reporting(E_ALL);
ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------
include_once "connect_to_mysql.php"; // Connect to the database
$dyn_www = $_SERVER['HTTP_HOST']; // Dynamic www.domainName available now to you in all of your scripts that include this file
//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
$logOptions = ''; // Initialize the logOptions variable that gets printed to the page
// If the session variable and cookie variable are not set this code runs
if (!isset($_SESSION['idx'])) { 
  if (!isset($_COOKIE['idCookie'])) {
     $logOptions = '<a href="http://' . $dyn_www . '/register.php">Register Account</a>
	 &nbsp;&nbsp; | &nbsp;&nbsp; 
	 <a href="http://' . $dyn_www . '/login.php">Log In</a>';
   }
}
// If session ID is set for logged in user without cookies remember me feature set
if (isset($_SESSION['idx'])) { 
    
	$decryptedID = base64_decode($_SESSION['idx']);
	$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
	$logOptions_id = $id_array[1];
    $logOptions_username = $_SESSION['username'];
    $logOptions_username = substr('' . $logOptions_username . '', 0, 15); // cut user name down in length if too long
	
	// Check if this user has any new PMs and construct which envelope to show
	$sql_pm_check = mysql_query("SELECT id FROM private_messages WHERE to_id='$logOptions_id' AND opened='0' LIMIT 1");
	$num_new_pm = mysql_num_rows($sql_pm_check);
	if ($num_new_pm > 0) {
		$PM_envelope = '<a href="pm_inbox.php"><img src="../images/pm2.gif" width="18" height="11" alt="PM" border="0"/></a>';
	} else {
		$PM_envelope = '<a href="pm_inbox.php"><img src="../images/pm1.gif" width="18" height="11" alt="PM" border="0"/></a>';
	}
    // Ready the output for this logged in user
    $logOptions = $PM_envelope . ' &nbsp; &nbsp;
	<!--<a href="http://' . $dyn_www . '">Home</a>
	&nbsp;&nbsp; |&nbsp;&nbsp; -->
	<a href="http://' . $dyn_www . '/profile.php?id=' . $logOptions_id . '">Profile</a>
	&nbsp;&nbsp; |&nbsp;&nbsp;
	<div class="dc">
<a href="#" onclick="return false">Account &nbsp; <img src="../images/darr.gif" width="10" height="5" alt="Account Options" border="0"/></a>
<ul>
<li><a href="http://' . $dyn_www . '/edit_profile.php">Account Options</a></li>
<li><a href="http://' . $dyn_www . '/pm_inbox.php">Inbox Messages</a></li>
<li><a href="http://' . $dyn_www . '/pm_sentbox.php">Sent Messages</a></li>
<li><a href="http://' . $dyn_www . '/logout.php">Log Out</a></li>
</ul>
</div>
';

} else if (isset($_COOKIE['idCookie'])) {// If id cookie is set, but no session ID is set yet, we set it below and update stuff
	
	$decryptedID = base64_decode($_COOKIE['idCookie']);
	$id_array = explode("nm2c0c4y3dn3727553", $decryptedID);
	$userID = $id_array[1]; 
	$userPass = $_COOKIE['passCookie'];
	// Get their user first name to set into session var
    $sql_uname = mysql_query("SELECT username, email FROM myMembers WHERE id='$userID' AND password='$userPass' LIMIT 1");
	$numRows = mysql_num_rows($sql_uname);
	if ($numRows == 0) {
		// Kill their cookies and send them back to homepage if they have cookie set but are not a member any longer
		setcookie("idCookie", '', time()-42000, '/');
	    setcookie("passCookie", '', time()-42000, '/');
		header("location: index.php"); // << makes the script send them to any page we set
		exit();
	}
    while($row = mysql_fetch_array($sql_uname)){ 
	    $username = $row["username"];
		$useremail = $row["email"];
	}

    $_SESSION['id'] = $userID; // now add the value we need to the session variable
	$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$userID");
    $_SESSION['username'] = $username;
	$_SESSION['useremail'] = $useremail;
	$_SESSION['userpass'] = $userPass;

    $logOptions_id = $userID;
    //$logOptions_uname = $username;
    //$logOptions_uname = substr('' . $logOptions_uname . '', 0, 15); 
    ///////////          Update Last Login Date Field       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    mysql_query("UPDATE myMembers SET last_log_date=now() WHERE id='$logOptions_id'"); 
    // Ready the output for this logged in user
    // Check if this user has any new PMs and construct which envelope to show
	$sql_pm_check = mysql_query("SELECT id FROM private_messages WHERE to_id='$logOptions_id' AND opened='0' LIMIT 1");
	$num_new_pm = mysql_num_rows($sql_pm_check);
	if ($num_new_pm > 0) {
		$PM_envelope = '<a href="pm_inbox.php"><img src="../images/pm2.gif" width="18" height="11" alt="PM" border="0"/></a>';
	} else {
		$PM_envelope = '<a href="pm_inbox.php"><img src="../images/pm1.gif" width="18" height="11" alt="PM" border="0"/></a>';
	}
	// Ready the output for this logged in user
     $logOptions = $PM_envelope . ' &nbsp; &nbsp;
	 <!--<a href="http://' . $dyn_www . '">Home</a>
	&nbsp;&nbsp; |&nbsp;&nbsp; -->
	 <a href="http://' . $dyn_www . '/profile.php?id=' . $logOptions_id . '">Profile</a>
	&nbsp;&nbsp; |&nbsp;&nbsp;
	<div class="dc">
<a href="#" onclick="return false">Account &nbsp; <img src="../images/darr.gif" width="10" height="5" alt="Account Options" border="0"/></a>
<ul>
<li><a href="http://' . $dyn_www . '/edit_profile.php">Account Options</a></li>
<li><a href="http://' . $dyn_www . '/pm_inbox.php">Inbox Messages</a></li>
<li><a href="http://' . $dyn_www . '/pm_sentbox.php">Sent Messages</a></li>
<li><a href="http://' . $dyn_www . '/logout.php">Log Out</a></li>
</ul>
</div>';
}
?>