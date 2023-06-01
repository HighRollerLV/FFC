<?php
session_start();
include "db.php";
include "verifyLogin.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container col center">
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
        <div class="box-login center col">
            <div class="register center col">
                <h1>Login</h1>
                    <form method="POST" class="forms center col">
                        <input type="email" class="inputArea" placeholder="Email" name="email" required>
                        <input type="password" class="inputArea" placeholder="Password" name="password" required>
                        <button class="glow-on-hover" name="login" id="button">Login</button>
                    </form>
            </div>
        </div>
    </div>
    <?php echo login($conn); ?>
</body>
</html>