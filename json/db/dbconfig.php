<?php
/************************************\
dbconfig.php
\************************************/

#Database Settings
/************************************\
dbconfig.php
\************************************/


$host = 'localhost'; // MYSQL database host adress
$db = 'cms'; // MYSQL database name
$user = 'root'; // Mysql Datbase user
$pass = ''; // Mysql Datbase password
 
// Connect to the database
$link = mysql_connect($host, $user, $pass);
mysql_select_db($db);
mysql_query('SET NAMES utf8', $link);

//$link=mysql_connect("localhost", "verfbestel", "LS2sJDu4")or die("cannot connect");
//mysql_select_db("verfbestel_mooij")or die("cannot select DB");
//mysql_query('SET NAMES utf8', $link);
//"SELECT * FROM products WHERE ItemName LIKE \"%$search%\" OR EANCode LIKE \"%$search%\" GROUP BY ItemName, EANCode")
?>