<?php
session_start();
require_once "../scripts/connect_to_mysql.php"; // Connect to the database
$messageid = preg_replace('#[^0-9]#i', '', $_POST['messageid']); 
$ownerid = preg_replace('#[^0-9]#i', '', $_POST['ownerid']);
// Decode the Session IDX variable and extract the user's ID from it
$decryptedID = base64_decode($_SESSION['idx']);
$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
$my_id = $id_array[1];
if ($ownerid != $my_id) {
	exit(); // Exit because either there is malicious activity or the user's session has expired from inactivity on the site
} else {
    mysql_query("UPDATE private_messages SET opened='1' WHERE id='$messageid' LIMIT 1"); 
}
?>