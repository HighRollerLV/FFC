<?php

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id='$id'";
    $texDel = insert($sql, $conn);
    if ($texDel === TRUE) {
        $inserdel = "Viss tika veiksmigi idzests!";
    } else {
        $insertdel = "Kluda! Neizdavas izdzest.";
    }
}
