<?php
    session_start();
    include "db.php";
    include "selectItem.php";
    include "verifyLogin.php";
    $productName = $_POST['productName'];
    $productAmount = $_POST['productAmount'];
    $productPrice = $_POST['productPrice'];
    $date = $_POST['creation'];
    $userId = $_SESSION['user'];

    if(!empty($productName)&& !empty($productAmount)){
        $sql = "INSERT INTO todo (productName, productAmount, productPrice, userId, `date`) VALUES ('$productName', '$productAmount','$productPrice', '$userId', '$date')";
        if($conn->query($sql)===TRUE){
            $msg = selectItems($conn);

        }else{
            $msg = "Error data has not been added!";
        }
    }else{
        $msg = "Enter values in both fields!";
    }
    echo $msg;  
?>