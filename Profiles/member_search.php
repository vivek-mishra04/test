<?php

include_once("scripts/checkuserlog.php");
?>
<?php
// DEAFAULT QUERY STRING
$queryString = "WHERE email_activated='1' ORDER BY id ASC";
// DEFAULT MESSAGE ON TOP OF RESULT DISPLAY
$queryMsg = "Showing Senior to Newest members by Default";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* ///////////////////// SET UP FOR SEARCH CRITERIA QUERY SWITCH MECHANISMS
if (($_POST['listByq'] == "newest_members")) {
	
    $queryString = "WHERE email_activated='1' ORDER BY id DESC";
	$queryMsg = "Showing Newest to Oldest Members";
	
} else if ($_POST['listByq'] == "yt_members") {

    $queryString = "WHERE youtube !='' AND email_activated='1' ORDER BY id DESC";
    $queryMsg = "Showing Members with embedded YouTube Channels";

} else if ($_POST['listByq'] == "by_firstname") {
	
	
    $fname = $_POST['fname'];
	$fname = stripslashes($fname); 
    $fname = strip_tags($fname);
	$fname = eregi_replace("`", "", $fname);
	$fname = mysql_real_escape_string($fname);
    $queryString = "WHERE firstname LIKE '%$fname%' AND email_activated='1'";
    $queryMsg = "Showing Members with the name you searched for";
	 
} 	
/////////////// END SET UP FOR SEARCH CRITERIA QUERY SWITCH MECHANISMS */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////  QUERY THE MEMBER DATA USING THE $queryString variable's value
$sql = mysql_query("SELECT id, username, firstname, country, website FROM myMembers WHERE email_activated='1' ORDER BY id ASC"); 
//////////////////////////////////// Adam's Pagination Logic ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$nr = mysql_num_rows($sql); // Get total of Num rows from the database query
if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
    //$pn = ereg_replace("[^0-9]", "", $_GET['pn']); // filter everything but numbers for security(deprecated)
} else { // If the pn URL variable is not present force it to be value of page number 1
    $pn = 1;
} 
//This is where we set how many database items to show on each page 
$itemsPerPage = 10; 
// Get the value of the last page in the pagination result set
$lastPage = ceil($nr / $itemsPerPage);
// Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
if ($pn < 1) { // If it is less than 1
    $pn = 1; // force if to be 1
} else if ($pn > $lastPage) { // if it is greater than $lastpage
    $pn = $lastPage; // force it to be $lastpage's value
} 
// This creates the numbers to click in between the next and back buttons
$centerPages = ""; // Initialize this variable
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
$sql2 = mysql_query("SELECT id, username, firstname, country, website FROM myMembers WHERE email_activated='1' ORDER BY id ASC $limit"); 
//////////////////////////////// END Adam's Pagination Logic ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Adam's Pagination Display Setup ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is not equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1"){
    // This shows the user what page they are on, and the total number of pages
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '<img src="images/clearImage.gif" width="48" height="1" alt="Spacer" />';
	// If we are not on page 1 we can place the Back button
    if ($pn != 1) {
	    $previous = $pn - 1;
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Back</a> ';
    } 
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
    } 
}
///////////////////////////////////// END Adam's Pagination Display Setup ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Build the Output Section Here
$outputList = '';
while($row = mysql_fetch_array($sql2)) { 

	$id = $row["id"];
	$username = $row["username"];
	$firstname = $row["firstname"];
	if (!$firstname) {
		$firstname = $username;
	}
	$country = $row["country"];
	$website = $row["website"];

	///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "members/$id/image01.jpg";
	$default_pic = "members/0/image01.jpg";
	if (file_exists($check_pic)) {
    $user_pic = "<img src=\"$check_pic\" width=\"50px\" border=\"0\" />"; // forces picture to be 120px wide and no more
	} else {
	$user_pic = "<img src=\"$default_pic\" width=\"50px\"  border=\"0\" />"; // forces default picture to be 120px wide and no more
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
$outputList .= '
<table width="100%">
                  <tr>
                    <td width="13%" rowspan="2"><div style=" height:50px; overflow:hidden;"><a href="profile.php?id=' . $id . '" target="_self">' . $user_pic . '</a></div></td>
                    <td width="14%" class="style7"><div align="right">Name:</div></td>
                    <td width="73%"><a href="profile.php?id=' . $id . '" target="_self">' . $firstname . '</a> </td>
                  </tr>
                  <tr>
                    <td class="style7"><div align="right">Website:</div></td>
                    <td><a href="http://' . $website . '" target="_blank">' . $website . '</a> </td>
                  </tr>
                  </table>
				  <hr />
';
	
	
} // close while //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////// END QUERY THE MEMBER DATA & Build the Output Section ////////////////////////////

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Description" content="Member Browsing" />
<meta name="Keywords" content="" />
<meta name="rating" content="General" />
<meta name="ROBOTS" content="All" />
<title>Browse Members</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<style type="text/css">
<!--
.pagNumActive {
	color: #000;
	border:#060 1px solid; background-color: #D2FFD2; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:link {
	color: #000;
	text-decoration: none;
	border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:visited {
	color: #000;
	text-decoration: none;
	border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:hover {
	color: #000;
	text-decoration: none;
	border:#060 1px solid; background-color: #D2FFD2; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:active {
	color: #000;
	text-decoration: none;
	border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
}
-->
</style>
</head>
<body>
<?php include_once "header_template.php"; ?>
<table width="900" border="0" style="background-color: #F2F2F2; border:#CCC 1px solid;" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="738" valign="top"><div><?php include_once "leaderBoardAd.php"; ?></div>
      <div style="margin-left:64px; margin-right:64px;">
        <h2>Total Web Intersect Members: <?php echo $nr; ?><br />
      <!--<table width="98%" align="center" cellpadding="6">
      <tr>
        <td bgcolor="#E9E9E9"><form id="form1" name="form1" method="post" action="member_search.php">
          Browse Newest Members 
     
            <input name="button" type="submit" id="button" value="Go" />
            <input type="hidden" name="listByq" value="newest_members" />
     
        </form>          </td>
        <td bgcolor="#E9E9E9"><form id="form2" name="form2" method="post" action="member_search.php">
          Browse YouTube Members
              <input name="button2" type="submit" id="button2" value="Go" />
          <input type="hidden" name="listByq" value="yt_members" />
        </form></td>
        <td bgcolor="#E9E9E9"><form id="form3" name="form3" method="post" action="member_search.php">
          Search By Name
                <input type="text" name="fname" id="fname" />
           
              <input name="button3" type="submit" id="button3" value="Go" />
          <input type="hidden" name="listByq" value="by_firstname" />
        </form></td>
      </tr>
    </table> -->
      </h2>
      </div>
      <div style="margin-left:58px; margin-right:58px; padding:6px; background-color:#FFF; border:#999 1px solid;"><?php echo $paginationDisplay; ?></div>
      <table width="80%" align="center" cellpadding="6">
        <tr>
          <td><?php //echo "$queryMsg"; ?><br /><br />
<?php echo "$outputList"; ?></td>
        </tr>
      </table>
      <div style="margin-left:58px; margin-right:58px; padding:6px; background-color:#FFF; border:#999 1px solid;"><?php echo $paginationDisplay; ?></div>
<br />
    <br /></td>
    <td width="160" valign="top"><?php include_once "right_AD_template.php"; ?></td>
  </tr>
</table>
<?php include_once "footer_template.php"; ?>
</body>
</html>
