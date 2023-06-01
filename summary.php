<?php
$xml=simplexml_load_file("https://api.sportradar.com/mma/trial/v2/en/schedules/2019-02-10/summaries.xml?api_key=nu5ks9tvsy278hdj8au5vntd") or die("Error: Cannot create object");
print_r($xml);
?>