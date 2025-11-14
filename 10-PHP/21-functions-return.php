<?php 
    $title       = '21- Functions Return';
    $description = 'A function that sends a value back to the code that called it.';

    include 'template/header.php';

    echo "<section>";

    function calculateDivision($num1, $num2 = 5) {
        return "$num1 / $num2 equals: " . ($num1 / $num2) . "<br>" ;
    }

    echo calculateDivision(4, 10);
    echo calculateDivision(6);
    echo calculateDivision(64, 4);

    include 'template/footer.php'; 