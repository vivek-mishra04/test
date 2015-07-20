<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

// Inialize session
            session_start();
            include('config.inc');
            $username = $_SESSION['username'];
            mysql_query("UPDATE user SET LOGGED_IN = 0 WHERE USERNAME='".mysql_real_escape_string($username)."'");
// Delete certain session
            unset($_SESSION['username']);
 // Delete all session variables
            session_destroy();
            header("Refresh: 2; url=index.php");

// Jump to login page
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">

        <h1><a href="home.php"><span>iRGIT</span><small>Networking Site</small></a></h1>
      </div>
      <div align="center">
	<h3>You have successfully logged out.</h3>
	<h4>See you soon.</h4>
     </div>
      <div class="clr"></div>
    </div>


<div align=center>This is a project by Vivek</div>
  </div>
</div></body>
</html>