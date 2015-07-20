<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
session_start();
include_once "connect_to_mysql.php";
include_once "agoTimeFormat.php";
$myAgoObject = new convertToAgo; // Establish the object

// Get the "id" URL variable and query the database for the original post of this thread
$thread_id = preg_replace('#[^0-9]#i', '', $_GET['id']);
$sql = mysql_query("SELECT * FROM forum_posts WHERE id='$thread_id' AND type='a' LIMIT 1");
$numRows = mysql_num_rows($sql);
if ($numRows < 1) {
	echo "ERROR: That thread does not exist. ";
	exit();
}
while($row = mysql_fetch_array($sql)){
	$post_author = $row["post_author"];
	$post_author_id = $row["post_author_id"];
	$date_time = $row["date_time"];
	$date_time = strftime("%b %d, %Y", strtotime($date_time));
	$section_title = $row["section_title"];
	$section_id = $row["section_id"];
	$thread_title = $row["thread_title"];
	$post_body = $row["post_body"];
}
$all_responses = "";
$sql = mysql_query("SELECT * FROM forum_posts WHERE otid='$thread_id' AND type='b'");
$numRows = mysql_num_rows($sql);
if ($numRows < 1) {
	$all_responses = '<div id="none_yet_div">Nobody has responded to this yet, you can be the first.</div>';
} else {
    while($row = mysql_fetch_array($sql)){
	$reply_author = $row["post_author"];
	$reply_author_id = $row["post_author_id"];
	$date_n_time = $row["date_time"];
	$convertedTime = ($myAgoObject -> convert_datetime($date_n_time));
    $whenReply = ($myAgoObject -> makeAgo($convertedTime));
	$reply_body = $row["post_body"];
	$all_responses .= '<div class="response_top_div">Re: ' . $thread_title . ' &nbsp; &nbsp; &bull; &nbsp; &nbsp; ' . $whenReply . '
	
	' . $reply_author . '
	
	<!--<a href="../profiles/profile.php?id=' . $reply_author_id . '">
	
	' . $reply_author . '</a>--> 
	
	said:</div>
	<div class="response_div">' . $reply_body . '</div>';
   }
}
   	$replyButton = '<input name="myBtn1" type="submit" value="Post a Response" style="font-size:16px; padding:12px;" onmousedown="javascript:toggleForm(\'reponse_form\');" />';
   	$u_name = mysql_real_escape_string($_SESSION['username']);
?>


<title><?php echo "SocialNet: ".$thread_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include('../config.inc');
// Inialize session
@session_start();
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
<style type="text/css">
<!--
.topic_div {
	background-color: #D9F9FF;
	font-size:14px;
	padding:16px;
	border: #01B3D8 1px solid;
	margin-bottom:6px;
	font-weight: 500;
	color:#069;
}
.response_top_div {
	background-color: #E4E4E4;
	color: #666;
	font-size:12px;
	padding:4px;
	border: #CCC 1px solid;
	border-bottom:none;
	color: #999;
}
.response_div {
	background-color: #FFF;
	font-size:12px;
	padding:12px;
	border:#CCC 1px solid;
	margin-bottom:6px;
	width:auto;
	overflow:hidden;
}
#none_yet_div {
	background-color: #E4E4E4;
	font-size:14px;
	padding:16px;
	border: #CCC 1px solid;
	margin-bottom:6px;
	color: #999;
}
-->
</style>

<script language="javascript" type="text/javascript">
function toggleForm(x) {
		if ($('#'+x).is(":hidden")) {
			$('#'+x).slideDown(200);
		} else {
			$('#'+x).slideUp(200);
		}
}

