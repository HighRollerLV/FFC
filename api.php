	<?php
$host = 'localhost';
$user = 'skolnieks';
$pass = 'pQcM10ClEn3lSWy';
$dbName = 'ralfsd';

$conn = new mysqli($host, $user, $pass, $dbName);

if($conn->connect_error){
    echo "Notikus kļūda savienojumā!";
}
    $apiData ="https://api.sportradar.com/mma/trial/v2/en/competitions.xml?api_key=8uh6qjpmfcbnqc4xazswdcva";

    $apiData2 = "https://api.sportradar.com/mma/trial/v2/en/rankings.xml?api_key=8uh6qjpmfcbnqc4xazswdcva";

    $apiData3 = "https://api.sportradar.com/mma/trial/v2/en/seasons.xml?api_key=8uh6qjpmfcbnqc4xazswdcva";

    // $apiData4 = "https://api.sportradar.com/mma/trial/v2/en/seasons.xml?api_key=8uh6qjpmfcbnqc4xazswdcva";
    
function getApi($apiData){    
   libxml_use_internal_errors(TRUE);
 
$objXmlDocument = simplexml_load_file($apiData);

if ($objXmlDocument === FALSE) {
    echo "There were errors parsing the XML file.\n";
    foreach(libxml_get_errors() as $error) {
        echo $error->message;
    }
    exit;
}

$objJsonDocument = json_encode($objXmlDocument);
$objJsonDocument = str_replace('@', '', $objJsonDocument);
$arrOutput = json_decode($objJsonDocument, TRUE);

return $arrOutput;
}

$api = getApi($apiData2);
echo "<pre>";
print_r($api['ranking']);
$api = $api['ranking'];
foreach($api as $wClass){
    $callData = $wClass['competitor_rankings']['competitor_ranking'];
    $weightDiv = $wClass['attributes']['name'];
    foreach ($callData as $fighter){
        $name =  str_replace("'", " ", $fighter['competitor']['attributes']['name']);
    	$id = ltrim($fighter['competitor']['attributes']['id'], 'sr:competitor:');
        $rank = $fighter['attributes']['rank'];
        $sqlSelect = "SELECT id FROM Fighter WHERE fighter = '$name' AND weightDiv = '$weightDiv'";
        $results = $conn->query($sqlSelect);
        if($results->num_rows>0){
             echo "Fighter already exists!";
        }else{
            if(!empty($name)){
            $sql = "INSERT INTO Fighter (fighter, `rank`, weightDiv, fig_id) VALUES ('$name', '$rank', '$weightDiv', '$id')";
            if($conn->query($sql)=== TRUE){
                echo $name." succesfully added!";
            }else{
            	echo $conn->error;
            }
        }
        }
    }
}
$api3 = getApi($apiData3);
$api3 = $api3['season'];
echo "<pre>";
print_r($api3);
foreach($api3 as $season){
	$seasonId = $season['attributes']['id'];
	$seasonId = str_replace('sr:season:', '', $seasonId);
	$seasonEvent = htmlspecialchars($season['attributes']['name'], ENT_QUOTES);
	$startDate = $season['attributes']['start_date'];
    $competitionId = $season['attributes']['competition_id'];
	$competitionId = str_replace('sr:competition:', '', $competitionId);
    $sqlSelect = "SELECT id FROM eventInfo WHERE seasonId = '$seasonId'";
    $results = $conn->query($sqlSelect);

    if($results->num_rows > 0){
        echo "Season already exists!";
    }else{
        if(!empty($seasonId)){
            $sql = "INSERT INTO eventInfo (seasonId, `event`, startDate, competitionId)
            VALUES ('$seasonId', '$seasonEvent','$startDate', '$competitionId')";
        if($conn->query($sql)=== TRUE){
            echo $seasonId." succesfully added!";
        }else{
            echo "Couldnt add!";
        }
    }else{
        echo "No values!";
    }
    }
    
}
?>