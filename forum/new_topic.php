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
<script type="text/javascript" language="javascript">
<!--
function validateMyForm ( ) {
    var isValid = true;
    if ( document.form1.post_title.value == "" ) {
	    alert ( "Please type in a title for this topic" );
	    isValid = false;
    } else if ( document.form1.post_title.value.length < 10 ) {
            alert ( "Your title must be at least 10 characters long" );
            isValid = false;
    } else if ( document.form1.post_body.value == "" ) {
            alert ( "Please type in your topic body." );
            isValid = false;
    }
    return isValid;
}
//-->
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

           <?php
           include_once "connect_to_mysql.php";
           if (!isset($_POST['forum_id']) || $_POST['forum_id'] == "" || !isset($_POST['forum_title']) || $_POST['forum_title'] == "")
           {
	      echo "Important variables are missing";
	      exit();
           }
            else {

	             $forum_section_id = preg_replace('#[^0-9]#i', '', $_POST['forum_id']);
      	             $forum_section_title = preg_replace('#[^A-Za-z 0-9]#i', '', $_POST['forum_title']);
                 }
            $sql = mysql_query("SELECT * FROM forum_sections WHERE id='$forum_section_id' AND title='$forum_section_title'");
            $numRows = mysql_num_rows($sql);
            if ($numRows < 1)
            {
	        echo "ERROR: That section deos not exist.";
	        exit();
             }

            $u_name = mysql_real_escape_string($_SESSION['username']);
           ?>
<table style="background-color: #F0F0F0; border:#069 1px solid; border-top:none;" width="auto" border="0" align="center" cellpadding="12" cellspacing="0">
  <tr>
    <td width="731" valign="top">
      
      <h2>Creating New Topic In the  <em><?php echo $forum_section_title; ?></em> Forum</h2>
      
      <form action="parse_post.php" method="post" name="form1">
        <input name="post_type" type="hidden" value="a" />
        Topic Author:<br /><input name="topic_author" id="topic_author" type="text" disabled="disabled" maxlength="64" style="width:96%;" value="<?php echo $u_name; ?>" />
        <br /><br />
        Please type in a title for your topic here:<br /><input name="post_title" type="text" maxlength="64" style="width:96%;" /><br /><br />
        Please type in your topic body:<br /><textarea name="post_body" rows="15" style="width:96%;"></textarea>
        <br /><br /><input name="" type="submit" value="Create my topic now!" onClick="javascript:return validateMyForm();"/>
        <input name="fsID" type="hidden" value="<?php echo $forum_section_id; ?>" />
        <input name="fsTitle" type="hidden" value="<?php echo $forum_section_title; ?>" />
        
        
        </form>
      
    </td>
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