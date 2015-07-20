<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The Test Results</title>
</head>
<body id="resultpage">
<div id="wrapresult">
<h1>The Results Page </h1>
<div id="intro">
<h2>Top Scorers</h2>
<?php
session_start();
require_once('config.inc');
require_once('functions.php');
require_once('questionsandanswer.php');
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

</div><!--intro-->
<div id="quiz">
<?php  showAnswers($answers,$questions); ?>
</div><!--quiz-->
<ul id="footer" class="clear">
    <li><a href="index.php" title="Start The Quiz Again">Start Again</a></li>
</ul>
</div><!--wrapper-->
</body>
</html>