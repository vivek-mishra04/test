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
 include('../config.inc');
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

          <p>&nbsp;</p>
          <form id="form1" name="form1" action="bookList.php?" method="GET">
            <label>
                <select name="branch" size="1" id="cat1">
                <option selected="selected">Branch</option>
                <?php
                $result = mysql_query("SELECT BRANCH_NAME FROM branch");
                while($row = mysql_fetch_assoc($result))
                {
                           echo "<option>".$row['BRANCH_NAME']."</option>";
                }
                ?>
              </select>
              <select name="year" size="1" id="cat2">
                <option label="Year" selected="selected">Year</option>
                 <?php
                $result = mysql_query("SELECT YEAR_NAME FROM year");
                while($row = mysql_fetch_assoc($result))
                {
                           echo "<option>".$row['YEAR_NAME']."</option>";
                }
                ?>
              </select>
              <select name="subject" size="1" id="cat3">
                <option label="Subject" selected="selected">Subject</option>
                <?php
                $result = mysql_query("SELECT SUBJECT_NAME FROM subject");
                while($row = mysql_fetch_assoc($result))
                {
                           echo "<option>".$row['SUBJECT_NAME']."</option>";
                }
                ?>
              </select>
            </label>
            <input type="submit" name="button" id="button1" value="SEARCH" />
          </form>
          <p>&nbsp;</p>
	<?php
	 	if(isset($_GET["button"]) AND $_GET['year']!=NULL AND $_GET['subject']!=NULL)
                          {
                                       if($_GET['year']=="Year" OR $_GET['subject']=="Subject" OR $_GET['branch']=="Branch" OR $_GET['year']==NULL OR $_GET['subject']==NULL OR $_GET['branch']==NULL)
                                       {
                                                        echo "<h2>MAKE A VALID SELECTION.</h2>";
                                       }
                                       else
                                       {
                                            $result = mysql_query("SELECT * FROM bookinfo WHERE (BOOK_SUBJECT = '" . mysql_real_escape_string($_GET['subject']) . "') and (BOOK_YEAR = '" . mysql_real_escape_string($_GET['year']) . "')");
		                            if(mysql_num_rows($result) == 0)
	                        	    {
		                                  	echo "<h2>CURRENTLY WE DO NOT HAVE SUCH BOOKS</h2>";
	                          	           }
		                            else
	                            	    {
              	                                        $count=mysql_num_rows($result);
	 	                      	                for ($i=1; $i<=4; $i++)
 		                       	                 {
			                  	            echo "<p>";
	   		                                    for($j=1;$j<=4;$j++)
			                    		    {	$row = mysql_fetch_assoc($result);
			                      			$op=$row["BOOK_ID"];
			                         			echo "<span class=\"article\"><a href=\"bookInfo.php?book_id=".$op."jpg\"><img name=\"".$op."\" src=\"\" id=\"1111\" width=\"100\" height=\"100\" alt=\"\"   /></a></span>";
				                    		$count--;
				                      		if($count==0)
				                        			break;
				                           	}
			                       	            echo "</p>";
                  	                                    if($count==0)
			                                          break;
	                                                 }
		                             }
                                         }
                          }
	 ?>
          <p>&nbsp;</p>
        </div>
        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li><a href="../home.php">Home</a></li>
              <li><a href="../photos">Photos</a></li>
              <li><a href="../recommender/">Recommender</a></li>
              <ul>
                 <li class="active"><a href="#">>>Search Books</a></li>
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