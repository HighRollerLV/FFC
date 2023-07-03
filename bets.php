<?php
$host = 'localhost';
$user = 'skolnieks';
$pass = 'pQcM10ClEn3lSWy';
$dbName = 'ralfsd';

$conn = new mysqli($host, $user, $pass, $dbName);

function getEvent($eventId)
{
    $xml = simplexml_load_file("https://api.sportradar.com/mma/trial/v2/en/seasons/sr:season:" . $eventId . "/probabilities.xml?api_key=8uh6qjpmfcbnqc4xazswdcva") or die("Error: Cannot create object");

    $objJsonDocument = json_encode($xml);
    $objJsonDocument = str_replace('@', '', $objJsonDocument);
    $arrOutput = json_decode($objJsonDocument, TRUE);

    return $arrOutput;
}

$sql = "SELECT * FROM eventInfo ORDER BY startDate DESC LIMIT 50";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seasonId = $row['seasonId'];
        echo "<h1>" . $row['event'] . "</h1><br>";
        set_time_limit(1);
        $singleEvent = getEvent($seasonId);
        $singleEvent = $singleEvent['sport_event_probability'];
        foreach ($singleEvent as $event) {
            $fightId = $event['sport_event']['competitors']['competitor'];
        	if(!empty($fightId)){
            echo "<pre>";
            $time = $event['sport_event']['attributes']['start_time'];
            $time = explode('T', $time);
            $time = explode('+', $time[1]);
            $time = $time[0];
            // foreach($fightId as $fig){
            // echo "<pre>";
            // print_r($fig['attributes']);
            // }
            $eventFighter = $event['sport_event']['competitors']['competitor'];
            $weightDiv = $event['sport_event_status']['attributes']['weight_class'];
            $weightDiv = explode("(", $weightDiv);
            $weightDiv = $weightDiv[0];
            $weightDiv = htmlspecialchars($weightDiv, ENT_NOQUOTES);
            echo "<h1>" . $weightDiv . "</h1>";
            echo "<pre>";
            //print_r($event);
            $endMinute = $event['sport_event_status']['attributes']['final_round_length'];
            $fightWinner = $event['sport_event_status']['attributes']['winner'];
            $fightEndType = $event['sport_event_status']['attributes']['method'];
            $fightRounds = $event['sport_event_status']['attributes']['scheduled_length'];
            $fightEndRound = $event['sport_event_status']['attributes']['final_round'];
            $fightStatus = $event['sport_event_status']['attributes']['match_status'];
            $isTitleFight = $event['sport_event_status']['attributes']['title_fight'];
            $cardType = $event['sport_event']['sport_event_context']['stage']['attributes']['type'];
            $ods = $event['markets']['market']['outcomes']['outcome'];

            foreach ($ods as $odd) {
                if ($odd['attributes']['name'] === 'home_team_winner') {
                    $homeOds = $odd['attributes']['probability'];
                } else if ($odd['attributes']['name'] === 'away_team_winner') {
                    $awayOds = $odd['attributes']['probability'];
                } else {
                    $homeOds = 0;
                    $awayOds = 0;
                }
            }
            $eventId = ltrim($event['sport_event']['sport_event_context']['competition']['attributes']['id'], 'sr:competition:');
            $figId = $event['sport_event']['competitors']['competitor'];
            //print_r($figId);
            foreach ($figId as $singleFigId) {
                if ($singleFigId['attributes']['qualifier'] == "away") {
                    $figAwayId = ltrim($singleFigId['attributes']['id'], 'sr:competitor:');
                } else if ($singleFigId['attributes']['qualifier'] == "home") {
                    $figHomeId = ltrim($singleFigId['attributes']['id'], 'sr:competitor:');
                } else {
                    $figAwayId = 0;
                    $figHomeId = 0;
                }
            }
            echo "Fight status: " . $fightStatus . "<br>";
            echo "Fight round count: " . $fightRounds . "<br>";
            echo "card type: " . $cardType . "<br>";
            echo "away fighter id = " . $figAwayId . "<br>";
            echo "away ods = " . $awayOds . "<br>";
            echo "home fighter id = " . $figHomeId . "<br>";
            echo "home ods = " . $homeOds . "<br>";
            echo "Winner: " . $fightWinner . "<br>";
            echo "Title fight: " . $isTitleFight . "<br>";
            echo "Win by: " . $fightEndType . "<br>";
            echo "Win in round:  = " . $fightEndRound . "<br>";
            echo "In " . $endMinute . " minutes . $eventId .<br>";

            $eDate = $row['startDate'];


            foreach ($eventFighter as $fighter) {

                //print_r($fighter);
                $singleFighter = htmlspecialchars($fighter['attributes']['name'], ENT_NOQUOTES);
            	echo "<h1>".$singleFighter."</h1>";
            	$singleFighter = str_replace("'", "", $singleFighter);
                if ($fighter['attributes']['qualifier'] == "away") {
                    echo "Away fighter: " . $singleFighter . "<br>";
                } else {
                    echo "Home fighter: " . $singleFighter . "<br>";
                }
                $f_id = $fighter['attributes']['id'];
                $f_id = ltrim($f_id, "sr:competitor:");
                //echo $singleFighter . "<br>";
                $sqlFighters = "SELECT * FROM Fighter WHERE fighter = '$singleFighter' AND weightDiv = '$weightDiv'";
                $fighterResults = $conn->query($sqlFighters);
            	
                if ($fighterResults->num_rows == 0) {
                    $insertSql = "INSERT INTO Fighter (fighter, `rank`, weightDiv, fig_id) VALUES('$singleFighter', 99, '$weightDiv', $f_id)";
                    if ($conn->query($insertSql) == true) {
                        echo "New fighter " . $singleFighter . " added!";
                    }
                } else {
                    echo "Fighter already exists! <br>";
                }
            }

            $sql = "SELECT * FROM UFC_Single_Event WHERE event_id='$eventId' AND fighter_away_id='$figAwayId' AND fighter_home_id='$figHomeId'";
            $selRes = $conn->query($sql);
            if ($selRes->num_rows > 0) {
                echo "Event already saved!";
            } else {
				
				$realTime = strtotime($time);

				if ($realTime !== false) {
    				$formattedTime = date("H:i:s", $realTime);
                }
                $sqlIns = "INSERT INTO UFC_Single_Event (event_id, fighter_away_id, fighter_home_id, koef_home_fighter,
                koef_away_fighter, weightDiv, cardType, titleBout, eventDate, eventStatus, startTime) VALUES ('$eventId', '$figAwayId', '$figHomeId', 
                '$homeOds', '$awayOds', '$weightDiv', '$cardType', '$isTitleFight', '$eDate', '$fightStatus', '$formattedTime')";
                if ($conn->query($sqlIns) === TRUE) {
                    echo "Added new event!";
                	$singleEvId = $conn->insert_id;
                }
            }

            //Event results insert to DB

            if(!empty($fightWinner)) {
                if($fightWinner === "away_team"){
                    $fightWinner = $figAwayId;
                }else{
                    $fightWinner = $figHomeId;
                }
                $eventIns = "INSERT INTO ufcResults (eventId, singleEventId, fightWinner, fightRounds, finalRound, finalMinute, method, date)
                   VALUES ('$eventId', '$singleEvId' ,'$fightWinner', '$fightRounds', '$fightEndRound', '$endMinute', '$fightEndType','$eDate')";

                if ($conn->query($eventIns) === TRUE) {
                    echo "Data inserted successfully.";
                }
            }

            }
        }
        sleep(1);
        // echo "<pre>";
        // print_r($singleEvent);
    }
}
?>