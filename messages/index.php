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
<script type="text/javascript">
        function openMsgSendWin()
        {
                 myWindow=window.open("send_message.php","Send New Message","width=600,height=400","");
        }
        function openMsgExpandWin()
        {
                 myWindow=window.open("view_message.php","Send New Message","width=600,height=400","");
        }
        function closeWin()
        {
                 myWindow.close();
        }
</script>
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

<ul class="pagenavi">

<a href="#" onclick="openMsgSendWin()" >Send new message</a>
<br>


<!--<li><a href="#">View messages</a></li>
<br>

<li><a href="#">Search messages</a></li>-->


                        </ul>
<hr><hr><hr>
        <?php
             $uname=$_SESSION['username'];
             $send_message_query_sender = mysql_query("SELECT USER_ID FROM user WHERE (USERNAME = '" . mysql_real_escape_string($uname) . "') ");

             $sender_user_id_row = mysql_fetch_assoc($send_message_query_sender);
             echo mysql_error();
             $sender_user_id = $sender_user_id_row['USER_ID'];
             //$sender_user_id2 = $_SESSION["user_id"];
             if ($sent_message_query = mysql_query("SELECT * FROM messages WHERE (SENDER = '" . mysql_real_escape_string($sender_user_id) . "' or RECIPIENT = '" . mysql_real_escape_string($sender_user_id) . "') "))

            {

             while( $sent_message_row = mysql_fetch_assoc($sent_message_query))
                 {
                   $sender =  $sent_message_row['SENDER'];
                   $recipient = $sent_message_row['RECIPIENT'];
                   $message = $sent_message_row['MESSAGE'];
                   $time = $sent_message_row['TIME'];
                   
/*extracting id from MYMEMBERS to use in profile links
*/

$sender_mm_query = mysql_query("SELECT id FROM mymembers WHERE (USER_ID = '" . mysql_real_escape_string($sender) . "') ");

$sender_id_row = mysql_fetch_assoc($sender_mm_query);
             echo mysql_error();
             $sender_id = $sender_id_row['id'];
			 			 
//echo $sender_id;


$recipient_mm_query = mysql_query("SELECT id FROM mymembers WHERE (USER_ID = '" . mysql_real_escape_string($recipient) . "') ");

             $recipient_id_row = mysql_fetch_assoc($recipient_mm_query);
             echo mysql_error();
             $recipient_id = $recipient_id_row['id'];

//echo $recipient_id;




$s_mm_query = mysql_query("SELECT username FROM mymembers WHERE (USER_ID = '" . mysql_real_escape_string($sender) . "') ");

$s_uname_row = mysql_fetch_assoc($s_mm_query);
             echo mysql_error();
             $sname = $s_uname_row['username'];
			 			 
//echo $sname;


$r_mm_query = mysql_query("SELECT username FROM mymembers WHERE (USER_ID = '" . mysql_real_escape_string($recipient) . "') ");

             $r_uname_row = mysql_fetch_assoc($r_mm_query);
             echo mysql_error();
             $rname = $r_uname_row['username'];

//echo $rname;



			  
				   
echo "<div class=\"msgsBody\"> 

<span class=\"msgsHead\">
Sent by <a href=\"..\profiles/profile.php?id=".$sender_id."\">".$sname."</a>
To <a href=\"..\profiles/profile.php?id=".$recipient_id."\">".$rname."</a>

&nbsp;|&nbsp;
<span class=\"date\">".$time."</span>  
</span>

<div class=\"clr\"></div>

<p class=\"post-data\">
<p>".$message."</p><div class=\"clr\"></div></div>
<hr>";
                  }
          }
          ?>

          
        </div>
        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li><a href="../home.php">Home</a></li>
              <li><a href="../photos/">Photos</a></li>
              <li><a href="../bookList.php">Recommender</a></li>
              <li><a href="../friends.php">Friend list</a></li>
              <li><a href="../messages/" class="active">Messages</a>
              		
              </li>
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
            <li><a href="../MAR/">MAR</a></li>
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