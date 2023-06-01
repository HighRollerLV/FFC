<!-- Ajax POST Function -->
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
            <form id="form">
                <input type="text" name="name">
                <input type="text" name="lastname">
                <input type="number" name="age">
                <input type="number" min="1900" max="2030" step="1" value="2022" name="year">
                <button onclick="getInput()">Iesniegt</button>
                <p id="msg"></p>
            </form>
        </div>
    </div>
    <script>
        function getInput(){
            event.preventDefault();
            let form = document.getElementById('form')
            let formData = new FormData(form);
            let msg = document.getElementById('msg');

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    msg.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST", "test2.php", true);
            xmlhttp.send(formData);
        }
    </script>
</body>
</html>