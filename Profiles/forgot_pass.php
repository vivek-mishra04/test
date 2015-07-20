<?php

include_once("scripts/checkuserlog.php");
// ----------------------------------------------------------------------------------------------------------------------------------------
$outputForUser = "";
if (isset($_POST['email']) && $_POST['email'] != "") {

       $email = $_POST['email'];
       $email   = strip_tags($email);
	   $email= str_replace("`", "", $email);
	   $email = mysql_real_escape_string($email);
       $sql = mysql_query("SELECT * FROM myMembers WHERE email='$email' AND email_activated='1'"); 
       $emailcheck = mysql_num_rows($sql);
       if ($emailcheck == 0){
       
              $outputForUser = '<font color="#FF0000">There is no account with that info<br />
                                                                                     in our records, please try again.';

       } else {
				 
				$emailcut = substr($email, 0, 4); // Takes first four characters from the user email address
				$randNum = rand(); 
                $tempPass = "$emailcut$randNum"; 
				$hashTempPass = md5($tempPass);

                @mysql_query("UPDATE myMembers SET password='$hashTempPass' where email='$email'") or die("cannot set your new password");

                $headers ="From: $adminEmail\n"; // $adminEmail is established in [ scripts/connect_to_mysql.php ]
                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
                $subject ="Login Password Generated";

                $body="<div align=center><br>----------------------------- New Login Password --------------------------------<br><br><br>
                Your New Password for our site is: <font color=\"#006600\"><u>$tempPass</u></font><br><br />
				</div>";

				if(mail($email,$subject,$body,$headers)) {

								$outputForUser = "<font color=\"#006600\"><strong>Your New Login password has been emailed to you.</strong></font>";
				} else {
							   
								$outputForUser = '<font color="#FF0000">Password Not Sent.<br /><br />
                                                                                               Please Contact Us...</font>';
				}
				
     }

} else {
 
   $outputForUser = 'Enter your email address into the field below.';

}
////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Forgot Password</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
</head>

<body>
<?php include_once "header_template.php"; ?>
<table class="mainBodyTable" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="738" valign="top"><br />
      <table width="600" align="center" cellpadding="4" cellspacing="4">
        <form action="forgot_pass.php" method="post" enctype="multipart/form-data" name="newpass" id="newpass">
          <tr>
            <td valign="top" style="line-height:1.5em;"><p align="left"><strong>Forgot or lost your Password? <br />
              <br />
              </strong><br />
              <br />
            </p></td>
            <td valign="top" style="line-height:1.5em;">A new login password  will be made for you.<br />
              <br />
              <br />
              <?php print "$outputForUser"; ?></td>
          </tr>
          <tr>
            <td><div align="right" class="style3">Enter your Email Address Here:</div></td>
            <td><input name="email" type="text" id="email" size="38" maxlength="56" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Get Password" /></td>
          </tr>
        </form>
      </table>
    <br /></td>
    <td width="160" valign="top"><?php include_once "right_AD_template.php"; ?></td>
  </tr>
</table>
<?php include_once "footer_template.php"; ?>
</body>
</html>
