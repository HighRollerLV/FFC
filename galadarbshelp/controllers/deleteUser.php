<?php
    session_start();
    include "../models/dbOperations.php";
    include "../config/db.php";
    include "../controllers/sessions.php";
$userID = $_SESSION['user'];
$stmt = $conn->prepare("DELETE FROM loginhelp WHERE id=?");
$stmt->bind_param("i", $userID);
if ($stmt->execute()) {
    unset($_SESSION['user']);
    unset($_SESSION['logged']);
    session_destroy();
    $insertDel = 0;
} else {
    $insertDel = "Radusies kluda luudzu labojies!";
}
echo $insertDel;
?>