$('#responseForm').submit(function(){$('input[type=submit]', this).attr('disabled', 'disabled');});
function parseResponse ( ) {
	  var thread_id = $("#thread_id");
	  var post_body = $("#post_body");
	  var fs_id = $("#forum_section_id");
	  var fs_title = $("#forum_section_title");
	  var u_id = $("#member_id");
	  var u_pass = $("#member_password");
	  var url = "parse_post.php";
      if (post_body.val() == "") {
           $("#formError").html('<font size="+2">Please type something</font>').show().fadeOut(3000);
      } else if (post_body.val().length < 2 ) {
	         $("#formError").html('<font size="+2">Your post must be at least 2 characters long').show().fadeOut(3000);
      } else {
		$("#myBtn1").hide();
		$("#formProcessGif").show();
        $.post(url,{ post_type: "b", tid: thread_id.val(), post_body: post_body.val(), fsID: fs_id.val(), fsTitle: fs_title.val(), uid: u_id.val(), upass: u_pass.val() } , function(data) {
			   $("#none_yet_div").hide();
			   var myDiv = document.getElementById('responses');
			   var magicdiv1 = document.createElement('div');
			   magicdiv1.setAttribute("class", "response_top_div");
			   magicdiv1.htmlContent = 'Re: <?php echo $thread_title ?>';
			   magicdiv1.innerHTML = 'Re: <?php echo $thread_title ?>';
			   myDiv.appendChild(magicdiv1);
			   var magicdiv = document.createElement('div');
			   magicdiv.setAttribute("class", "response_div");
			   magicdiv.htmlContent = data;
			   magicdiv.innerHTML = data;
			   myDiv.appendChild(magicdiv);
			   $('#reponse_form').slideUp("fast");
			   document.responseForm.post_body.value='';
			   $("#formProcessGif").hide();
			   $("#myBtn1").show();
         });
	  }
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
<tr>
  <td width="auto" style="line-height:1.5em;"><br />



  <div class="sidebar">
        <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li><a href="../home.php">Home</a></li>
              <li><a href="../photos/">Photos</a></li>
              
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
            <li><a href="../MAR/">MAR</a></li>
            <li><a href="../quiz/">Quiz</a></li>
            <li><a href="../forum/">Forums</a></li>
            <li ><a href="../profiles/edit_profile.php">Account settings</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>



      <div class="clr"></div>
    </div>
  <div class="content">
    <div class="content_bg">
      <div class="mainbar">
        <table style="background-color: #F0F0F0; border:#069 1px solid; border-top:none;" width="650" border="1" align="auto" cellpadding="12" cellspacing="0">
          <tr>
            <td width="auto" style="line-height:1.5em;"> Topic Started By: <?php echo $post_author; ?> &nbsp; &nbsp; &nbsp; Created: <span class="topicCreationDate"><?php echo $date_time; ?></span>
              <div class="topic_div"><?php echo $post_body; ?></div>
              <div id="responses"><?php echo $all_responses; ?></div>
              <!-- START DIV that contains the form -->
              <div id="reponse_form" style="display:none; background-color: #BAE1FE; border:#06C 1px solid; padding:16px;">
                <form action="javascript:parseResponse();" name="responseForm" id="responseForm" method="post">
                  Please type in your response here <?php echo $u_name; ?>:<br />
                  <textarea name="post_body" id="post_body" cols="64" rows="12" style="width:98%;"></textarea>
                  <div id="formError" style="display:none; padding:16px; color:#F00;"></div>
                  <br />
                  <br />
                  <input name="myBtn1" id="myBtn1" type="submit" value="Submit Your Response" style="padding:6px;" />
                  <span id="formProcessGif" style="display:none;"><img src="../images/loading.gif" width="28" height="10" alt="Loading" vspace="2" hspace="48" /></span> or <a href="#" onclick="return false" onmousedown="javascript:toggleForm('reponse_form');">Cancel</a>
                  <input name="thread_id" id="thread_id" type="hidden" value="<?php echo $thread_id; ?>" />
                  <input name="forum_section_id" id="forum_section_id" type="hidden" value="<?php echo $section_id; ?>" />
                  <input name="forum_section_title" id="forum_section_title" type="hidden" value="<?php echo $section_title; ?>" />
                  <input name="topic_author" id="topic_author" type="hidden" value="<?php echo $post_author; ?>" />
                </form>
              </div>
              <!-- END DIV that contains the form -->
              <?php echo $replyButton; ?> <br /></td>
          </tr>
        </table>
      </div>
    </div>
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
