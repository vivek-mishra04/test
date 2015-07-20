<?php
	include('config.inc');
	session_start();
	function checkValues($value)
	{
		 // Use this function on all those values where you want to check for both sql injection and cross site scripting
		 //Trim the value
		 $value = trim($value);
		 
		// Stripslashes
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		
		 // Convert all &lt;, &gt; etc. to normal html and then strip these
		 $value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));
		
		 // Strip HTML Tags
		 $value = strip_tags($value);
		
		// Quote the value
		$value = mysql_real_escape_string($value);
		$value = htmlspecialchars ($value);
		return $value;
		
	}	
	
	if(checkValues($_REQUEST['comment_text']) && $_REQUEST['post_id'])
	{
		$uname=$_SESSION['username'];
		
		mysql_query("INSERT INTO status_comments (post_id,user_name,comments,date_created) VALUES('".$_REQUEST['post_id']."','".$uname."','".checkValues($_REQUEST['comment_text'])."','".strtotime(date("Y-m-d H:i:s"))."')");
		
		$result = mysql_query("SELECT *,
		UNIX_TIMESTAMP() - date_created AS CommentTimeSpent FROM status_comments order by c_id desc limit 1");
	}
	
	function clickable_link($text = '')
	{
		$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $text);
		$ret = ' ' . $text;
		$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
		
		$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
		$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
		$ret = substr($ret, 1);
		return $ret;
	}
	while ($rows = mysql_fetch_array($result))
	{
		$days2 = floor($rows['CommentTimeSpent'] / (60 * 60 * 24));
		$remainder = $rows['CommentTimeSpent'] % (60 * 60 * 24);
		$hours = floor($remainder / (60 * 60));
		$remainder = $remainder % (60 * 60);
		$minutes = floor($remainder / 60);
		$seconds = $remainder % 60;	?>
		<div id="record-<?php  echo $rows['c_id'];?>" align="left">
			
            
            
            <?php
	   
	   
	   $uname=$_SESSION['username'];
	   
 $result = mysql_query("SELECT * FROM user WHERE (USERNAME = '" . mysql_real_escape_string($uname) . "') ");
$row2 = mysql_fetch_assoc($result);
$uid = $row2["USER_ID"];
echo "<a href=profile.php?pid=".$uid."><img src=\"dp/".$uid.".jpg\" width=\"40\" class=\"CommentImg\" style=\"float:left;\" alt=\"\" /></a>";
 ?>
            
            
            
            
            
			<label class="postedComments">
				<?php  echo clickable_link($rows['comments']);?>
			</label>
			<br clear="all" />
			
			<span style="margin-left:43px; color:#666666; font-size:11px">
			<?php
			
			if($days2 > 0)
			echo date('F d Y', $rows['date_created']);
			elseif($days2 == 0 && $hours == 0 && $minutes == 0)
			echo "few seconds ago";		
			elseif($days2 == 0 && $hours == 0)
			echo $minutes.' minutes ago';
			else
			echo "few seconds ago";	
			
			?>
			</span>
			
			<?php
			$uname=$_SESSION['username'];
			if($rows['user_name'] == $uname){?>
			&nbsp;&nbsp;<a href="#" id="CID-<?php  echo $rows['c_id'];?>" class="c_delete">Delete</a>
			<?php
			}?>
		</div>
	<?php
	}?>	

		
		
		
		