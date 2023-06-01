<?php
    include_once 'db.php';


    function insertUser($conn){
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $nickname = $_POST['nick'];
            $password = $_POST['pass'];
                $sql = "INSERT INTO loginhelp (email, nick, pass) VALUES ($email, $nickname, $password)";
    }
?>