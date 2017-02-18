<?php
$connection=mysql_connect("localhost","root",""); // no password for arif
	
if(!$connection){
	die("connection failed".mysql.error());
}
$db_select=mysql_select_db("blood_donation",$connection);
if(!$db_select){
	die("DB selection failed".mysql.error());
}
?>
