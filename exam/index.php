<?php
    include "db.php";
    if(isset($_POST['submit'])){
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productPrice = $_POST['productPrice'];

        $category = $_POST['category'];
        $color = $_POST['color'];

        $sql1 = "SELECT id, category FROM productCategory";
        $result1 = $conn->query($sql1);

        $sql2 = "SELECT id, color FROM productColor";
        $result2 = $conn->query($sql2);

        $sql = "INSERT INTO products (productName, productDescription, productPrice, categoryId, colorId) 
        VALUES ('".$productName."', '".$productDescription."', '".$productPrice."', '".$category."', '".$color."')";
        $conn->query($sql);
    }
    // if (isset($_GET['delete'])) {
    //     $id = $_POST['id'];
    
    //     $sql = "DELETE FROM products WHERE id='$id'";
    //     $texDel = insert($sql, $conn);
    //     if ($texDel === TRUE) {
    //         $inserdel = "Viss tika veiksmigi idzests!";
    //     } else {
    //         $insertdel = "Kluda! Neizdavas izdzest.";
    //     }
    // }
    function insert($sql, $conn) {
        if($conn -> query($sql) ===TRUE){
            return true;
        }else{
            return false;
    }
    }
    function select($sql, $conn){
        $results = $conn->query($sql);
        if($results->num_rows > 0){
        return $results;
        }else{
        return false;
        }
    
    }
    function selectItems($conn){
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $i = 1;
        while($row = $result->fetch_assoc()){
            echo "<div class='itemsSelected row center'>"."<input type='submit' name='delete' value='delete'>"."Nr.".$i.
            " || Product name: ".$row['productName']." || Product Description: ".$row['productDescription']." || ".$row['productPrice']."&euro;".
            " || Product category: ".$row['categoryId']." || Product color: ".$row['colorId']."</div>";
            $i++;
        }
    }

    if (isset($_POST['update'])) {
        $productName1 = $_POST['productName1'];
        $productDescription1 = $_POST['productDescription1'];
        $productPrice1 = $_POST['productPrice1'];
        $id = $_POST['id1'];
    
        $sql = "UPDATE products SET id='$id', productName='$productName1', productDescription='$productDescription1', productPrice ='$productPrice1' WHERE id='$id'";
        $textUpd = insert($sql, $conn);
        if ($textUpd === TRUE) {
            $insertUpd = "Viss tika veiksmigi atjaunots!";
        } else {
            $insertUpd = "Kluda! Neizdavas atjaunot datus.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
</head>
<body>
    <h1>Products</h1>
    <form method="POST">
        <input type="text" name="productName" placeholder="Product Name">
        <input type="text" name="productDescription" placeholder="Product Description">
        <input type="number" name="productPrice" placeholder=" Product Price">
        <select name="category">
            <?php
                while($row = $result1->fetch_assoc()){
                    echo "<option value = '".$row['category']."'>". $row['category']. "</option>";
                    }
            ?>
        </select>
        <select name="color">
            <?php
                while($row = $result2->fetch_assoc()){
                    echo "<option value = '".$row['color']."'>". $row['color']. "</option>";
                    }
            ?>
        </select>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php selectItems($conn);?>
    <input type="text" name="id1" placeholder="id">
    <input type="text" name="productName1" placeholder="Product Name">
    <input type="text" name="productDescription1" placeholder="Product Description">
    <input type="number" name="productPrice1" placeholder="Product Price">
    <input type="submit" name="update" value="update">
</body>
</html>