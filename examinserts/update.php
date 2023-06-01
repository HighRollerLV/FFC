<?php

if (isset($_POST['SubmitUpdate'])) {
    $newlietotajsvards = $_POST['newlietotajsvards'];
    $newlietotajsuzvards = $_POST['newlietotajsuzvards'];
    $id = $_POST['lietotajaid'];

    $sql = "UPDATE examinsert SET vards='$newlietotajsvards', uzvards='$newlietotajsuzvards' WHERE id='$id'";
    $textUpd = insert($sql, $conn);
    if ($textUpd === TRUE) {
        $insertUpd = "Viss tika veiksmigi atjaunots!";
    } else {
        $insertUpd = "Kluda! Neizdavas atjaunot datus.";
    }
}