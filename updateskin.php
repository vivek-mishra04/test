<?php

include('config.inc');
session_start();
if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }
 $style=$_POST['skins'];

 $sid = $_SESSION['sid'];

 mysql_query("UPDATE user SET style = '" .$style ."' WHERE SID ='".$sid."'");



header("Refresh: 2; url=home.php");


?>