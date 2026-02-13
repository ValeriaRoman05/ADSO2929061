<?php 
    $title       = '19- Functions';
    $description = 'A block of code designed to perform a specific, reusable task.';

    include 'template/header.php';

    echo "<section>";

    function showInfo() {
        echo "<p> <b>Welcome:</b> John Wick </p>";
        echo "<p> Is an American action film series starring Keanu Reeves as a legendary hitman pulled out of retirement to seek revenge after the theft of his car and the killing of his puppy, a final gift from his deceased wife. </p>";
    }

    showInfo();
    showInfo();

    include 'template/footer.php'; 