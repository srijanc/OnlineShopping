<?php
 // config file used to connect to data base.
 // connection to database.
 $con = mysql_connect("localhost","root","");
 // if database is not found.
if(!$con)
{
 $query =  mysql_query("SET CHARACTER SET utf8") or die('Cannot select CHARACTER SET utf8: ' . mysql_error());
} 
// selection of database.
 mysql_select_db("srijan",$con);
?>

