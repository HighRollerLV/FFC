<?php
// Ajax GET Function
    include "db.php";
    $name = $_GET['name'];
    $lastname = $_GET['lastname'];
    $nickname = $_GET['nickname'];
    $middlename = $_GET['middlename'];

    echo $name ." ". $lastname . " " . $nickname . " " . $middlename;

	$sql = "INSERT INTO `ajax`( `name`, `lastname`, `nickname`, `middlename`) 
	VALUES ('$name','$lastname','$nickname','$middlename')";

if($conn->query($sql)===TRUE){
    return true;
}else{
    return false;
}
?>