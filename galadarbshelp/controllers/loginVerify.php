<?php
session_start();
include "../models/dbOperations.php";
include "../config/db.php";
//Check if email and password are set
if (isset($_POST['email2']) && isset($_POST['password2'])) {
    //Get email and password values
    $email = mysqli_real_escape_string($conn, $_POST['email2']);
    $password = mysqli_real_escape_string($conn, $_POST['password2']);
//Retrieve user details from the database by email
    $stmt = $conn->prepare("SELECT * FROM loginhelp WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
//Check if the user exists
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Check if the password matches
            if ($email == $row['email'] && password_verify($password, $row['password'])) {
                $_SESSION['user'] = $row['id'];
                $_SESSION['logged'] = true;
                $users = "true";
            } else {
                $users = "Password or Email is incorrect, please try again!";
            }
        }
    } else {
        $users = "User does not exist";
    }
} else {
    $users = "Fill in all fields!";
}

if (!empty($users)) {
    echo htmlentities($users, ENT_QUOTES);
}

?>