<?php
include "../config/db.php";
include "../models/dbOperations.php";

if (isset($_POST['coin'])) {
    session_start();
    $userID = $_SESSION['user'];
    $currency = $_POST['coin'];
    $eventID = $_POST['event'];
    $fighterID = $_POST['fighter'];
    $koef = $_POST['koef'];
    $mainEv = $_POST['mainEv'];

    // Retrieve user's total currency from the loginhelp table
    $sqlGetCurrency = "SELECT currency FROM loginhelp WHERE id = ?";
    $stmtGetCurrency = $conn->prepare($sqlGetCurrency);
    $stmtGetCurrency->bind_param("i", $userID);
    $stmtGetCurrency->execute();
    $resultGetCurrency = $stmtGetCurrency->get_result();
    $rowGetCurrency = $resultGetCurrency->fetch_assoc();
    $userTotalCurrency = $rowGetCurrency['currency'];

    // Check if the user has already bet on the fighter for the given event
    $sqlCheck = "SELECT * FROM UserBets WHERE SingleEventId = ? AND FighterId = ? AND UserId = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("iii", $eventID, $fighterID, $userID);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        echo "You have already bet on the fighter!";
    } else {
        // User has not bet on the fighter, proceed with inserting the new bet
        if ($currency <= 0 || $currency > $userTotalCurrency) {
            echo "Not enough funds!";
        } else {
            $sqlIns = "INSERT INTO UserBets (SingleEventId, eventId, FighterId, Koef, UserId, BetAmount) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlIns);
            $stmt->bind_param("iiidii", $eventID, $mainEv, $fighterID, $koef, $userID, $currency);
            $stmt->execute();

            $sql = "UPDATE loginhelp SET currency = currency - ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $currency, $userID);
            $stmt->execute();
            $updateCurrency = $stmt->affected_rows;
            echo json_encode($updateCurrency);
        }
    }
}