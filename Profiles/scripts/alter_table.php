<?php
include_once "connect_to_mysql.php";
// create the query string
$sql = 'ALTER TABLE `myMembers` CHANGE `phone` `style_sheet` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL'; 

if (mysql_query($sql)){
print "Success in table field manipulation!";
} else {
print "Script Failure!";
}

?>