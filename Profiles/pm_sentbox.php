<?php

include_once("scripts/checkuserlog.php");
?>
<?php
if (!isset($_SESSION['idx'])) {
echo  '<br /><br /><font color="#FF0000">Your session has timed out</font>
<p><a href="pm_sentbox.php.php">Please Click Here</a></p>';
exit(); 
}
// Decode the Session IDX variable and extract the user's ID from it
$decryptedID = base64_decode($_SESSION['idx']);
$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
$my_id = $id_array[1];
// ------- ESTABLISH THE INTERACTION TOKEN ---------
$thisRandNum = rand(9999999999999,999999999999999999);
$_SESSION['wipit'] = base64_encode($thisRandNum); // Will always overwrite itself each time this script runs
// ------- END ESTABLISH THE INTERACTION TOKEN ---------
?>
<?php
// Mailbox Parsing for deleting inbox messages
if (isset($_POST['deleteBtn'])) {
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
		if ($key != "deleteBtn") {
		   $sql = mysql_query("UPDATE private_messages SET senderDelete='1' WHERE id='$value' AND from_id='$my_id' LIMIT 1");
		   // Check to see if sender also removed from sent box, then it is safe to remove completely from system
		}
    }
	header("location: pm_sentbox.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages You Sent</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function toggleChecks(field) {
	if (document.myform.toggleAll.checked == true){
		  for (i = 0; i < field.length; i++) {
              field[i].checked = true;
		  }
	} else {
		  for (i = 0; i < field.length; i++) {
              field[i].checked = false;
		  }		
	}
		 
}
$(document).ready(function() { 
$(".toggle").click(function () { 
  if ($(this).next().is(":hidden")) {
	$(".hiddenDiv").hide();
    $(this).next().slideDown("fast"); 
  } else { 
    $(this).next().hide(); 
  } 
}); 
});
</script>
<style type="text/css"> 
.hiddenDiv{display:none}
#pmFormProcessGif{display:none}
.msgDefault {font-weight:bold;}
.msgRead {font-weight:100;color:#666;}
</style>
</head>
<body>
<?php include_once "header_template.php"; ?>
<table width="920" style="background-color:#F2F2F2;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="732" valign="top">
  <h2 style="margin-left:24px;">Messages You Sent</h2>
<!-- START THE PM FORM AND DISPLAY LIST -->
<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table width="94%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="3%" align="right" valign="bottom"><img src="images/crookedArrow.png" width="16" height="17" alt="Develop PHP Private Messages" /></td>
            <td width="97%" valign="top"><input type="submit" name="deleteBtn" id="deleteBtn" value="Delete" />
              <span id="jsbox" style="display:none"></span>
            </td>
          </tr>
      </table>
        <table width="96%" border="0" align="center" cellpadding="4" style=" background-image:url(style/headerStrip.jpg); background-repeat:repeat-x; border: #999 1px solid;">
          <tr>
            <td width="4%" valign="top">
            <input name="toggleAll" id="toggleAll" type="checkbox" onclick="toggleChecks(document.myform.cb)" />
            </td>
            <td width="20%" valign="top">To</td>
            <td width="58%" valign="top"><span class="style2">Subject</span></td>
            <td width="18%" valign="top">Date</td>
          </tr>
        </table> 
<?php
///////////End take away///////////////////////
// SQL to gather their entire PM list
$sql = mysql_query("SELECT * FROM private_messages WHERE from_id='$my_id' AND senderDelete='0' ORDER BY id DESC LIMIT 100");

while($row = mysql_fetch_array($sql)){ 

    $date = strftime("%b %d, %Y",strtotime($row['time_sent']));
    $to_id = $row['to_id'];    
    // SQL - Collect username for Recipient 
    $ret = mysql_query("SELECT id, username FROM myMembers WHERE id='$to_id' LIMIT 1");
    while($raw = mysql_fetch_array($ret)){ $Rid = $raw['id']; $Rname = $raw['username']; }

?>
        <table width="96%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="4%" valign="top">
            <input type="checkbox" name="cb<?php echo $row['id']; ?>" id="cb" value="<?php echo $row['id']; ?>" />
            </td>
            <td width="20%" valign="top"><a href="profile.php?id=<?php echo $Rid; ?>"><?php echo $Rname; ?></a></td>
            <td width="58%" valign="top">
              <span class="toggle" style="padding:3px;">
              <a class="msgDefault" id="subj_line_<?php echo $row['id']; ?>" style="cursor:pointer;"><?php echo stripslashes($row['subject']); ?></a>
              </span>
              <div class="hiddenDiv"> <br />
                <?php echo stripslashes(wordwrap(nl2br($row['message']), 54, "\n", true)); ?>
                <br />
              </div>
           </td>
            <td width="18%" valign="top"><span style="font-size:10px;"><?php echo $date; ?></span></td>
          </tr>
        </table>
<hr style="margin-left:20px; margin-right:20px;" />
<?php
}// Close Main while loop
?>
</form>
<!-- END THE PM FORM AND DISPLAY LIST -->
</td>
    <td width="188" valign="top"><?php include_once("right_AD_template1.php"); ?><br /><br /><?php include_once "right_AD_template.php"; ?></td>
  </tr>

</table>
<?php include_once "footer_template.php"; ?>
</body>
</html>