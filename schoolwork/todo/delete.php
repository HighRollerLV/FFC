<?php
include "db.php";
include "dbOperations.php";
include "selectItem.php";
    if($conn){
        $id = $_GET['id'];

        $sql = "DELETE FROM todo WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $insertDel = selectItems($conn);
        }else{
            $insertDel = "Radusies kluda luudzu labojies!";
        }
    }
    echo $insertDel;
?>