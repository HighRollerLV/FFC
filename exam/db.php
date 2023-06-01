<?php
$host = 'localhost';
$user = 'skolnieks';
$pass = 'pQcM10ClEn3lSWy';
$dbName = 'ralfsd';

$conn = new mysqli($host, $user, $pass, $dbName);

if($conn->connect_error){
    echo "Notikus kļūda savienojumā!";
}

// function delete($conn) {
//     if($conn){
//         $id = $_GET['id'];

//         $sql = "DELETE FROM products WHERE id='$id'";
//         if ($conn->query($sql) === TRUE) {
//             $insertDel = selectItems($conn);
//         }else{
//             $insertDel = "Radusies kluda luudzu labojies!";
//         }
//     }
//     echo $insertDel;    
//     }

// if($conn){
//         $id = $_GET['id'];

//         $sql = "DELETE FROM todo WHERE id='$id'";
//         if ($conn->query($sql) === TRUE) {
//             $insertDel = selectItems($conn);
//         }else{
//             $insertDel = "Radusies kluda luudzu labojies!";
//         }
//     }
//     echo $insertDel;
// ?>