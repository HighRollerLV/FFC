<?php
include "insert.php";
include "select.php";
include "delete.php";
include "update.php";
?>
<!-- INSERT START -->
<html>
<form method="POST">
    <input type="text" name="vards" placeholder="vards" required>
    <input type="text" name="uzvards" placeholder="uzvards" required>
    <input type="email" name="epasts" placeholder="epasts" required>
    <input type="submit" name="submit" value="submit">
</form>
<?php
    echo !empty($resultinsert) ? $resultinsert : "";
?>
<!-- INSERT END -->

<!-- SELECT -->
<?php
    echo printSelected($conn);

?>
<!-- SELECT -->



<!-- DELETE START-->
<form method="POST">
    <input type="number" name="lietotajaid">
    <input type="submit" name="SubmitDelete" value="delete">
</form>

<?php
    echo !empty($inserdel) ? $inserdel : "";
?>
<!-- DELETE END -->

<!-- UPDATE START -->
<form method="POST">
    <input type="number" name="lietotajaid">
    <input type="text" name="newlietotajsvards">
    <input type="text" name="newlietotajsuzvards">
    <input type="submit" name="SubmitUpdate" value="Update">
</form>

<?php
    echo !empty($insertUpd) ? $insertUpd : "";
?>
<!-- UPDATE END -->