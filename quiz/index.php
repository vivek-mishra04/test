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
           $style = "../profiles/".$row["style"];
		  
		   


?>

<link href="<?php echo $style; ?>" rel="stylesheet" type="text/css" />




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

         require_once('functions.php');
         require_once('../config.inc');
         ?>
<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well ou know the subject</h1>
<hr><br><br>
<p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You will then be given the next question.</p>

<div id="leaderboard">
<br><br><h2>Top 10 Scorers</h2>
<hr><br>
        <?php
              $sql = mysql_query("SELECT * FROM quiztab ORDER BY score DESC ");
              $output = "<ul class=\"leaders\">\n";
              while($row = mysql_fetch_array($sql)){

	      $username = $row["username"];
	      $score = $row["score"];
	      if ($username == $_SESSION['username'])
	      {
 			$output .= "<li><strong>$username:</strong> $score/10</li>\n";
               } else
	       {
 	              $output .= "<li>$username: $score/10</li>\n";
          	}
          }

	   $output .= "</ul>\n";
	   echo $output;


?>

</div><!-- leaderboard-->
</div><!--intro-->
<div id="quiz">
<br><br><h2>Start The Test</h2>
<hr><br>
<form id="questionBox" method="post" action="test.php">

<h2> Select your subject </h2>

<input type="radio" name="subject" value="GK">General knowledge<br>
 <input type="radio" name="subject" value="DBMS">Database Management System<br />
<input type="radio" name="subject" value="SE">Software Engineering<br>
 <input type="radio" name="subject" value="CN">Computer Networks


<br />
<br />
  <input type="submit" name="submit1" value="Take The Test" />
</p>
</p>
</form>
<p id="helper"></p>
</div><!--quiz-->
</div><!--wrapper-->

        </div>
       
        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li ><a href="../home.php">Home</a></li>
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
            <li class="../active"><a href="../quiz/">Quiz</a></li>
            <li><a href="../forum/">Forum</a></li>
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
