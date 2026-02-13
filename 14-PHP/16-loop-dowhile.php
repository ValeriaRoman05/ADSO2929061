<?php 
    $title       = '16- Loop do while';
    $description = 'Executes code once, then repeats if the condition remains true.';

    include 'template/header.php';

    echo "<section style='display: flex; gap: 0.2rem'>";

    $i = 1;

    do {
        if($i % 2 == 0) {
            echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'>
                    $i
                  </p>";
        }

        $i++;
    } while($i <= 18);

    include 'template/footer.php'; 