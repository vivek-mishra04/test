<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
// Inialize session
 session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: ../index.php');
 }
        /*
         THE OLD INSERT PART
         include('config.inc');
         $USER_NAME=$_SESSION['username'];
         $USER_ID_RESULT = mysql_query("SELECT * FROM user WHERE (USERNAME = '" . mysql_real_escape_string($USER_NAME) . "') ");
         $USER_ID_RESULT_ROW = mysql_fetch_assoc($USER_ID_RESULT);
         $USER_ID = (int)$USER_ID_RESULT_ROW["USER_ID"];
         $BOOK_ID = (int)$_POST['book_id'];
         $RATING_VALUE = (int)$_POST['rating'];
         mysql_query("INSERT INTO rating VALUES($BOOK_ID,$USER_ID,$RATING_VALUE)");
          */


             include('../config.inc');

         $USER_NAME=$_SESSION['username'];
         $USER_ID_RESULT = mysql_query("SELECT * FROM user WHERE (USERNAME = '" . mysql_real_escape_string($USER_NAME) . "') ");
         $USER_ID_RESULT_ROW = mysql_fetch_assoc($USER_ID_RESULT);
         $USER_ID = (int)$USER_ID_RESULT_ROW["USER_ID"];
         $BOOK_ID = (int)$_POST['book_id'];
         $RATING_VALUE = (int)$_POST['rating'];
          mysql_query("INSERT INTO rating VALUES($BOOK_ID,$USER_ID,$RATING_VALUE)");
         $sql = "SELECT DISTINCT r.BOOK_ID, r2.RATING_VALUE-r.RATING_VALUE as rating_difference FROM rating r, rating r2 WHERE r.USER_ID=$USER_ID AND r2.BOOK_ID=$BOOK_ID AND r.USER_ID=$USER_ID";
//dis is item 2 item relation

         $db_result = mysql_query($sql);

         $num_rows = mysql_num_rows($db_result);
         while ($row = mysql_fetch_assoc($db_result))
         {
         $other_itemID = $row["BOOK_ID"];
         $rating_difference = $row["rating_difference"];

        if (mysql_num_rows(mysql_query("SELECT BOOK_ID_1 FROM dev WHERE BOOK_ID_1=$BOOK_ID AND BOOK_ID_2=$other_itemID")) > 0)
        {
        $sql = "UPDATE dev SET COUNT=COUNT+1, SUM=SUM+$rating_difference WHERE BOOK_ID_1=$BOOK_ID AND BOOK_ID_2=$other_itemID";
        mysql_query($sql);

        if ($BOOK_ID != $other_itemID)
           {
            $sql = "UPDATE dev SET COUNT=COUNT+1,SUM=SUM-$rating_difference WHERE (BOOK_ID_1=$other_itemID AND BOOK_ID_2=$BOOK_ID)";
            mysql_query($sql);
            }
        }
        else
        {
            $sql = "INSERT INTO dev VALUES ($BOOK_ID, $other_itemID,1, $rating_difference)";
            mysql_query($sql);

            if ($BOOK_ID != $other_itemID)
            {
                         $sql = "INSERT INTO dev VALUES ($other_itemID, $BOOK_ID, 1, -$rating_difference)";
                         mysql_query($sql);
            }
         }
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
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
           $style = "../profiles/".$row["style"];
		  
		   


?>

<link href="<?php echo $style; ?>" rel="stylesheet" type="text/css" />

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

        <h1><a href="../home.php"><span>iRGIT</span><small>Networking Site</small></a></h1>
      </div>
      <div align="center">
	<h3>Rating Successful.</h3>
	<h4>Thank you for rating.</h4>
        </div>
      <div class="clr"></div>
    </div>
  </div>
</div>
<div class="footer">
  <div class="footer_resize">
       <div class="clr"></div>
  <div align=center>This is a project by Sidhesh-Vivek-Vaibhav</div>
  
  </div>
</div>
</body>
</html>

