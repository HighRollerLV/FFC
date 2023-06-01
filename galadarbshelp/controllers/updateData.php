<?php
session_start();
include "../models/dbOperations.php";
include "../config/db.php";
include "../controllers/sessions.php";

$oldEmail = $_POST['oldEmail'];
$newEmail = $_POST['newEmail'];
$userID = userID();

if ($oldEmail == $newEmail) {
    $insertMsg = "The new email is the same as the old email. Please enter a different email.";
} else {
    // Check if the new email already exists in the database
    $sql = "SELECT email FROM loginhelp WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $newEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $insertMsg = "The new email already exists in the database. Please enter a different email.";
    } else {
        // Check if the old email matches the current email for the user
        $sql = "SELECT email FROM loginhelp WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentEmail = $row['email'];
            if ($oldEmail != $currentEmail) {
                $insertMsg = "The old email you entered does not match your current email. Please try again.";
            } else {
                // Update the user's email
                $sql = "UPDATE loginhelp SET email = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $newEmail, $userID);
                if ($stmt->execute()) {
                    $insertMsg = "Email updated successfully";
                } else {
                    $insertMsg = "Error updating email: " . $stmt->error;
                }
            }
        } else {
            $insertMsg = "Could not find user with ID $userID. Please log in again.";
        }
    }
}

echo $insertMsg;
$conn->close();