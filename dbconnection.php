<?php
$con = mysql_connect("localhost","root","");
if(!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("lib", $con);
?>
<link rel="icon" href="IMG/dsi.png"/>
