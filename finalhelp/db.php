<?php

$host = "into.id.lv";
$username = "ralfs_d";
$password = "@kIp_0Ja";
$dbname = "ralfsd";

$conn = mysqli_connect ($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully ";

?>