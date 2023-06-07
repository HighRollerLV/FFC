<?php
include "../config/db.php";
session_start();

if(isset($_POST['getResult'])) {
    $userID = $_SESSION['user'];

    $stmt = $conn->prepare("SELECT * FROM UserBets WHERE UserId = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $hasResultsThisWeek = false;

        while ($row = $result->fetch_assoc()) {
            $fighterId = $row['FighterId'];
            $betAmount = $row['BetAmount'];
            $koef = $row['Koef'];
            $mainEv = $row['eventId'];
            $fighterNameStmt = $conn->prepare("SELECT * FROM Fighter WHERE id = ?");
            $fighterNameStmt->bind_param("i", $fighterId);
            $fighterNameStmt->execute();
            $fighterNameResult = $fighterNameStmt->get_result();
            $fighterNameResult = $fighterNameResult->fetch_assoc();
            $fighterName = $fighterNameResult['fighter'];
            $figId = $fighterNameResult['fig_id'];
            $fighterNameStmt->close();

            $result2 = $conn->prepare("SELECT * FROM ufcResults WHERE eventId = ? AND singleEventId = ? AND `date` >= CURDATE() - INTERVAL 6 DAY AND `date` <= CURDATE()");
            $result2->bind_param("ii", $mainEv, $row['SingleEventId']);
            $result2->execute();
            $result2 = $result2->get_result();

            if ($result2->num_rows > 0) {
                $hasResultsThisWeek = true;
                $row2 = $result2->fetch_assoc();
                $fightWinner = $row2['fightWinner'];
                $calculate = intval($koef * $betAmount / 20);

                if ($row['paid'] == 0) {
                    $updateStmt = $conn->prepare("UPDATE loginhelp SET currency = currency + ? WHERE id = ?");
                    $updateStmt->bind_param("ii", $calculate, $userID);
                    $updateResult = $updateStmt->execute();

                    if ($updateResult) {
                        $updatePaidStmt = $conn->prepare("UPDATE UserBets SET paid = 1 WHERE UserId = ?");
                        $updatePaidStmt->bind_param("i", $userID);
                        $updatePaidStmt->execute();
                        $playerPaidStmt = $conn->prepare("SELECT * FROM loginhelp WHERE id = ?");
                        $playerPaidStmt->bind_param("i", $userID);
                        $playerPaidStmt->execute();
                        $playerPaidStmt = $playerPaidStmt->get_result();
                        $playerPaidStmt = $playerPaidStmt->fetch_assoc();
                        echo $playerPaidStmt['currency'];

                    }

                }
            }
            $result2->close();
        }
    }
    $result->free_result();
    $stmt->close();
    $conn->close();
}
