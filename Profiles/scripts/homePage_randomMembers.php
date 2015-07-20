<?php

$MemberDisplayList = '<table border="0" align="center" cellpadding="3">
              <tr>  ';
// Mysql connection is already made in the file this one gets included into
// So we can run queries here without having to connect again
$sql = mysql_query("SELECT uid, username, firstname FROM myMembers WHERE email_activated='1' ORDER BY RAND() LIMIT 4");


$sql = mysql_query("SELECT id, username, firstname FROM myMembers WHERE email_activated='1' ORDER BY RAND() LIMIT 4");
while($row = mysql_fetch_array($sql)){
	$id = $row["id"];
	$username = $row["username"];
	$firstname = $row["firstname"];
	if (!$firstname) {
		$firstname = $username;
	}
    $firstnameCut = substr($firstname, 0, 10);
	$check_pic = "members/$id/image01.jpg";
	if (file_exists($check_pic)) {
	    $user_pic = "<img src=\"members/$id/image01.jpg\" width=\"64px\" border=\"0\" />";
	} else {
		$user_pic = "<img src=\"members/0/image01.jpg\" width=\"64px\" border=\"0\" />";
	}
	$MemberDisplayList .= '<td><a href="profile.php?id=' . $id . '" title="' . $firstname . '"><font size="-2">' . $firstnameCut . '</font></a><br />
	<div style=" height:64px; overflow:hidden;"><a href="profile.php?id=' . $id . '"  title="' . $firstname . '">' . $user_pic . '</a></div></td>';

} // close while loop

$MemberDisplayList .= '              </tr>
            </table>  ';
?>