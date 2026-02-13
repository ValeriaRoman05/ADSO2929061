<?php 
    $title       = '14- Arrays Multidimensional';
    $description = 'Array that contains other nested arrays.';

    include 'template/header.php';

    echo "<section>";

    $bicycles = array(
        'Specialized' => array('Enduro', 'Stumjumper', 'Camber'),
        'Intense'     => array('Carbine', 'Tracer', 'Spider'),
        'Santa Cruz'  => array('Nomad', 'Megatower', 'Hightower')
    );

    //var_dump($bicycles);
    
     foreach ($bicycles as $key => $value) {
        echo "<h3> $key </h3>";
        echo "<ul>";
        foreach($value as $refer) {
            echo "<li>" . $refer . "</li>";
        }
        echo "</ul>";
    }
    
    include 'template/footer.php'; 