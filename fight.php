<?php 
$token = "29c4797ec4084fb4b0edc08b11314e8d";
$url = "https://api.sportsdata.io/v3/mma/stats/json/Fight/275";

$headers[0] = 'Ocp-Apim-Subscription-Key:' . $token;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);
echo $response;