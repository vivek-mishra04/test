<?php

// Inialize session
 session_start();

// Include database connection settings
 include('config.inc');

// Retrieve username and password from database according to user's input
//$pwd=md5($_POST['password']);
 $login = mysql_query("SELECT * FROM user WHERE (username = '" . mysql_real_escape_string($_POST['username']) . "') and (password = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");
 $row = mysql_fetch_assoc($login);
 $user_id = $row['USER_ID'];
 $password = $row['PASSWORD'];

 $SID = time().$password;
// Check username and password match
 if (mysql_num_rows($login) == 1) {
 // Set username session variable
 $username =  $_POST['username'];
 $_SESSION['username'] = $username;
 $_SESSION['user_id'] = $user_id;
 $_SESSION['sid'] = hash("md5",$SID);
 
 mysql_query("UPDATE user SET LOGGED_IN = 1, SID = '".mysql_real_escape_string($_SESSION['sid'])."' WHERE USERNAME='".mysql_real_escape_string($username)."'");

//mysql_query("INSERT INTO mymembers('SID')VALUES('".$_SESSION['sid']."') WHERE USERNAME='".mysql_real_escape_string($username)."'");

 // Jump to secured page
 header('Location: home.php');
 }
 else {
 // Jump to login page
 header('Location: index.php');
 }

$sql = mysql_query("SELECT * FROM myMembers WHERE username='".$_SESSION['username']."'");

$login_check = mysql_num_rows($sql);
if($login_check > 0)
{ 
    	while($row = mysql_fetch_array($sql))
				{
					$id = $row["id"];   
					$_SESSION['id'] = $id;
					// Create the idx session var
					$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id");
                    // Create session var for their username
					$username = $row["username"];
					$_SESSION['username'] = $username;
					// Create session var for their email
					$useremail = $row["email"];
					$_SESSION['useremail'] = $useremail;
					// Create session var for their password
					$userpass = $row["password"];
					$_SESSION['userpass'] = $userpass;

					mysql_query("UPDATE myMembers SET last_log_date=now() WHERE id='$id' LIMIT 1");
        
    			
					
					
				}
}
				
?>
include('config.inc');
mysql_query("UPDATE user SET LOGGED_IN = 1 WHERE USERNAME='".mysql_real_escape_string($username)."'");