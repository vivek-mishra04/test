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
 header('Location: ../index.php');
 }
           $style="style.css";
           $sid=$_SESSION['sid'];
           $result = mysql_query("SELECT * FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row = mysql_fetch_assoc($result);
           $style = $row["style"];


?>
<link href="../<?php echo $style; ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv1 {
	position: absolute;
	width: 398px;
	height: 33px;
	z-index: 1;
	left: 352px;
	top: 13px;
}
</style>
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


        <h1><a href="../home.php"><span>iRGIT</span><small>Networking Site</small></a>   </h1>

        <div id="apDiv1" align="right">
        <form id="form1" name="form1" method="post" action="">

            <input type="text" width="500" height="30" name="search" id="search" />
            <a href="../search/">
            SEARCH</a>
          </form>
        </div>


  </div>
 <div class="menu_nav">
      <div class="clr"></div>
  </div>
<div i
class="clr"></div>

  <div class="content">
      <div class="content_bg">
        <div class="mainbar">

        <?php
        if(isset($_GET['search_key_word']))
        {
          echo "<h2>messages</h2><hr>";
           $search_key_word = $_GET['search_key_word'];
          //skw =search key word
           $skw_pre_post = "%".$search_key_word."%";
           $skw_pre = "%".$search_key_word;

          //extracts msgs where sender IS the current user AND recipient, message is like skw.

          $message_result = mysql_query("SELECT * FROM messages WHERE ( (SENDER = ".mysql_real_escape_string($_SESSION['user_id'])." or RECIPIENT = ".mysql_real_escape_string($_SESSION['user_id']).") and (MESSAGE LIKE '".mysql_real_escape_string($skw_pre_post)."'))");

           while($message_result_row = mysql_fetch_assoc($message_result))
           {
  //fetching the necessary details and echo them appropriately
                   $sender =  $message_result_row['SENDER'];
                   $recipient = $message_result_row['RECIPIENT'];
                   $message = $message_result_row['MESSAGE'];
                   $time = $message_result_row['SENDER'];
                   echo "$sender $recipient $message $time <br>";
            }
        echo "<h2>profiles</h2><hr>";
        $profile_result = mysql_query("SELECT USER_ID, FIRST_NAME, LAST_NAME FROM user WHERE (FIRST_NAME LIKE '".$skw_pre_post."' or LAST_NAME LIKE '".$skw_pre_post."')");
                   while($profile_result_row = mysql_fetch_assoc($profile_result))
           {
  //fetching the necessary details and echo them appropriately
                   $user_id = $profile_result_row['USER_ID'];
                   $fname =  $profile_result_row['FIRST_NAME'];
                   $lname = $profile_result_row['LAST_NAME'];
                   echo "<a href=\"../profile.php?pid=".$user_id."\">$fname $lname <br>";
            }
       echo "<h2>images</h2><hr>";
       $image_result = mysql_query("SELECT IMAGE_ID, FIRST_NAME, LAST_NAME FROM user WHERE (FIRST_NAME LIKE '".$skw_pre_post."' or LAST_NAME LIKE '".$skw_pre_post."')");
                   while($profile_result_row = mysql_fetch_assoc($profile_result))
           {
  //fetching the necessary details and echo them appropriately
                   $user_id = $profile_result_row['USER_ID'];
                   $fname =  $profile_result_row['FIRST_NAME'];
                   $lname = $profile_result_row['LAST_NAME'];
                   echo "<a href=\"../profile.php?pid=".$user_id."\">$fname $lname <br>";
            }
        }
        else
        {
         echo "<h1>Enter a valid search word</h1>";
        }
        ?>
        </div>
        <div class="sidebar" "position:fixed">
          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li><a href="../home.php">Home</a></li>
              <li><a href="../photos/">Photos</a></li>
              <li><a href="../group/">Groups</a></li>
              <li><a href="../recommender/">Recommender</a></li>
              <li><a href="../profiles/friends.php">Friend list</a></li>
              <li><a href="../messages/">Messages</a></li>
              <li><a href="../notices/">Notices</a></li>
            </ul>
          </div>



      <div class="clr"></div>


      <div class="gadget">
        <div class="clr"></div>

        <ul class="sb_menu">
          <li><br />

            <?php
           //$sid=$_SESSION['sid'];
		
		   $roll_no=$_SESSION['user_id'];
           $result = mysql_query("SELECT * FROM mymembers WHERE USER_ID = '".$roll_no."'");
		  // echo $result;
           $row = mysql_fetch_assoc($result);
           echo  "<p class=\"sidebar\">";
		  
		   
           echo $row["firstname"]." ".$row["lastname"];
           echo "</p><p>";
           $uid = $row["id"];
           echo "<a href=../profiles/profile.php?id=".$uid."><img src=\"../profiles/members/".$uid."/image01.jpg\" width=\"200\" height=\"200\"></a></p>";
          ?>
            <br />
          </div>

          </li>
        </ul>


        <div class="gadget">
          <div class="clr"></div>
          <ul class="sb_menu">
            <li ><a href="../mar/">MAR</a></li>
            <li><a href="quiz/">Quiz</a></li>
            <li><a href="../forum/">Forums</a></li>
            <li ><a href="../profiles/edit_profile.php">Account settings</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>



      <div class="clr"></div>
    </div>


      <div class="clr"></div>
    </div>



  </div>
</div>
<div class="footer">
  <div class="footer_resize">
       <div class="clr"></div>
  </div>
</div>
<div align=center>This is a project by Vivek</div></body>
</html>