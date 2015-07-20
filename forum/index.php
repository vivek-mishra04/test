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
//echo "for the forum/";
include_once "connect_to_mysql.php";
//echo $_SESSION['username'];
$sql = mysql_query("SELECT * FROM forum_sections ORDER BY ordered ASC LIMIT 10");
echo mysql_error();
$displayList = "";
while($row = mysql_fetch_array($sql)){
                             echo mysql_error();
	$sectionID = $row["id"];
	$sectionTitle = $row["title"];
	$displayList .= '<br /><a href="section.php?id=' . $sectionID . '"><img src="sectionPic.png" width="50" height="50" alt="Section" /> <br/>'  . $sectionTitle . '</a><br /><hr />';
}


?>
<table style="background-color: #F0F0F0; border:#069 1px solid; border-top:none;" width="auto" border="0" align="center" cellpadding="12" cellspacing="0">
  <tr>
    <td width="665" align="center" valign="top">
      <div class="forum" id="vaibhav"><h1> RGIT FORUM</h1></div>
    <div id="sectionLinks"><ul><?php echo $displayList; ?></ul></div></td>
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