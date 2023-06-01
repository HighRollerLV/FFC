<?php
    include "dbOperations.php";
    include "db.php";

function login($conn){
    if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM loginhelp WHERE email = '$email'";
    $msg = select($sql,$conn);
    if($msg){
        while($row=$msg->fetch_assoc()){
            if($email == $row['email'] && password_verify($password , $row['password'])){
                $_SESSION['user'] = $row['id'];
                $_SESSION['logged'] = true;
                $users = $_SESSION['user'];
                    header("Location:index.php");
            }else{
                $users = "Parole vai Epasts nav pareizs, mēģini vēlreiz!";
            }
        }
    }else{
        $users = "Lietotājs neeksistē";
    }
    if(!empty($users)){
        echo $users;
    }
}
}
?>