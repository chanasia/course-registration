<?php
session_start();
$hostname_surachet = "localhost";
$database_surachet = "***";
$username_surachet = "***";
$password_surachet = "***";

$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

$subid = $_GET['subid'];

$sql = "delete from tbl_subject where subid = " . $subid;
$query = mysql_db_query($database_surachet, $sql)or die(mysql_error());

header("location:/register/subject.php");
?>