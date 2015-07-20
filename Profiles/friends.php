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
<style type="text/css">

 if (!isset($_SESSION['username'])) {
 header('Location: index.php');
 }
 <?php
           //$style="style.css";
           $sid=$_SESSION['sid'];
           $result = mysql_query("SELECT * FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row = mysql_fetch_assoc($result);
           $style = $row["style"];


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

<script src="../jquery.elastic.js" type="text/javascript" charset="utf-8"></script>

<script src="../jquery.watermarkinput.js" type="text/javascript"></script>

<script type="text/javascript">

	// <![CDATA[

	$(document).ready(function(){

		$('#shareButton').click(function(){

			var a = $("#watermark").val();
			if(a != "What's on your mind?")
			{
				$.post("posts.php?value="+a, {

				}, function(response){

					$('#posting').prepend($(response).fadeIn('slow'));
					$("#watermark").val("What's on your mind?");
				});
			}
		});


		$('.commentMark').livequery("focus", function(e){

			var parent  = $('.commentMark').parent();
			$(".commentBox").children(".commentMark").css('width','320px');
			$(".commentBox").children("a#SubmitComment").hide();
			$(".commentBox").children(".CommentImg").hide();

			var getID =  parent.attr('id').replace('record-','');
			$("#commentBox-"+getID).children("a#SubmitComment").show();
			$('.commentMark').css('width','300px');
			$("#commentBox-"+getID).children(".CommentImg").show();
			
			
		});

		//showCommentBox
		$('a.showCommentBox').livequery("click", function(e){

			var getpID =  $(this).attr('id').replace('post_id','');

			$("#commentBox-"+getpID).css('display','');
			$("#commentMark-"+getpID).focus();
			$("#commentBox-"+getpID).children("CommentImg").show();
			$("#commentBox-"+getpID).children("a#SubmitComment").show();
		});

		//SubmitComment
		$('a.comment').livequery("click", function(e){

			var getpID =  $(this).parent().attr('id').replace('commentBox-','');
			var comment_text = $("#commentMark-"+getpID).val();

			if(comment_text != "Write a comment...")
			{
				$.post("add_comment.php?comment_text="+comment_text+"&post_id="+getpID, {

				}, function(response){

					$('#CommentPosted'+getpID).append($(response).fadeIn('slow'));
					$("#commentMark-"+getpID).val("");
				});
			}

		});

		//more records show
		$('a.more_records').livequery("click", function(e){

			var next =  $('a.more_records').attr('id').replace('more_','');

			$.post("posts.php?show_more_post="+next, {

			}, function(response){
				$('#bottomMoreButton').remove();
				$('#posting').append($(response).fadeIn('slow'));

			});

		});

		//deleteComment
		$('a.c_delete').livequery("click", function(e){

			if(confirm('Are you sure you want to delete this comment?')==false)

			return false;

			e.preventDefault();
			var parent  = $('a.c_delete').parent();
			var c_id =  $(this).attr('id').replace('CID-','');

			$.ajax({

				type: 'get',

				url: 'delete_comment.php?c_id='+ c_id,

				data: '',

				beforeSend: function(){

				},

				success: function(){

					parent.fadeOut(200,function(){

						parent.remove();

					});

				}

			});
		});

		/// hover show remove button
		$('.friends_area').livequery("mouseenter", function(e){
			$(this).children("a.delete").show();
		});
		$('.friends_area').livequery("mouseleave", function(e){
			$('a.delete').hide();
		});
		/// hover show remove button


		$('a.delete').livequery("click", function(e){

		if(confirm('Are you sure you want to delete this post?')==false)

		return false;

		e.preventDefault();

		var parent  = $('a.delete').parent();

		var temp    = parent.attr('id').replace('record-','');

		var main_tr = $('#'+temp).parent();

			$.ajax({

				type: 'get',

				url: 'delete.php?id='+ parent.attr('id').replace('record-',''),

				data: '',

				beforeSend: function(){

				},

				success: function(){

					parent.fadeOut(200,function(){

						main_tr.remove();

					});

				}

			});

		});

		$('textarea').elastic();

		jQuery(function($){

		   $("#watermark").Watermark("What's on your mind?");
		   $(".commentMark").Watermark("Write a comment...");

		});

		jQuery(function($){

		   $("#watermark").Watermark("watermark","#369");
		   $(".commentMark").Watermark("watermark","#EEEEEE");

		});

		function UseData(){

		   $.Watermark.HideAll();

		   //Do Stuff

		   $.Watermark.ShowAll();

		}

	});

	// ]]>

</script>
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




</div>
 <div class="menu_nav">
      <div class="clr"></div>
  </div>
<div i
class="clr"></div>

  <div class="content">
      <div class="content_bg">
        <div class="clr"></div>
    </div>

 <?php

include_once("scripts/checkuserlog.php");
// Include the class files for auto making links out of full URLs and for Time Ago date formatting
include_once("wi_class_files/autoMakeLinks.php");
include_once ("wi_class_files/agoTimeFormat.php");
// Create the two new objects before we can use them below in this script
$activeLinkObject = new autoActiveLink;
$myObject = new convertToAgo;
?>
<?php
// ------- INITIALIZE SOME VARIABLES ---------
// they must be initialized in some server environments or else errors will get thrown
$id = "";
$username = "";
$firstname = "";
$lastname = "";
$mainNameLine = "";
$country = "";
$state = "";
$city = "";
$zip = "";
$bio_body = "";
$website = "";
$youtube = "";
$facebook = "";
$twitter = "";
$twitterWidget = "";
$locationInfo = "";
$user_pic = "";
$blabberDisplayList = "";
$interactionBox = "";
$cacheBuster = rand(999999999,9999999999999); // Put on an image URL will help always show new when changed
// ------- END INITIALIZE SOME VARIABLES ---------

// ------- ESTABLISH THE PAGE ID ACCORDING TO CONDITIONS ---------
if (isset($_GET['id'])) {
	 $id = preg_replace('#[^0-9]#i', '', $_GET['id']); // filter everything but numbers
} else if (isset($_SESSION['idx'])) {
	 $id = $logOptions_id;
} else {
   header("location: index.php");
   exit();
}
// ------- END ESTABLISH THE PAGE ID ACCORDING TO CONDITIONS ---------

// ------- FILTER THE ID AND QUERY THE DATABASE --------
$id = preg_replace('#[^0-9]#i', '', $id); // filter everything but numbers on the ID just in case
$sql = mysql_query("SELECT * FROM myMembers WHERE id='$id' LIMIT 1"); // query the member
// ------- FILTER THE ID AND QUERY THE DATABASE --------

// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
 if ($existCount == 0) { // evaluate the count
	 header("location: index.php?msg=user_does_not_exist");
     exit();
}
// ------- END MAKE SURE PERSON EXISTS IN DATABASE ---------

// ------- WHILE LOOP FOR GETTING THE MEMBER DATA ---------
while($row = mysql_fetch_array($sql)){
    $username = $row["username"];
	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
	$country = $row["country"];
	$state = $row["state"];
	$city = $row["city"];
	$sign_up_date = $row["sign_up_date"];
    $sign_up_date = strftime("%b %d, %Y", strtotime($sign_up_date));
	$last_log_date = $row["last_log_date"];
    $last_log_date = strftime("%b %d, %Y", strtotime($last_log_date));
	$bio_body = $row["bio_body"];
	$bio_body = str_replace("&amp;#39;", "'", $bio_body);
	$bio_body = stripslashes($bio_body);
	$website = $row["website"];
	$youtube = $row["youtube"];
	$facebook = $row["facebook"];
	$twitter = $row["twitter"];
	$friend_array = $row["friend_array"];
	///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "members/$id/image01.jpg";
	$default_pic = "members/0/image01.jpg";
	if (file_exists($check_pic)) {
    $user_pic = "<img src=\"$check_pic?$cacheBuster\" width=\"218px\" />";
	} else {
	$user_pic = "<img src=\"$default_pic\" width=\"218px\" />";
	}
	///////  Mechanism to Display Real Name Next to Username - real name(username) //////////////////////////
	if ($firstname != "" && $lastname != "") {
        $mainNameLine = "$firstname $lastname";
		$username = $firstname;
	} else {
		$mainNameLine = $username;
	}
	///////  Mechanism to Display Youtube channel link or not  //////////////////////////
	if ($youtube == "") {
    $youtube = "";
	} else {
	$youtube = '<br /><br /><img src="images/youtubeIcon.jpg" width="18" height="12" alt="Youtube Channel for ' . $username . '" /> <strong>YouTube Channel:</strong><br /><a href="http://www.youtube.com/user/' . $youtube . '" target="_blank">youtube.com/' . $youtube . '</a>';
	}
    ///////  Mechanism to Display Facebook Profile link or not  //////////////////////////
	if ($facebook == "") {
    $facebook = "";
	} else {
	$facebook = '<br /><br /><img src="images/facebookIcon.jpg" width="18" height="12" alt="Facebook Profile for ' . $username . '" /> <strong>Facebook Profile:</strong><br /><a href="http://www.facebook.com/profile.php?id=' . $facebook . '" target="_blank">profile.php?id=' . $facebook . '</a>';
	}
	///////  Mechanism to Display Twitter Tweet Widget or not  //////////////////////////
	if ($twitter == "") {
    $twitterWidget = "";
	} else {
	$twitterWidget = "<script src=\"http://widgets.twimg.com/j/2/widget.js\"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 5,
  interval: 6000,
  width: 218,
  height: 160,
  theme: {
    shell: {
      background: '#BDF',
      color: '#000000'
    },
    tweets: {
      background: '#ffffff',
      color: '#000000',
      links: '#0066FF',
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('$twitter').start();
</script>";
	}
    ///////  Mechanism to Display Website URL or not  //////////////////////////
	if ($website == "") {
    $website = "";
	} else {
	$website = '<br /><br /><img src="images/websiteIcon.jpg" width="18" height="12" alt="Website URL for ' . $username . '" /> <strong>Website:</strong><br /><a href="http://' . $website . '" target="_blank">' . $website . '</a>';
	}
	///////  Mechanism to Display About me text or not  //////////////////////////
	if ($bio_body == "") {
    $bio_body = "";
	} else {
	$bio_body = '<div class="infoBody">' . $bio_body . '</div>';
	}
	///////  Mechanism to Display Location Info or not  //////////////////////////
	if ($country == "" && $state == "" && $city == "") {
    $locationInfo = "";
	} else {
	$locationInfo = "$city &middot; $state<br />$country ".'';
	}
} // close while loop
// ------- END WHILE LOOP FOR GETTING THE MEMBER DATA ---------

// ------- DETECT USER DEVICE ----------


// Loop through the array of user agents and matching operating systems
/*foreach($OSList as $CurrOS=>$Match) {
        // Find a match
        if (eregi($Match, $agent)) {
                break;
        } else {
			$CurrOS = "Unknown OS";
		}
}*/
//$device = "$user_device : $CurrOS";
// ------- END DETECT USER DEVICE ----------

// ------- POST NEW BLAB TO DATABASE ---------
$blab_outout_msg = "";
if (isset($_POST['blab_field']) && $_POST['blab_field'] != "" && $_POST['blab_field'] != " "){

	 $blabWipit = $_POST['blabWipit'];
     $sessWipit = base64_decode($_SESSION['wipit']);
	 if (!isset($_SESSION['wipit'])) {

	 } else if ($blabWipit == $sessWipit) {
	 	 // Delete any blabs over 50 for this member
	 	 $sqlDeleteBlabs = mysql_query("SELECT * FROM blabbing WHERE mem_id='$id' ORDER BY blab_date DESC LIMIT 50");
	 	 $bi = 1;
		  while ($row = mysql_fetch_array($sqlDeleteBlabs)) {
		 	 $blad_id = $row["id"];
			  if ($bi > 20) {
			  	 $deleteBlabs = mysql_query("DELETE FROM blabbing WHERE id='$blad_id'");
		 	 }
		 	 $bi++;
		  }
		  // End Delete any blabs over 20 for this member
	 	 $blab_field = $_POST['blab_field'];
	 	 $blab_field = stripslashes($blab_field);
	 	 $blab_field = strip_tags($blab_field);
	 	 $blab_field = mysql_real_escape_string($blab_field);
	 	 $blab_field = str_replace("'", "&#39;", $blab_field);
	 	 $sql = mysql_query("INSERT INTO blabbing (mem_id, the_blab, blab_date, blab_type) VALUES('$id','$blab_field', now(),'a')") or die (mysql_error());
	 	 $blab_outout_msg = "";
	 	 }
}
// ------- END POST NEW BLAB TO DATABASE ---------

// ------- MEMBER BLABS OUTPUT CONSTRUCTION ---------
///////  Mechanism to Display Pic
	if (file_exists($check_pic)) {
    $blab_pic = '<div style="overflow:hidden; height:40px;"><a href="profile.php?id=' . $id . '"><img src="' . $check_pic . '" width="40px" border="0" /></a></div>';
	} else {
	$blab_pic = '<div style="overflow:hidden; height:40px;"><a href="profile.php?id=' . $id . '"><img src="' . $default_pic . '" width="40px" border="0" /></a></div>';
	}
///////  END Mechanism to Display Pic
$sql_blabs = mysql_query("SELECT id, mem_id, the_blab, blab_date, blab_type, device FROM blabbing WHERE mem_id='$id' ORDER BY blab_date DESC LIMIT 30");

while($row = mysql_fetch_array($sql_blabs)){

	$blabid = $row["id"];
	$blabber_id = $row["mem_id"];
	$the_blab = $row["the_blab"];
	$the_blab = ($activeLinkObject -> makeActiveLink($the_blab));
	$blab_date = $row["blab_date"];
	$convertedTime = ($myObject -> convert_datetime($blab_date));
    $whenBlab = ($myObject -> makeAgo($convertedTime));
	$blab_date = $row["blab_date"];
	$blab_type = $row["blab_type"];
	$blab_device = $row["device"];
	
				$blabberDisplayList .= '
			        <table style="background-color:#FFF; border:#999 1px solid; border-top:none;" cellpadding="5" width="100%">
					<tr>
					<td width="10%" valign="top">' . $blab_pic . '</td>
					<td width="90%" valign="top" style="line-height:1.5em;">
					<span class="liteGreyColor textsize9">' . $whenBlab . ' <a href="profile.php?id=' . $blabber_id . '"><strong>' . $mainNameLine . '</strong></a> via <em>' . $blab_device . '</em></span><br />
					 ' . $the_blab . '
            </td>
            </tr></table>';
	
}
// ------- END MEMBER BLABS OUTPUT CONSTRUCTION ---------

// ------- ESTABLISH THE PROFILE INTERACTION TOKEN ---------
$thisRandNum = rand(9999999999999,999999999999999999);
$_SESSION['wipit'] = base64_encode($thisRandNum); // Will always overwrite itself each time this script runs
// ------- END ESTABLISH THE PROFILE INTERACTION TOKEN ---------

// ------- EVALUATE WHAT CONTENT TO PLACE IN THE MEMBER INTERACTION BOX -------------------
// initialize some output variables
$friendLink = "";
$the_blab_form = "";
if (isset($_SESSION['idx']) && $logOptions_id != $id) { // If SESSION idx is set, AND it does not equal the profile owner's ID

	// SQL Query the friend array for the logged in viewer of this profile if not the owner
	$sqlArray = mysql_query("SELECT friend_array FROM myMembers WHERE id='" . $logOptions_id ."' LIMIT 1"); 
	while($row=mysql_fetch_array($sqlArray)) { $iFriend_array = $row["friend_array"]; }
	 $iFriend_array = explode(",", $iFriend_array);
	if (in_array($id, $iFriend_array)) { 
	    $friendLink = '<a href="#" onclick="return false" onmousedown="javascript:toggleInteractContainers(\'remove_friend\');">Remove Friend</a>';
	} else {
	    $friendLink = '<a href="#" onclick="return false" onmousedown="javascript:toggleInteractContainers(\'add_friend\');">Add as Friend</a>';	
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$interactionBox = '<br /><br /><div class="interactionLinksDiv">
		   ' . $friendLink . ' 
           
          </div><br />';
		  $the_blab_form = '<div style="background-color:#BDF; border:#999 1px solid; padding:8px;">
          <textarea name="blab_field" rows="3" style="width:99%;"></textarea>
          <strong>Write on ' . $username . '\'s Board (coming soon)</strong>
          </div>';
} else if (isset($_SESSION['idx']) && $logOptions_id == $id) { // If SESSION idx is set, AND it does equal the profile owner's ID
	$interactionBox = '<br /><br /><div class="interactionLinksDiv">
           <a href="#" onclick="return false" onmousedown="javascript:toggleInteractContainers(\'friend_requests\');">Friend Requests</a>
          </div><br />';
		  $the_blab_form = ' ' . $blab_outout_msg . '
          <div style="background-color:#BDF; border:#999 1px solid; padding:8px;">
          <form action="profile.php" method="post" enctype="multipart/form-data" name="blab_from">
          <textarea name="blab_field" rows="3" style="width:99%;"></textarea>
		  <input name="blabWipit" type="hidden" value="' . $thisRandNum . '" />
          <strong>Blab away ' . $username . '</strong> (220 char max) <input name="submit" type="submit" value="Blab" />
          </form></div>';
} else { // If no SESSION id is set, which means we have a person who is not logged in
	$interactionBox = '<div style="border:#CCC 1px solid; padding:5px; background-color:#E4E4E4; color:#999; font-size:11px;">
           <a href="register.php">Sign Up</a> or <a href="login.php">Log In</a> to interact with ' . $username . '
          </div>';
		  $the_blab_form = '<div style="background-color:#BDF; border:#999 1px solid; padding:8px;">
          <textarea name="blab_field" rows="3" style="width:99%;"></textarea>
          <a href="register.php">Sign Up</a> or <a href="login.php">Log In</a> to write on ' . $username . '\'s Board
          </div>';
}
// ------- END EVALUATE WHAT CONTENT TO PLACE IN THE MEMBER INTERACTION BOX -------------------

// ------- POPULATE FRIEND DISPLAY LISTS IF THEY HAVE AT LEAST ONE FRIEND -------------------
$friendList = "";
$friendPopBoxList = "";
if ($friend_array  != "") { 
	// ASSEMBLE FRIEND LIST AND LINKS TO VIEW UP TO 6 ON PROFILE
	$friendArray = explode(",", $friend_array);
	$friendCount = count($friendArray);
    $friendArray6 = array_slice($friendArray, 0, 50);
	
	$friendList .= '<div class="infoHeader1">' . $username . '\'s Friends (' . $friendCount . '</a>)</div>';
    $i = 0; // create a varible that will tell us how many items we looped over 
	 $friendList .= '<div class="infoBody1" style="border-bottom:#666 1px solid;"><table id="friendTable" align="center" cellspacing="4"></tr>'; 
    foreach ($friendArray6 as $key => $value) { 
        $i++; // increment $i by one each loop pass 
		$check_pic = 'members/' . $value . '/image01.jpg';
		    if (file_exists($check_pic)) {
				$frnd_pic = '<a href="profile.php?id=' . $value . '"><img src="' . $check_pic . '" width="54px" border="1"/></a>';
		    } else {
				$frnd_pic = '<a href="profile.php?id=' . $value . '"><img src="members/0/image01.jpg" width="54px" border="1"/></a> &nbsp;';
		    }
			$sqlName = mysql_query("SELECT username, firstname FROM myMembers WHERE id='$value' LIMIT 1") or die ("Sorry we had a mysql error!");
		    while ($row = mysql_fetch_array($sqlName)) { $friendUserName = substr($row["username"],0,12); $friendFirstName = substr($row["firstname"],0,12);}
			if (!$friendUserName) {$friendUserName = $friendFirstName;} // If username is blank use the firstname... programming changes in v1.32 call for this
			if ($i % 6 == 4){
				$friendList .= '<tr><td><div style="width:56px; height:68px; overflow:hidden;" title="' . $friendUserName . '">
				<a href="profile.php?id=' . $value . '">' . $friendUserName . '</a><br />' . $frnd_pic . '
				</div></td>';  
			} else {
				$friendList .= '<td><div style="width:56px; height:68px; overflow:hidden;" title="' . $friendUserName . '">
				<a href="profile.php?id=' . $value . '">' . $friendUserName . '</a><br />' . $frnd_pic . '
				</div></td>'; 
			}
    } 
	 $friendList .= '</tr></table>
	
	 </div>'; 
	// END ASSEMBLE FRIEND LIST... TO VIEW UP TO 6 ON PROFILE
	// ASSEMBLE FRIEND LIST AND LINKS TO VIEW ALL(50 for now until we paginate the array)
	$i = 0;
	$friendArray50 = array_slice($friendArray, 0, 50);
	$friendPopBoxList = '<table id="friendPopBoxTable" width="100%" align="center" cellpadding="6" cellspacing="0">';
	foreach ($friendArray50 as $key => $value) { 
        $i++; // increment $i by one each loop pass 
		$check_pic = 'members/' . $value . '/image01.jpg';
		    if (file_exists($check_pic)) {
				$frnd_pic = '<a href="profile.php?id=' . $value . '"><img src="' . $check_pic . '" width="54px" border="1"/></a>';
		    } else {
				$frnd_pic = '<a href="profile.php?id=' . $value . '"><img src="members/0/image01.jpg" width="54px" border="1"/></a> &nbsp;';
		    }
			$sqlName = mysql_query("SELECT username, firstname, country, state, city FROM myMembers WHERE id='$value' LIMIT 1") or die ("Sorry we had a mysql error!");
		    while ($row = mysql_fetch_array($sqlName)) { $funame = $row["username"]; $ffname = $row["firstname"]; $fcountry = $row["country"]; $fstate = $row["state"]; $fcity = $row["city"]; }
			if (!$funame) {$funame = $ffname;} // If username is blank use the firstname... programming changes in v1.32 call for this
				if ($i % 2) {
					$friendPopBoxList .= '<tr bgcolor="#F4F4F4"><td width="14%" valign="top">
					<div style="width:56px; height:56px; overflow:hidden;" title="' . $funame . '">' . $frnd_pic . '</div></td>
				     <td width="86%" valign="top"><a href="profile.php?id=' . $value . '">' . $funame . '</a><br /><font size="-2"><em>' . $fcity . '<br />' . $fstate . '<br />' . $fcountry . '</em></font></td>
				    </tr>';  
				} else {
				    $friendPopBoxList .= '<tr bgcolor="#E0E0E0"><td width="14%" valign="top">
					<div style="width:56px; height:56px; overflow:hidden;" title="' . $funame . '">' . $frnd_pic . '</div></td>
				     <td width="86%" valign="top"><a href="profile.php?id=' . $value . '">' . $funame . '</a><br /><font size="-2"><em>' . $fcity . '<br />' . $fstate . '<br />' . $fcountry . '</em></font></td>
				    </tr>';  
				}
    } 
	$friendPopBoxList .= '</table>';
	// END ASSEMBLE FRIEND LIST AND LINKS TO VIEW ALL(50 for now until we paginate the array)
}
// ------- END POPULATE FRIEND DISPLAY LISTS IF THEY HAVE AT LEAST ONE FRIEND -------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Description" content="Profile for <?php echo "$username"; ?>" />
<meta name="Keywords" content="<?php echo "$username, $city, $state, $country"; ?>" />
<meta name="rating" content="General" />
<meta name="ROBOTS" content="All" />
<title>Site Profile for <?php echo "$username"; ?></title>
<link href="style/main2.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<style type="text/css">
<!--
.infoHeader {
	background-color: #BDF;
	font-size:11px;
	font-weight:bold;
	padding:8px;
	border: #999 1px solid;
	border-bottom:none;
	width:200px;
}
.infoHeader1 {
	background-color: #BDF;
	font-size:11px;
	font-weight:bold;
	padding:8px;
	border: #999 1px solid;
	border-bottom:none;
	width:95%;
}
.infoBody{
	background-color: #FFF;
	font-size:11px;
	padding:8px;
	border: #999 1px solid;
	border-bottom:none;
	width:200px;
}

.infoBody1{
	background-color: #FFF;
	font-size:11px;
	padding:8px;
	border: #999 1px solid;
	border-bottom:none;
	width:95%;
}

/* ------- Interaction Links Class -------- */
.interactionLinksDiv a {
   border:#B9B9B9 1px solid; padding:5px; color:#060; font-size:11px; background-image:url(style/headerBtnsBG.jpg); text-decoration:none;
}
.interactionLinksDiv a:hover {
	border:#090 1px solid; padding:5px; color:#060; font-size:11px; background-image:url(style/headerBtnsBGover.jpg);
}
/* ------- Interaction Containers Class -------- */
.interactContainers {
	padding:8px;
	background-color:#BDF;
	border:#999 1px solid;
	display:none;
}
#add_friend_loader {
	display:none;
}
#remove_friend_loader {
	display:none;
}
#interactionResults {
	display:none;
	font-size:16px;
	padding:8px;
}
#friendTable td{
	font-size:9px;
}
#friendTable td a{
	color:#03C;
	text-decoration:none;
}
#view_all_friends {
	background-image:url(style/opaqueDark.png);
	width:270px;
	padding:20px;
	position:fixed;
	top:150px;
	display:none;
	z-index:100;
	margin-left:50px;
}
#google_map {
	background-image:url(style/opaqueDark.png);
	padding:20px;
	position:fixed;
	top:150px;
	display:none;
	z-index:100;
	margin-left:50px;
}
-->
</style>
<script language="javascript" type="text/javascript">
// jQuery functionality for toggling member interaction containers
function toggleInteractContainers(x) {
		if ($('#'+x).is(":hidden")) {
			$('#'+x).slideDown(200);
		} else {
			$('#'+x).hide();
		}
		$('.interactContainers').hide();
}
function toggleViewAllFriends(x) {
		if ($('#'+x).is(":hidden")) {
			$('#'+x).fadeIn(200);
		} else {
			$('#'+x).fadeOut(200);
		}
}
function toggleViewMap(x) {
		if ($('#'+x).is(":hidden")) {
			$('#'+x).fadeIn(200);
		} else {
			$('#'+x).fadeOut(200);
		}
}
// Friend adding and accepting stuff
var thisRandNum = "<?php echo $thisRandNum; ?>";
var friendRequestURL = "scripts_for_profile/request_as_friend.php";
function addAsFriend(a,b) {
	$("#add_friend_loader").show();
	$.post(friendRequestURL,{ request: "requestFriendship", mem1: a, mem2: b, thisWipit: thisRandNum } ,function(data) {
	    $("#add_friend").html(data).show().fadeOut(12000);
    });	
}
function acceptFriendRequest (x) {
	$.post(friendRequestURL,{ request: "acceptFriend", reqID: x, thisWipit: thisRandNum } ,function(data) {
            $("#req"+x).html(data).show();
    });
}
function denyFriendRequest (x) {
	$.post(friendRequestURL,{ request: "denyFriend", reqID: x, thisWipit: thisRandNum } ,function(data) {
           $("#req"+x).html(data).show();
    });
}
// End Friend adding and accepting stuff
// Friend removal stuff
function removeAsFriend(a,b) {
	$("#remove_friend_loader").show();
	$.post(friendRequestURL,{ request: "removeFriendship", mem1: a, mem2: b, thisWipit: thisRandNum } ,function(data) {
	    $("#remove_friend").html(data).show().fadeOut(12000);
    });	
}
// End Friend removal stuff
// Start Private Messaging stuff
$('#pmForm').submit(function(){$('input[type=submit]', this).attr('disabled', 'disabled');});
function sendPM ( ) {
      var pmSubject = $("#pmSubject");
	  var pmTextArea = $("#pmTextArea");
	  var sendername = $("#pm_sender_name");
	  var senderid = $("#pm_sender_id");
	  var recName = $("#pm_rec_name");
	  var recID = $("#pm_rec_id");
	  var pm_wipit = $("#pmWipit");
	  var url = "scripts_for_profile/private_msg_parse.php";
      if (pmSubject.val() == "") {
           $("#interactionResults").html('<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp; Please type a subject.').show().fadeOut(6000);
      } else if (pmTextArea.val() == "") {
		   $("#interactionResults").html('<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp; Please type in your message.').show().fadeOut(6000);
      } else {
		   $("#pmFormProcessGif").show();
		   $.post(url,{ subject: pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderID: senderid.val(), rcpntName: recName.val(), rcpntID: recID.val(), thisWipit: pm_wipit.val() } ,           function(data) {
			   $('#private_message').slideUp("fast");
			   $("#interactionResults").html(data).show().fadeOut(10000);
			   document.pmForm.pmTextArea.value='';
			   document.pmForm.pmSubject.value='';
			   $("#pmFormProcessGif").hide();
           });
	  }
}
// End Private Messaging stuff
</script>
</head>
<body>
<table class="mainBodyTable" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="738" valign="top"><br />
      <table width="98%" border="0" align="center" cellpadding="6">
      <tr>
        <td width="33%" valign="top">
          <?php echo $user_pic; ?>
          <?php echo $bio_body; ?>
          <div class="infoHeader"><?php echo $username; ?>'s Information</div>
          <div class="infoBody">
          <?php echo $locationInfo; ?>
          <?php echo $website; ?>
          <?php echo $youtube; ?>
          <?php echo $facebook; ?>
          </div>
          <div class="infoBody">
          <a href="edit_profile.php">Account settings</a>
          </div>
          
        <div id="view_all_friends">
              <div align="right" style="padding:6px; background-color:#FFF; border-bottom:#666 1px solid;">
                       <div style="display:inline; font-size:14px; font-weight:bold; margin-right:150px;">All Friends</div> 
                       <a href="#" onclick="return false" onmousedown="javascript:toggleViewAllFriends('view_all_friends');">close </a>
              </div>
              <div style="background-color:#FFF; height:240px; overflow:auto;">
                   <?php echo $friendPopBoxList; ?>
              </div>
              <div style="padding:6px; background-color:#000; border-top:#666 1px solid; font-size:10px; color: #0F0;"></div>
         </div>
         
         
         
         
         
         <div class="infoHeader"> <a href="../logout.php">Log Out</a></div>
         
          
          
          
         
         
          <div class="infoBody" style="border-bottom:#999 1px solid;"></div>  
          </td>
        <td width="67%" valign="top"> <div class="infoBody1" style="border-bottom:#999 1px solid;"><h1>FRIEND LIST</h1></div>
        
         <?php echo $friendList; ?>
		  
          <!-- START DIV that serves as an interaction status and results container that only appears when we instruct it to -->
          <div id="interactionResults" style="font-size:15px; padding:10px;"></div>
          <!-- END DIV that serves as an interaction status and results container that only appears when we instruct it to -->
         
          <div class="interactContainers" id="friend_requests" style="background-color:#FFF; height:240px; overflow:auto;">
            <div align="right"><a href="#" onclick="return false" onmousedown="javascript:toggleInteractContainers('friend_requests');">close window</a> &nbsp; &nbsp; </div>
            <h3>The following people are requesting you as a friend</h3>
    <?php 
    $sql = "SELECT * FROM friends_requests WHERE mem2='$id' ORDER BY id ASC LIMIT 50";
	$query = mysql_query($sql) or die ("Sorry we had a mysql error!");
	$num_rows = mysql_num_rows($query); 
	if ($num_rows < 1) {
		echo 'You have no Friend Requests at this time.';
	} else {
        while ($row = mysql_fetch_array($query)) { 
		    $requestID = $row["id"];
		    $mem1 = $row["mem1"];
	        $sqlName = mysql_query("SELECT username FROM myMembers WHERE id='$mem1' LIMIT 1") or die ("Sorry we had a mysql error!");
		    while ($row = mysql_fetch_array($sqlName)) { $requesterUserName = $row["username"]; }
		    ///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
		    $check_pic = 'members/' . $mem1 . '/image01.jpg';
		    if (file_exists($check_pic)) {
				$lil_pic = '<a href="profile.php?id=' . $mem1 . '"><img src="' . $check_pic . '" width="50px" border="0"/></a>';
		    } else {
				$lil_pic = '<a href="profile.php?id=' . $mem1 . '"><img src="members/0/image01.jpg" width="50px" border="0"/></a>';
		    }
		    echo	'<hr />
<table width="100%" cellpadding="5"><tr><td width="17%" align="left"><div style="overflow:hidden; height:50px;"> ' . $lil_pic . '</div></td>
                        <td width="83%"><a href="profile.php?id=' . $mem1 . '">' . $requesterUserName . '</a> wants to be your Friend!<br /><br />
					    <span id="req' . $requestID . '">
					    <a href="#" onclick="return false" onmousedown="javascript:acceptFriendRequest(' . $requestID . ');" >Accept</a>
					    &nbsp; &nbsp; OR &nbsp; &nbsp;
					    <a href="#" onclick="return false" onmousedown="javascript:denyFriendRequest(' . $requestID . ');" >Deny</a>
					    </span></td>
                        </tr>
                       </table>';
        }	 
	}
    ?>
          </div>
          
        
             
            </div>
          </td>
      </tr>
      <tr>
        <td colspan="2" valign="top">&nbsp;</td>
        </tr>
      </table>
      <p><br />
        <br />
      </p></td>
    <td width="160" valign="top"><br /><br />
    
    <table border="0" align="center" cellpadding="3">
  
   </table>
    
    </td>
  </tr>
</table>
</body>
</html>
    
  </div>
</div>
<div class="footer">
  <div class="footer_resize">
       <div class="clr"></div>
  </div>
</div>
<div align=center>This is a project by Sidhesh-Vivek-Vaibhav</div></body>
</html>
