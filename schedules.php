<?php
$xml=simplexml_load_file("https://api.sportradar.us/mma/trial/v2/en/schedules/2022-11-12/summaries.xml?api_key=nu5ks9tvsy278hdj8au5vntd") or die("Error: Cannot create object");
print_r($xml);
?>