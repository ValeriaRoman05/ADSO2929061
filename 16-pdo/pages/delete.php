<?php
include '../config/app.php';
include '../config/database.php';
include '../config/security.php';

if($_GET){
    $photo = obtenerPhoto($_GET['id'],$conx);
    if(deletePet($_GET['id'],$conx)){
        unlink("../uploads/".$photo['photo']);
        $_SESSION['message']= "la mascota fue eliminada con exito";
        echo "<script> window.location.replace('dashboard.php') </script>";
    }
}
?>