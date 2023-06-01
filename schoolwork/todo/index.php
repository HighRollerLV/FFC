<?php
   session_start();
   include "db.php";
   include "selectItem.php";
   include "verifyLogin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container row center">
        <div class="purple div"></div>
        <div class="medium-blue div"></div>
        <div class="light-blue div"></div>
        <div class="red div"></div>
        <div class="orange div"></div>
        <div class="yellow div"></div>
        <div class="cyan div"></div>
        <div class="light-green div"></div>
        <div class="lime div"></div>
        <div class="magenta div"></div>
        <div class="lightish-red div"></div>
        <div class="pink div"></div>
            <div class="box-position wrap">
                <div class="box">
                <form class="forms center col" id="form">
                    <h1 class="maintitle">TO-DO List</h1>
                    <img src="images/cart.png" class="cart">
                    <p class="inputText">Product</p>
                    <input type="text" class="inputArea" name="productName">
                    <p class="inputText">Product amount</p>
                    <input type="number" class="inputArea" name="productAmount">
                    <p class="inputText">Product price</p>
                    <input type="number" class="inputArea" name="productPrice">
                    <input type="date" id="start" name="creation" value="2022-12-08" min="2022-01-01">
                    <button class="glow-on-hover" type="button" onclick="getInput('todoInsert.php', event)">Submit!</button>
                    <p id="msg"></p>
                </form>
                </div>
                <div class="list col center" id="list"><div class="leftBox"><?php selectItems($conn);?></div></div>
            </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>