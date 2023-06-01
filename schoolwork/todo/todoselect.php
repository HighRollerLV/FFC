<?php
include "verifyLogin.php";
function selectItems($conn){
$sql = "SELECT * FROM todo";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo "Nr:".$row["id"]." ".$row["productName"]." ".$row['productAmount'];
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM todo WHERE userId = $users";
    $result = $conn->query($sql);
}
?>