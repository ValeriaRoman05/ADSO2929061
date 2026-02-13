<?php 
    $title       = '17- Loop for';
    $description = 'Loop that repeats for a specific, predefined number of iterations.';

    include 'template/header.php';

    echo "<section style='display: flex; gap: 0.2rem'>";


    for ($i=1; $i <=40 ; $i++) { 
        if ($i % 5 == 0) {
            echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'>
                    $i
                  </p>";
            if($i == 25) continue;
            if($i == 30) break;
        }
    }

    include 'template/footer.php'; 