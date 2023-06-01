<?php
include "db.php";
include "function.php";

if(isset($_POST['submit'])) {
    $vards= $_POST['vards'];
    $uzvards= $_POST['uzvards'];
    $epasts= $_POST['epasts'];

    $sql = "INSERT INTO examinsert (vards, uzvards, epasts) VALUES ('$vards', '$uzvards', '$epasts')"; 
    $result = insert($sql, $conn);
        if($result === true) {
            $resultinsert = "Dati ir pievienoti veiksmigi!";
        }else{
            $resultinsert = "Dati netika pievienoti";
    }
}
?>