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
                <p id="msg"></p>

            <?php
                $sql = "SELECT * FROM kategorijas";
                $result = $conn->query($sql);
            ?>
            <select id="cat_id" onchange="getInput()">
            <?php
                while($row = $result->fetch_assoc()){
                    echo "<option value = '".$row['id']."'>".$row['name']." "."</option>";
                }
            ?>
            </select>
        </div>
    </div>
    <script>
        function getInput(){
            let selVal = document.getElementById('cat_id').value;
            let msg = document.getElementById('msg');

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    msg.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "kategorijasSelect.php?id="+selVal, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>