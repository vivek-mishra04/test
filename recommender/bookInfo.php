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
@ session_start();
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

<table style="background-color: #F0F0F0; solid; border-top:none;" width="650" border="0" align="center" cellpadding="12" cellspacing="0">
  <tr>
    <td width="auto" valign="top">
     <?php

        include('../config.inc');
	$result = mysql_query("SELECT * FROM bookinfo WHERE (BOOK_ID = '" . mysql_real_escape_string($_GET['book_id']) . "') ");
	$row1 = mysql_fetch_assoc($result);
	echo "<h3>BOOK ID </h3><h4>".$row1['BOOK_ID']."</h4>";
	echo  "<h2>NAME:</h2><h3>".$row1['BOOK_NAME']."</h3>";
	echo "<p><img src=\"pics/".$row1['BOOK_ID'].".jpg\" width=\"125\" height=\"200\" alt=\"\" /></p>";
	echo  "<h2>AUTHOR/S:</h2><h3>".$row1['BOOK_AUTHOR']."</h3>";
	echo  "<h2>DESCRIPTION:</h2><h3>".$row1['BOOK_DESC']."</h3>";
?>
    </td>
<td width="189" valign="top"><div style=" width:200px; height:600px; background-color: #CCC; color: #000; padding:12px;"> <br />
<br />
<br />
    <?php
         $USER_ID = $_SESSION["user_id"];
         echo "<h2 style=color:blue>Here are some recommendations for you:<br/>_______________ </h2><br/><br/>";
         for($BOOK_ID=1;$BOOK_ID<=10;$BOOK_ID++)
         {
	   $value=predict($USER_ID,$BOOK_ID);
           $threshold=5;
	   $img = mysql_query("SELECT BOOK_IMG FROM bookinfo WHERE BOOK_ID=$BOOK_ID");
	   if($threshold<$value)
              {
                            $BOOK_NAME_RESULT = mysql_query("SELECT BOOK_NAME, BOOK_AUTHOR FROM bookinfo WHERE BOOK_ID=$BOOK_ID");
                            $BOOK_NAME_RESULT_ROW = mysql_fetch_assoc($BOOK_NAME_RESULT);
                            $BOOK_NAME = $BOOK_NAME_RESULT_ROW["BOOK_NAME"];
                            $BOOK_AUTHOR = $BOOK_NAME_RESULT_ROW["BOOK_AUTHOR"];
                            echo $BOOK_NAME." by ".$BOOK_AUTHOR."<br/><br/>";
                 	   //echo "The predicted rating for the book<a href=\"http://localhost/projectNew/bookInfo.php?book_id=".$BOOK_ID."\"> ".$BOOK_ID."</a> is";
	                   //echo $value."<br/>";
              }
           //else
                //echo "do not recommend  <br />";
           }
           function predict($USER_ID, $BOOK_ID)
           {
               global $connection;
               $denom = 0.0;
               $numer = 0.0;
               $k = $BOOK_ID;
               $sql1 = "SELECT r.BOOK_ID, r.RATING_VALUE FROM rating r WHERE r.USER_ID=$USER_ID AND r.BOOK_ID!=$BOOK_ID";
               $db_result = mysql_query($sql1);
               if (! $db_result)
                  {
                     throw new Exception('Database error: ' . mysql_error());
                   }
               while ($row = mysql_fetch_assoc($db_result))
                   {
                     $j = $row["BOOK_ID"];
                     $ratingValue = $row["RATING_VALUE"];

                     $sql2 = "SELECT d.COUNT, d.SUM FROM dev d WHERE BOOK_ID_1=$k AND BOOK_ID_2=$j";
                     $count_result = mysql_query($sql2);

                     if(mysql_num_rows($count_result) > 0)
                     {
                        $count = mysql_result($count_result, 0, "COUNT");
                        $sum = mysql_result($count_result, 0, "SUM");
                        $average = $sum / $count;
                        $denom += $count;
                        $numer += $count * ($average + $ratingValue);
                     }
                    }
               if ($denom == 0)
                     return 0;
               else
                     return ($numer / $denom);
           }
         $CURRENT_BOOK_ID=$_GET['book_id'];
         $url="update.php?";
         echo "<form action=\"".$url."\" method=\"POST\">
           <p>Ratings:
            <select name=\"rating\" size=\"1\" id=\"select\">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
            </select>
          </p>
          <!-- <p hidden name=\"book_id\" label=\"\">.$CURRENT_BOOK_ID.</p>  -->
          <select hidden name=\"book_id\" label=\"\"><option>".$CURRENT_BOOK_ID."</option></input>
          <br><input type=\"submit\" value=\"Rate this book!\"/></form>
          ";
 ?>


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
              <ul>
                 <li class="active"><a href="bookList.php">&gt;&gt;Search Books</a></li>
              </ul>
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
            <li><a href="../forums/">Forums</a></li>
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