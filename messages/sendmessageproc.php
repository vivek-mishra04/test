<?php

// Include database connection settings
 include('../config.inc');

// Inialize session
 session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }

// Retrieve username and password from database according to user's input
//$pwd=md5($_POST['password']);

$message = $_POST['message'];
$recipient = (string) $_POST['recipient'];
$uname=(string) $_SESSION['username'];
$time = date("Y-m-d H:i:s");
if ($send_message_query_sender = mysql_query("SELECT * FROM user WHERE (USERNAME = '" . mysql_real_escape_string($uname) . "') "))
   {
     $sender_user_id_row = mysql_fetch_assoc($send_message_query_sender);
     $sender_user_id = (int) $sender_user_id_row['USER_ID'];
   }
else
   {
      echo (mysql_error ());
   }

if ($send_message_query_recipient = mysql_query("SELECT * FROM user WHERE (USERNAME = '" . mysql_real_escape_string($recipient) . "') "))
   {
     $recipient_user_id_row = mysql_fetch_assoc($send_message_query_recipient);
     $recipient_user_id = (int) $recipient_user_id_row['USER_ID'];
   }
else
   {
      echo (mysql_error ());
   }

if ( $send_message_query = mysql_query("INSERT INTO messages VALUES('','$sender_user_id','$recipient_user_id','$message','$time')"))
   {
      echo "<script = \"text/javascript\"> window.close()</script>" ;
   }
else
   {
      echo (mysql_error ());
   }


?>