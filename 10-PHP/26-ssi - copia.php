<?php 
    $title       = '26- Server Side Include';
    $description = 'Is used to include the content of one file into another.';

    include 'template/header.php';

    echo "<section>";

    require 'template/content.php';
    include_once 'template/content.php';
    require_once 'template/content.php';

    include 'template/footer.php'; 