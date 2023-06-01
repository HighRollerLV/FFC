<?php
$xml=simplexml_load_file("http://api.sportradar.us/mma/trial/v2/en/competitions/sr:competition:38209/seasons.xml?api_key=nu5ks9tvsy278hdj8au5vntd") or die("Error: Cannot create object");
print_r($xml);
?>