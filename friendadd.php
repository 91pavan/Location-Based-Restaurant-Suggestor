<?php
	$id=$_GET['fbid'];
	$name=$_GET['name'];
	$email=$_GET['email'];
	$photo=$_GET['photo'];
	if($id && $name && $email)
{
	$link = mysql_connect('localhost', 'root', ''); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('ayana');
	$query="SELECT * FROM users WHERE fbid='$id'";
	$result=mysql_query($query) or die(mysql_error());
	$numrows=mysql_num_rows($result);
	if($numrows!=0)
	{
	while($row=mysql_fetch_array($result))
	{
	$dbid=$row['fbid'];
	if($dbid == $id)
	{
		//redirect to different page
	}
	}
	}
	else
{
	$query="INSERT INTO users (fbid,name,email,photo) VALUES('$id','$name','$email','$photo')";
	$result=mysql_query($query) or die(mysql_error());
	//redirect him here.

}
?>