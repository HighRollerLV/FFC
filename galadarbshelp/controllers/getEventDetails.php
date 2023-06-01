<?php
$event = "SELECT * FROM UFC_Single_Event 
          WHERE eventDate >= CURDATE() AND eventDate <= DATE_ADD(CURDATE(), INTERVAL 12 DAY) 
          ORDER BY eventDate DESC";

$result = select($event, $conn);

$noDataMessageShown = false;

while ($currentEvent = $result->fetch_assoc()) {
    $closestEvent = $currentEvent["event_id"];
    $selectEvent = "SELECT * FROM eventInfo WHERE event_id = $closestEvent";
    $thisEvent = select($selectEvent, $conn);
    if ($thisEvent && $thisEvent->num_rows > 0) {
        $thisEvent = $thisEvent->fetch_assoc();
        ?>
        <div class="EventDetails flex flex-row justify-center items-center">
            <div class="Event">
                <h1><?php echo $thisEvent["event"]; ?></h1>
            </div>
        </div>
        <?php
    }
//    } else {
//        if (!$noDataMessageShown) {
//            ?>
<!--            <div class="flex flex-col justify-center items-center">-->
<!--                <h2 class="text-6xl font-bold">Sorry we have run into some problems!</h2>-->
<!--                <p class="text-3xl font-bold">Will be back shortly!</p>-->
<!--            </div>-->
<!--            --><?php
//            $noDataMessageShown = true;
//        }
//    }
}
?>