<?php 
    $title       = '15- Loop while';
    $description = 'A loop that repeats code while condition is true';

    include 'template/header.php';

    echo "<section style='display: flex; gap: 0.2rem'>";

    $i = 1;

    while($i <= 10) {
        echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'>
                $i
              </p>";
        $i++;
    }

    include 'template/footer.php'; 