<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginHelp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container col center">
        <div class="box center col">
            <div class="register center col">
               <h1>Register</h1>
                    <form method="POST" class="forms center col" action="login.php">
                        <input type="email" placeholder="Email" required>
                        <input type="text" placeholder="Nickname" required>
                        <input type="password" placeholder="Password" required>
                        <input type="password" placeholder="Repeat Password" required>
                        <input type="submit" name="submit" value="Confirm">
                    </form>
            </div>
        </div>
    </div>
</body>
</html>