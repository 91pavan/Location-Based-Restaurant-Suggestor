<?php
session_start();
$link = mysql_connect('localhost', 'takeijok_ayana', 'root123'); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('takeijok_Ayana');
	$count_firstrestaurant=0;
	$count_secondrestaurant=0;
	$count_thirdrestaurant=0;
	$priority1=$_SESSION['restaurant1'];
	$priority2=$_SESSION['restaurant2'];
	$priority3=$_SESSION['restaurant3'];
	if((isset($_POST['priority1']))||(isset($_POST['priority2']))||(isset($_POST['priority3'])))
	{
		if(isset($_POST['priority1'])) {
			$result=mysql_query("update events set option1count=(option1count+1)") or die(mysql_error());
			//echo "Most voted Restaurant ".$priority1."<br/>";
		}
		if(isset($_POST['priority2'])) {
			$result=mysql_query("update events set option2count=(option2count+1)") or die(mysql_error());
			//echo "Most voted Restaurant ".$priority2."<br/>";
		}
		if(isset($_POST['priority3'])) {
			$result=mysql_query("update events set option3count=(option3count)+1)") or die(mysql_error());
			//echo "Most voted Restaurant ".$priority3."<br/>";
		}
	}
?>