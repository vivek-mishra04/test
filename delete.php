<?php
	include('config.inc');
  session_start();
	$uname=$_SESSION['username'];
	
	mysql_query("delete from status_posts where p_id ='".$_REQUEST['id']."' AND user_name ='".$uname."'");
	mysql_query("delete from status_comments where post_id ='".$_REQUEST['id']."'");
	
?>