<?php

include_once("scripts/checkuserlog.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Description" content="Message to user" />
<meta name="Keywords" content="" />
<title>Title</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
<?php include_once "header_template.php"; ?>
<table class="mainBodyTable" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="738" valign="top"><p><br />
        <br />
    </p>
      <table width="80%" border="0" align="center">
        <tr>
          <td><?php echo "$msgToUser"; ?></td>
        </tr>
      </table>
<p>&nbsp;</p>
      <p><br />
        <br />
        <br />
        <br />
        <br />
        </p></td>
    <td width="160" valign="top"><?php include_once "right_AD_template.php"; ?></td>
  </tr>
</table>
<?php include_once "footer_template.php"; ?>
</body>
</html>
