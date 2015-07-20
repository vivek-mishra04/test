<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
// Inialize session
	 session_start();

// Check, if user is already login, then jump to secured page
	 if (isset($_SESSION['username'])) {
	 header('Location: home.php');
	 }

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
    
        <h1><a href="home.php"><span>iRGIT</span><small>Networking Site</small></a></h1>
      </div>
   <br><br>

<table>   
   

   <td width="189" valign="top"><div style=" width:650px; height:300px ; background-image:url(images/irgit.jpg) ; padding:12px;"> <br />
</td>
   
    
   
      
      <div align="right">

   <td width="189" valign="top"><div style=" width:250px; height:300px; background-color: #333; color: #CCC; padding:12px;"> <br />

      <h3 >User Login</h3>
	<h4>Please login to continue.</h4>
		<table border="0">
 			<form method="POST" action="loginproc.php">
 			<tr style="color:#FFF"><td>Username</td><td>:</td><td><input type="text" name="username" size="20"></td></tr>
 						<tr style="color:#FFF"><td>Password</td><td>:</td><td><input type="password" name="password" size="20"></td></tr>
			 <tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="Login"></td></tr>
			 </form>
		 </table>
         
        <center><a href="profiles/register.php">Register</a></center>
     </div>
         
</table>        
 
      <div class="clr"></div>
    </div>
  </div>

<div class="footer">
  <div class="footer_resize">
       <div class="clr"></div>
  </div>
<div align=center>This is a project by Sidhesh-Vivek-Vaibhav
<hr width="73%">
</div>

</div>
</body>
</html>