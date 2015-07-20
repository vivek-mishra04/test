<?php
session_start();
include_once "connect_to_mysql.php";
$post_type = $_POST['post_type'];

$post_body = $_POST['post_body'];



$post_body = nl2br(htmlspecialchars($post_body));
$post_body = mysql_real_escape_string($post_body);

$forum_section_id = preg_replace('#[^0-9]#i', '', $_POST['fsID']);
$forum_section_title = preg_replace('#[^A-Za-z 0-9]#i', '', $_POST['fsTitle']);
$post_author = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION['username']);




if ($post_type == "a") {
	$post_title = preg_replace('#[^A-za-z0-9 ?!.,]#i', '', $_POST['post_title']);
	if ($post_title == "") { echo "The Topic Title is missing"; exit(); }
	//if (strlen($post_title) < 10) { echo "Your Topic Title is less than 10 characters weenis"; exit(); }
	$sql = mysql_query("INSERT INTO forum_posts (post_author, date_time, type, section_title, section_id, thread_title, post_body)
     VALUES('$post_author',now(),'a','$forum_section_title','$forum_section_id','$post_title','$post_body')") or die (mysql_error());
	$this_id = mysql_insert_id();
header("location: view_thread.php?id=$this_id");
    exit();
}
if ($post_type == "b") {
	$this_id = preg_replace('#[^0-9]#i', '', $_POST['tid']);
	if ($this_id == "") { echo "The thread ID is missing weenis"; exit(); }
	$sql = mysql_query("INSERT INTO forum_posts (post_author,otid, date_time, type, post_body) VALUES('$post_author','$this_id',now(),'b','$post_body')") or die (mysql_error());
	$post_body = stripslashes($post_body);
	echo $post_body;
}
?>