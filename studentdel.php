<?php
session_start();
$hostname_surachet = "localhost";
$database_surachet = "***";
$username_surachet = "***";
$password_surachet = "***";

$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

$sid = $_GET['sid'];

$sql_studentdel = "delete from tbl_student where sid = " . $sid;
$query_studentdel = mysql_db_query($database_surachet, $sql_studentdel)or die(mysql_error());

header("location:/register");
?>