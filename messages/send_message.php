<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include('../config.inc');
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: index.php');
 }
           $style="style.css";
           $sid=$_SESSION['sid'];
           $result = mysql_query("SELECT * FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row = mysql_fetch_assoc($result);
           $style = $row["style"];


?>
<link href="<?php echo $style; ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/cufon-yui.js"></script>
<script type="text/javascript" src="../js/arial.js"></script>
<script type="text/javascript" src="../js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">

        <h1><a href="../home.php"><span>iRGIT</span><small>Networking Site</small></a></h1>
      </div>

      <div class="menu_nav">
<div class="clr"></div>
      </div>

    <div class="content">
      <div class="content_bg"></div>
</div>
<div class="footer">
  <div class="footer_resize">
       <div class="clr">
         <form id="form1" name="form1" method="post" action="sendmessageproc.php">
           <p>
             <label>Recipient
               <input type="text" name="recipient" id="recipient" />
             </label>
             <label><br />
               <br />
               Message
               <textarea name="message" id="message" cols="45" rows="5"></textarea>
               <br />
             </label>
           </p>
           <br>
           <p>
             <input type="submit" name="submit" id="submit" value="Submit" />
             <input type="button" name="cancel" id="cancel" value="Cancel" onclick="window.close()"/>
           </p>
         </form>
       </div>
  </div>
</div>
<div align=center>This is a project by Vivek</div></body>
</html>