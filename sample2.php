<?php
    $html="";
    //$url="https://api.zomato.com/v1/cities.xml?&apikey=4f99789820ae95952985584f99789820";
    //$json = simplexml_load_file($url);

$string = file_get_contents("http://api.zomato.com/v1/search.json/near?&apikey=4f99789820ae95952985584f99789820&city_id=4&lat=12.948142630499198&lon=77.58970802403462");
$json_a = json_decode($string, true);

	for($i=0;$i<sizeof($json_a['results']);$i++) {
		foreach($json_a['results'][$i] as $abc) {
	print_r($abc['name']); 

 
 }
}
?>
    