<?php
function selectItems($conn){
    $users = $_SESSION['user'];
    $sql = "SELECT * FROM todo WHERE userId = '$users'";
    $result = $conn->query($sql);
    $i = 1;
    $total = 0;
    while($row = $result->fetch_assoc()){
        echo "<div class='itemsSelected row center'>".
        "<button class='glow-on-hover-items' id='delete' onclick='deleteItem(".$row['id'].")'>-</button>".
        "<p class='listItem center col'>"."Nr.".$i." || Name: ".$row['productName']." || Product-Count: "
        .$row['productAmount']." || ".$row['productPrice']."&euro;"." || ".$row['date']."</p>"."</div>";
        $total += $row['productAmount'] * $row['productPrice'];
        $i++;
    }
    echo "<div class='row center'>"."<p>"."Total: "."$total"."&euro;"."</p>"."</div>";
}
?>