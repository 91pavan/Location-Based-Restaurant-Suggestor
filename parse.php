<?php
    $html="";
    $url="http://gdata.youtube.com/feeds/api/users/phpacademy/uploads";
    $xml = simplexml_load_file($url);
    for( $i = 0; $i < 10 ; $i++) {
        $title = $xml->feed->entry[$i];
        $html .="$title";
    }
    echo $html;    
    
    ?>