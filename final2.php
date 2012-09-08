<html>
<head>
</head>
<body>
<form action="final3.php" method="post">
<?php
session_start();
    $html="";
    //$url="https://api.zomato.com/v1/cities.xml?&apikey=4f99789820ae95952985584f99789820";
    //$json = simplexml_load_file($url);
$long=$_SESSION['longitude'];
$lat=$_SESSION['latitude'];
$string = file_get_contents("http://api.zomato.com/v1/search.json/near?&apikey=4f99789820ae95952985584f99789820&city_id=4&lat=$lat&lon=$long");
$json_a = json_decode($string, true);

	for($i=0;$i<sizeof($json_a['results']);$i++) {
		foreach($json_a['results'][$i] as $abc) {
	$restaurantname[$i] = $abc['name'];
	$restaurantlocality[$i]=$abc['locality'];
	$restaurantcuisines[$i]=$abc['cuisines'];
	$restaurantrating[$i]=$abc['rating_editor_overall'];
	$restaurantlat[$i]=$abc['latitude'];
	$restaurantlon[$i]=$abc['longitude'];
	
	//print "RestaurantName  ".$restaurantname[$i]; print "<br/>";
	//print "Locality  " . $restaurantlocality[$i];print "<br/>";
//	print "Cuisines  " . $restaurantcuisines[$i];print "<br/>";
		//print "Rating  " . $restaurantrating[$i];print "<br/>";
		//print "Latitude " . $restaurantlat[$i];print "<br/>";
		//print "Longitude  " . $restaurantlon[$i];print "<br/>";
	//print "<hr/>";
 }
}
?>
    <?php 
		$link = mysql_connect('localhost', 'root', ''); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('ayana');
	$value1=$restaurantname[0].",".$restaurantlocality[0].",".$restaurantcuisines[0].",".$restaurantrating[0]."";
	$value2=$restaurantname[1].",".$restaurantlocality[1].",".$restaurantcuisines[1].",".$restaurantrating[1]."";
	$value3=$restaurantname[2].",".$restaurantlocality[2].",".$restaurantcuisines[2].",".$restaurantrating[2]."";
	$query="INSERT INTO events (option1,option2,option3) values('$value1','$value2','$value3')";
	$result=mysql_query($query) or die(mysql_error());
	//$numrows=mysql_num_rows($result);
	?>
	<?php echo "<ul><h3> Restaurant Name - $restaurantname[0]</h3><br/><li> Locality -$restaurantlocality[0]</li><br/><li> Cuisines - $restaurantcuisines[0]</li><br/><li>Rating - $restaurantrating[0]</li></ul>"; $_SESSION['restaurant1']=$restaurantname[0];?>Okay with this?<input type="checkbox" name="priority1" /><br/>
	<?php echo "<ul><h3>Restaurant Name -$restaurantname[1]</h3><br/><li>Locality - $restaurantlocality[1]</li><br/><li>Cuisines - $restaurantcuisines[1]</li><br/><li> Rating -$restaurantrating[1]</li></ul>"; $_SESSION['restaurant2']=$restaurantname[1];?>Okay with this?<input type="checkbox" name="priority2" /><br/>
	<?php echo "<ul><h3>Restaurant Name -$restaurantname[2]</h3><br/><li>Locality - $restaurantlocality[2]</li><br/><li>Cuisines - $restaurantcuisines[2]</li><br/><li> Rating - $restaurantrating[2]</li></ul>"; $_SESSION['restaurant3']=$restaurantname[2];?>Okay with this?<input type="checkbox" name="priority3" /><br/>
	<input type="submit" />
	</form>
</body>
</html>