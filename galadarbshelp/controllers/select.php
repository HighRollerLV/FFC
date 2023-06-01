<?php

function printSelected($conn){
    $sql = "SELECT * FROM loginhelp";
    $results = select($sql, $conn);

    while($row = $results->fetch_assoc()){
        echo "
                <div class='box'>
                    <h2>".$row['nickname']."</h2>
                    <p>".$row['email']."</p>
                    <p>".$row['password']."</p>
                    <p>".$row['repeatpassword']."</p>
                </div>
        ";
    }
}


?>