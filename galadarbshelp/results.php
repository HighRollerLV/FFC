<?php
$title = "Results";
include "includes/views/components/header.php";
//    echo '<pre>';
//    print_r($row); // Display the fetched row data from UserBets
//    print_r($fighterRow); // Display the fetched row data from Fighter
//    print_r($row2); // Display the fetched row data from ufcResults
//    print_r($loginHelpRow); // Display the fetched row data from loginhelp
//    echo '</pre>';
?>
    <main class="pt-[5rem]">
        <div class="content w-full min-h-screen flex flex-col justify-center items-center pt-32">
            <?php include "controllers/getMoney.php"; ?>
        </div>
    </main>
<?php include "includes/views/components/footer.php"; ?>


