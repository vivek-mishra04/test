<?php
@mysql_connect("localhost:3306","root","") or die (mysql_error());
mysql_select_db("db1") or die (mysql_error());
?>