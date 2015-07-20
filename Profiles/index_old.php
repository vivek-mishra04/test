<?php
include_once("scripts/checkuserlog.php");
include_once("wi_class_files/autoMakeLinks.php");
include_once ("wi_class_files/agoTimeFormat.php");
$activeLinkObject = new autoActiveLink;
$myObject = new convertToAgo; 
?>
<?php
include_once "scripts/homePage_randomMembers.php"; 
?>
<?php
$sql_blabs = mysql_query("SELECT * FROM blabbing ORDER BY blab_date DESC LIMIT 10");

$blabberDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sql_blabs)){
	
	$blabid = $row["id"];
	$uid = $row["mem_id"];
	$the_blab = $row["the_blab"];
	//$the_blab = substr($the_blab, 0, 48);
	$the_blab = wordwrap($the_blab, 30, "\n", true);
	//$the_blab = wordwrap($the_blab, 14, "<br />\n");
	$notokinarray = array("fag", "gay", "shit", "fuck", "stupid", "idiot", "asshole", "cunt", "douche");
    $okinarray   = array("sorcerer", "grey", "shug", "farg", "smart", "awesome guy", "butthole", "cake", "dude");
	$the_blab = str_replace($notokinarray, $okinarray, $the_blab);
	$the_blab = ($activeLinkObject -> makeActiveLink($the_blab));
	$blab_date = $row["blab_date"];
	$convertedTime = ($myObject -> convert_datetime($blab_date));
    $whenBlab = ($myObject -> makeAgo($convertedTime));
	$blab_type = $row["blab_type"];
	$blab_device = $row["device"];
	
	// Inner sql query
	$sql_mem_data = mysql_query("SELECT id, username, firstname, lastname FROM myMembers WHERE id='$uid' LIMIT 1");
	while($row = mysql_fetch_array($sql_mem_data)){
			$uid = $row["id"];
			$username = $row["username"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			if ($firstname != "") {$username = "$firstname $lastname"; } // (I added usernames late in  my system, this line is not needed for you)
			///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
			$ucheck_pic = "members/$uid/image01.jpg";
			$udefault_pic = "members/0/image01.jpg";
			if (file_exists($ucheck_pic)) {
			$blabber_pic = '<div style="overflow:hidden; width:40px; height:40px;"><img src="' . $ucheck_pic . '" width="40px" border="0" /></div>'; // forces picture to be 100px wide and no more
			} else {
			$blabber_pic = "<img src=\"$udefault_pic\" width=\"40px\" height=\"40px\" border=\"0\" />"; // forces default picture to be 100px wide and no more
			}
	
			$blabberDisplayList .= '
      			<table width="100%" align="center" cellpadding="4" style="background-color:#CCCCCC; border:#999 1px solid;">
        <tr>
          <td width="7%" bgcolor="#FFFFFF" valign="top"><a href="profile.php?id=' . $uid . '">' . $blabber_pic . '</a>
          </td>
          <td width="93%" bgcolor="#F9F9F9" style="line-height:1.5em;" valign="top">
		 <span class="liteGreyColor textsize9"> ' . $whenBlab . ' <a href="profile.php?id=' . $uid . '"><strong>' . $username . '</strong></a> <br />
          via <em>' . $blab_device . '</em></span><br />
         <span class="textsize10"> ' . $the_blab . '</span>
            </td>
        </tr>
      </table>';
			}
	
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Description" content="" />
<meta name="Keywords" content="" />
<title>Web Intersect - Social Network Community Building</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript"> 
function toggleSlideBox(x) {
		if ($('#'+x).is(":hidden")) {
			//$(".sourceBox").slideUp(200);
			$('#'+x).slideDown(300);
		} else {
			$('#'+x).slideUp(300);
		}
}
</script>
</head>
<body>
<?php include_once "header_template.php"; ?>

<table width="920" style="background-color:#F2F2F2;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>

    <td width="732" valign="top">
<div class="textsize16 greenColor" style="border:#999 1px solid; width:728px; border-top:none; border-bottom:none;"><img src="images/web_intersect_2.jpg" width="728" height="152" alt="Web Intersect Free Social Network Tutorial System" /></div>

<div id="sb1" style="display:none; width:704px; border:#999 1px solid; padding:12px; background-image:url(style/area1BG.jpg); line-height:1.5em; ">Web Intersect is an open source social network website template software, and web community starter package for webmasters worldwide. It is also a very in depth HD video tutorial training series for people that want to really grasp the guts of this software. Webmasters that download and install the latest v1.33, will enjoy the following PHP social network web site features and base systems listed here below to get their community project underway and take it in the exact direction they require:<br />
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;">
  <tr>
      <td width="34%"><strong>&bull; Registration System</strong><span class="textsize10"> (php  mysql)</span><strong><br />
        &bull; Activation System</strong> <span class="textsize10">(php  mysql)</span><strong><br />
        &bull; Login w/ keep log System</strong> <span class="textsize10">(php  mysql)</span></td>
    <td width="33%"><strong>&bull; Friend System</strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull; Private Message System </strong><span class="textsize10">(php  mysql)</span><strong><br />
&bull; API and Gadget Systems </strong><span class="textsize10">(php  mysql)</span></td>
    <td width="33%"><strong>&bull; Profile EditingSystem</strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull; Member Listing System </strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull;Status System</strong> <span class="textsize10">(php  mysql)</span></td>
    </tr>
</table>
</div>
<div style="width:728px; border:#999 1px solid; border-bottom:none;"><?php include_once "leaderBoardAd.php"; ?></div>
<table style="background-color:#EFEFEF; border:#999 thin solid; padding:10px; line-height:1.5em;" width="730" border="0" cellspacing="0" cellpadding="8">
  <tr>
      <td width="42%" valign="top">
      <div style="font-size:15px; margin-bottom:5px;"><strong>Web Intersect Video and Lesson Alerts</strong></div>
      <strong>1.</strong> Subscribe via Adam's video feed on <a href="http://www.youtube.com/subscription_center?add_user=flashbuilding" target="_blank">Youtube</a><br />
      <strong>2.</strong> Follow via <a href="http://twitter.com/flashbuilding" target="_blank">Adam's Twitter Tweets</a><br />
      <strong>3.</strong> Get Updates via <a href="http://www.facebook.com/profile.php?id=1280782775" target="_blank">Adam's Facebook Page</a><br />
      <br />
      <div style="font-size:15px; margin-bottom:5px;"><strong>Some Cool Web Intersect Members</strong></div>        
        <?php  print "$MemberDisplayList"; ?><br />
         <div style="font-size:15px; margin-bottom:5px;"><strong>Web Intersect Jibber Jabber Blabbers</strong></div>
         <div style="font-size:10px; margin-bottom:5px;"><strong>Don't believe anything that these communists say below, they have no god and they have no soul. They are liars.</strong></div>
         <div style="width:284px; overflow:hidden; border: #999 thin solid;"> <?php echo "$blabberDisplayList"; ?></div>
         <br />
        </td>
      <td width="58%" valign="top" style="font-size:10px;">
      <div style="font-size:15px; margin-bottom:5px;"><strong>What are our next set of moves with Web Intersect?</strong><strong></strong></div>
      <div style="font-size:12px;"><strong class="greenColor">1</strong><span class="greenColor"><strong>.</strong></span> Adam is going to do a little series on building a custom forum right into the system. <br />
        <br />
        <strong class="greenColor">2</strong><span class="greenColor"><strong>.</strong></span> He then plans to open the doors here with one more custom app to allow file listing, descriptions, and link sharing so coders can let all other web intersect members know about scripts and tutorials they can offer for enhancing the base WI systems.<br />
      </div>
      <br />
      <div style="font-size:15px; margin-bottom:5px;"><strong>Watch How Web Intersect Has Evolved</strong> <strong> via HD Video</strong></div>
        <strong>Basic Member System Website Using PHP and MySQL</strong><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=762" target="_blank">1. How to Create A Basic Membership Website System Using PHP and MySQL</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=763" target="_blank">2. How to Create A Basic Membership Website System Using PHP and MySQL </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=764" target="_blank">3. How to Create A Basic Membership Website System Using PHP and MySQL </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=772" target="_blank">PHP and MySQL Security Best Practices For Your Website and Server</a><br />
        <br />
        <strong>Webintersect: Social Network Community Building Website Tutorials</strong><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=132" target="_blank">Part 1 - Building a Social Network Website Tutorial - Webintersect.com</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=137" target="_blank">Part 2 - Create the universal Flash header and test in browsers</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=134" target="_blank">Part 3 - CSS Layout and php include files Dreamweaver Tutorial</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=135" target="_blank">Part 4 - PHP Join Form Creation and Parsing Script</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=136" target="_blank">Part 5 - Activation Script creation and discussion</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=138" target="_blank">Part 6 - Header Login check, Login Script, and Session Variables</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=140" target="_blank">Part 7 - Create Log Out in Flash AS 3.0 and PHP</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=139" target="_blank">Part 8 - Create the Universal Member Profile Page</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=142" target="_blank">Part 9 - Create the Profile Edit Page</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=143" target="_blank">Part 10 - Continue production of the profile edit page</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=144" target="_blank">Part 11 - Continue production of the profile edit page</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=147" target="_blank">Part 12 - Display member list temporarily for Viewing</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=148" target="_blank">Part 13 - Embedding API Interfacing from other websites</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=153" target="_blank">Part 14 - Display newest members on homepage</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=154" target="_blank">Part 15 - Create Browse Members Page</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=176" target="_blank">Part 16 - Trim and Format Dynamic String Data using PHP and CSS  </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=175" target="_blank">Part 17 - Finish profile page and learn to diplay alternate content</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=174" target="_blank">Part 18 - Begin creating twitter or facebook like status functionality for live feeds</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=173" target="_blank">Part 19 - Allow members to blab and run live feeds on site</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=172" target="_blank">Part 20 - Completing the base functionality of the status application</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=253" target="_blank">Part 21 - Learning how to display dynamically displayed PHP and MySQL </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=254" target="_blank">Part 22 - Creating the edit_settings.php script to allow editing of  account</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=255" target="_blank">Part 23 - Learn how to parse the edit_settings.php script to update settings</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=256" target="_blank">Part 24 - Allow members to delete their account and remove them</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=257" target="_blank">Part 25 - Capping the maximum post amount to 20 in the database</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=258" target="_blank">Part 26 - Programming the Forgot or Lost Password script to generate temporary</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=259" target="_blank">Part 27 - Programming the Remember Me feature so remeber the member</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=300" target="_blank">Part 28 - Fixing the setcookie bug when using PHP version 5 for Remember Me </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=392" target="_blank">Part 29 - Make the site PHP 5.0 but still PHP 4 workable, and random  displays</a><br />
        <br />
        <strong>Webintersect: Open Source Social Network Website Extended Tutorials</strong><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1038" target="_blank">Web Intersect v1.3 - HTML Header, Fixed Bugs, and GNU GPL</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1039" target="_blank">Pagination Tutorial for PHP MySQL Programmers -  Paging Database Results</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1040" target="_blank">Intro - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1041" target="_blank">1/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1042" target="_blank">2/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1043" target="_blank">3/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1044" target="_blank">4/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1045" target="_blank">5/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1046" target="_blank">6/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1047" target="_blank">7/7 - Web Intersect Friend Add System Tutorial PHP jQuery MySQL Social </a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1051" target="_blank">Web Intersect Pure CSS Drop Down Menu Site Installation Tutorial : W3C OK</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1052" target="_blank">1/3 Private Message System Tutorial for PHP MySQL Websites Web Intersect</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1053" target="_blank">2/3 Private Message System Tutorial for PHP MySQL Websites Web Intersect</a><br />
        &bull;&nbsp;<a href="http://www.developphp.com/view.php?tid=1054" target="_blank">3/3 Private Message System Tutorial for PHP MySQL Websites Web Intersect</a></td>
    </tr>
  </table></td>
    <td width="188" valign="top"><?php include_once("right_AD_template1.php"); ?><br /><br /><?php include_once "right_AD_template.php"; ?><br />
<a href="http://www.developphp.com" target="_blank"><center><img src="images/developphp_banner.jpg" alt="Learn Web Programming and Design Online Free at Develop PHP" width="180" height="600" border="0" /></center></a></td>
  </tr>

</table>
</body>
</html>