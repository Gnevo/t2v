<?php
session_start();
require_once('../class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
require_once('../class/user.php');
$user = new user();

header("content-type: text/javascript");
$salt = "k92kgjDdkQv8Ck9091kTcdWaklBaO5jhMgg4kaljkmzlJ";
$passw = md5($_REQUEST['passw'].$salt);
$query = "SELECT userid FROM user_password WHERE userid='$_REQUEST[user]' AND new_password='$passw'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if($row['userid']) {

	$query = "SELECT user,access,fnamn,enamn,lasttime FROM users WHERE user='$_REQUEST[user]'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if(!$row['access']) {
	
		$query = "SELECT user,access,fnamn,enamn,lasttime FROM bruk WHERE user='$_REQUEST[user]'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
	}
}
else {

	$query = "SELECT user,access,fnamn,enamn,lasttime FROM users WHERE user='$_REQUEST[user]' AND passw='$passw'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if(!$row['access']) {
	
		$query = "SELECT user,access,fnamn,enamn,lasttime FROM bruk WHERE user='$_REQUEST[user]' AND passw='$passw'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
	}
}
$obj->fnamn = $row['fnamn'];
$obj->enamn = $row['enamn'];
$obj->access = $row['access'];
$obj->lasttime = $row['lasttime'];
$_SESSION['user'] = $row['user'];
$query = "UPDATE users SET lasttime='".time()."' WHERE user='$_REQUEST[user]'";
mysql_query($query);
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>