<!-- Ajax GET Function -->
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
            <input type="text" id="name">
            <input type="text" id="lastname">
            <input type="text" id="nickname">
            <input type="text" id="middlename">
            <button onclick="getInput()" name="submit">Poga</button>
            <p id="msg"></p>
        </div>
    </div>
    <script>
        function getInput(){
            let nameVal= document.getElementById('name').value;
            let lastnameVal= document.getElementById('lastname').value;
            let nicknameVal= document.getElementById('nickname').value;
            let middlenameVal= document.getElementById('middlename').value;
            let msg = document.getElementById('msg');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    msg.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "test2.php?name=" + nameVal+"&lastname="+ lastnameVal + "&nickname="+ nicknameVal + "&middlename=" + middlenameVal, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>