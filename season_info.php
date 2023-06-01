<?php
$xml=simplexml_load_file("http://api.sportradar.us/mma/trial/v2/en/seasons/sr:season:99241/info.xml?api_key=nu5ks9tvsy278hdj8au5vntd") or die("Error: Cannot create object");
print_r($xml);
?>