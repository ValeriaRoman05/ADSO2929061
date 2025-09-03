<?php
    //echo password_hash('admin', null);
    include 'config/app.php';
    include 'config/database.php';
    include 'config/redirect.php';
 
    include 'pages/login.php';
 
    $conx = null;