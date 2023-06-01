<?php
    include "models/dbOperations.php";
    include "db.php";

    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];

    if($password === $repeatpassword){
        $sql = "SELECT nickname FROM loginhelp WHERE nickname = '$nickname' OR email = '$email'";
        $results = select($sql, $conn);
        if($results){
            $insertMsg = "Lietotājs jau eksistē!";
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO loginhelp (email, nickname, `password`) VALUES ('$email', '$nickname', '$password')";

            $msg = insert($sql, $conn);
            if($msg === true){
                $insertMsg = "Dati ir pievienoti veiksmīgi!";
            }else{
                $insertMsg = "Kļūda! Datus neizdevās pievienot!";
            }
        }
    }else{
        $insertMsg = "Paroles nesakrīt! Mēģini vēlreiz!";
    }
    echo $insertMsg;
?>
