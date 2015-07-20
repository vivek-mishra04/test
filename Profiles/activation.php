<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------
if ($_GET['id'] != "") {
	
    //Connect to the database through an include 
    include_once "scripts/connect_to_mysql.php";

    $id = $_GET['id']; 
    $hashpass = $_GET['sequence']; 

    $id  = mysql_real_escape_string($id );
    $id = eregi_replace("`", "", $id);

    $hashpass = mysql_real_escape_string($hashpass);
    $hashpass = eregi_replace("`", "", $hashpass);

    $sql = mysql_query("UPDATE myMembers SET email_activated='1' WHERE id='$id' AND password='$hashpass'"); 

    $sql_doublecheck = mysql_query("SELECT * FROM myMembers WHERE id='$id' AND password='$hashpass' AND email_activated='1'"); 
    $doublecheck = mysql_num_rows($sql_doublecheck); 

    if($doublecheck == 0){ 
        $msgToUser = "<br /><br /><h3><strong><font color=red>Your account could not be activated!</font></strong><h3><br />
        <br />
        Please email site administrator and request manual activation.
        "; 
    include 'msgToUser.php'; 
	exit();
    } elseif ($doublecheck > 0) { 

        $msgToUser = "<br /><br /><h3><font color=\"#0066CC\"><strong>Your account has been activated! <br /><br />
        Log In anytime up top.</strong></font></h3>";
	
    include 'msgToUser.php'; 
	exit();
} 

} // close first if

print "Essential data from the activation URL is missing! Close your browser, go back to your email inbox, and please use the full URL supplied in the activation link we sent you.<br />
<br />
admin@yourdomain.com
";
?>