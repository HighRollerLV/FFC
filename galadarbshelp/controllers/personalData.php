<?php
session_start();
include "../models/dbOperations.php";
include "../config/db.php";
include "../controllers/sessions.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$location = $_POST['location'];
$age = $_POST['age'];
$userID = userID();

if (empty($firstName) || empty($lastName) || empty($location) || empty($age)) {
    $insertMsg = "All fields must be complete";
} else {
    $stmt = $conn->prepare("UPDATE loginhelp SET firstName=?, lastName=?, location=?, age=? WHERE id=?");
    $stmt->bind_param("ssssi", $firstName, $lastName, $location, $age, $userID);
    if ($stmt->execute()) {
        $insertMsg = "Data has been added successfully!";
    } else {
        $insertMsg = "Data has not been added! Try again!";
    }

    $stmt->close();
}
