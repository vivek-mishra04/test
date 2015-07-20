<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The iRGIT Test</title>
</head>
<body>

<?php

 

require_once('questionsandanswer.php');
require_once('config.inc');

@session_start();
if (!isset($_POST['submitter']))
{
	$num = 0;
 $last=false;
$_SESSION['score'] = 0; // score set to 0
$_SESSION['correct'] = array(); // to hold the user's correct answers
$_SESSION['wrong'] = array(); // to hold the user's incorrect answers
$_SESSION['finished'] = 'no'; // they haven't finished the quiz yet
}
else
{   $last=false;
	$num = (int) $_POST['num'];
$postedanswer = str_replace("_"," ",$_POST['answers']);
if ($postedanswer == $answers[$num]['0'])
{ 
    $_SESSION['score']++;
    $_SESSION['correct'][] = $postedanswer;
}
else 
{
    $_SESSION['wrong'][] = $postedanswer;
}
if($num < count($questions)-1)
{
$num++;
}
else
{
$last = true;
$_SESSION['finished'] = 'yes';
}
}



?>


<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well you know your subject</h1>
<p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You'll then be given the next question</p>
<?php if(isset($_SESSION['username'])) echo "<h4>Current tester:{$_SESSION['username']}</h4>"; ?>
</div><!--intro-->
<div id="quiz">

<?php if  (!$last)
{
?>
<h2>Question <?php echo $num+1; ?>:</h2>
<p>   <strong><?php echo $questions[$num]; ?></strong>           </p>
<form id="questionBox" method="post" action="test.php">
<ul>
<?php
require_once('functions.php');

$pattern = ' ';
$replace = '_';
$shufled = array();

$shufled=shuffle_assoc($answers[$num]);
foreach ($shufled as $answer) {
    $answer2 = str_replace($pattern,$replace,$answer);
    echo "<li><input type=\"radio\" id=\"$answer2\" value=\"$answer2\" name=\"answers\" />\n";
    echo "<label for=\"$answer2\">$answer</label></li>\n";

}
?>

</ul>
<p><input type="hidden" name="num" value="<?php echo $num; ?>" />
<input type="hidden" name="submitter" value="TRUE" />
<input type="submit" id="submit" name="submit" value="Submit Answer" /></p>


</form>

<?php

} else { 
echo "<h2 id=\"score\">{$_SESSION['username']}, your final score is:</h2>\n
<h3>{$_SESSION['score']}/20</h3><h4>Verdict:</h4>";
if($_SESSION['score'] <= 5) echo "<p id=\"verdict\">Witty Remark #1</p>\n";
if(($_SESSION['score'] > 5) && ($_SESSION['score'] <= 10)) echo "<p id=\"verdict\">Witty Remark #2</p>\n";
if(($_SESSION['score'] > 10) && ($_SESSION['score'] <= 15)) echo "<p id=\"verdict\">Witty Remark #3</p>\n";
if($_SESSION['score'] > 15) echo "<p id=\"verdict\">Witty Remark #4</p>";
echo "<p id=\"compare\"><a href=\"results.php\">See how you compare!</a></p>";

$uname=$_SESSION['username'];
$score=$_SESSION['score'];

$sql = mysql_query("SELECT * FROM quiztab WHERE username='".$uname."'");

if($sql)
{
$sql = mysql_query("UPDATE quiztab SET score='" . $score .  "' WHERE username='".$uname."'");
}

else
{
$sql = mysql_query("INSERT INTO quiztab (username,score)VALUES('$uname',$score)");
}

}

?>


</div><!--quiz-->
</div><!--wrapper-->
</body>
</html>