<?php
    include "db.php";
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
    <div class="box-position">
        <div class="box">
            <form class="forms center col" id="form">
                        <input id="nickname" type="text" name="nickname" placeholder="Nickname" required>
                        <input id="email" type="email" name="email" placeholder="Email" required>
                        <input id="password" type="password" name="password" placeholder="Password" required>
                        <input id="repeatpassword" type="password" name="repeatpassword" placeholder="Repeat Password" required>
                        <button onclick="getInput()">Register</button>
            </form>
            <p id="msg"></p>
        </div>
    </div>
    <script>
        function getInput(){
            event.preventDefault();
            let nickname = document.getElementById('nickname').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let repeatpassword = document.getElementById('repeatpassword').value;

            console.log("nickname: " + nickname + " email:" + email + " password:" + password + " RepeatPassword:" + repeatpassword);
            let msg = document.getElementById('msg');

            var xmlhttp = new XMLHttpRequest();
            let form = document.getElementById('form');
            let formData = new FormData(form);
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    msg.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST", "reginsert.php", true);
            xmlhttp.send(formData);
        }
    </script>
</body>
</html>