<?php
include "db.php";
function printSelected($conn){
$sql="SELECT * FROM examinsert";
$result = select($sql,$conn);
if($result){
    while($row =$result->fetch_assoc()){

    echo "<div class='box'>"
    .$row['vards'] .$row['uzvards'] . " </div>";
}
}
}
?>