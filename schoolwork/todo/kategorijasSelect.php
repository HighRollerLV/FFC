<?php
include "db.php";
$id = $_GET['id'];
$sql = "SELECT * FROM produkts WHERE cati_id = $id";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo $row['id']." ".$row['name'];
    }
?>