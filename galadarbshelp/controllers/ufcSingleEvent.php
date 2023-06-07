<?php


//$event = "SELECT * FROM UFC_Single_Event
//WHERE eventDate >= CURDATE() AND eventDate <= DATE_ADD(CURDATE(), INTERVAL 8 DAY)
//ORDER BY id DESC";
$event = "SELECT * FROM UFC_Single_Event
WHERE eventDate >= DATE_SUB(CURDATE(), INTERVAL 20 DAY) AND eventDate <= CURDATE()
ORDER BY id DESC";
$stmt = $conn->prepare($event);

// Check if the statement preparation was successful
if ($stmt) {
    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();
$i = 0;
$eventPrinted = false;
$cardNull = null;
while ($rowEv = $result->fetch_assoc()) {
    // $activeBet = "SELECT * FROM UserBets WHERE SingleEventId = $rowEv";
    // $fighterBet = $rowEv['FighterId'];
    // $betAmount = $rowEv['BetAmount'];

    $figAway = $rowEv["fighter_away_id"];
    $figHome = $rowEv["fighter_home_id"];

    $fighterHome = "SELECT * FROM Fighter WHERE fig_id = $figHome";
    $fighterAway = "SELECT * FROM Fighter WHERE fig_id = $figAway";
    $figHomeSelected = select($fighterHome, $conn);
    $figAwaySelected = select($fighterAway, $conn);
    $figHomeSelected = $figHomeSelected->fetch_assoc();
    $figAwaySelected = $figAwaySelected->fetch_assoc();

    $fighterHomeFull = substr(strstr($figHomeSelected["fighter"], ', '), 2) . ' ' . strstr($figHomeSelected["fighter"], ', ', true);
    $fighterHomeRank = str_replace('99', 'NR', ($figHomeSelected["rank"]));
    $fighterHomeRank = ($figHomeSelected["rank"] === '0') ? 'C' : str_replace('99', 'NR', $figHomeSelected["rank"]);

    $fighterAwayFull = substr(strstr($figAwaySelected["fighter"], ', '), 2) . ' ' . strstr($figAwaySelected["fighter"], ', ', true);
    $fighterAwayRank = ($figAwaySelected["rank"] === '0') ? 'C' : str_replace('99', 'NR', $figAwaySelected["rank"]);

    $fightBout = ucfirst(str_replace('lightheavy', 'light heavyweight', str_replace('_', ' ', $rowEv["weightDiv"])));

    $evId = $rowEv["event_id"];
    $eventId = "SELECT * FROM eventInfo WHERE competitionId = $evId";
    $eventSelected = select($eventId, $conn);
    $eventSelected = $eventSelected->fetch_assoc();

    $currentEvent = $eventSelected["event"];
    $cardType = $rowEv["cardType"];
    ?>
    <?php if (!$eventPrinted) { ?>
        <div class="eventName flex flex-col items-center justify-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-[#e4c065] drop-shadow-xl" style="text-shadow: 0 0 5px #4E4E4E, 1px 0 0 #4E4E4E,
            -1px 0 0 #4E4E4E, 0 1px 0 #4E4E4E, 0 -1px 0 #4E4E4E,
            1px 1px #4E4E4E, -1px -1px 0 #4E4E4E, 1px -1px 0 #4E4E4E,
            -1px 1px 0 #4E4E4E;"
            ><?php echo $currentEvent; ?></h1>
        </div>
        <?php
        $eventPrinted = true;
    }
    ?>
    <?php
    if ($cardType != $cardNull) { ?>
        <div class="flex flex-col w-full">
            <div class="cardType flex flex-col min-h-[5vh] w-full text-center justify-center items-center font-semibold bg-[#606060] text-[#e4c065] drop-shadow-xl">
                <h2 class="text-3xl sm:text-4xl font-bold text-[#e4c065] drop-shadow-xl justify-center items-center"
                    style="text-shadow: 0 0 5px #4E4E4E, 1px 0 0 #4E4E4E,
            -1px 0 0 #4E4E4E, 0 1px 0 #4E4E4E, 0 -1px 0 #4E4E4E,
            1px 1px #4E4E4E, -1px -1px 0 #4E4E4E, 1px -1px 0 #4E4E4E,
            -1px 1px 0 #4E4E4E;"><?php echo $cardType; ?></h2>
            </div>
            <div class="flex w-full min-h-[0.5vh] bg-[#e4c065]"></div>
        </div>
        <?php
        $cardNull = $cardType;
    }
    ?>
    <!--If User has pressed button set it as active forever even on refresh-->
    <div class="main1 flex flex-row min-h-[40vh] sm:min-h-[30vh] justify-center items-center font-semibold w-full bg-[#606060] text-[#e4c065] drop-shadow-xl" data-mainEv="<?= $evId ?>" id="mainEv-<?= $rowEv['id'] ?>">
        <div class="Profile hidden flex-col lg:flex">
            <img src="includes/images/boxing.png" class="max-w-[15rem] sticky">
        </div>
        <div class="Data flex flex-col justify-center gap-4">
            <?php
            if ($rowEv["titleBout"] == "true") {
                ?><h3 class="text-2xl font-semibold text-[#e4c065]">Championship</h3><?php
            } elseif ($rowEv["titleBout"] == "false") {
                echo "";
            } ?>
            <div class="flex flex-col sm:flex-row items-center justify-around gap-4 sm:gap-16 flex-wrap">
                <div class="flex flex-row gap-4 text-lg items-center justify-center">
                    <p><?php echo $fighterHomeRank ?></p>
                    <h4><?php echo $fighterHomeFull ?></h4>
                    <input id="checkBoxHome-<?= $rowEv['id'] ?>" data-event="<?= $rowEv['id'] ?>" type="checkbox"
                           name="fight-<?= $i ?>"
                           value="<?= $figHomeSelected['id'] ?>"
                           class="h-5 w-5 rounded-sm accent-[#e4c065]">
                </div>
                <div class="flex flex-row gap-4 text-lg items-center justify-center">
                    <input id="checkBoxAway-<?= $rowEv['id'] ?>" type="checkbox" name="fight-<?= $i ?>"
                           value="<?= $figAwaySelected['id'] ?>"
                           class="h-5 w-5 rounded-sm accent-[#e4c065]">
                    <p><?php echo $fighterAwayRank ?></p>
                    <h4><?php echo $fighterAwayFull ?></h4>
                </div>
                <script>
                    toggleCheckboxes('checkBoxHome-', 'checkBoxAway-', <?= $rowEv['id']?>);
                </script>
            </div>
            <div class="flex flex-col justify-center items-center">
                <h5 class="text-2xl"><?php echo $fightBout ?>
                    Bout</h5>
                <p class="text-lg">VS</p>
                <div class="flex flex-row justify-center items-center gap-6 text-lg">
                    <p id="koefHome-<?= $rowEv['id'] ?>"
                       data-koef="<?= $rowEv["koef_home_fighter"]; ?>"><?php echo $rowEv["koef_home_fighter"]; ?></p>
                    <p>ODDS</p>
                    <p id="koefAway-<?= $rowEv['id'] ?>"
                       data-koef="<?= $rowEv["koef_away_fighter"]; ?>"><?php echo $rowEv["koef_away_fighter"]; ?></p>
                </div>
            </div>
            <div class="Buttons flex flex-row gap-4 justify-center items-center flex-wrap">
                <button value="10"
                        id="bet-<?= $rowEv['id'] ?>-10"
                        type="button"
                        data-amount="10"
                        onclick="activateButton(<?= $rowEv['id'] ?>,10)"
                        class="currency-btn-<?= $rowEv['id'] ?> rounded bg-[#4E4E4E] text-[#e4c065] font-bold w-20 h-[2rem] text-xl hover:bg-[#e4c065] hover:text-[#4E4E4E] transition duration-150 ease-out hover:ease-in hover:transition duration-300 ease-out">
                    10
                </button>
                <button value="20"
                        id="bet-<?= $rowEv['id'] ?>-20"
                        type="button"
                        data-amount="20"
                        onclick="activateButton(<?= $rowEv['id'] ?>,20)"
                        class="currency-btn-<?= $rowEv['id'] ?> rounded bg-[#4E4E4E] text-[#e4c065] font-bold w-20 h-[2rem] text-xl hover:bg-[#e4c065] hover:text-[#4E4E4E] transition duration-150 ease-out hover:ease-in hover:transition duration-300 ease-out">
                    20
                </button>
                <button value="50"
                        id="bet-<?= $rowEv['id'] ?>-50"
                        type="button"
                        data-amount="50"
                        onclick="activateButton(<?= $rowEv['id'] ?>,50)"
                        class="currency-btn-<?= $rowEv['id'] ?> rounded bg-[#4E4E4E] text-[#e4c065] font-bold w-20 h-[2rem] text-xl hover:bg-[#e4c065] hover:text-[#4E4E4E] transition duration-150 ease-out hover:ease-in hover:transition duration-300 ease-out">
                    50
                </button>
                <button value="100"
                        id="bet-<?= $rowEv['id'] ?>-100"
                        type="button"
                        data-amount="100"
                        onclick="activateButton(<?= $rowEv['id'] ?>,100)"
                        class="currency-btn-<?= $rowEv['id'] ?> rounded bg-[#4E4E4E] text-[#e4c065] font-bold w-20 h-[2rem] text-xl
                hover:bg-[#e4c065] hover:text-[#4E4E4E] transition duration-150 ease-out hover:ease-in hover:transition
                duration-300 ease-out">
                    100
                </button>
                <button value="200"
                        id="bet-<?= $rowEv['id'] ?>-200"
                        type="button"
                        data-amount="200"
                        onclick="activateButton(<?= $rowEv['id'] ?>,200)"
                        class="currency-btn-<?= $rowEv['id'] ?> rounded bg-[#4E4E4E] text-[#e4c065] font-bold w-20 h-[2rem] text-xl
                hover:bg-[#e4c065] hover:text-[#4E4E4E] transition duration-150 ease-out hover:ease-in hover:transition
                duration-300 ease-out">
                    200
                </button>
            </div>
        </div>
        <div class="Profile hidden flex-col lg:flex">
            <img src="includes/images/boxing.png" class="sticky max-w-[15rem]">
        </div>
    </div>

    <?php
    $i++;
}
    $stmt->close();
} else {
    echo "Sorry we ran into an error!";
}
$conn->close();