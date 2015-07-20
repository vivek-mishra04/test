<?php
	include('config.inc');
	session_start();
	$uname=$_SESSION['username'];
	echo "delete from status_comments where c_id ='".$_REQUEST['c_id']."' AND user_name ='".$uname."'";
	mysql_query("delete from status_comments where c_id ='".$_REQUEST['c_id']."' AND user_name ='".$uname."'");
	
?>