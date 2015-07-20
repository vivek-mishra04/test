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
        <form action="updateAttendanceproc.php" method = "POST">
          <p>
            <select name="subjectattended" id="subjectattended">
              <?php
//code to echo subject options
           include('../config.inc');
           $sid=$_SESSION['sid'];

           $subjectslist = mysql_query("SELECT SUBJECTS, YEAR FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row = mysql_fetch_assoc($subjectslist);
           $subjectslist_string = $row["SUBJECTS"];
           $year = $row["YEAR"];

           $token = strtok($subjectslist_string, ",");
           for($i=0;$token;$i++)
                        {
                           $option = $token;
                            echo "<option>".$option."</option>";
                           $token = strtok(",");
                        }
?>
            </select>
            <input type="submit" value="Attended!" />
          </p>
          <p>&nbsp;</p>
        </form>
        <form action="addSubjectproc.php" method = "POST">
          <p>
            <select name="subjectadded" id="subjectadded">
              <?php

     $subjectslist1 = mysql_query("SELECT SUBJECT_ABBR FROM subject WHERE SUBJECT_YEAR = ".$year."");
     //generate all possible subjects
     while($row1 = mysql_fetch_assoc($subjectslist1))
     {
                             //Match Found
                           $MF = 0;
                           $token1 = $row1['SUBJECT_ABBR'];
                           $subjectslist2 = mysql_query("SELECT SUBJECTS FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row2 = mysql_fetch_assoc($subjectslist2);
           $subjectslist_string2 = $row2["SUBJECTS"];
           $token2 = strtok($subjectslist_string2, ",");
           //loop to generate already present subjects
           while($token2)
                        {
            //if the  possible subjecct equals existing subject, break the inner while loop and go for next iteration of the outer while loop

                           if($token1 == $token2)
                           {
                                      $MF = 1;
                                      break;

                           }
                           $token2 = strtok(",");
                        }
                        if($MF == 0)
                        {
                           //inner while loop terminated because End Of Options and not due to a found match.
                           echo "<option>".$token1."</option>";
                        }

     }


?>
            </select>
            <input type="submit" value="Add Subject" />
          </p>
          <p>&nbsp;</p>
        </form>
        <table border = 1>
<?php
//display the table header.

//reusing the code
           $subjectslist = mysql_query("SELECT SUBJECTS FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row1 = mysql_fetch_assoc($subjectslist);
           $subjectslist_string = $row1["SUBJECTS"];
           $subject = strtok($subjectslist_string, ",");
           while($subject)
                        {
                            echo "<th>".$subject."</th>";
                           $subject = strtok(",");
                        }
           $subjectslist_string = $row["SUBJECTS"];
           $subject = strtok($subjectslist_string, ",");
           $attendancelist = mysql_query("SELECT * FROM subject_attendance WHERE USER_ID ='".mysql_real_escape_string($_SESSION['user_id'])."'");
           $row2 = mysql_fetch_assoc($attendancelist);
           echo "<tr>";
           while($subject)
                  {
                          echo "<td>".$row2[$subject]."</td>";
                           $subject = strtok(",");

                  }
           echo "</tr>";

?>

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
            <li class="active"><a href="mar/">MAR</a></li>
            <li><a href="../quiz/">Quiz</a></li>
            <li><a href="../forum/">Forums</a></li>
            <li ><a href="../profiles/edit_profile">Account settings</a></li>
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