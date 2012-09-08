<?php
	session_start();
	//$id=$_GET['fbid'];
	//$name=$_GET['name'];
	//$email=$_GET['email'];
	//$photo=$_GET['photo'];
	//if($id)
//{
	$link = mysql_connect('localhost', 'takeijok_ayana', 'root123'); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('takeijok_Ayana');
	$query="SELECT * FROM users";
	$result=mysql_query($query) or die(mysql_error());
	$numrows=mysql_num_rows($result);
	$lat = 0;
	$lon = 0;
	if($numrows!=0)
	{
	while($row=mysql_fetch_array($result))
	{
	$lat+=$row['lat'];
	$lon+=$row['long'];
	}
	$latcentroid = $lat / 3;
	$loncentroid = $lon / 3;
	$_SESSION['latitude']=$latcentroid;
	$_SESSION['longitude']=$loncentroid;
	echo $latcentroid."<br/>";
	echo $loncentroid."<br/>";
	echo "<form action='final2.php' method='post'>";
	echo "<input type='submit' />";
	echo "</form>";
	
	}
	//}
?>