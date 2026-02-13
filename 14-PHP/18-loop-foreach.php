<?php 
    $title       = '18- Loop foreach';
    $description = 'Loop that iterates over each element in an array.';

    include 'template/header.php';

    echo "<section>";


    $signs = ['♈️ Aries', '♉️ Tauro', '♊️ Geminis', '♋️ Cancer', '♌️ Leo','♍️ Virgo'];

    //var_dump($jobs);

    foreach ($signs as $sign) {
       echo "<p>$sign</p>";
    }

    include 'template/footer.php'; 