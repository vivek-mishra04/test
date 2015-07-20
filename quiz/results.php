<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="style.css" rel="stylesheet" type="text/css" />



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
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="../jquery.livequery.js"></script>
<link href="../dependencies/screen.css" type="text/css" rel="stylesheet" />
</head>

<?php
// Inialize session
 @session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: index.php');
 }
?>
<body>
<div class="main">
<div class="main_resize">
    <div class="header">


      <h1 align="left"><a href="../home.php"><span>iRGIT</span><small>Networking Site</small></a>   </h1>
      
      
      
      
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
          <div id="posting" align="center">
          <h1> TOP SCORERS</h1>  
           <?php


//session_start();
require_once('../config.inc');
require_once('functions.php');


//$radio = $_POST['subject'];
 //print $radio;
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

</div><!--intro-->
<div id="quiz">
<?php  showAnswers($answers,$questions); ?>
 <br />
    <br/>
<li><a href="../index.php" title="Start The Quiz Again">Start Again</a></li>



  




      </div>
</div>


        </div>

        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li ><a href="../home.php">Home</a></li>
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
