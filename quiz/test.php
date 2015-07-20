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

<?php
// Inialize session
 @session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }
?>
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

if (isset($_POST['submit1'])) {

$radio = $_POST['subject'];
$_SESSION['subject']=$radio;
 //print $radio;
if($radio == 'GK')
{
require_once('questionsandanswer.php');
//echo "gk loaded";
}

if($radio == 'DBMS')
{
require_once('dbmsq.php');
//echo "DBMS loaded";
}

if($radio == 'SE')
{
require_once('seq.php');
//echo "SE loaded";
}

if($radio == 'CN')
{
require_once('cnq.php');
//echo "CN loaded";
}



}
else
{
	$radio=$_SESSION['subject'];

if($radio == 'GK')
{
require_once('questionsandanswer.php');
//echo "gk loaded";
}

if($radio == 'DBMS')
{
require_once('dbmsq.php');
//echo "DBMS loaded";
}

if($radio == 'SE')
{
require_once('seq.php');
//echo "SE loaded";
}

if($radio == 'CN')
{
require_once('cnq.php');
//echo "CN loaded";
}

}
require_once('../config.inc');

@session_start();
if (!isset($_POST['submitter']))
{
	$num = 0;
 $last=false;
$_SESSION['score'] = 0; // score set to 0
$_SESSION['correct'] = array(); // to hold the user's correct answers
$_SESSION['wrong'] = array(); // to hold the user's incorrect answers
$_SESSION['finished'] = 'no'; // they haven't finished the quiz yet
}
else
{   $last=false;
	$num = (int) $_POST['num'];
$postedanswer = str_replace("_"," ",$_POST['answers']);
if ($postedanswer == $answers[$num]['0'])
{
    $_SESSION['score']++;
    $_SESSION['correct'][] = $postedanswer;
}
else
{
    $_SESSION['wrong'][] = $postedanswer;
}
if($num < count($questions)-1)
{
$num++;
}
else
{
$last = true;
$_SESSION['finished'] = 'yes';
}
}



?>


<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well you know your subject</h1>
<hr><br><br>
<p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You will then be given the next question</p>
<?php if(isset($_SESSION['username'])) echo "<h4>Current tester:{$_SESSION['username']}</h4>"; ?>
</div><!--intro-->
<div id="quiz">

<?php if  (!$last)
{
?>
<h2>Question <?php echo $num+1; ?>:</h2>
<p>   <strong><?php echo $questions[$num]; ?></strong>           </p>
<form id="questionBox" method="post" action="test.php">
<ul>
<?php
require_once('functions.php');

$pattern = ' ';
$replace = '_';
$shufled = array();

$shufled=shuffle_assoc($answers[$num]);
foreach ($shufled as $answer) {
    $answer2 = str_replace($pattern,$replace,$answer);
    echo "<li><input type=\"radio\" id=\"$answer2\" value=\"$answer2\" name=\"answers\" />\n";
    echo "<label for=\"$answer2\">$answer</label></li>\n";

}
?>

</ul>
<p><input type="hidden" name="num" value="<?php echo $num; ?>" />
<input type="hidden" name="submitter" value="TRUE" />
<input type="submit" id="submit" name="submit" value="Submit Answer" /></p>


</form>

<?php

} else {
echo "<h2 id=\"score\">{$_SESSION['username']}, your final score is:</h2>\n
<h3>{$_SESSION['score']}/10</h3><h4>Verdict:</h4>";
if($_SESSION['score'] <= 2) echo "<p id=\"verdict\">Need to improve</p>\n";
if(($_SESSION['score'] > 2) && ($_SESSION['score'] <= 5)) echo "<p id=\"verdict\">Average</p>\n";
if(($_SESSION['score'] > 5) && ($_SESSION['score'] <= 8)) echo "<p id=\"verdict\">Very Good</p>\n";
if($_SESSION['score'] > 8) echo "<p id=\"verdict\">Excellent!!</p>";
echo "<p id=\"compare\"><a href=\"results.php\">See how you compare!</a></p>";

$uname=$_SESSION['username'];
$score=$_SESSION['score'];

$sql = mysql_query("SELECT * FROM quiztab WHERE username='".$uname."'");

if($sql)
{
$sql = mysql_query("UPDATE quiztab SET score='" . $score .  "' WHERE username='".$uname."'");
}

else
{
$sql = mysql_query("INSERT INTO quiztab (username,score)VALUES('$uname',$score)");
}

}

?>


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
            <li class="active"><a href="../quiz/">Quiz</a></li>
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
<div align=center>This is a project by Sidhesh-Vivek-Vaibhav</div></body>
</html>
