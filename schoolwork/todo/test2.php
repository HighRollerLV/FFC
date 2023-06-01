<?php
// AJAX POST Function
    include "db.php";

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $year = $_POST["year"];
    echo $name ." ". $lastname . " " . $age . " " . $year . " ";

    $sql = "INSERT INTO `ajaxpost`( `name`, `lastname`, `age`, `year`) 
	VALUES ('$name','$lastname','$age','$year')";

    if($conn->query($sql)===TRUE){
        return true;
    }else{
        return false;
    }

?>