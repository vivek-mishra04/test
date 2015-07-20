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
//session_start();
include_once "agoTimeFormat.php";
$myAgoObject = new convertToAgo;
include_once "connect_to_mysql.php";
if (isset($_GET['id']) && $_GET['id'] != "")
        {
	        $sid = preg_replace('#[^0-9]#i', '', $_GET['id']);
	}
        else
        {
	     echo "ERROR: Variables to run this script have been removed from the URL.";
	     exit();
	}
	$sql = mysql_query("SELECT * FROM forum_sections WHERE id='$sid' LIMIT 1");
$numRows = mysql_num_rows($sql);
if ($numRows < 1)
        {
       	     echo "ERROR: That section deos not exist you have tampered with our URLs.";
	     exit();
        }
while($row = mysql_fetch_array($sql))
       {
	     $sectionTitle = $row["title"];
        }
$sql = mysql_query("SELECT * FROM forum_posts WHERE type='a' AND section_id='$sid' ORDER BY date_time DESC LIMIT 25");
$dynamicList = "";
$numRows = mysql_num_rows($sql);
if ($numRows < 1)
       {
      	     $dynamicList = "There are no threads in this section yet. You can be the first to post.";
       }
        else
        {
            while($row = mysql_fetch_array($sql))
            {
	        $thread_id = $row["id"];
		$post_author = $row["post_author"];
		$post_author_id = $row["post_author_id"];
		$date_time = $row["date_time"];
		$convertedTime = ($myAgoObject -> convert_datetime($date_time));
                $whenPost = ($myAgoObject -> makeAgo($convertedTime));
		$thread_title = $row["thread_title"];
		$dynamicList .= '<img src="threadPic.jpg" width="26" height="18" alt="Topic" /> ' . $post_author . ' - <a href="view_thread.php?id=' . $thread_id . '">' . $thread_title . '</a> - ' . $whenPost . '<br />';
            }
        }
?>

<table style="background-color: #F0F0F0; border:#069 1px solid; border-top:none;" width="auto" border="0" align="center" cellpadding="12" cellspacing="0">
  <tr>
    <td width="634" valign="top">

      <form action="new_topic.php" method="post">
      <input name="forum_id" type="hidden" value="<?php echo $sid; ?>" />
      <input name="forum_title" type="hidden" value="<?php echo $sectionTitle; ?>" />
      <input name="myBtn1" type="submit" value="Create New Topic" style="font-size:16px; padding:12px;" />
     </form>
      <br /><br />
      <div style="margin-left:12px; font-size:14px; line-height:1.5em;"><?php echo $dynamicList; ?></div>
    <br /><br /><br /></td>
  </tr>
</table>
        </div>
        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li><a href="../home.php">Home</a></li>
              <li><a href="../photos/">Photos</a></li>
              <li><a href="../recommender/">Recommender</a></li>
              <li><a href="../friends.php">Friend list</a></li>
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
            <li><a href="../MAR/">MAR</a></li>
            <li><a href="../quiz/">Quiz</a></li>
            <li class="active"><a href="../forum/">Forums</a></li>
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