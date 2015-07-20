<?php
include('../config.inc');
session_start();
if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }
// $style=$_POST['skins'].".css";

$style="skins/".$_POST['skins'].".css";

echo "$style";


 $sid = $_SESSION['sid'];

 mysql_query("UPDATE user SET style = '" .$style."' WHERE SID ='".$sid."'");



header("Refresh: 2; url=../home.php");


?>