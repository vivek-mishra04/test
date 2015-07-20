<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style_q.css" type="text/css" />
<title>The iRGIT Test</title>
</head>

<body id="splash">


<?php
require_once('functions.php');
require_once('config.inc');
?>


<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well ou know the subject</h1>
<p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You will then be given the next question.</p>

<div id="leaderboard">
<h2>Top 10 Scorers</h2>
<?php

session_start();
$sql = mysql_query("SELECT * FROM quiztab ORDER BY score DESC ");
$output = "<ul class=\"leaders\">\n";
while($row = mysql_fetch_array($sql)){

	$username = $row["username"];
	$score = $row["score"];
	if ($username == $_SESSION['username'])
	{
 			$output .= "<li><strong>$username:</strong> $score/20</li>\n";
    } else
	 {
 	   $output .= "<li>$username: $score/20</li>\n";
 	}
}

	$output .= "</ul>\n";
	echo $output;


?>

</div><!-- leaderboard-->
</div><!--intro-->
<div id="quiz">
<h2>Start The Test</h2>

<form id="questionBox" method="post" action="test.php">
<input type="submit" id="submit" value="Take The Test" /></p>
</form>
<p id="helper"></p>
</div><!--quiz-->
</div><!--wrapper-->
</body>
</html>