<?php

$getRankings = "SELECT * FROM loginhelp ORDER BY currency DESC LIMIT 50";
$stmt = $conn->prepare($getRankings);
if (!$stmt) {
    die("Error preparing query: " . $conn->error);
}
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}
$result = $stmt->get_result();

$rank = 1;
while ($row = $result->fetch_assoc()) {
    //Sanitize the output for values before outputting to html. Prevents XSS attacks
    $currency = htmlspecialchars($row['currency'], ENT_QUOTES);
    $nickname = htmlspecialchars($row['nickname'], ENT_QUOTES);
    if ($rank > 3) {
        ?>
        <div class="flex flex-row gap-6 w-full border-y-4 md:border-8 border-[#e4c065] bg-slate-200 justify-center items-center text-center drop-shadow-lg">
            <div class="rankTitle w-1/4 h-10 flex text-center items-center justify-center">
                <p class='text-base sm:text-lg font-bold'>Rank</p>
            </div>
            <div class="rank w-1/4 h-10 flex text-center items-center justify-center">
                <p class='text-base sm:text-lg font-bold'><?php echo $rank; ?></p>
            </div>
            <div class="nick w-1/4 h-10 flex text-center items-center justify-center">
                <p class='text-base sm:text-lg font-bold'><?php echo $nickname; ?></p>
            </div>
            <div class="currency w-1/4 h-10 flex text-center items-center justify-center">
                <p class='text-base sm:text-lg font-bold'><?php echo $currency; ?></p>
            </div>
        </div>

        <?php
    }
    $rank++;
}
$stmt->close();
$conn->close();




