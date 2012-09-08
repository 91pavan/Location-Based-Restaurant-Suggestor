<?php
session_start();
$fbid=$_SESSION['fbid'];
$date="";
$time="";
$link = mysql_connect('localhost', 'takeijok_ayana', 'root123'); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('takeijok_Ayana');
	ERROR_REPORTING(NULL);
	$mondaytime=$_POST['mondaytime'];
	$tuesdaytime=$_POST['tuesdaytime'];
	$wednesdaytime=$_POST['wednesdaytime'];
	$thursdaytime=$_POST['thursdaytime'];
	$fridaytime=$_POST['fridaytime'];
	$saturdaytime=$_POST['saturdaytime'];
	$sundaytime=$_POST['sundaytime'];
	$monday=$_POST['monday'];
	$tuesday=$_POST['tuesday'];
	$wednesday=$_POST['wednesday'];
	$thursday=$_POST['thursday'];
	$friday=$_POST['friday'];
	$saturday=$_POST['saturday'];
	$sunday=$_POST['sunday'];
	
	
	
	if(isset($monday)) {$date .="mon:".$mondaytime.",";}
	if(isset($tuesday)) {$date .="tue:".$tuesdaytime.",";}
	if(isset($wednesday)) {$date .="wed:".$wednesdaytime.",";}
	if(isset($thursday)) {$date .="thu:".$thursdaytime.",";}
	if(isset($friday)) {$date .="fri:".$fridaytime.",";}
	if(isset($saturday)) {$date .="sat:".$saturdaytime.",";}
	if(isset($sunday)) {$date .="sun:".$sundaytime.",";}
	
echo $date;
	$query="update users set date = '$date' where fbid='$fbid'";
	$result=mysql_query($query) or die(mysql_error());
	?>

