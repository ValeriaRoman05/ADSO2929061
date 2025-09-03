<?php   
// Sessiones
    session_start();
 
    // Routes Absolutes
    $url    = 'http://'.$_SERVER['HTTP_HOST'].'/';
   //$url   = 'http://'.$_SERVER['HTTP_HOST']. dirname($_SERVER['SCRIPT_NAME']) .  '/';
    $public = $url . 'public/';
    $css    = $public . 'css/';
    $js     =  $public . 'js/';
    $images =  $public . 'imgs/';
 
    // Date Base Config
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'tuamigoencasa';