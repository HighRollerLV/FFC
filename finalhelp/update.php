<?php

if (isset($_POST['SubmitUpdate'])) {
    $NewAnimalAge = $_POST['NewAnimalAge'];
    $AnimalName = $_POST['NewAnimalName'];
    $id = $_POST['AnimalID'];

    $sql = "UPDATE Animals SET AnimalAge='$NewAnimalAge', AnimalName='$AnimalName' WHERE id='$id'";
    $textUpd = insert($sql, $conn);
    if ($textUpd === TRUE) {
        $insertUpd = "Viss tika veiksmigi atjaunots!";
    } else {
        $insertUpd = "Kluda! Neizdavas atjaunot datus.";
    }
}



if (isset($_POST['SubmitDelete'])) {
    $id = $_POST['AnimalID'];

    $sql = "DELETE FROM Animals WHERE id='$id'";
    $texDel = insert($sql, $conn);
    if ($texDel === TRUE) {
        $inserdel = "Viss tika veiksmigi idzests!";
    } else {
        $insertdel = "Kluda! Neizdavas izdzest.";
    }
}